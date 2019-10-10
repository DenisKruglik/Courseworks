@extends('layouts.layout')

@section('pagename', 'Создание курсовой')

@section('head-includes')
<link rel="stylesheet" type="text/css" href="{{url('css/create-coursework.css')}}">
<script type="text/javascript" src="{{url('js/create-coursework.js')}}"></script>
@endsection

@section('content')
<div class="card">
	<h2>Создание курсовой</h2>
	<form id="create-coursework-form">
		{{csrf_field()}}
		<input class="input-field" type="text" name="title" placeholder="Название" required>
		<select class="input-field" name="topic" required>
			<option selected disabled value="">Тематика</option>
			@foreach($topics as $t)
			<option value="{{$t->id}}">{{$t->name}}</option>
			@endforeach
			<option value="custom">Своя тематика</option>
		</select>
		<input class="input-field hidden" name="topic_name" type="text" id="custom-topic" placeholder="Название тематики">
		<textarea name="description" placeholder="Описание"></textarea>
		<div class="tagline input-field"><input type="text" id="subject-input" placeholder="Введите название предмета"><div class="hidden" id="subjects"></div></div>
		<input type="submit" class="button" value="Создать">
	</form>
</div>
@endsection