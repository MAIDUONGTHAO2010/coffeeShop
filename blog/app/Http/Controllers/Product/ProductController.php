<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\File;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required|string',
            'name' => 'required|string',
            'price' => 'required',
            'size' => 'required|string',
            'image' => 'required',
            'category_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 404);
        }
        $resume = time() . '.' .  $request->file('image')->getClientOriginalExtension();
        $path = $request->file('image')->move(base_path() . '/storage/app/public', $resume);
        $product = new Product($request->all());
        $product->image = $resume;
        $product->save();
        return  response()->json($product);
    }
    public function index()
    {
        $listProduct =  Product::all();
        foreach ($listProduct as $key) {
            $key['image'] = env('APP_URL') . '/storage/' . $key['image'];
        }
        return $listProduct;
    }
}