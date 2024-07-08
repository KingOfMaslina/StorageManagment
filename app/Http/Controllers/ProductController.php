<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Characteristic;
use App\Models\Manufacturer;
use App\Models\Post;
use App\Models\Product;
use App\Models\Worker;
use App\Tables\Products;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view ('product.index',[

        'products' => Products::class,
        ]);
    }
    public function view($id){
        $product = Product::where('id',$id)->first();
        $characteristics= Characteristic::where('product_id', $id)->get();
        return view('product.view', compact('product', 'characteristics'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::pluck('name','id')->toArray();
        $manufacturer = Manufacturer::pluck('name','id')->toArray();
        return view('product.create', compact('manufacturer','category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $product = new Product();
        $product->name = $request->input('name');
        $product->category_id = $request->input('category_id');
        $product->articul = $request->input('articul');
        $product->price = $request->input('price');
        $product->manufacturer_id = $request->input('manufacturer_id');
        $product->unit = $request->input('unit');
        if($request->hasFile('image'))
        {
            $names = [];
            foreach($request->file('image') as $image)
            {
                $filename = $image->getClientOriginalName();
                $image->storeAs('public', $filename);
                array_push($names, $filename);
            }
            $product->image = json_encode($names);
        }
        $product->quantity  = $request->input('quantity');
        $product->save();
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $category = Category::pluck('name','id')->toArray();
        $manufacturer = Manufacturer::pluck('name','id')->toArray();
        return view('product.edit', compact('product','manufacturer','category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product->name = $request->input('name');
        $product->category_id = $request->input('category_id');
        $product->articul = $request->input('articul');
        $product->price = $request->input('price');
        $product->manufacturer_id = $request->input('manufacturer_id');
        $product->unit = $request->input('unit');
        if($request->hasFile('image'))
        {
            $names = [];
            foreach($request->file('image') as $image)
            {
                $filename = $image->getClientOriginalName();
                $image->storeAs('public', $filename);
                array_push($names, $filename);
            }
            $product->image = json_encode($names);
        }
        $product->quantity = $request->input('quantity');
        $product->save();
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index');
    }
}
