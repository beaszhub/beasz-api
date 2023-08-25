<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Enums\Message\MessageSuccess;
use App\Enums\Message\MessageError;
use App\Libraries\Response;

use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {   
        // Get Products
        $products = new ProductCollection(
            Product::from('products as p')
                ->select('p.*')
                ->get()
        );

        // Response as success
        $success = (object) MessageSuccess::RETRIEVED;
        return Response::success($success->code, $products, trans($success->message, ['attribute' => trans('product list')]));
    }

    public function show($id)
    {
        // Get product
        $product = Product::find($id);

        // Check if product exist
        if (empty($product)) 
        {
            // Response as error
            $error = (object) MessageError::NOT_FOUND;
            return Response::error($error->code, [], trans($error->message, ['attribute' => trans('product')]));
        }

        // Get product resource
        $product = new ProductResource($product);

        // Response as success
        $success = (object) MessageSuccess::RETRIEVED;
        return Response::success($success->code, $product->withWrap(), trans($success->message, ['attribute' => trans('product')]));
    }
}
