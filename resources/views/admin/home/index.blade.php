@extends('adminlte::page')

@section('title', 'Página Inicial')

@section('content_header')
    <h1>Página Inicial</h1>
@stop

@section('content')
    @if(Auth::user()->pessoa()->first()->profissional()->first())
        <p> É profissional da clinica! </p>
    @else
        <p> Não é profissional da clinica! </p>
    @endif

@stop