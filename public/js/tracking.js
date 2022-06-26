// MAPBOX API:
// https://api.mapbox.com/optimized-trips/v1/mapbox/driving/
// 31.100643,29.961999;31.017168,29.972186;30.987176,29.986906;30.954218,29.969212;30.904958,29.96475
// ?access_token=pk.eyJ1Ijoic2hlaGFiLWZla3J5IiwiYSI6ImNrejhva3M4czFmMW0ybnVzbDd3eXE5YmYifQ.bHRGTKh_1pdTl1RmsGmLSw
// &geometries=geojson&approaches=curb;curb;curb;curb;curb&steps=true&overview=full


let state = {
    channel: {},
    previewMap: {},
    trackingMap: {},
    marker: {},
    prevStep: {},
    currentStep: {},
    mapLoaded: false,
    locationIndex: 0,
    action: '',
    tripID: 0,
}
 

// ----------------------------------------------- Live Track -----------------------------------------------------

let pusher = new Pusher('a7171d09fe99b7303a96', {cluster: 'eu'});

const initTrack = (tripIndex) => {
    // reblace this line when you are local
    // fetch('http://localhost:8000/api/trip/live/' + tripIndex)
    fetch('http://bustrackingh.herokuapp.com/api/trip/live/' + tripIndex)
    .then(data => data.json())
    .then(data => {

        console.log('from tracking API: ', data)

        // Modifying data Object to the usable form
        let fathersArray = []
        let modifiedData = {}
        Object.keys(data.data.fathers).forEach(key => {
            fathersArray.push(data.data.fathers[key])
        })
        modifiedData.school = data.data.school
        modifiedData.fathers = fathersArray


        // changing flags and channel
        state.mapLoaded = false
        state.tripID = tripIndex
        state.locationIndex = 0
        state.action = 'tracking'
        changeChannel()
        
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
        state.trackingMap = new mapboxgl.Map({
            container: document.getElementById('map'),
            style: 'mapbox://styles/shehab-fekry/cl0e4k50n002p14si2n2ctxy9',
            center: schoolLocation,
            zoom: 13
            });

        // adding controls
        state.trackingMap.addControl(new mapboxgl.FullscreenControl());
        state.trackingMap.addControl(new mapboxgl.NavigationControl());

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
                .addTo(state.trackingMap);

                const marker = document.createElement('div');
                marker.classList = className;
                new mapboxgl.Marker(marker).setLngLat(location).setPopup(popup).addTo(state.trackingMap);
            }
        )
        

        // setting up routes and layers
        state.trackingMap.on('load', () => {
            state.trackingMap.addSource('route', {
                type: 'geojson',
                data: {
                    type: 'FeatureCollection',
                    features: [],
                }
            });
            
            state.trackingMap.addLayer(
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

            state.trackingMap.addLayer({
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

        
            getDirections(curbString, wayPointString, state.action)
            state.mapLoaded = true
        })
    })
    .catch(err => console.log(err))
}


const changeChannel = () => {
    Pusher.logToConsole = true;
    state.channel = pusher.subscribe('trip.' + state.tripID);
    state.channel.bind("triplocation", async (data) => {
        if (!state.mapLoaded) return

        console.log('from pusher map channel: ', data)
        let langLong = [data.latitude, data.longitude]

        console.log('langLong', langLong)

        // Styling the previous steps
        if(state.locationIndex !== 0)
        {
            state.prevStep = state.marker.getElement()
            state.prevStep.className = 'prevStep mapboxgl-marker mapboxgl-marker-anchor-center'
        }

        // Drawing the current step
        state.currentStep = document.createElement('div');
        state.currentStep.classList = 'currentStep';
        state.marker = new mapboxgl.Marker(state.currentStep).setLngLat([langLong[1],langLong[0]]).addTo(state.trackingMap);

        // Drwing the new current step
        state.trackingMap.flyTo({
            // These options control the ending camera position: centered at
            // the target, at zoom level 9, and north up.
            center: langLong,
            zoom: 13,
            bearing: 0,
            
            // These options control the flight curve, making it move
            // slowly and zoom out almost completely before starting
            // to pan.
            speed: 0.7, // make the flying slow
            curve: 1, // change the speed at which it zooms out
            
            // This can be any easing function: it takes a number between
            // 0 and 1 and returns another number between 0 and 1.
            easing: (t) => t,
            
            // this animation is considered essential with respect to prefers-reduced-motion
            essential: true
        })
        state.locationIndex += 1
    })
}




















// ----------------------------------------------- Preview -----------------------------------------------------

const initPreview = (tripIndex) => {
    fetch('http://bustrackingh.herokuapp.com/api/trip/preview/' + tripIndex)
    .then(data => data.json())
    .then(data => {

        console.log('from preview API: ', data)

        // Modifying data Object to the usable form
        let fathersArray = []
        let modifiedData = {}
        Object.keys(data.data.fathers).forEach(key => {
            fathersArray.push(data.data.fathers[key])
        })
        modifiedData.school = data.data.school
        modifiedData.fathers = fathersArray

        // changing flags
        state.action = 'preview'

        // creating (wayPoints) array for API porposes and specifying school location
        let {school, fathers} = modifiedData
        school.location = [school.location[1], school.location[0]]
        let waypts = [school.location, ...fathers.map(father => father.location)];
        let schoolLocation = waypts[0]
        
        // converting (wayPoints) to string and repeating (curb;) as many as wayPoints for API porposes
        let [curbString, wayPointString] = optinmizeAPI(waypts)
        // Initializing the map 
        mapboxgl.accessToken = 'pk.eyJ1Ijoic2hlaGFiLWZla3J5IiwiYSI6ImNrejhva3M4czFmMW0ybnVzbDd3eXE5YmYifQ.bHRGTKh_1pdTl1RmsGmLSw';
        state.previewMap = new mapboxgl.Map({
        container: document.getElementById('map'),
        style: 'mapbox://styles/shehab-fekry/cl0e4k50n002p14si2n2ctxy9',
        center: schoolLocation,
        zoom: 10
        });


        // Adding controls
        state.previewMap.addControl(new mapboxgl.FullscreenControl());
        state.previewMap.addControl(new mapboxgl.NavigationControl());


        // Popups and Markers
        const renderHTML = (name, children) => {
            return children 
                ? `<strong>${name}</strong><ul>${children.map(s => `<li>${s}</li>`).join('')}</ul>`
                : `<strong>${name}</strong>`
        }   

        [{...school, name: 'School', className: 'school'}, ...fathers].forEach(
            ({name, children, className='pickPoint', location}) => {
                const popup = new mapboxgl.Popup()
                .setHTML(renderHTML(name, children))
                .addTo(state.previewMap);

                const marker = document.createElement('div');
                marker.classList = className;
                new mapboxgl.Marker(marker).setLngLat(location).setPopup(popup).addTo(state.previewMap);
            }
        )

        // setting up routes and layers
        state.previewMap.on('load', () => {
            state.previewMap.addSource('route', {
                type: 'geojson',
                data: {
                    type: 'FeatureCollection',
                    features: [],
                }
            });
            
            state.previewMap.addLayer(
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

            state.previewMap.addLayer({
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

        
            getDirections(curbString, wayPointString, state.action)
        });
    })
    .catch(err => console.log(err))
}



const getDirections = (curbString, wayPointString, action) => {
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
        console.log(res)
        setRouteLine(res.routes, action)
    })
    .catch(err => console.log(err))
}

const setRouteLine = (routes, action) => {
    const routeLine = {
        type: 'FeatureCollection',
        features: [{
            properties: {},
            geometry: routes[0].geometry
        }]
    }
    if(action === 'preview')
    state.previewMap.getSource('route').setData(routeLine)
    else
    state.trackingMap.getSource('route').setData(routeLine)
}


const optinmizeAPI = (wayPoints) => {
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