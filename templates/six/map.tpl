<style>
    #header, #main-menu, .header-lined
    {
        display: none;
    }
    #main-body, #main-content
    {
        padding: 0px !important;
    }
    .container
    {
        width: 100%;
        padding: 0px;
    }
    canvas{
    width: 100% !important;
    height: 100%; position: fixed;}
    </style>
<script src='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css' rel='stylesheet' />

<div id='map' style='width: 100%; height: 100%; position: fixed'></div>
<script>

	mapboxgl.accessToken = 'pk.eyJ1IjoiYW1hcm5ld3NwYXJrIiwiYSI6ImNraDF4dHFzZDA1NXYyeW9pamkzdDF5MWUifQ.D2af5kGjaQbK_bjlaDyB3Q';
    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/light-v10',
        center: [0, 40.8],
        zoom: 1.2
    });

    map.on('load', function () {
        // Add an image to use as a custom marker
        map.loadImage(
            'https://docs.mapbox.com/mapbox-gl-js/assets/custom_marker.png',
            function (error, image) {
                if (error) throw error;
                map.addImage('custom-marker', image);
                // Add a GeoJSON source with 2 points
                map.addSource('points', {
                    'type': 'geojson',
                    'data': {$geodatajson}
                    
                });

                // Add a symbol layer
                map.addLayer({
                    'id': 'points',
                    'type': 'symbol',
                    'source': 'points',
                    'layout': {
                        'icon-image': 'custom-marker',
                        // get the title name from the source's "title" property
                        'text-field': ['get', 'title'],
                        'text-font': [
                            'Open Sans Semibold',
                            'Arial Unicode MS Bold'
                        ],
                        'text-offset': [0, 1.25],
                        'text-anchor': 'top'
                    }
                });
            }
        );
    });

</script>
