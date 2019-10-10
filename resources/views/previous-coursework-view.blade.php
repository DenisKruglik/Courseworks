<div class="coursework" data-id="{{$c->id}}">
	<figure>
		<a href="{{url('professor')}}/{{$c->professor_id}}">
			<img src="{{isset($c->professor->user->img) ? '/public'.$c->professor->user->img : url('img/empty-avatar.png')}}">
			<p>{{$c->professor->user->last_name.' '.$c->professor->user->first_name.' '.$c->professor->user->middle_name}}</p>
		</a>
		<figcaption>
			<h3>{{$c->title}}</h3>
			<div>Тематика: {{$c->topic->name}}</div>
			<div>Описание: <p>{{$c->description}}</p></div>
			<div>Связанные предметы: 
			@foreach($c->subjects as $s)
			<a href="{{url('search/subject')}}/{{$s->id}}"><div class="tag" data-id="{{$s->id}}">{{$s->title}}</div></a>
			@endforeach
			</div>
			<div>Оценка: {{$c->pivot->mark}}</div>
		</figcaption>
	</figure>
</div>