<?php
/**
 * @var \Modules\Map\Entities\Marker $model
 */

?>

@extends('map::layouts.master')

@section('title', "Update marker")

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


@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{route('admin.map.update', [$model])}}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="popup_text" class="form-label">
                                Text
                            </label>
                            <textarea name="popup_text" id="popup_text"
                                      class="form-control" placeholder="Marker text">{{$model->popup_text}}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="lat" class="form-label">
                                        Latitude
                                    </label>
                                    <input type="text" name="lat" id="lat"
                                           value="{{$model->lat}}"
                                           class="form-control" placeholder="Latitude">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="long" class="form-label">
                                        Longitude
                                    </label>
                                    <input type="text" name="long" id="long"
                                           value="{{$model->long}}"
                                           class="form-control" placeholder="Longitude">
                                </div>
                            </div>
                        </div>



                        <button type="submit" class="btn btn-outline-primary need-confirm">Save</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="map"></div>
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

        let  marker = null
        let latInput = $('input[name=lat]')
        let longInput = $('input[name=long]')

        function changeMarker(lat, long) {
            marker.setLatLng(new L.LatLng(lat, long))
        }

        function onMapClick(e) {
            let coord = e.latlng
            latInput.val(coord.lat)
            longInput.val(coord.lng)
            changeMarker(coord.lat, coord.lng)
        }

        map.on('click', onMapClick);

        $(document).ready(function () {
            marker = L.marker([latInput.val(), longInput.val()]).addTo(map);
        })

    </script>

@endsection
