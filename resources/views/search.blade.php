@extends('layouts.layout')

@section('pagename', 'Результаты поиска')

@section('head-includes')
<link rel="stylesheet" type="text/css" href="{{url('css/search.css')}}">
@endsection

@section('content')
<div class="card">
	<h2>Результаты поиска</h2>
	<div class="professors">
		<h3>Преподаватели ({{$pCount}})</h3>
		<div class="professor-wrapper">
			@each('professor-view', $professors, 'p', 'empty-list')
		</div>
		@if($pCount > 3)
		<a href="{{url('search/professors')}}/{{Request::get('search_query')}}">Больше результатов ></a>
		@endif
	</div>
	<div class="topics">
		<h3>Тематики ({{$tCount}})</h3>
		<div class="topic-wrapper">
			@each('topic-view', $topics, 't', 'empty-list')
		</div>
		@if($tCount > 5)
		<a href="{{url('search/topics')}}/{{Request::get('search_query')}}">Больше результатов ></a>
		@endif
	</div>
	<div class="subjects">
		<h3>Предметы ({{$sCount}})</h3>
		<div class="subject-wrapper">
			@each('subject-view', $subjects, 's', 'empty-list')
		</div>
		@if($sCount > 10)
		<a href="{{url('search/subjects')}}/{{Request::get('search_query')}}">Больше результатов ></a>
		@endif
	</div>
	<div class="courseworks">
		<h3>Курсовые ({{$cCount}})</h3>
		<div class="coursework-wrapper">
			@each('coursework-view', $courseworks, 'c', 'empty-list')
		</div>
		@if($cCount > 3)
		<a href="{{url('search/courseworks')}}/{{Request::get('search_query')}}">Больше результатов ></a>
		@endif
	</div>
</div>
@endsection