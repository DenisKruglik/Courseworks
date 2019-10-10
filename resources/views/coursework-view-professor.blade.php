<div class="coursework" data-id="{{$c->id}}">
	<figure>
		<figcaption>
			<h3>{{$c->title}}</h3>
			<div>Тематика: {{$c->topic->name}}</div>
			<div>Описание: <p>{{$c->description}}</p></div>
			<div>Связанные предметы: 
			@foreach($c->subjects as $s)
			<a href="{{url('search/subject')}}/{{$s->id}}"><div class="tag" data-id="{{$s->id}}">{{$s->title}}</div></a>
			@endforeach
			</div>
			<div>Статус: 
			@if($c->is_actual)
			активна
			@else
			неактивна
			@endif
			</div>
			@if($c->is_actual)
			<a href="{{url('coursework/deactivate')}}/{{$c->id}}"><input type="button" class="button" value="Деактивировать"></a>
			@else
			<a href="{{url('coursework/activate')}}/{{$c->id}}"><input type="button" class="button" value="Активировать"></a>
			@endif
		</figcaption>
	</figure>
</div>