
@extends('layouts.master')

@section('content') 
<head>
    <link href="{{ asset("css/school.css") }}" rel="stylesheet">
</head>
<div class="schools_wrapper">
    @if ($school == NULL)
            <div class="joinSchool">
                <div class="joinSchool-title">Join School</div>
                <form class="joinShoolForm"  action="{{route('school.assignAdminToSchool')}} " method="POST"  enctype="multipart/form-data">
                    @csrf
                    {{-- @method('PUT') --}}
                {{-- <form class="joinShoolForm"  action="{{route('home')}}" method="POST" >
                        @csrf --}}
                        {{-- @method('PUT') --}}
                    <div class="inputPart">
                        <input oninput="verifyCode()" id="SchoolCode" type="text" name="code" placeholder="#Code">
                    </div>
                    <div class="submitPart">
                        <button class="btn trackingBtn btnColor" id="joinSubmit" disabled="true" type="submit">Join</button>
                    </div>
                </form>
            </div>
            @if (session('code'))
            <div class="alert alert-danger" role="alert">
                {{ session('code') }}
            </div>
            @endif
@if (Auth::user()->is_admin == 1)
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
          
    @else


    
      <div class="card" style="width: 90%;">
        <div class="card-body">
          <h5 class="card-title" style="color: #384850">{{$school->name}}<span class="card-code">#{{$school->code}}</span></h5>
          <!-- <h6 class="card-subtitle mb-2" style="color: #ffc107;">Secondary Schools</h6> -->
          <div class="card-map" id="map"></div>
          <div class="card-foot mt-2">
            {{-- <form action="{{route('driver.destroy',$drivers->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">DELETE</button>
            </form> --}}
            <form action="{{route('school.left',$school->id)}}" method="POST">
                @csrf
                <button class="btn trackingBtn btnColor" style="margin-right: 10px" type="submit">
                    Leave
                </button>
            </form>
            @if (Auth::user()->is_admin == 1)
            <form action="{{route('school.destroy',$school->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn trackingBtn btnColor" style="margin-right: 10px" type="submit">
                    Delete
                </button>
            </form>
            @endif
            {{-- <form action="" method="GET">
                <button class="btn trackingBtn btnColor" type="submit" onclick="">Update</button>
            </form> --}}
          </div>
        </div>
    </div>
    @endif

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
            },{timeout:10000})
        }


        verifyCode = () => {
            let field = document.getElementById('SchoolCode').value

            if(field == '')
            document.getElementById('joinSubmit').disabled = true
            else
            document.getElementById('joinSubmit').disabled = false 
        }
 


        let map = {}
        let url = window.location.search
        let tripId = url.split('?')[1]
        fetch('http://localhost:8000/api/school/location/' + tripId )
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
