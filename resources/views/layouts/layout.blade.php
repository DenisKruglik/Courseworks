<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('pagename') - Курсовые ММФ</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" type="text/css" href="{{url('css/common.css')}}">
	<script type="text/javascript" src="{{url('js/jquery.js')}}"></script>
	<script type="text/javascript" src="{{url('js/common.js')}}"></script>
	@yield('head-includes')
</head>
<body>
	<header>
		<div class="logo"><h1>Курсовые ММФ</h1></div>
		@if(Auth::check())
		<form action="{{url('search')}}" class="searchline">
			{{csrf_field()}}
			<input type="text" name="search_query" placeholder="Введите предмет, преподавателя, тематику или что-то, интересующее Вас в курсовой работе">
			<button type="submit"></button>
		</form>
		<div class="profile-info">
			<p class="greeting">Вы вошли как </p>
			<div class="profile-buttons">
				<span class="username">
					@if(Auth::user()->role === 'admin')
					admin
					@else
					{{Auth::user()->last_name." ".Auth::user()->first_name." ".Auth::user()->middle_name}}
					@endif
				</span>
				@if(Auth::check() && Auth::user()->role !== 'admin')
				<img class="avatar" src="{{isset(Auth::user()->img) ? '/public'.Auth::user()->img : 'img/empty-avatar.png'}}">
				@endif
				▼
				<ul class="button-list">
					@if(Auth::user()->role === 'professor')
					<li><a href="{{url('courseworks')}}">Мои курсовые</a></li>
					<li><a href="{{url('applications')}}">Заявки</a></li>
					<li><a href="{{url('students-work')}}">Работы студентов</a></li>
					<li><a href="{{url('create-coursework')}}">Создать курсовую</a></li>
					@elseif(Auth::user()->role === 'student')
					<li><a href="{{url('current-coursework')}}">Текущая курсовая</a></li>
					<li><a href="{{url('current-applications')}}">Текущие заявки</a></li>
					<li><a href="{{url('previous-courseworks')}}">Прошлые курсовые</a></li>
					@endif
					<li><a href="{{url('settings')}}">Настройки профиля</a></li>
					<li><a href="{{url('logout')}}">Выйти</a></li>
				</ul>
			</div>
		</div>
		@endif
	</header>
	<main>
		@yield('content')
	</main>
	<footer>Денис Круглик &copy; 2018</footer>
	<div id="notification" class="card"></div>
	@if(session('status'))
	<script type="text/javascript">
		notifyInfo('{{session('status')}}');
	</script>
	@elseif(session('error'))
	<script type="text/javascript">
		notifyError('{{session('error')}}');
	</script>
	@endif
</body>
</html>