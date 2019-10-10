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
	$('#student-registration').on('submit', e => {
		e.preventDefault();
		let fields = $(e.target).find('.input-field');
		let params = {};
		for(let f of fields){
			params[f.name] = f.value;
		}
		let tokenInput = $(e.target).find('input[name=_token]');
		params[tokenInput.attr('name')] = tokenInput.val();
		$.post('student', params, d => {
			switch (d.status) {
				case 'OK':
					notifyInfo(d.data);
					break;
				case 'ERROR':
					notifyError(d.message);
					break;
				default:
					console.error(d);
			}
		});
	});

	$('#professor-registration').on('submit', e => {
		e.preventDefault();
		let fields = $(e.target).find('.input-field');
		let params = {};
		for(let f of fields){
			params[f.name] = f.value;
		}
		let tokenInput = $(e.target).find('input[name=_token]');
		params[tokenInput.attr('name')] = tokenInput.val();
		let subjects = $.map($('.tagline > .tag'), e => {
			return {
				id: e.dataset.id,
				title: e.innerText
			}
		});
		params.subjects = subjects;
		$.post('professor', params, d => {
			switch (d.status) {
				case 'OK':
					notifyInfo(d.data);
					break;
				case 'ERROR':
					notifyError(d.message);
					break;
				default:
					console.error(d);
			}
		});
	});

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
});