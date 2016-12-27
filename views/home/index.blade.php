@extends('layout/baseLayout')

@section('title', 'Home')

@section('content')
    <a href="{{ URL::to('/') }}/select/services">Servicios</a><br/>
    <a href="{{ URL::to('/') }}/select/certificates">Gift certificates</a><br/>
    <a href="{{ URL::to('/') }}/select/weddings">Weddings</a><br/>
@endsection