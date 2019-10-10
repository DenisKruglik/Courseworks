@extends('layouts.layout')

@section('pagename', 'Добро пожаловать')

@section('head-includes')
<link rel="stylesheet" type="text/css" href="{{url('css/welcome.css')}}">
@endsection

@section('content')
<div class="card">
    <div class="welcome-speech">
        <h2>Добро пожаловать</h2>
        <p>Здесь преподаватели и студенты механико-математического факультета Белорусского государственного университета экономят своё время на организацию процесса поиска и назначения курсовых работ. Преподаватели публикуют доступные курсовые с подробным описанием и назначают их выбранным студентам. Студенты же вольны выбрать любую курсовую работу из доступных, отбирая наиболее интересные</p>
    </div>
    <form id="login-form" action="{{url('login')}}" method="post">
        <h3>Войдите в аккаунт</h3>
        {{csrf_field()}}
        <input type="text" name="username" class="input-field" placeholder="Имя пользователя" required>
        <input type="password" name="password" class="input-field" placeholder="Пароль" required>
        <input type="submit" value="Войти" class="button">
    </form>
</div>
@endsection