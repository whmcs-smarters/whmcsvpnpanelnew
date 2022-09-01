<?php
/* Smarty version 3.1.36, created on 2020-11-20 11:03:38
  from '/var/www/html/templates/six/map.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5fb7a28a46de69_31063036',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4757d4cfbf4c99ded73e00fb8b5e0609d4c8e823' => 
    array (
      0 => '/var/www/html/templates/six/map.tpl',
      1 => 1605870217,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fb7a28a46de69_31063036 (Smarty_Internal_Template $_smarty_tpl) {
?><style>
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
<?php echo '<script'; ?>
 src='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'><?php echo '</script'; ?>
>
<link href='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css' rel='stylesheet' />

<div id='map' style='width: 100%; height: 100%; position: fixed'></div>
<?php echo '<script'; ?>
>

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
                    'data': <?php echo $_smarty_tpl->tpl_vars['geodatajson']->value;?>

                    
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

<?php echo '</script'; ?>
>
<?php }
}
