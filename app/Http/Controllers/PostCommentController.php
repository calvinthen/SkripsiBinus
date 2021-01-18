<?php

namespace App\Http\Controllers;

use App\post_comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request,$id)
    {
        post_comment::create([
            'post_id' => $id ,
            'user_id' => Auth::user()->id,
            'comment' => $request->input('comment'),


        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\post_comment  $post_comment
     * @return \Illuminate\Http\Response
     */
    public function show(post_comment $post_comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\post_comment  $post_comment
     * @return \Illuminate\Http\Response
     */
    public function edit(post_comment $post_comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\post_comment  $post_comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, post_comment $post_comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\post_comment  $post_comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(post_comment $post_comment)
    {
        //
    }
}
