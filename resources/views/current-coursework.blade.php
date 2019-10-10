@extends('layouts.layout')

@section('pagename', 'Текущая курсовая')

@section('head-includes')
<link rel="stylesheet" type="text/css" href="{{url('css/current-coursework.css')}}">
@endsection

@section('content')
<div class="card">
	<h2>Текущая курсовая</h2>
	@if($coursework)
	@include('current-coursework-view', ['c' => $coursework])
	@else
	@include('empty-list')
	@endif
</div>
@endsection