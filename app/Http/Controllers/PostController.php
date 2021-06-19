<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post=Post::all();
       return view('crud.index')->with('post',$post);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:posts',
            'mobile'=>'required|min:11|max:11',
            'post'=>'required'
        ]);
        
        $post=new Post;
        $post->name=$request->input('name');
        $post->email=$request->input('email');
        $post->mobile=$request->input('mobile');
        $post->post=$request->input('post');
        if($request->has('image')){

            $file = $request->file('image');
           
            $extenstion= $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('image/',$filename);
            
            $post->image = $filename;
        }

        $post->save();

        
            return redirect('PostResources')->with('success','Inserted successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $PostResource)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $PostResource)
    {
        $id = $request->id;

        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'mobile'=>'required|min:11|max:11',
            'post'=>'required'
        ]);
        
        $post= Post::find($id);

        
        $post->name=$request->name;
        $post->email=$request->email;
        $post->mobile=$request->mobile;
        $post->post=$request->post;
        if($request->has('image')){

            $file = $request->file('image');
           
            $extenstion= $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('image/',$filename);
            
            $post->image = $filename;
        }
        
        $post->save();

            return back()->with('success','Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $PostResource)
    {
       $query= $PostResource->delete();
       if($query){
        return back()->with('success','Deleted successfully');
        }
    }
}
