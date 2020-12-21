@extends('layouts.app')

@section('medicos-centro')

<style>
    .card:hover {
        box-shadow: 0px 0px 29px 3px rgba(0, 0, 0, 0.2);
        transition: all 1s;
    }

    .card {
        transition: all 1s;
    }
</style>
<div class="content-wrapper">
    <div class="container-fluid pl-5 pr-5">
        <div class="card-deck pt-4 justify-content-center ">
            @foreach ($medicos as $medico)
            <div class="card-medicos mb-4">
                <img class="card-img-top" src="{{ asset('storage/'.$medico->photo) }}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{$medico->name}}</h5>
                    <p class="card-text">{{$medico->lastname}}</p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">{{$medico->email}}</small>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</div>

@endsection