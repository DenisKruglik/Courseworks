function notifyInfo(message){
    var n = $('#notification');
    n.text(message);
    n.addClass('notification-info');
    n.fadeIn(200, function(){
        setTimeout(function(){
            n.fadeOut(200, function(){
                n.text('');
                n.removeClass('notification-info');
            });
        }, 3000);
    });
}

function notifyError(message){
    var n = $('#notification');
    n.text(message);
    n.addClass('notification-error');
    n.fadeIn(200, function(){
        setTimeout(function(){
            n.fadeOut(200, function(){
                n.text('');
                n.removeClass('notification-error');
            });
        }, 3000);
    });
}