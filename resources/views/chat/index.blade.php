@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">Halaman chat with : <strong>{{$user->name}}</strong> </div>

                <div class="card-body chat-overflow">

                    <div>
                        <ul>
                            @foreach ($chat as $chats)
                                @php
                                    $sender = DB::table('users')->where('id','LIKE',$chats->sender_id)->first();
                                @endphp

                                <li>
                                    <strong>
                                        {{$sender->name}} Says:
                                    </strong><br>

                                    {{$chats->chat}}<br>
                                    Send in {{$chats->created_at}}
                                    <br><br>
                                </li>

                            @endforeach
                        </ul>
                    </div>


                    <br>

                </div>

                <div class="card-body">
                    <form action="{{route('user.send_chat',$user->id)}}" method="GET">
                        @csrf

                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="chat" id="chat" placeholder="Send your chat" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection



