<?php
/**
 * @var $markers \Modules\Map\Entities\Marker[]
 */

?>

@extends('map::layouts.master')

@section('content')

    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('map.name') !!}
    </p>
    <div id="map"></div>

@endsection


@section('head-css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
          crossorigin=""/>
    <style>
        #map {
            height: 500px;
        }
    </style>
@endsection

@section('end-scripts')
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
            crossorigin=""></script>

    <script>
        var map = L.map('map').setView([{{config('app.map_center_lat')}}, {{config('app.map_center_long')}}], {{config('app.map_default_zoom')}});
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);


        @foreach($markers as $marker)
            L.marker([{{$marker->lat}}, {{$marker->long}}])
            .addTo(map)
            .bindPopup('{{$marker->popup_text}}')

        @endforeach

    // var marker1 = L.marker([50.45, 30.52]).addTo(map);
    // var marker2 = L.marker([50.55, 30.72]).addTo(map);

    </script>

@endsection
