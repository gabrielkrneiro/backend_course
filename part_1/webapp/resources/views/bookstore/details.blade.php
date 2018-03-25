@extends('index')

@section('conteudo')
    <div>
        @if(get_class($bookstore) == get_class(new Error()))
            <h1 class="text-center">This object not exists</h1>
        @else
            <h1 class="text-center"> {{ $bookstore->getName() }} </h1>
            <p class="text-center"> {{ $bookstore->getAddress() }} </p>
        @endif
    </div>
        <!DOCTYPE html>
<html>
<head>
    <title>Geocoding service</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
            height: 50%;
            width: 30%;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        /* Optional: Makes the sample page fill the window. */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        #floating-panel {
            position: absolute;
            top: 10px;
            left: 25%;
            z-index: 5;
            background-color: #fff;
            padding: 5px;
            border: 1px solid #999;
            text-align: center;
            font-family: 'Roboto','sans-serif';
            line-height: 30px;
            padding-left: 10px;
        }
    </style>
</head>
<body>
<div id="floating-panel" class="hidden">
    <input id="address" type="textbox" value="{{ $bookstore->getAddress() }}">
    <input id="submit" type="button" value="Geocode">
</div>
<div id="map"></div>

<script>
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: {lat: -34.397, lng: 150.644}
        });
        var geocoder = new google.maps.Geocoder();

        document.getElementById('submit').addEventListener('click', function() {
            geocodeAddress(geocoder, map);
        });
    }

    function geocodeAddress(geocoder, resultsMap) {
        var address = document.getElementById('address').value;
        geocoder.geocode({'address': address}, function(results, status) {
            if (status === 'OK') {
                resultsMap.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: resultsMap,
                    position: results[0].geometry.location
                });
            } else {
                alert('Geocode was not successful for the following reason: ' + status);
            }
        });
    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBz3pb3StqJD9u-853Y_3dy498wHhP8fyA&callback=initMap">
</script>

<script>
    window.onload = function()
    {
        document.getElementById('submit').click();

    }
</script>
</body>
</html>
@stop