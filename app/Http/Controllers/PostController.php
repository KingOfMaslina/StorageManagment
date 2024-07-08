<?php

namespace App\Http\Controllers;


use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Tables\Posts;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('post.index',[
//            'posts' => SpladeTable::for(Post::class)
//                ->column('post',label: 'Должность', sortable: true)
//                ->column('action',label:'Действие', canBeHidden: false)
//                ->withGlobalSearch(columns: ['post'])
//                ->paginate(10),
        'posts' => Posts::class,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $post = new Post();
        $post->post = $request->input('post');
        $post->save();
        return redirect()->route('post.index');
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
    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $post->post = $request->input('post');
        $post->save();
        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index');
    }
}
