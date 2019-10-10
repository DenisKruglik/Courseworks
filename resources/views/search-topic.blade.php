@extends('layouts.layout')

@section('pagename', 'Поиск по тематике')

@section('head-includes')

@endsection

@section('content')
<div class="card">
	<h2>Поиск по тематике</h2>
	<div class="coursework-wrapper">
		@each('coursework-view', $courseworks, 'c', 'empty-list')
	</div>
	{{$courseworks->links()}}
</div>
@endsection