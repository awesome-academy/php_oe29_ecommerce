$(document).ready(function() {
    $('#dataTables-example').DataTable({
        responsive: false
    });
})

$(document).ready(function() {
   let show_modal = $('.define').data('value');
   if (show_modal == 'create') {
       $('#mymodal').modal('show');
   }

   if (show_modal == 'edit') {
        url = $('.define').data('url');
       $.ajax({
           url : url,
           type : 'GET',
           success : function(reponse) {
               let data = JSON.parse(reponse);
               if (data.status == 200) {
                   $('#edit-name').val(data.name);
                   $('#edit-phone').val(data.phone);
                   $('#edit-email').val(data.email);
                   $('#edit-address').val(data.address);
                   $('.role').each(function() {
                       if ($(this).val() == data.role) {
                           $(this).prop('selected', true);
                       }
                   });
                   $('.edit-user').attr('action', data.route);
                   $('#modal-edit').modal('show');
               } else {
                   errorAlert(data.message);
               }
           }
       })
   }
});

$(document).on('click', '.edit-user', function(){
    let url = this.getAttribute('data-url');
    $.ajax({
        url : url,
        type : 'GET',
        success : function(reponse) {
            let data = JSON.parse(reponse);
            if (data.status == 200) {
                $('#edit-name').val(data.name);
                $('#edit-phone').val(data.phone);
                $('#edit-email').val(data.email);
                $('#edit-address').val(data.address);
                $('.role').each(function() {
                    if ($(this).val() == data.role) {
                        $(this).prop('selected', true);
                    }
                });
                $('.edit-user').attr('action', data.route);
                $('#modal-edit').modal('show');
            } else {
                errorAlert(data.message);
            }
        }
    })
});
