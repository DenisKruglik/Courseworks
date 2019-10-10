@extends('layouts.layout')

@section('pagename', 'Панель администратора')

@section('head-includes')
<link rel="stylesheet" type="text/css" href="{{url('css/admin.css')}}">
<script type="text/javascript" src="{{url('js/admin.js')}}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<div class="card">
	<form id="student-registration" method="post">
		<h2>Регистрация студента</h2>
		{{csrf_field()}}
		<input class="input-field" type="text" name="username" placeholder="Имя пользователя" required>
		<input class="input-field" type="email" name="email" placeholder="E-mail" required>
		<input class="input-field" type="password" name="password" placeholder="Пароль" required>
		<input class="input-field" type="number" name="recordbook_id" placeholder="Номер зачётки" required>
		<input class="input-field" type="number" name="course" placeholder="Курс" min="1" max="5" step="1" required>
		<input class="input-field" type="text" name="first_name" placeholder="Имя">
		<input class="input-field" type="text" name="last_name" placeholder="Фамилия">
		<input class="input-field" type="text" name="middle_name" placeholder="Отчество">
		<input type="submit" class="button" value="Зарегистрировать">
	</form>
	<form id="professor-registration" method="post">
		<h2>Регистрация преподавателя</h2>
		{{csrf_field()}}
		<input class="input-field" type="text" name="username" placeholder="Имя пользователя" required>
		<input class="input-field" type="email" name="email" placeholder="E-mail">
		<input class="input-field" type="password" name="password" placeholder="Пароль" required>
		<select class="input-field" name="chair" required>
			<option value="" disabled selected>Кафедра</option>
			@foreach($chairs as $chair)
			<option value="{{$chair->id}}">{{$chair->name}}</option>
			@endforeach
		</select>
		<input class="input-field" type="text" name="first_name" placeholder="Имя">
		<input class="input-field" type="text" name="last_name" placeholder="Фамилия">
		<input class="input-field" type="text" name="middle_name" placeholder="Отчество">
		<div class="tagline input-field"><input type="text" id="subject-input" placeholder="Введите название предмета"><div class="hidden" id="subjects"></div></div>
		<input class="button" type="submit" value="Зарегистрировать">
	</form>
</div>
@endsection