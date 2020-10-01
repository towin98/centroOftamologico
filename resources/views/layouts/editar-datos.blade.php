@extends('layouts.app')
@section('link')
<link rel="stylesheet" href="{{ asset('css/editar-datos.css') }}">
@endsection
@section('editar-datos')
<style>
    .form-group .icons {
        position: absolute;
        top: 0;
        left: 0;
        line-height: 100px;
        font-size: 18px;
    }
</style>
@livewire('edit-datos-component')
@endsection