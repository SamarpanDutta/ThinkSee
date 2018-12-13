$('document').ready(function(){
    $('.rejection').click(function(){
        var el = this;
        var id = this.id;
        var splitid = id.split("_");

        // Delete id
        var rejectionid = splitid[1];
        
        // AJAX Request
        $.ajax({
            url: 'admin_rejection.php',
            type: 'POST',
            data: { id:rejectionid },
            success: function(response){
                // Removing row from HTML Table
                $(el).closest('tr').css('background','tomato');
                $(el).closest('tr').fadeOut(800, function(){      
                    $(this).remove();
                });
            }
        });
    });
});