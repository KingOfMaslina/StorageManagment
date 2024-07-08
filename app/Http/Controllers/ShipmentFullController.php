<?php

namespace App\Http\Controllers;


use App\Models\Product;
use App\Models\Shipment;
use App\Models\ShipmentFull;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;

class ShipmentFullController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $shipmentfull = ShipmentFull::where('shipment_id', $id);
        $shipment = Shipment::where('id', $id)->first();
        return view('shipmentfull.index',[
            'shipmentfulls' => SpladeTable::for($shipmentfull)
                ->column('product.name',label: 'Название', sortable: true)
                ->column('quantity',label: 'Количество', sortable: true)
                ->column('action',label:'Действие', canBeHidden: false)
                ->withGlobalSearch(columns: ['product.name'])
                ->paginate(10),
        ],compact('shipment'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $shipment = Shipment::where('id', $id)->first();
        $product = Product::pluck('name','id')->toArray();
        return view('shipmentfull.create',compact('shipment','product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,$id)
    {
        $shipmentfull = new ShipmentFull();
        $shipmentfull->shipment_id = $id;
        $shipmentfull->product_id = $request->input('product_id');
        $shipmentfull->quantity = $request->input('quantity');
        // Вызов модель Product
        $product = Product::find($shipmentfull->product_id);
        if($product) {
            $product->quantity += $shipmentfull->quantity;
            $product->save();
        }
        // конец модели Product
        $shipmentfull->save();
        return redirect()->route('shipmentfull.index',$id);
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
    public function edit($id,ShipmentFull $shipmentfull)
    {
        $shipment = Shipment::where('id', $id)->first();
        $product = Product::pluck('name','id')->toArray();
        return view('shipmentfull.edit',compact('shipment','product','shipmentfull'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id,ShipmentFull $shipmentfull)
    {
        $shipmentfull->shipment_id = $id;
        $shipmentfull->product_id = $request->input('product_id');
        $shipmentfull->quantity = $request->input('quantity');
                // Вызов модель Product
                $product = Product::find($shipmentfull->product_id);
                if($product) {
                    $oldQuantity = $product->quantity; //11
                    $quantityDifference = $shipmentfull->quantity - $oldQuantity; //2
                    $product->quantity += $shipmentfull->quantity;
                    $product->save();
                }
                // конец модели Product
        $shipmentfull->save();
        return redirect()->route('shipmentfull.index',$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id,ShipmentFull $shipmentfull)
    {
        $product = Product::find($id);
        if($product) {
            $product->quantity -= $shipmentfull->quantity;
            $product->save();
        }
        $shipmentfull->delete();
        return redirect()->route('shipmentfull.index',$id);
    }
}
