<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('e_commerce.products.index', compact('products'));
    }

    public function AdminIndex()
    {
        $products = Product::all();
        return view('e_commerce.products.show', compact('products'));
    }

    public function create()
    {
        return view('e_commerce.products.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Dapatkan file dari request
            $image = $request->file('image');
            // Buat nama file yang unik
            $imageName = time() . '_' . $image->getClientOriginalName();
            // Tentukan direktori tujuan
            $destinationPath = public_path('/images/products');
            // Pindahkan file ke direktori tujuan
            $image->move($destinationPath, $imageName);
            // Simpan nama file di database
            $validatedData['image'] = 'images/products/' . $imageName;
        }

        Product::create($validatedData);

        return redirect()->route('products.index')->with('success', 'Product added successfully!');
    }


    public function edit(Product $product)
    {
        return view('e_commerce.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product->fill($request->all());

        if ($request->hasFile('image')) {
            // Dapatkan file dari request
            $image = $request->file('image');
            // Buat nama file yang unik
            $imageName = time() . '_' . $image->getClientOriginalName();
            // Tentukan direktori tujuan
            $destinationPath = public_path('/images/products');
            // Pindahkan file ke direktori tujuan
            $image->move($destinationPath, $imageName);
            // Simpan nama file di database
            $validatedData['image'] = 'images/products/' . $imageName;
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');


    }
    public function show($id)
    {
        // Ambil produk berdasarkan ID
        $product = Product::findOrFail($id);

        // Kirim data produk ke view
        return view('e_commerce.products.overview', compact('product'));
    }

}
