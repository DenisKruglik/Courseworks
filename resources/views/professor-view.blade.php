<div class="professor">
	<a href="{{url('professor')}}/{{$p->id}}">
		<img class="avatar" src="{{isset($p->user->img) ? '/public'.$p->user->img : url('img/empty-avatar.png')}}">
		<span class="full-name">{{$p->user->last_name.' '.$p->user->first_name.' '.$p->user->middle_name}}</span>
	</a>
</div>