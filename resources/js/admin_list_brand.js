$(document).ready(function() {
    $('#dataTables-example').DataTable({
        responsive: false
    });
});
//show modal khi co loi thuc thi
$(document).ready(function () {
     let nameModal = $(".show-errors").data('modal');
     let array = nameModal.split('-');
     if (array[0] == 'create') {
         $('#createCategory').modal('show');
     }
     if(array[0] == 'editCategory') {
         $("#" + nameModal).modal('show');
     }
});
