<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProviderRequest;
use App\Models\Address;
use App\Models\Provider;
use App\Tables\Providers;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $address = Address::pluck('address','id')->toArray();
        return view ('provider.index',[
//            'providers' => SpladeTable::for(Provider::class)
//                ->withGlobalSearch(columns: ['name','boss_last_name','boss_father_name','address.address','phone','boss'])
//                ->column('name',label: 'ФИО или название' , sortable: true)
//                ->column('business', label: 'Лицо', sortable: true)
//                ->selectFilter(key: 'business', label: 'Лицо', options: [
//                    'Частное' => 'Частное',
//                    'Юридическое' => 'Юридическое',
//                ])
//                ->column('boss', label: 'Имя директора', sortable: true)
//                ->column('boss_last_name',label: 'Фамилия' , sortable: true)
//                ->column('boss_father_name',label: 'Отчество' , sortable: true)
//                ->column('address.address', label: 'Адрес', sortable: true)
//                ->column('phone', label: 'Номер телефона', sortable: true)
//                ->column('email', label: 'Эл.почта', sortable: true)
//                ->column('inn', label: 'ИНН', sortable: true)
//                ->column('action', label: 'Действия')
                'providers' => Providers::class,
        ]);
    }
    public function view($id){
        $provider = Provider::where('id',$id)->first();
        return view('provider.view', compact( 'provider'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $address = Address::pluck('address','id')->toArray();
        return view('provider.create', compact('address'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProviderRequest $request)
    {
        $provider = new Provider();
        $provider->name = $request->input('name');
        $provider->business = $request->input('business');
        $provider->boss = $request->input('boss');
        $provider->boss_last_name = $request->input('boss_last_name');
        $provider->boss_father_name = $request->input('boss_father_name');
        $provider->address_id = $request->input('address_id');
        $provider->phone = $request->input('phone');
        $provider->email = $request->input('email');
        $provider->inn = $request->input('inn');
        $provider->save();
        return redirect()->route('provider.index');
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
    public function edit(Provider $provider)
    {
        $address = Address::pluck('address','id')->toArray();
        return view('provider.edit', compact('provider','address'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Provider $provider)
    {
        $provider->name = $request->input('name');
        $provider->business = $request->input('business');
        $provider->boss = $request->input('boss');
        $provider->boss_last_name = $request->input('boss_last_name');
        $provider->boss_father_name = $request->input('boss_father_name');
        $provider->address_id = $request->input('address_id');
        $provider->phone = $request->input('phone');
        $provider->email = $request->input('email');
        $provider->inn = $request->input('inn');
        $provider->save();
        return redirect()->route('provider.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Provider $provider)
    {
        $provider->delete();
        return redirect()->route('provider.index');
    }
}
