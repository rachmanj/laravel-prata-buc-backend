<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit', 6);
        $name = $request->input('name');
        $description = $request->input('description');
        $categories = $request->input('categories');

        if ($id) {
            $product = Product::with(['category'])->find($id);

            if($product) {
                return ResponseFormatter::success(
                    $product,
                    'Data found'
                );
            } else {
                return ResponseFormatter::error(
                    null,
                    'Data not found',
                    404
                );
            }
        }

        $product = Product::with(['category']);

        if($name) {
            $product->where('name', 'like', '%' . $name . '%');
        }

        if($description) {
            $product->where('description', 'like', '%' . $description . '%');
        }

        if($categories) {
            $product->where('categories_id', $categories);
        }

        return ResponseFormatter::success(
            $product->paginate($limit),
            'Data success found'
        );
    }
}
