<?php

namespace App\Http\Controllers;


use App\Http\Requests\CharacteristicRequest;
use App\Models\Characteristic;
use App\Models\Product;
use App\Tables\Characteristics;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;

class ChracteristicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $characteristics = Characteristic::where('product_id', $id);
        $product = Product::where('id', $id)->first();
        return view('characteristic.index',[
            'characteristics' => SpladeTable::for($characteristics)
                ->column('name',label: 'Название', sortable: true)
                ->column('value',label: 'Значение', sortable: true)
                ->column('action',label:'Действие', canBeHidden: false)
                ->withGlobalSearch(columns: ['name'])
                ->paginate(10),
        ],compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $product = Product::where('id', $id)->first();
        return view('characteristic.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,$id)
    {
        $characteristic = new Characteristic();
        $characteristic->product_id = $id;
        $characteristic->name = $request->input('name');
        $characteristic->value = $request->input('value');
        $characteristic->save();
        return redirect()->route('characteristic.index',$id);
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
    public function edit($id,Characteristic $characteristic)
    {
        $product = Product::where('id', $id)->first();
        return view('characteristic.edit', compact('product','characteristic'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id,Request $request, Characteristic $characteristic)
    {
        $characteristic->product_id = $id;
        $characteristic->name = $request->input('name');
        $characteristic->value = $request->input('value');
        $characteristic->save();
        return redirect()->route('characteristic.index',$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id,Characteristic $characteristic)
    {
        $characteristic->delete();
        return redirect()->route('characteristic.index',$id);
    }
}
