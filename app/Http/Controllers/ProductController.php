<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page = request('page', 1);
        $cacheKey = "products_page_$page";

        $products = Cache::remember($cacheKey, 3600, function () {
            return Product::paginate(3);
        });

        return view('pages.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'color' => 'required|in:red,black,white',
            'image' => 'nullable|image|max:2048|mimes:jpg,jpeg,png,gif',
        ]);

        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $data['image'] = $request->file('image')->storeAs('products', $fileName, 'public');
        }

        Product::create($data);

        $this->clearProductCache();

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('pages.products.show', compact('product') );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('pages.products.edit', compact('product') );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'color' => 'required|in:red,black,white',
            'image' => 'nullable|image|max:2048|mimes:jpg,jpeg,png,gif',
        ]);

        if ($request->hasFile('image')) {

            if ($product->image && \Storage::disk('public')->exists($product->image)) {
                \Storage::disk('public')->delete($product->image);
            }

            $fileName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $data['image'] = $request->file('image')->storeAs('products', $fileName, 'public');
        }

        $product->update($data);

        $this->clearProductCache();

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        $this->clearProductCache();
        $this->clearTrashCache();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    public function trash(){

        $page = request('page', 1);
        $cacheKey = "trash_page_$page";

        $products = Cache::remember($cacheKey, 3600, function () {
            return Product::onlyTrashed()->paginate(3);
        });

        return view('pages.products.trash', compact('products'));
    }

    public function restore($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $product->restore();

        $this->clearProductCache();
        $this->clearTrashCache();

        return redirect()->route('products.index')->with('success', 'Product restored successfully.');
    }

    public function forceDelete($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        if ($product->image && \Storage::disk('public')->exists($product->image)) {
            \Storage::disk('public')->delete($product->image);
        }
        $product->forceDelete();

        $this->clearTrashCache();

        return redirect()->route('products.index')->with('success', 'Product permanently deleted successfully.');
    }

    private function clearProductCache()
    {
        $total = Product::count();
        $lastPage = ceil($total / 3);

        Cache::forget("products_page_1");
        Cache::forget("products_page_{$lastPage}");
    }

    private function clearTrashCache()
    {
        $total = Product::onlyTrashed()->count();
        $lastPage = ceil($total / 3);

        Cache::forget("trash_page_1");
        Cache::forget("trash_page_{$lastPage}");
    }

}
