@extends('layouts.layout')

@section('pagename', 'Настройки профиля')

@section('head-includes')
<link rel="stylesheet" type="text/css" href="{{url('css/settings.css')}}">
<script type="text/javascript" src="{{url('js/settings.js')}}"></script>
@endsection

@section('content')
<div class="card">
	<h2>Настройки профиля</h2>
	{{csrf_field()}}
	<div class="avatar-container">
		<img src="{{isset(Auth::user()->img) ? '/public'.Auth::user()->img : url('img/empty-avatar.png')}}">
		<label class="avatar-overlay">
			<input type="file" name="avatar" accept="image/*">
			<span>⇑<br>Загрузить фото</span>
		</label>
	</div>
	<div class="forms">
		<form id="settings-form">
			<h3>Смена имени пользователя</h3>
			<input type="text" class="input-field" name="username" value="{{Auth::user()->username}}" required>
		</form>
		<form id="password-form">
			<h3>Смена пароля</h3>
			<input type="password" class="input-field" name="old_password" placeholder="Старый пароль" required>
			<input type="password" class="input-field" name="new_password" placeholder="Новый пароль" required>
			<input type="submit" class="button" value="Сохранить">
		</form>
	</div>
</div>
@endsection