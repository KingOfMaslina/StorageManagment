<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Post;
use App\Models\Worker;
use App\Tables\Workers;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        $post = Post::pluck('post','id')->toArray();
        return view ('worker.index',[
//            'workers' => SpladeTable::for(Worker::class)
//                ->withGlobalSearch(columns: ['name','last_name','father_name','post.post','phone','address_id'])
//                ->column('name',label: 'Имя' , sortable: true)
//                ->column('last_name',label: 'Фамилия' , sortable: true)
//                ->column('father_name',label: 'Отчество' , sortable: true)
//                ->column('post.post',label: 'Должность', sortable: true)
//                ->selectFilter('post_id', $post, label: 'Должность')
//                ->column('phone', label: 'Номер телефона', sortable: true)
//                ->column('email', label: 'Эл.Почта', sortable: true)
//                ->column('passport', label: 'Паспортные данные', sortable: true)
//                ->column('regaddress', label: 'Адрес прописки', sortable: true)
//                ->column('address_id', label: 'Фактический адрес', sortable: true)
//                ->column('action', label: 'Действия')
        'workers' => Workers::class,
        ]);
    }
    public function view($id){
        $worker = Worker::where('id',$id)->first();
        return view('worker.view', compact( 'worker'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $post = Post::pluck('post','id')->toArray();
        $address = Address::pluck('address')->toArray();
        return view('worker.create', compact('post','address'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $worker = new Worker();
    $checkaddress = $request->input('matching')==TRUE ? 1 : 0;
    $worker->name = $request->input('name');
    $worker->last_name = $request->input('last_name');
    $worker->father_name = $request->input('father_name');
    $worker->post_id = $request->input('post_id');
    $worker->phone = $request->input('phone');
    $worker->email = $request->input('email');
    $worker->passport = $request->input('passport');
    if ($checkaddress === 1) {
        $worker->regaddress =$request->input('regaddress');
        $worker->address_id = $request->input('regaddress');
    } else {
        $worker->regaddress = $request->input('regaddress');
        $worker->address_id = $request->input('address_id');
    }

    $worker->save();
    return redirect()->route('worker.index');
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
    public function edit(Worker $worker)
    {
        $post = Post::pluck('post','id')->toArray();
        $address = Address::pluck('address')->toArray();
        return view('worker.edit', compact('worker','post','address'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Worker $worker)
    {

        $checkaddress = $request->input('matching')==TRUE ? 1 : 0;
        $worker->name = $request->input('name');
        $worker->last_name = $request->input('last_name');
        $worker->father_name = $request->input('father_name');
        $worker->post_id = $request->input('post_id');
        $worker->phone = $request->input('phone');
        $worker->email = $request->input('email');
        $worker->passport = $request->input('passport');
        if ($checkaddress === 1) {
            $worker->regaddress =$request->input('regaddress');
            $worker->address_id = $request->input('regaddress');
        } else {
            $worker->regaddress = $request->input('regaddress');
            $worker->address_id = $request->input('address_id');
        }
        var_dump($checkaddress);
        $worker->save();
        return redirect()->route('worker.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Worker $worker)
    {
        $worker->delete();
        return redirect()->route('worker.index');
    }
}
