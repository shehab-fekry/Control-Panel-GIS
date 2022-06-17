
@extends('layouts.master')

@section('content') 
<head><link href="{{ asset("css/school.css")}}" rel="stylesheet"></head>

<div class="schools_wrapper">
    @if (Auth::user()->school_id == NULL && Auth::user()->is_admin == 0) {{-- if user is a Clerk & if user is a school admin and not assigned to a school --}}
        <!-- Join School Card -->
        <div class="joinSchool">
            <div class="joinSchool-title">Join School</div>
            <form class="joinShoolForm"  action="{{route('school.assignAdminToSchool')}} " method="POST"  enctype="multipart/form-data">
                @csrf
                <div class="inputPart">
                    <input oninput="verifyCode()" id="SchoolCode" type="text" name="code" placeholder="#Code">
                </div>
                <div class="submitPart">
                    <button class="btn trackingBtn btnColor" id="joinSubmit" disabled="true" type="submit">Join</button>
                </div>
            </form>
        </div>
    @endif

    @if (session('code'))
    <div class="alert alert-danger" role="alert">
        {{ session('code') }}
    </div>
    @endif

    @if (Auth::user()->is_admin == 1 && Auth::user()->school_id == NULL) {{-- if user is a admin & if user is a school admin and not assigned to a school --}} 
    <!-- Create School Card -->
    <div class="createSchool"> 
        <div class="createSchool-title">Add New School</div>
        <form action="{{route('school.store')}}" method="POST" class="createShoolForm" enctype="multipart/form-data">
            @csrf
            <div class="inputPart">
                <input id="SchoolName" type="text" name="name" placeholder="School Name">
                <input type="hidden" name="location" id="hiddenInput" value="">
                <div id="location" name="location" class="btn red" onclick="getLocation()">Location</div>
            </div>
            <div class="submitPart">
                <button class="btn trackingBtn btnColor" id="submit" disabled="true" type="submit">Create</button>
            </div>
        </form>
    </div> 
    @endif         


    @if (Auth::user()->school_id  ==! NULL)  {{-- if user is assigned to a school --}}
    <!-- School Main Card -->
    <div class="card" style="width: 90%;" id="schoolCard">
        <div class="card-body">
            <h5 class="card-title" style="color: #384850">{{$school->name}} School<span class="card-code">#{{$school->code}}</span></h5>
            <div class="card-map" id="map"></div>
            <div class="card-foot mt-2">
            @if (Auth::user()->is_admin == 0) {{-- if user is a clerk --}}
                <form action="{{route('school.left',$school->id)}}" method="POST">
                    @csrf
                    <button class="btn trackingBtn btnColor" style="margin-right: 10px" type="submit">
                        Leave
                    </button>
                </form>
            @endif

            @if (Auth::user()->is_admin == 1) {{-- if user is a admin --}}
            <button class="btn trackingBtn btnColor" onclick="confirmDelete()">Delete</button>
            @endif
            </div>
        </div>
    </div>
    @endif
    
    <!-- Confirm Deletion Modal -->
    <div class="delete-modal" id="delete-modal">
        <div class="delete-modal-header">Are you sure you want to delete school?</div>
        <div class="delete-modal-body">
            this operation will also include deletion of all school related data.   
        </div>
        @if (Auth::user()->school_id  ==! NULL) {{-- if user is assigned to a school --}}
        <div class="delete-modal-footer">
            <button class="btn trackingBtn btnColor" style="margin-right: 10px" onclick="Cancel()">Cancel</button>
            <form action="{{route('school.destroy',$school->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn red" style="margin-right: 10px" type="submit">
                    Delete
                </button>
            </form> 
        </div>
        @endif
    </div>

    <!-- tracking.js  -->
    <script src=" {{ asset("js/school.js") }}"></script>
    <script>
        getLocation = () => {
            navigator.geolocation.getCurrentPosition(({coords: {latitude, longitude}}) => {
                // console.log([latitude, longitude])
                document.getElementById('hiddenInput').value = '' + [latitude, longitude]
                document.getElementById('location').style.backgroundColor = 'green'
                document.getElementById('location').innerHTML = 'Located'
                document.getElementById('location').setAttribute('disabled', true)

                let text1 = document.getElementById('SchoolName').value
                // let text2 = document.getElementById('schoolLevel').value

                if(text1 !== '')
                document.getElementById('submit').disabled = false;
            }, 
            (error) => {
                console.log(error)
            },{timeout:10000, enableHighAccuracy: true})
        }


        verifyCode = () => {
            let field = document.getElementById('SchoolCode').value

            if(field == '')
            document.getElementById('joinSubmit').disabled = true
            else
            document.getElementById('joinSubmit').disabled = false 
        }

        confirmDelete = () => {
            document.getElementById('schoolCard').style.display = 'none'
            document.getElementById('delete-modal').style.display = 'block'
        }

        Cancel = () => {
            document.getElementById('schoolCard').style.display = 'flex'
            document.getElementById('delete-modal').style.display = 'none'
        }


        let map = {}
        let url = window.location.search
        let tripId = url.split('?')[1]
        // replace this line when you are local
        // fetch('http://localhost:8000/api/school/location/' + tripId )
        // replace this line when you are remote
        // fetch('http://bustrackingh.herokuapp.com/api/school/location/' + tripId )
        fetch('http://bustrackingh.herokuapp.com/api/school/location/' + tripId )
        .then(schoolLocation => schoolLocation.json())
        .then(schoolLocation => {

            // Initializing the map 
            mapboxgl.accessToken = 'pk.eyJ1Ijoic2hlaGFiLWZla3J5IiwiYSI6ImNrejhva3M4czFmMW0ybnVzbDd3eXE5YmYifQ.bHRGTKh_1pdTl1RmsGmLSw';
                map = new mapboxgl.Map({
                container: document.getElementById('map'),
                style: 'mapbox://styles/shehab-fekry/cl0e4k50n002p14si2n2ctxy9',
                center: schoolLocation.data,
                zoom: 13
            });

            // Adding controls
            map.addControl(new mapboxgl.FullscreenControl());
            map.addControl(new mapboxgl.NavigationControl());

            // adding marker
            let marker = document.createElement('div');
            marker.classList = 'school';
            new mapboxgl.Marker(marker).setLngLat(schoolLocation.data).addTo(map);
        })
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

@if (session('error'))
<div class="alert alert-danger" role="alert">
    {{ session('error') }}
</div>
@endif
@endsection
