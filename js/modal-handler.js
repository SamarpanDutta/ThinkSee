$(document).ready(function(){
        $('#userloginmodal').on('hidden.bs.modal', function(){
            $(this).find('form')[0].reset();
            $('.is-dirty').removeClass('is-dirty');
            $('.is-invalid').removeClass('is-invalid');
            $('#login-form-submit').prop('disabled',false);
        });	

        $('#adminloginmodal').on('hidden.bs.modal', function(){
            $(this).find('form')[0].reset();
            $('.is-dirty').removeClass('is-dirty');
            $('.is-invalid').removeClass('is-invalid');
            $('#adminlogin-form-submit').prop('disabled',false);
        });

        $('#userregistration').on('hidden.bs.modal', function(){
            $(this).find('form')[0].reset();
            $('.is-dirty').removeClass('is-dirty');
            $('.is-invalid').removeClass('is-invalid');
            $('#reg').prop('disabled',false);
        });

});