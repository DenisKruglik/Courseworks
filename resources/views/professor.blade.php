@extends('layouts.layout')

@section('pagename', 'Поиск по тематике')

@section('head-includes')
<link rel="stylesheet" type="text/css" href="{{url('css/professor.css')}}">
@endsection

@section('content')
<div class="card">
	<div class="professor-info">
		<img src="{{isset($professor->user->img) ? '/public'.$professor->user->img : url('img/empty-avatar.png')}}" alt="" class="avatar">
		<div class="info">
			<h2>{{$professor->user->last_name.' '.$professor->user->first_name.' '.$professor->user->middle_name}}</h2>
			<p class="facts">
				<div>Кафедра: {{$professor->chair->name}}</div>
				<div>Преподаваемые предметы: @each('subject-view', $professor->subjects, 's')</div>
			</p>
		</div>
	</div>
	<div class="courseworks">
		<h2>Курсовые преподавателя</h2>
		<div class="coursework-wrapper">
			@each('coursework-view', $courseworks, 'c', 'empty-list')
		</div>
		{{$courseworks->links()}}
	</div>
</div>
@endsection