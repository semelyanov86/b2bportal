<?php

namespace Modules\Account\Http\Controllers;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\Cart\Cart;
use Modules\Order\Entities\Order;
use Illuminate\Database\Eloquent\Builder;
use Modules\Product\Entities\Product;
use Money\Money;
use \GuzzleHttp\Client;
use Modules\Order\Entities\OrderProduct;

class AccountOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groupId = auth()->user()->company_id;
        if ($groupId) {
            $orders = Order::whereHas('Contract', function ($query) use ($groupId){
                $query->where('company_id', 'like', $groupId);
            })->latest()->paginate(15);
        } else {
            $orders = auth()->user()
                ->orders()
                ->latest()
                ->paginate(15);
        }

        return view('public.account.orders.index', compact('orders'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = auth()->user()
            ->orders()
            ->with(['products', 'coupon', 'taxes'])
            ->where('id', $id)
            ->firstOrFail();

        return view('public.account.orders.show', compact('order'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = auth()->user()
            ->orders()
            ->with(['products', 'coupon', 'taxes'])
            ->where('id', $id)
            ->firstOrFail();

        \Cart::clear();
        $cart = \Cart::instance();

        Session::put('CurrentContract', $order->contract_id);
        Session::put('CurrentOrder', $id);
        $cart->orderId = $order->id;
        $cart->updateContract();
        foreach ($order->products()->get() as $item){
            $cart->store($item->product_id, $item->qty, [] );
        }

//        dump($cart);
        return view('public.account.orders.show', compact('order'));
    }


    public function send($id)
    {
        $order = auth()->user()
            ->orders()
            ->with(['products', 'coupon', 'taxes'])
            ->where('id', $id)
            ->firstOrFail();
        $result = array(
          'Order_codeERP' => $order->erp_id,
            'B2B_OrderNUM' => $order->id,
            'Contract_CodeERP' => $order->contract->erp_id,
            'order_lines' => $order->products->map(function ($item){
                return array(
                  'product_codeERP' =>  Product::whereId($item->product_id)->first()->erp_id,
                  'quantity' => $item->qty,
                  'price' => $item->unit_price->amount()
                );
            })->toArray()
        );
        $client = new Client();
       try {
            $response = $client->post(config('app.ERP_API'), [
                    'headers' => [
                        'token' => config('app.ERP_TOKEN'),
                        'Accept' => 'application/json',
                    ],
                    \GuzzleHttp\RequestOptions::JSON => $result
                ]
            );
        } catch (RequestException $exception) {
            info($exception->getMessage());
            return back()->with('error', 'Отправка Заказа временно невозможна. Повторите отправку через некоторое время');
        }
        if ($response->getStatusCode() == '200') {
            $resultRes = $response->getBody()->getContents();
            $collectRes = collect(json_decode($resultRes))->get('error');
            if ($collectRes) {
                info($collectRes->error_message);
                return back()->with('error', $collectRes->error_message);
            }
            if ($resultRes && !empty($resultRes)) {
                $this->updateProductTable($order, $resultRes);
            }
            return back()->with('success', 'Заказ успешно отправлен');
        } else {
            info($response->getStatusCode() . '-' . $response->getBody()->getContents());
            return back()->with('error', 'Произошла ошибка при отправке заказа');
        }

    }

    private function updateProductTable($order, $result)
    {
        $olderLines = collect(collect(json_decode($result))->get('order_lines'));
        if ($olderLines && $olderLines->first() && $olderLines->first()->id) {
            $order->products->each(function ($item, $key){
                $item->delete();
            });
            $olderLines->each(function($item) use ($order) {
                OrderProduct::create(
                    [
                        'order_id' => $order->id,
                        'product_id' => Product::where('erp_id', $item->product_codeERP)->first()->id,
                        'unit_price' => $item->price,
                        'qty' => $item->quantity,
                        'line_total' => $item->price * $item->quantity
                    ]
                );
            });
        }
        return $order;
    }
}
