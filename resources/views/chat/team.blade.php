@extends('layouts.app')

<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Team Message : <strong> {{$team->team_name}}</strong> </div>

                <div class="card-body chat-overflow" id ="chat">

                    <div>
                        <ul>
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
                    </div>
                    <br>
                </div>

                <div class="card-body">
                    <form action="{{route('team.send_chat',$team->id)}}" method="GET">
                        @csrf

                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="chat" id="chat" placeholder="Send your message" aria-label="Recipient's username" aria-describedby="basic-addon2" onkeyup="validate(this)">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit" id="send-chat" name="send-chat" disabled>Send</button>

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

function validate(obj) {
    if (obj.value.length > 0) {
        document.getElementById("send-chat").disabled = false;
    } else {
        document.getElementById("send-chat").disabled = true;
    }
}

</script>
