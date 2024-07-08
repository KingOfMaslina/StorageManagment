<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Models\Address;
use App\Tables\Addresses;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('address.index',[
//            'addresses' => SpladeTable::for(Address::class)
//                ->column('address',label: 'Адрес', sortable: true)
//                ->column('action',label:'Действие', canBeHidden: false)
//                ->withGlobalSearch(columns: ['address'])
//                ->paginate(10)
        'addresses' => Addresses::class,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('address.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddressRequest $request)
    {
        $address = new Address();
        $address->address = $request->input('address');
        $address->save();
        return redirect()->route('address.index');
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
    public function edit(Address $address)
    {
        return view('address.edit', compact('address'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Address $address)
    {
        $address->address = $request->input('address');
        $address->save();
        return redirect()->route('address.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address)
    {
        $address->delete();
        return redirect()->route('address.index');
    }
}
