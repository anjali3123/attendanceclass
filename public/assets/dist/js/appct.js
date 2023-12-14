var appct = {
    clearErrors: function(e) {
        $(e).find('span.error-msg').html('');
        $(e).find('div.form-group.has-danger').removeClass('has-danger');
    }
};
$.loader = {
    on : function () {
        $('#app-process-loader').fadeIn()
    },
    off: function(){
        $('#app-process-loader').fadeOut()
    }
}
$.toast = {
    notify : (tm,tc) => {
        $.notify(tm,{type:tc});
    }
}