<?php

namespace FleetCart\Http\Controllers;

use FleetCart\Http\Requests\ApiProductRequest;
use FleetCart\Http\Requests\ApiPhotoRequest;
use FleetCart\Http\Resources\ApiCollection;
use FleetCart\Http\Resources\ApiContracts;
use FleetCart\Pricelist;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Modules\Core\Http\Requests\Request;
use Modules\Media\Entities\File;
use Modules\Product\Entities\Product;
use Modules\Support\Eloquent\Translatable;
use Modules\Product\Http\Controllers\Admin\ProductController;

class ApiController extends Controller
{
    public function index(): ApiCollection
    {
        return new ApiCollection(Pricelist::all());
    }

    public function updategoods(ApiProductRequest $request)
    {
//        $product = Product::where('erp_id', $request->codeERP)->first();
        if ($request->category_id) {
            $categories = array($request->category_id);
        } else {
            $categories = array();
        }
        Product::updateOrCreate(['erp_id' => $request->codeERP], [
            'name' => $request->name,
            'description' => $request->description,
            'slug' => $this->getSlugRules(),
            'erp_id' => $request->codeERP,
            "tax_class_id" => null,
            "is_active" => "1",
            "price" => "0",
            "special_price" => null,
            "special_price_start" => null,
            "special_price_end" => null,
            "sku" => null,
            "manage_stock" => "0",
            "qty" => null,
            "in_stock" => "1",

            "options" => [
                0 => [
                    "id" => null,
                    "name" => null,
                    "type" => null,
                    "is_required" => "0"
                ]
            ],
            "short_description" => null,
            "new_from" => null,
            "new_to" => null,
            'categories' => $categories
        ]);
        return response()->json('OK', 200);

    }

    private function getSlugRules()
    {
        $rules = ['sometimes'];

        $slug = Product::withoutGlobalScope('active')->value('slug');

        $rules[] = Rule::unique('products', 'slug')->ignore($slug, 'slug');

        return $rules;
    }

    public function uploadPhoto(ApiPhotoRequest $request)
    {
        $product = Product::where('erp_id', $request->header('codeERP'))->firstOrFail();
        $contentArr = explode(';', $request->header('Content-Disposition'));
        foreach ($contentArr as $content) {
            if (strpos($content, 'filename=')){
                $filename = trim(substr($content, 10), '"');
            }
        }
        $files = $request->allFiles();
        if (count($files) < 1) {
            return response()->json('No Files', 200);
        }
        foreach ($files as $file) {
            $path = Storage::putFile('media', $file);

            $fileModel = File::updateOrCreate([
              'filename' =>  $filename
            ],
            [
                'user_id' => 1,
                'disk' => config('filesystems.default'),
                'filename' => $filename,
                'path' => $path,
                'extension' => $file->guessClientExtension() ?? '',
                'mime' => $file->getClientMimeType(),
                'size' => $file->getClientSize(),
            ]);
            $product->files()->save($fileModel, ['zone' => 'base_image']);
        }


        return response()->json('OK', 200);
    }
}
