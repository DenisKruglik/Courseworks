@extends('layouts.layout')

@section('pagename', 'Поиск по предмету')

@section('head-includes')

@endsection

@section('content')
<div class="card">
	<h2>Поиск по предмету</h2>
	<div class="coursework-wrapper">
		@each('coursework-view', $courseworks, 'c', 'empty-list')
	</div>
	{{$courseworks->links()}}
</div>
@endsection