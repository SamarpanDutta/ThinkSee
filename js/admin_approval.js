$('document').ready(function(){
    $('.approval').click(function(){
        var el = this;
        var id = this.id;
        var splitid = id.split("_");

        // Delete id
        var approvalid = splitid[1];
        
        // AJAX Request
        $.ajax({
            url: 'admin_approval.php',
            type: 'POST',
            data: { id:approvalid },
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
