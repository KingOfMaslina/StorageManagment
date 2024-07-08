<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Address;
use App\Models\Customer;
use App\Tables\Customers;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $address = Address::pluck('address','id')->toArray();
        return view ('customer.index',[
//            'customers' => SpladeTable::for(Customer::class)
//                ->withGlobalSearch(columns: ['name','boss_last_name','boss_father_name','address.address','phone','boss'])
//                ->column('name',label: 'ФИО или организация' , sortable: true)
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
        'customers' => Customers::class,
        ]);
    }
    public function view($id){
        $customer = Customer::where('id',$id)->first();
        return view('customer.view', compact( 'customer'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $address = Address::pluck('address','id')->toArray();
        return view('customer.create', compact('address'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRequest $request)
    {
        $customer = new Customer();
        $customer->name = $request->input('name');
        $customer->business = $request->input('business');
        $customer->boss = $request->input('boss');
        $customer->boss_last_name = $request->input('boss_last_name');
        $customer->boss_father_name = $request->input('boss_father_name');
        $customer->address_id = $request->input('address_id');
        $customer->phone = $request->input('phone');
        $customer->email = $request->input('email');
        $customer->inn = $request->input('inn');
        $customer->save();
        return redirect()->route('customer.index');
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
    public function edit(Customer $customer)
    {
        $address = Address::pluck('address','id')->toArray();
        return view('customer.edit', compact('customer','address'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $customer->name = $request->input('name');
        $customer->business = $request->input('business');
        $customer->boss = $request->input('boss');
        $customer->boss_last_name = $request->input('boss_last_name');
        $customer->boss_father_name = $request->input('boss_father_name');
        $customer->address_id = $request->input('address_id');
        $customer->phone = $request->input('phone');
        $customer->email = $request->input('email');
        $customer->inn = $request->input('inn');
        $customer->save();
        return redirect()->route('customer.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customer.index');
    }
}
