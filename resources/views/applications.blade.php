@extends('layouts.layout')

@section('pagename', 'Заявки')

@section('head-includes')
<link rel="stylesheet" type="text/css" href="{{url('css/applications.css')}}">
@endsection

@section('content')
<div class="card">
	<h2>Заявки</h2>
	<div class="application-wrapper">
		@each('application-view', $applications, 'a', 'empty-list')
	</div>
	{{$applications->links()}}
</div>
@endsection