@extends('layouts.app')

@section('content')
<div class="container">
    @php
        $pernahReviewBelum = DB::table('reviews')->where(['reviewer_id' => Auth::user()->id, 'receiver_id' => $member->id])->count();
    @endphp
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card"  >
                <div class="card-header" style="text-align: center">
                    <h2><strong> Team Member : {{$member->name}}</strong></h2>
                </div>

                <div class="card-body"  >
                    <img src="{{url('./images/' . $member->photo_profile)}}" alt="" width="200px" height="200px">
                    <br><br>


                    @if ($pernahReviewBelum == 0)
                        <div class="row">
                            <div class="col-md-12" style="text-align: center">

                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                    Review Player !
                                </button>

                            </div>
                        </div>
                    @else

                    <div class="row">
                        <div class="col-md-12" style="text-align: center">
                           <strong>You already review this player !</strong>

                        </div>
                    </div>
                    @endif


                    <form action="{{route('review.store',$member->id)}}" method="POST">
                        @csrf

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="color: black">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2 class="modal-title" id="exampleModalLabel" style="text-align: center">
                                        Review {{$member->name}}
                                    </h2>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body" style="text-align: center">

                                    <strong>Review Player</strong><br>
                                    <textarea name="reviewText" id="reviewText" cols="50" rows="5" required></textarea>
                                    <br>

                                    <label class="radio-inline">
                                        <i class="fa fa-thumbs-up" style="font-size: 20px;color: greenyellow"></i> <input type="radio" name="optradio" id="optradio" value="like" checked>
                                    </label>
                                    <label class="radio-inline">
                                        <i class="fa fa-thumbs-down" style="font-size: 20px;color: red"></i><input type="radio" name="optradio" id="optradio" value="dislike">
                                    </label>

                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                    <button class="btn btn-primary" type="submit">
                                        Submit
                                    </button>

                                </div>
                            </div>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
