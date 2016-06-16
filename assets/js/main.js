$(window).on('ajaxErrorMessage', function(event, message){
    event.preventDefault();
});

$(window).on('ajaxError', function(event, obj, context, status) {
    var message;
    var showfm = function(message){
        if(document.flashflag){
            document.romanov_flashoptions.message = message;
            document.romanov_flashsettings.type = 'danger';
            $.notify(document.romanov_flashoptions, document.romanov_flashsettings);
        }else{
            $.notify({
                message: message
            },{
                type: 'danger',
                placement: {
                    from: "top",
                    align: "center"
                },
                delay: 10000
            });
        }
    };
    if (typeof status.responseJSON === 'undefined') {
        if (typeof status.responseText !== 'undefined') {
            message = status.responseText.match(/^\"(.*)\"\s/);
            if (message && typeof message[1] !== 'undefined') {
                message = message[1];
            } else {
                message = status.responseText;
            }
        }
    } else {
        message = status.responseJSON.X_OCTOBER_ERROR_FIELDS;
    }
    if( typeof message === 'object' ) {
        $.each(message, function(){
            showfm(this[0]);
        });
    }else if(typeof message !== 'undefined'){
        showfm(message);
    }
});

$(document).ready(function(){
    $.request('onShowFlashMsg', {
        success: function(data){
            if(data != ''){
                $.each(data.msgs, function(type, msg) {
                    var t = type == 'error' ? 'danger' : type;
                    data.options.message = msg;
                    data.settings.type = t;
                    $.notify(data.options, data.settings);
                });
            }
        }
    });
});
