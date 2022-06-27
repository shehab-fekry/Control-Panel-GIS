
@extends('layouts.master')

@section('content')
 
<head><link rel="stylesheet" href="{{ asset("css/tripDetails.css") }}"></head>

@if( $driver->count()>= 1) {{-- if there is at least one driver --}}
<div class="tripDetails-wrapper">
    <div class="card" style="width: 90%;">
        <div class="card-body">
            <h5 class="details-card-title" style="color: #384850">Trip Details<span class="card-code">#{{$trip->id}}  {{$trip->geofence}}</span></h5>
            
            <div id="map" class="card-map mb-2"></div>

            <div class="card-driver mb-3">
                <div class="driver-icon">
                    <img src="{{ asset("assets/images/user.png") }}">
                    Driver
                </div>
                <div class="driver-table">
                    <div class="driver-table-header">
                        <div class="driver-table-data">Identity</div>
                        <div class="driver-table-data">Name</div>
                        <div class="driver-table-data">Email</div>
                        <div class="driver-table-data">License</div>
                        <div class="driver-table-data">Phone</div>
                    </div>
                    
                    @foreach ( $driver as $drivers)
                    <div class="driver-table-row">
                        <div class="driver-table-data">
                            <img src="{{ asset($drivers->image_path) }}">
                        </div>
                        <div class="driver-table-data info">{{$drivers->name}}</div>
                        <div class="driver-table-data">{{$drivers->email}}</div>
                        <div class="driver-table-data">#{{$drivers->licenseNumber}}</div>
                        <div class="driver-table-data">{{$drivers->mobileNumber}}</div>
                    </div>
                    @endforeach
                </div>  
            </div>

            <div class="card-parents mb-3">
                <div class="parent-icon">
                    <img src="{{ asset("assets/images/user.png") }}">
                    Parents
                </div>
                <div class="parent-names">
                    @foreach ( $father as $fathers)
                        <div class="name-bubble">{{$fathers->name}}</div>
                        @foreach ($fathers->child()->where('status',1)->get()  as $childs )
                        <div class="name-bubble">{{$childs->name}}</div>
                    @endforeach
                    @endforeach
                </div>
            </div>

            <div class="card-childs"> 
                <div class="child-icon">
                    <img src="{{ asset("assets/images/user.png") }}">
                    Children
                </div>
                <div class="child-names"> 
                    @foreach ( $child->where('status',1) as $childs)
                    <div class="name-bubble">{{$childs->name}}</div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@if( $driver->count()<1) {{-- if no drivers --}}
    <img src="{{ asset("assets/images/Documents.svg") }}" width="100%" height="350px" style="margin-top:100px">
    <center style="font-size:20px"> There are no enough <span style="color:#ffc017">trip details</span> to show </center>
@endif

