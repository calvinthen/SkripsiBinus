@extends('layouts.app')

@section('content')

@php
    $comment = DB::table('post_comments')->where('post_id','LIKE',$post->id)->get();
@endphp
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" >
                <div class="card-header" style="text-align: center"> <h3><strong>Detail Post</strong></h3></div>

                <div class="card-body">
                    <img src="{{url('./images/' . $post->thumbnail)}}" alt="" width="250px" height="250px" style="text-align: center">

                    <p>{{$post->post}}</p>
                </div>
            </div>
            <br>

            @foreach ($comment as $comments)
            @php
                $orangYangComment = DB::table('users')->where('id','LIKE',$comments->user_id)->first();
            @endphp
            <div class="card">
                <div class="card-body">
                    {{$orangYangComment->name}} Comments : <br>
                    {{$comments->comment}}
                </div>
            </div>
            <br>
            @endforeach

            <div class="card">
                <div class="card-body">
                    <h2>Comment</h2>

                    <br>
                    <form action="{{route('comment.store',$post->id)}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <center>
                                    <button type="submit" class="btn btn-customBlack">
                                        {{ __('Comment') }}
                                    </button>
                                </center>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
