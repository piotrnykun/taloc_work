
$(document).ready(function() {
    
    var ajaxPath = $('#ajaxPath').val();
    $('#userList').dataTable( {
        "ajax": ajaxPath
    });
    
    
});