<script>
  // let url = window.location.search
  // let getQuery = url.split('?')[1] 
  // let Query = getQuery.split('=')[1]
  // console.log(Query)

  // let url = window.location.search
  // let tripId = url.split('?')[1]
  // console.log(tripId)

  let url = window.location.pathname
  let urlArray = url.split('/')
  let tripIndex = urlArray[urlArray.length-1]


  let map = {}
  fetch('http://bustrackingh.herokuapp.com/api/trip/preview/' + tripIndex)
  .then(data => data.json())
  .then(data => {

    console.log('tripDetails API: ', data)

    // Modifying data Object to the usable form
    let fathersArray = []
        let modifiedData = {}
        Object.keys(data.data.fathers).forEach(key => {
            fathersArray.push(data.data.fathers[key])
        })
        modifiedData.school = data.data.school
        modifiedData.fathers = fathersArray

    // creating (wayPoints) array for API porposes and specifying school location
    let {school, fathers} = modifiedData
    school.location = [school.location[1], school.location[0]]
    let waypts = [school.location, ...fathers.map(father => father.location)];
    let schoolLocation = waypts[0]
    
    // converting (wayPoints) to string and repeating (curb;) as many as wayPoints for API porposes
    let [curbString, wayPointString] = optinmizeAPI(waypts)

    console.log('from tracking API (wayPoints): ', waypts)
    console.log('from tracking API (wayPointString): ', wayPointString)

    // Initializing the map 
    mapboxgl.accessToken = 'pk.eyJ1Ijoic2hlaGFiLWZla3J5IiwiYSI6ImNrejhva3M4czFmMW0ybnVzbDd3eXE5YmYifQ.bHRGTKh_1pdTl1RmsGmLSw';
    map = new mapboxgl.Map({
    container: document.getElementById('map'),
    style: 'mapbox://styles/shehab-fekry/cl0e4k50n002p14si2n2ctxy9',
    center: schoolLocation,
    zoom: 10
    });


    // Adding controls
    map.addControl(new mapboxgl.FullscreenControl());
    map.addControl(new mapboxgl.NavigationControl());


    // Popups and Markers
    const renderHTML = (name, children) => {
            return children 
                ? `<strong style="color:#384850">Parent: ${name}</strong><ul>${children.map(s => `<li style="width:130px; color:#384850">${s}</li>`).join('')}</ul>`
                : `<strong style="color:#384850">${name}</strong>`
        }   

    [{...school, name: 'School', className: 'school'}, ...fathers].forEach(
        ({name, children, className='pickPoint', location}) => {
            const popup = new mapboxgl.Popup()
            .setHTML(renderHTML(name, children))
            .addTo(map);

            const marker = document.createElement('div');
            marker.classList = className;
            new mapboxgl.Marker(marker).setLngLat(location).setPopup(popup).addTo(map);
        }
    )

    // setting up routes and layers
    map.on('load', () => {
        map.addSource('route', {
            type: 'geojson',
            data: {
                type: 'FeatureCollection',
                features: [],
            }
        });
        
        map.addLayer(
            {
            id: 'routeline-active',
            type: 'line',
            source: 'route',
            layout: {
                'line-join': 'round',
                'line-cap': 'round'
            },
            paint: {
                'line-color': 'rgb(255, 196, 0)',
                'line-width': 8
            }
            },
            'waterway-label'
        );

        map.addLayer({
                id: 'routeArrows',
                type: 'symbol',
                source: 'route',
                layout: {
                    'symbol-placement': 'line',
                    'text-field': '➔',
                    'text-rotate': 0,
                    'text-keep-upright': false,
                    'symbol-spacing': 60,
                    'text-size': 11,
                    'text-offset': [0, -0.1],
                },
    
                paint: {
                    'text-color': 'rgb(49, 49, 49)',
                    'text-halo-width': 1,
                }
            });

    
        getDirections(curbString, wayPointString)
    });
  })
  .catch(err => console.log(err))

  
  getDirections = (curbString, wayPointString) => {
    let request = 'https://api.mapbox.com/directions/v5/'
    request += 'mapbox/driving/'
    request += '' + wayPointString
    request += '?access_token=' + mapboxgl.accessToken
    request += '&geometries=geojson'
    // request += '&approaches=' + curbString
    request += '&steps=true'
    request += '&overview=full'

    fetch(request)
    .then(res => res.json())
    .then(res => {
        setRouteLine(res.routes)
    })
    .catch(err => console.log(err))
}

setRouteLine = (routes) => {
    const routeLine = {
        type: 'FeatureCollection',
        features: [{
            properties: {},
            geometry: routes[0].geometry
        }]
    }
    map.getSource('route').setData(routeLine)
}


optinmizeAPI = (wayPoints) => {
    let wayPointString = ''
    let curbString = ''
    wayPoints.forEach(point => {
        wayPointString += point.join(',') + ';'
        curbString += 'curb;'
    })
    wayPointString = wayPointString.slice(0, -1);
    curbString = curbString.slice(0, -1)
    return [curbString, wayPointString]
}
</script>

@endsection
