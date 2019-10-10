@extends('layouts.layout')

@section('pagename', 'Мои курсовые')

@section('head-includes')
<link rel="stylesheet" type="text/css" href="{{url('css/courseworks.css')}}">
@endsection

@section('content')
<div class="card">
	<h2>Мои курсовые</h2>
	<div class="coursework-wrapper">
		@each('coursework-view-professor', $courseworks, 'c', 'empty-list')
	</div>
	{{$courseworks->links()}}
</div>
@endsection