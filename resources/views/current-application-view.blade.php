<div class="coursework" data-id="{{$a->id}}">
	<figure>
		<a href="{{url('professor')}}/{{$a->professor_id}}">
			<img src="{{isset($a->professor->user->img) ? '/public'.$a->professor->user->img : url('img/empty-avatar.png')}}">
			<p>{{$a->professor->user->last_name.' '.$a->professor->user->first_name.' '.$a->professor->user->middle_name}}</p>
		</a>
		<figcaption>
			<h3>{{$a->title}}</h3>
			<div>Тематика: {{$a->topic->name}}</div>
			<div>Описание: <p>{{$a->description}}</p></div>
			<div>Связанные предметы: 
			@foreach($a->subjects as $s)
			<a href="{{url('search/subject')}}/{{$s->id}}"><div class="tag" data-id="{{$s->id}}">{{$s->title}}</div></a>
			@endforeach
			</div>
		</figcaption>
	</figure>
</div>