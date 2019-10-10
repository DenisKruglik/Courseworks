@extends('layouts.layout')

@section('pagename', 'Мои заявки')

@section('head-includes')
<link rel="stylesheet" type="text/css" href="{{url('css/current-applications.css')}}">
@endsection

@section('content')
<div class="card">
	<h2>Мои заявки</h2>
	<div class="application-wrapper">
		@each('current-application-view', $applications, 'a', 'empty-list')
	</div>
	{{$applications->links()}}
</div>
@endsection