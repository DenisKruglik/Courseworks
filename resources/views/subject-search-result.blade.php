@extends('layouts.layout')

@section('pagename', 'Поиск по предметам')

@section('head-includes')
<link rel="stylesheet" type="text/css" href="{{url('css/applications.css')}}">
@endsection

@section('content')
<div class="card">
	<h2>Поиск по предметам</h2>
	<div class="application-wrapper">
		@foreach($subjects as $s)
		<div class="tag"><a href="{{url('search/subject')}}/{{$s->id}}">{{$s->title}}</a></div>
		@endforeach
	</div>
	{{$subjects->links()}}
</div>
@endsection