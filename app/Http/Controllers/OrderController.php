<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderFull;
use App\Models\Product;
use App\Models\Status;
use App\Models\Worker;
use App\Tables\Orders;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\QueryBuilder;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view ('order.index',[
        'orders' => Orders::class
        ]);
    }
    public function view($id){
        $order = Order::where('id',$id)->first();
        $orderfulls = OrderFull::where('order_id',$id)->get();
        return view('order.view', compact( 'order','orderfulls'));
    }
//    public function download(Request $request,$order)
//    {
//        return response()->download(storage_path('app/public/'.$order));
//    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customer = Customer::pluck('name','id')->toArray();
        $worker = Worker::pluck('last_name','id')->toArray();
        $status = Status::pluck('status','id')->toArray();
        return view('order.create', compact('customer','worker','status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $order = new Order();
        $order-> customer_id = $request->input('customer_id');
        $order-> worker_id = $request->input('worker_id');
        $order-> order_date = $request->input('order_date');
        $order-> entry_date = $request->input('entry_date');
        $order-> status_id = $request->input('status_id');
//        if($request->hasFile('document')) {
//            $document = $request->file('document');
//            $filename = $document->getClientOriginalName();
//            $document->storeAs('public', $filename);
//            $order->document = $filename;
//        }
        $order-> save();
        return redirect()->route('order.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $customer = Customer::pluck('name','id')->toArray();
        $product = Product::pluck('name','id')->toArray();
        $worker = Worker::pluck('last_name','id')->toArray();
        $status = Status::pluck('status','id')->toArray();
        return view('order.edit', compact('order','customer','product','worker','status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $order-> customer_id = $request->input('customer_id');
        $order-> worker_id = $request->input('worker_id');
        $order-> order_date = $request->input('order_date');
        $order-> entry_date = $request->input('entry_date');
        $order-> status_id = $request->input('status_id');
//        if($request->hasFile('document')) {
//            $document = $request->file('document');
//            $filename = $document->getClientOriginalName();
//            $document->storeAs('public', $filename);
//            $order->document = $filename;
//        }
        $order-> save();
        return redirect()->route('order.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('order.index');
    }
}
