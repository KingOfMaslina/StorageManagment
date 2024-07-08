<?php

namespace App\Http\Controllers;


use App\Http\Requests\StatusRequest;
use App\Models\Status;
use App\Tables\Statuses;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('status.index',[
//            'statuses' => SpladeTable::for(Status::class)
//                ->column('status',label: 'Статус', sortable: true)
//                ->column('action',label:'Действие', canBeHidden: false)
//                ->withGlobalSearch(columns: ['status'])
//                ->paginate(10),
        'statuses' => Statuses::class,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('status.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StatusRequest $request)
    {
        $status = new Status();
        $status->status = $request->input('status');
        $status->save();
        return redirect()->route('status.index');
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
    public function edit(Status $status)
    {
        return view('status.edit', compact('status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Status $status)
    {
        $status->status = $request->input('status');
        $status->save();
        return redirect()->route('status.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Status $status)
    {
        $status->delete();
        return redirect()->route('status.index');
    }
}
