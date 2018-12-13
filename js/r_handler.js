function r(){
    var p1 = $('#passwordreg').val();
    var p2 = $('#confirmpasswordreg').val();
    if(p1!=p2 || p1==""|| p2=="")
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

    $('#confirmpasswordreg').on('keyup',r);	

    $('#passwordreg').on('keyup',r);	

    $('#passwordreg').on('change',r);	

    $('#confirmpasswordreg').on('change',r);

});