@if ($product->productCount->count() > 0)
    <div class="table-responsive">
        <table class="table">
            <tbody>
            @foreach ($product->productCount as $product)
                <tr>
                    <td><h5>{{$product->storage->name}}</h5></td>
                    <td><h5>{{$product->quantity}}</h5></td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@else
    <span class="ribbon bg-red">{{ trans('storefront::product_card.out_of_stock') }}</span>
@endif