@extends('layouts.app')
@section('ubicaciongeografica')
@section('scripts')
<script src="{{ asset('js/geolocation.js') }}"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap&libraries=places&v=weekly" defer></script>
@endsection
<div class="content-wrapper">
    <div class="container-fluid pl-5 pr-5">


        <style>
            #map {
                height: 100%;
            }

            /* Optional: Makes the sample page fill the window. */
            html,
            body {
                height: 100%;
                margin: 0;
                padding: 0;
            }
        </style>
        <div id="map"></div>
    </div>
</div>
@endsection