<div class="coursework" data-id="{{$a->id}}">
	<figure>
		<div class="student-info">
			<img src="{{isset($a->student->user->img) ? '/public'.$a->student->user->img : url('img/empty-avatar.png')}}">
			<p>{{$a->student->user->last_name.' '.$a->student->user->first_name.' '.$a->student->user->middle_name}}</p>
		</div>
		<figcaption>
			<h3>{{$a->coursework->title}}</h3>
			<div>Тематика: {{$a->coursework->topic->name}}</div>
			<div>Описание: <p>{{$a->coursework->description}}</p></div>
			<div>Связанные предметы: 
			@foreach($a->coursework->subjects as $s)
			<a href="{{url('search/subject')}}/{{$s->id}}"><div class="tag" data-id="{{$s->id}}">{{$s->title}}</div></a>
			@endforeach
			</div>
			<a href="{{url('approve')}}/{{$a->id}}"><input type="button" class="button" value="Принять"></a>
		</figcaption>
	</figure>
</div>