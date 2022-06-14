
@extends('layouts.master')

@section('content')
<head>
    <link rel="stylesheet" href="{{ asset("css/editTrips.css") }}">
</head>
<div class="editTrips-wrapper">
    <div class="table">
        <div class="roow head_row">
            <div class="head_data">#</div>
            <div class="head_data">Location</div>
            <div class="head_data">Status</div>
            <div class="head_data tdata-btns">Action</div>
        </div>

        @if($trips)
        @foreach($trips as $trip )
        <div class="roow">
            <div class="tdata">{{$trip->id}}</div>
            <div class="tdata">{{$trip->geofence}}</div>
            <div class="tdata">
                <div class="status" style="<?php echo ($trip['status']>='1') ? 'background-color: #ffc017' : 'background-color: #384850'?>">
                    <?php echo ($trip['status']>='1') ? 'Active' : 'Inactive'; ?>
                </div>
            </div>
            <div class="tdata tdata-btns">
                <a href="{{route('trip.show',$trip->id)}}" class="btn trackingBtn">
                    Details
                </a>
                <button onclick="editTrip({{$trip->id}})" class="btn trackingBtn btn_live">
                    Edit
                </button>
                <form style="display:inline-block; padding:0px; margin:0px" action="{{route('trip.destroy',$trip->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn trackingBtn">
                        Delete
                    </button>
                </form>
            </div>
        </div>
        @endforeach
        @endif

        @if($trips->count() <1)
        <div class="roow">
        <center style="font-size:20px; padding:10px">There are no created<span style="color:#ffc017">trips</span>to show yet </center>
        </div>
        @endif
    </div>

    <div id="editTrip" style="display: none;" class="editTrip" data-before="dfefae">
            <form class="editTripForm"  action="{{route('trip.update',1)}} " method="POST"  enctype="multipart/form-data">
                @csrf
                @method('PUT')
            <input  name="geofence" id="location" oninput="verifyEdit()" type="text" placeholder="GeoFence Location">
            <input  id="hiddenTripId" type="hidden" name="tripId">
            <button id="editTripSubmit" class="btn trackingBtn btnHover" disabled="true" type="submit">Edit</button>
            </form>
    </div>

    <script>
        editTrip = (tripId) => {
            document.getElementById('editTrip').style.display = 'unset'
            document.getElementById('editTrip').setAttribute('data-before', 'Edit Trip #' + tripId)
            document.getElementById('hiddenTripId').value = tripId
        }


        verifyEdit = () => {
            let field = document.getElementById('location').value

            if(field == '')
            document.getElementById('editTripSubmit').disabled = true
            else
            document.getElementById('editTripSubmit').disabled = false
        }
    </script>
</div>
@endsection
