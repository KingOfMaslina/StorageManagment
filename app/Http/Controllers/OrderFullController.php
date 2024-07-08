<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderFullRequest;
use App\Models\Order;
use App\Models\OrderFull;
use App\Models\Product;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;

class OrderFullController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $orderfull = OrderFull::where('order_id', $id);
        $order = Order::where('id', $id)->first();
        return view('orderfull.index',[
            'orderfulls' => SpladeTable::for($orderfull)
                ->column('product.name',label: 'Название', sortable: true)
                ->column('quantity',label: 'Количество', sortable: true)
                ->column('action',label:'Действие', canBeHidden: false)
                ->withGlobalSearch(columns: ['product.name'])
                ->paginate(10),
        ],compact('order'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $order = Order::where('id', $id)->first();
        $product = Product::pluck('name','id')->toArray();
        return view('orderfull.create',compact('order','product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,$id)
    {
        $orderfull = new OrderFull();
        $orderfull->order_id = $id;
        $orderfull->product_id = $request->input('product_id');
        $orderfull->quantity = $request->input('quantity');
                // Вызов модель Product
                $product = Product::find($orderfull->product_id);
                if($product) {
                    $product->quantity -= $orderfull->quantity;
                    $product->save();
                }
                // конец модели Product
        $orderfull->save();
        return redirect()->route('orderfull.index',$id);
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
    public function edit($id, OrderFull $orderfull)
    {
        $order = Order::where('id', $id)->first();
        $product = Product::pluck('name','id')->toArray();
        return view('orderfull.edit',compact('order','product','orderfull'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id, OrderFull $orderfull)
    {
        $orderfull->order_id = $id;
        $orderfull->product_id = $request->input('product_id');
        $orderfull->quantity = $request->input('quantity');
        $orderfull->save();
        return redirect()->route('orderfull.index',$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, OrderFull $orderfull)
    {
        $orderfull->delete();
        return redirect()->route('orderfull.index',$id);
    }
}
