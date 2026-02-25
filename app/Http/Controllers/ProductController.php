<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at', 'DESC')->get();
        return view('products.list', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5',
            'sku' => 'required|min:3|unique:products,sku',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('products.create')
                ->withErrors($validator)
                ->withInput();
        }

        $product = new Product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/products'), $imageName);
            $product->image = $imageName;
            $product->save();
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5',
            'sku' => 'required|min:3|unique:products,sku,' . $product->id,
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('products.edit', $product->id)
                ->withErrors($validator)
                ->withInput();
        }

        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;

        if ($request->hasFile('image')) {
            if ($product->image && File::exists(public_path('uploads/products/' . $product->image))) {
                File::delete(public_path('uploads/products/' . $product->image));
            }
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/products'), $imageName);
            $product->image = $imageName;
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        if ($product->image && File::exists(public_path('uploads/products/' . $product->image))) {
            File::delete(public_path('uploads/products/' . $product->image));
        }
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }

    public function deleteAll()
    {
        try {
            DB::transaction(function () {
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                DB::delete('DELETE FROM products');
                DB::statement('ALTER TABLE products AUTO_INCREMENT = 1;');
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            });

            return redirect()->route('products.index')->with('success', 'All products deleted successfully!');
        } catch (\Exception $e) {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            return redirect()->route('products.index')->with('error', 'Failed to delete products: ' . $e->getMessage());
        }
    }
}
