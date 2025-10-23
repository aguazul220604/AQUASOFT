@extends('layouts.app1')

@section('content')
    <x-client.header />
    <x-client.div1 />
    <x-client.encabezado5 />
    <x-client.novedades :noticias="$noticias" />
    <x-client.footer />
@endsection
