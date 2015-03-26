$(window).on('ajaxErrorMessage', function(event, message){
    event.preventDefault();
});
$('button[type="submit"]').click( function(event)
{
    var form = $(this).closest('form')[0];
    $(form).on('ajaxError', function(event, obj, context, status){
        var message;
        if(typeof status.responseJSON === 'undefined') {
            message = status.responseText.match(/^\"(.*)\"\s/)[1];
        } else {
            message = status.responseJSON.X_OCTOBER_ERROR_FIELDS;
        }
        $('.form-group').removeClass('has-error');
        $('.form-group .romanov_err_label').remove();
        if( typeof message === 'object' ) {
            for(var key in message) {
                $(this).find('input[name="'+ key +'"]').parent().addClass('has-error');
                $(this).find('input[name="'+ key +'"]').before('' +
                '<div class="romanov_err_label"><label class="text-danger">' +
                message[key][0]+'</label></div>');
            }
        } else {
            alert(message);
        }
    });
});