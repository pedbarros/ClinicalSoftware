@extends('adminlte::page')

@section('title', 'Página Inicial')

@section('content_header')
    <h1>Página Inicial</h1>
@stop

@section('content')
    {{auth()->user()->nivel_acesso()->first()->id}}
    @if(Auth::user()->nivel_acesso()->first()->id == 1)
        <p> É profissional da clinica! </p>
    @elseif(Auth::user()->nivel_acesso()->first()->id == 2) 
            <p> É profissional da clinica! </p>
    @else
        <p> Não é profissional da clinica! </p>
    @endif

@stop