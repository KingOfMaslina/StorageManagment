<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Provider;
use App\Models\Shipment;
use App\Models\Status;

use App\Tables\Shipments;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;

class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view ('shipment.index',[
            'shipments' => Shipments::class,
        ]);
    }
//    public function download(Request $request,$shipment)
//    {
//        return response()->download(storage_path('app/public/'.$shipment));
//    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $provider = Provider::pluck('name','id')->toArray();
        $status = Status::pluck('status','id')->toArray();
        return view('shipment.create', compact('provider','status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $shipment = new Shipment();
        $shipment-> provider_id = $request->input('provider_id');
        $shipment-> ship_date = $request->input('ship_date');
        $shipment-> status_id = $request->input('status_id');
//        if($request->hasFile('document')) {
//            $document = $request->file('document');
//            $filename = $document->getClientOriginalName();
//            $document->storeAs('public', $filename);
//            $shipment->document = $filename;
//        }
        $shipment-> save();
        return redirect()->route('shipment.index');
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
    public function edit(Shipment $shipment)
    {
        $product = Product::pluck('name','id')->toArray();
        $provider = Provider::pluck('name','id')->toArray();
        $status = Status::pluck('status','id')->toArray();
        return view('shipment.edit', compact('shipment','product','provider','status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shipment $shipment)
    {
        $shipment-> provider_id = $request->input('provider_id');
        $shipment-> ship_date = $request->input('ship_date');
        $shipment-> status_id = $request->input('status_id');
//        if($request->hasFile('document')) {
//            $document = $request->file('document');
//            $filename = $document->getClientOriginalName();
//            $document->storeAs('public', $filename);
//            $shipment->document = $filename;
//        }
        $shipment-> save();
        return redirect()->route('shipment.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shipment $shipment)
    {
        $shipment->delete();
        return redirect()->route('shipment.index');
    }
}
