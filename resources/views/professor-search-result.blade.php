@extends('layouts.layout')

@section('pagename', 'Поиск по преподавателям')

@section('head-includes')
@endsection

@section('content')
<div class="card">
	<h2>Поиск по предметам</h2>
	<div class="application-wrapper">
		@each('professor-view', $professors, 'p', 'empty-list')
	</div>
	{{$professors->links()}}
</div>
@endsection