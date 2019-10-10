function handleResultTags(){
	$('#subjects .tag').click(e => {
		addTag(e.target);
	});
}

function addTag(t){
	let copy = $(t).clone();
	copy.insertBefore($('#subject-input'));
	copy.click(e => {
		$(e.target).remove();
	});
}

$(function(){
	$('#subject-input').on('input', e => {
		if (e.target.value.length > 0) {
			$.get('subjects/' + e.target.value, {}, d => {
				$('#subjects').html('');
				$('#subjects').show();
				for(let o of d){
					$('#subjects').append('<div class="tag" data-id="'+o.id+'">'+o.title+'</div>');
				}
				handleResultTags();
			});
		}else {
			$('#subjects').hide();
		}
	});

	$('select[name=topic]').change(e => {
		if (e.target.value === 'custom') {
			$('#custom-topic').show();
			$('#custom-topic').attr('required', 'true');
		}else{
			$('#custom-topic').hide();
			$('#custom-topic').removeAttr('required');
		}
	})

	$('#create-coursework-form').on('submit', e => {
		e.preventDefault();
		let params = {
			_token: $('input[name=_token]').val(),
			title: $('input[name=title]').val(),
			topic: $('select[name=topic]').val(),
			description: $('textarea[name=description]').val()
		};
		if ($('select[name=topic]').val() === 'custom') {
			params.topic_name = $('#custom-topic').val();
		}
		let subjects = $.map($('.tagline > .tag'), e => {
			return {
				id: e.dataset.id,
				title: e.innerText
			}
		});
		params.subjects = subjects;

		$.post('coursework', params, d => {
			switch (d.status) {
				case 'OK':
					notifyInfo(d.data);
					break;
				case 'ERROR':
					notifyError(d.message);
					break;
				default:
					notifyError('Возникла ошибка');
					console.error(d);
					break;
			}
		});
	});
});