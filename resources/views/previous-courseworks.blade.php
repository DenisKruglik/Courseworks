@extends('layouts.layout')

@section('pagename', 'Прошлые курсовые')

@section('head-includes')
<link rel="stylesheet" type="text/css" href="{{url('css/previous-courseworks.css')}}">
@endsection

@section('content')
<div class="card">
	<h2>Прошлые курсовые</h2>
	<div class="coursework-wrapper">
		@each('previous-coursework-view', $courseworks, 'c', 'empty-list')
	</div>
	{{$courseworks->links()}}
</div>
@endsection