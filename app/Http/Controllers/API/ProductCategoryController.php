<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:product_categories']
        ]);

        $category = ProductCategory::create([
            'name' => $request->name
        ]);

        return ResponseFormatter::success(
            $category,
            'Product Category created'
        );
    }

    public function all(Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit', 6);
        $name = $request->input('name');
        $show_product = $request->input('show_product');

        if ($id) {
            $category = ProductCategory::with(['products'])->find($id);

            if($category) {
                return ResponseFormatter::success(
                    $category,
                    'Data category found'
                );
            } else {
                return ResponseFormatter::error(
                    null,
                    'Category not found',
                    404
                );
            }
        }

        $category = ProductCategory::query();

        if($name) {
            $category->where('name', 'like', '%' . $name . '%'); 
        }

        if($show_product) {
            $category->with('products');
        }

        return ResponseFormatter::success(
            $category->paginate($limit),
            'Data category found'
        );
    }
}
