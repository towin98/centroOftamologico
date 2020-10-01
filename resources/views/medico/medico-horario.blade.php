@extends('layouts.app')

@section('scripts')
   {{--  <script src="{{ asset('js/turno.js') }}"></script> --}}
@endsection

@section('medico-horario')
    @livewire('horario-medicos-component')
@endsection