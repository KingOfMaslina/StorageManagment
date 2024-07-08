<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Product;
use App\Tables\Categories;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::pluck('name','id')->toArray();
        return view('category.index',[
//           'categories' => SpladeTable::for(Category::class)
//               ->column('name',label: 'Категория', sortable: true)
//               ->column('product.name',label: 'Товар', sortable: true)
//               ->column('action',label:'Действие', canBeHidden: false)
//               ->withGlobalSearch(columns: ['name','product.name'])
//               ->paginate(10)
                'categories' => Categories::class,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $category = new Category();
        $category->name = $request->input('name');
        $category->save();
        return redirect()->route('category.index');
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
    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $category->name = $request->input('name');
        $category->save();
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('category.index');
    }
}
