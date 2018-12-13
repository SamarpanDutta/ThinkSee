function cp(){
    var p1 = $('#new_password').val();
    var p2 = $('#re_password').val();
    if(p1!=p2)
    {
        $('#pmatch').text('highlight_off');
        $('#reg').prop('disabled',true);
    }
    else
    {
        $('#pmatch').text('check_circle');
        $('#reg').prop('disabled',false);
    }
}

$(document).ready(function(){

    $('#re_password').on('keyup',cp);	

    $('#new_password').on('keyup',cp);	

    $('#new_password').on('change',cp);	

    $('#re_password').on('change',cp);

});