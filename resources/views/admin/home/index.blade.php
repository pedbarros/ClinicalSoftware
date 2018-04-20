@extends('adminlte::page')

@section('title', 'Página Inicial')

@section('content_header')
    <h1>Página Inicial</h1>
@stop

@section('content')
    <p> {{ Auth::user() }}</p>
@stop