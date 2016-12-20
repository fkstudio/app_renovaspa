@extends('layout/baseLayout')

@section('title', 'Home')

@section('content')
    <div class="container-fluid" style="background: url({{ URL::to('/images') }}/about-bg.jpg);background-size: cover;">
    	<div class="container" style="height:600px;">
    		<div class="row" style="text-align: center;">
    			<h3 class="about-title">{{ trans('about.about') }}</h3>
    		</div>
    	</div>
    </div>
    <div class="container-fluid">
    	<div class="container about-container" style="height:400px;">
    		<div class="row" style="text-align: center;">
    			<h3 class="history-title">{{ trans('about.our_history') }}</h3>
    			<p>{{ trans("about.history") }}</p>
    		</div>
    	</div>
    </div>
@endsection