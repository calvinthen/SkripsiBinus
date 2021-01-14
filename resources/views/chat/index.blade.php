@extends('layouts.app')
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header"> Halaman chat with :  <strong>{{$user->name}}</strong> </div>

                <div class="card-body chat-overflow" id="chat" style="text-decoration: none">

                        <ul style=>
                            @foreach ($chat as $chats)
                                @php
                                    $sender = DB::table('users')->where('id','LIKE',$chats->sender_id)->first();

                                @endphp

                                @if($sender->name == Auth::user()->name)
                                    <li style="text-align: right;text-decoration: none">
                                        <strong>
                                            {{$sender->name}} <small>{{ \Carbon\Carbon::parse($chats->created_at)->format('d/m/Y H:i')}}</small>
                                        </strong><br>

                                        {{$chats->chat}}<br>

                                        <br><br>
                                    </li>

                                @else
                                    <li>
                                        <strong>
                                            {{$sender->name}} <small>{{ \Carbon\Carbon::parse($chats->created_at)->format('d/m/Y H:i')}}</small>
                                        </strong><br>

                                        {{$chats->chat}}<br>

                                        <br><br>
                                    </li>
                                @endif


                            @endforeach
                        </ul>



                    <br>

                </div>

                <div class="card-body">
                    <form action="{{route('user.send_chat',$user->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="chat" id="chat" placeholder="Send your chat" aria-label="Recipient's username" aria-describedby="basic-addon2" onkeyup="validate(this)">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit" name="send-chat" id="send-chat" disabled>Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<script>
    // $(document).ready(function()
    // {
    //     $('#send-chat').click(function(e){
    //         e.preventDefault();

    //         $.ajaxSetup({

    //             headers:
    //             {
    //                 'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')

    //             }
    //         });
    //         $.ajax({

    //             url: "{{url('home/user/friendlist/{id}/chat/send')}}",
    //             method: "POST",
    //             data: {chat: $("#chat").val()},
    //         })
    //     });
    // })

    function validate(obj) {
    if (obj.value.length > 0) {
        document.getElementById("send-chat").disabled = false;
    } else {
        document.getElementById("send-chat").disabled = true;
    }
}

</script>


