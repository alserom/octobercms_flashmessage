$(window).on('ajaxErrorMessage', function(event, message){
    event.preventDefault();
});

$(window).on('ajaxError', function(event, obj, context, status) {
    var message;
    var showfm = function(message){
        if(document.flashflag){
            document.romanov_flashoptions.message = message[key][0];
            document.romanov_flashsettings.type = 'danger';
            $.notify(document.romanov_flashoptions, document.romanov_flashsettings);
        }else{
            $.notify({
                message: message[key][0]
            },{
                type: 'danger',
                placement: {
                    from: "top",
                    align: "center"
                },
                delay: 10000
            });
        }
    }
    if (typeof status.responseJSON === 'undefined') {
        message = status.responseText.match(/^\"(.*)\"\s/)[1];
    } else {
        message = status.responseJSON.X_OCTOBER_ERROR_FIELDS;
    }
    if( typeof message === 'object' ) {
        for (var key in message) {
            showfm(message);
        }
    }else{
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