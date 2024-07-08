<?php

namespace App\Http\Controllers;

use App\Http\Requests\ManufacturerRequest;
use App\Models\Address;
use App\Models\Manufacturer;
use App\Tables\Manufacturers;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;

class ManufacturerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $address = Address::pluck('address','id')->toArray();
        return view ('manufacturer.index',[
//            'manufacturers' => SpladeTable::for(Manufacturer::class)
//                ->withGlobalSearch(columns: ['name','boss_last_name','boss_father_name','address.address','phone','boss'])
//                ->column('name',label: 'Название' , sortable: true)
//                ->column('boss', label: 'Имя директора', sortable: true)
//                ->column('boss_last_name',label: 'Фамилия' , sortable: true)
//                ->column('boss_father_name',label: 'Отчество' , sortable: true)
//                ->column('address.address', label: 'Адрес', sortable: true)
//                ->column('phone', label: 'Номер телефона', sortable: true)
//                ->column('email', label: 'Эл.почта', sortable: true)
//                ->column('inn', label: 'ИНН', sortable: true)
//                ->column('action', label: 'Действия')
        'manufacturers' => Manufacturers::class,
        ]);
    }
    public function view($id){
        $manufacturer = Manufacturer::where('id',$id)->first();
        return view('manufacturer.view', compact( 'manufacturer'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $address = Address::pluck('address','id')->toArray();
        return view('manufacturer.create', compact('address'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ManufacturerRequest $request)
    {
        $manufacturer = new Manufacturer();
        $manufacturer-> name = $request->input('name');
        $manufacturer-> boss = $request->input('boss');
        $manufacturer-> boss_last_name = $request->input('boss_last_name');
        $manufacturer-> boss_father_name = $request->input('boss_father_name');
        $manufacturer-> address_id = $request->input('address_id');
        $manufacturer-> phone = $request->input('phone');
        $manufacturer-> email = $request->input('email');
        $manufacturer-> inn = $request->input('inn');
        $manufacturer-> save();
        return redirect()->route('manufacturer.index');
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
    public function edit(Manufacturer $manufacturer)
    {
        $address = Address::pluck('address','id')->toArray();
        return view('manufacturer.edit', compact('manufacturer','address'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Manufacturer $manufacturer)
    {
        $manufacturer-> name = $request->input('name');
        $manufacturer-> boss = $request->input('boss');
        $manufacturer-> boss_last_name = $request->input('boss_last_name');
        $manufacturer-> boss_father_name = $request->input('boss_father_name');
        $manufacturer-> address_id = $request->input('address_id');
        $manufacturer-> phone = $request->input('phone');
        $manufacturer-> email = $request->input('email');
        $manufacturer-> inn = $request->input('inn');
        $manufacturer ->save();
        return redirect()->route('manufacturer.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Manufacturer $manufacturer)
    {
        $manufacturer->delete();
        return redirect()->route('manufacturer.index');
    }
}
