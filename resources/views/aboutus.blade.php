@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="background: #8C949D">
                <div class="card-header" style="text-align: center"><strong><h3>{{ __('About Us') }}</h3></strong></div>

                <div class="card-body" style="background: #C4CAD0">

                    <button class="form-control" data-toggle="modal" data-target="#whatIsPlaymaker">
                        What is Playmaker ?
                    </button>

                    <br>
                    <button class="form-control" data-toggle="modal" data-target="#whyWeCreate">
                        Why we are making Playmaker ?
                    </button>
                    <br>

                    <button class="form-control" data-toggle="modal" data-target="#functionality">
                        Playmaker Functionality
                    </button>
                    <br>

                    <button class="form-control" data-toggle="modal" data-target="#creator">
                        Creator of Playmaker
                    </button>


                    <!-- Modal what is playmaker -->
                    <div class="modal fade" id="whatIsPlaymaker" tabindex="-1" role="dialog" aria-labelledby="whatIsPlaymaker" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="whatIsPlaymaker" style="text-align: center">What is Playmaker ?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Est earum voluptas distinctio quas
                                 eligendi eius nulla. Ea iure tempore perspiciatis
                                aspernatur architecto inventore obcaecati incidunt! Quibusdam iure provident eos commodi?
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                        </div>
                    </div>

                    <!-- Modal why we create playmaker -->
                    <div class="modal fade" id="whyWeCreate" tabindex="-1" role="dialog" aria-labelledby="whyWeCreate" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="whyWeCreate" style="text-align: center"> Why we are making Playmaker ? </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Est earum voluptas distinctio quas
                                 eligendi eius nulla. Ea iure tempore perspiciatis
                                aspernatur architecto inventore obcaecati incidunt! Quibusdam iure provident eos commodi?
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                        </div>
                    </div>

                    <!-- Modal Playmaker functionality -->
                    <div class="modal fade" id="functionality" tabindex="-1" role="dialog" aria-labelledby="functionality" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="functionality" style="text-align: center"> Playmaker Functionality </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Est earum voluptas distinctio quas
                                 eligendi eius nulla. Ea iure tempore perspiciatis
                                aspernatur architecto inventore obcaecati incidunt! Quibusdam iure provident eos commodi?
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                        </div>
                    </div>

                    <!-- Modal creator Playmaker -->
                    <div class="modal fade" id="creator" tabindex="-1" role="dialog" aria-labelledby="creator" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="creator" style="text-align: center"> Creator of Playmaker </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Est earum voluptas distinctio quas
                                 eligendi eius nulla. Ea iure tempore perspiciatis
                                aspernatur architecto inventore obcaecati incidunt! Quibusdam iure provident eos commodi?
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

@endsection

