@extends('layouts.layout')

@section('pagename', 'Работы студентов')

@section('head-includes')
<link rel="stylesheet" type="text/css" href="{{url('css/students-work.css')}}">
@endsection

@section('content')
<div class="card">
	<h2>Работы студентов</h2>
	<div class="application-wrapper">
		@each('students-work-view', $applications, 'a', 'empty-list')
	</div>
	{{$applications->links()}}
</div>
@endsection