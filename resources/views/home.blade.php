@extends('layouts.app')

@section('content')
@php
    $leaderboard = DB::table('leaderboards')
@endphp
<div class="row">

    <div class="col-sm-1">

    </div>
    <div class="col-sm-3">

        <div class="row">
            <div class="card" style="width: 18rem;height: 300px;border-radius: 30px">
                <div class="card-body">
                  <h3 class="card-title" style="text-align: center">
                      <strong>Leaderboard</strong>
                  </h3>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <a href="#" style="color: orange"> <u>See More</u> </a>
                </div>
              </div>
        </div>
        <br>
        <div class="row">
            <div class="card" style="width: 18rem;height: 300px;border-radius: 30px">
                <div class="card-body">
                    <h3 class="card-title" style="text-align: center">
                        <strong>Recent Review</strong>
                    </h3>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>

                </div>
            </div>
        </div>

    </div>

    <div class="col-sm-5">
        <div class="row">
            <div class="col-sm-12" style="text-align: center">
                <h3 style="color: white">
                    <strong> <u>Latest Notification</u></strong>
                </h3>
            </div>

        </div>
        <br>

        <div class="row">
            <div class="col-sm-12" style="text-align: center">
                <div class="card" style="width: 500px;height: 100px;border-radius: 50px">
                    <div class="card-body">

                      <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>

                    </div>
                </div>
            </div>

        </div>

    </div>

    <div class="col-sm-2">
        <div class="row">
            <div class="row">
                <div class="card" style="width: 240px;height: 300px;border-radius: 30px">
                    <div class="card-body">


                    </div>
                </div>
            </div>
        </div>

        <div class="row"style="text-align: center">
            <h3 style="color: white" >
                <strong> <u>Player we suggest !</u></strong>
            </h3>

        </div>
        <br>

        <div class="row">
            <div class="col-sm-3">
                photo
            </div>

            <div class="col-sm-4">
                isi
            </div>

            <div class="col-sm-2">
                <i class="fa fa-plus" style="color: orange;font-size: 25px"></i>
            </div>
        </div>


    </div>

</div>
@endsection
