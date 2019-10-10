$(function(){
	$('input[name=avatar]').on('change', e => {
		if (e.target.files && e.target.files[0]) {
			let fd = new FormData;
			fd.append('avatar', e.target.files[0]);
			$.ajax({
		        url: 'avatar',
		        data: fd,
		        processData: false,
		        contentType: false,
		        type: 'POST',
		        headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
		        success:  d => {
					switch (d.status) {
						case 'OK':
							$('.avatar-container img').attr('src', '/public'+d.data);
							break;
						default:
							notifyError('Произошла ошибка')
							break;
					}
				}
		    });
		}
	});

	$('input[name=username]').on('input', e => {
		$.ajax({
			url: 'username',
			data: {
				username: e.target.value
			},
			type: 'POST',
			headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
		    success: d => {

		    }
		});
	});

	$('#password-form').on('submit', e => {
		e.preventDefault();
		let params = {};
		let fields = $(e.target).find('.input-field');
		for(let f of fields){
			params[f.name] = f.value;
		}
		$.ajax({
			url: 'password',
			data: params,
			type: 'POST',
			headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
		    success: d => {
		    	switch (d.status) {
		    		case 'OK':
		    			notifyInfo(d.data);
		    			break;
		    		case 'ERROR':
		    			notifyError(d.data);
		    			break;
		    		default:
		    			notifyError('Произошла ошибка');
		    			console.error(d);
		    			break;
		    	}
		    }
		});
	});
});