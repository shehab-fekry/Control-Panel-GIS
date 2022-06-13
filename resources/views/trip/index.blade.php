

@extends('layouts.master')

@section('content')

<div class="tracking-wrapper">
    <div id="map" class="map">
        <img class="map-img" src="{{ asset("assets/images/tracking.svg") }}"/>
    </div>
        <div class="table">
            <div class="roow head_row">
                <div class="head_data">#</div>
                <div class="head_data">Location</div>
                <div class="head_data">Status</div>
                <div class="head_data">Route</div>
            </div>
            
            @foreach ($trips as $trip)
            <div class="roow">
                <div class="tdata">{{$trip->id}}</div>
                <div class="tdata">{{$trip->geofence}}</div>
                <div class="tdata">
                    <div class="status" style="<?php echo ($trip['status']>='1') ? 'background-color: #ffc017' : 'background-color: #384850'?>">
                        <?php echo ($trip['status']>='1') ? 'Active' : 'Inactive'; ?>
                    </div>
                </div>
                <div class="tdata">
                    <button class="btn trackingBtn"
                    onclick="initPreview('{{$trip->id}}')">
                        <img src="{{ asset("assets/images/preview.png") }}" width="25px" height="25px">
                        Preview
                    </button>
                    <button class="btn trackingBtn btn_live"  <?php echo ($trip['status']>='1') ? '' : 'disabled' ; ?>
                    onclick="initTrack('{{$trip->id}}')">
                        <img src="{{ asset("assets/images/tracking.png") }}" width="25px" height="25px">
                        <div class="text">
                            Live
                            <span class=" <?php echo ($trip['status']>='1') ? 'live-on' : 'live-off' ; ?> "></span>
                        </div>
                    </button>
                </div>
            </div>
            @endforeach

            @if($trips->count()<1) {{-- if no trips --}}
            <div class="roow">
            <center style="font-size:20px; padding:10px">There are no created<span style="color:#ffc017">trips</span>to show yet </center>
            </div>
            @endif


            <!-- <div class="">
                {{ $trips->links() }}
                {{-- <button>Previous</button>
                <button>Next </button> --}}
            </div> -->
        </div>

        <div class="createTrip">
            <form action="{{route('trip.store')}}" method="POST" class="createTripForm" enctype="multipart/form-data">
                @csrf
                <input oninput="verifyCreate()" id="location" name="geofence" type="text" placeholder="GeoFence Location">
                <button id="createTripSubmit" disabled="true" class="btn trackingBtn btnHover" type="submit">Create</button>
            </form>
        </div>

        <script>
            verifyCreate = () => {
                let field = document.getElementById('location').value

                if(field == '')
                document.getElementById('createTripSubmit').disabled = true
                else
                document.getElementById('createTripSubmit').disabled = false
            }
        </script>
</div>
@if (session('success'))
<div class="alertg hide">
<span class='fas fa-check-circle'></span>
<span class="msg">{{ session('success') }}</span>
<div class="close-btn">
   <span class="fas fa-times"></span>
</div>
</div>
@endif
<!-- tracking.js  -->
<script src="{{ asset("js/tracking.js") }}"></script>
@endsection
