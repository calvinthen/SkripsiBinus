@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="background: #8C949D">
                <div class="card-header" style="text-align: center"> <h3><strong>Detail Post</strong></h3></div>

                <div class="card-body" style="background: #C4CAD0">
                    <img src="{{url('./images/' . $post->thumbnail)}}" alt="" width="250px" height="250px" style="text-align: center">

                    <p>{{$post->post}}</p>
                </div>
            </div>
            <br>

            <div class="card">
                <div class="card-body">
                    <h2>Comment</h2>

                    <br>
                    <form action="{{route('comment.store',$post->id)}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Comment
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
