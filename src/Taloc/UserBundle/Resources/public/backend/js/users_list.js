
$(document).ready(function() {
    
    var ajaxPath = $('#ajaxPath').val();
    var langPath = $('#dataTablesLangPath').val();
    var editPath = $('#user_edit_path').val();
    
    $('#userList').dataTable( {
        "lengthMenu": [1, 2, 3],
        "processing": true,
        "serverSide": true,
        "ajax": {
            "type" : "POST",
            "url" : ajaxPath
        },
        "language": {
                "url": langPath
            },
        "aoColumnDefs":[
            {
                "aTargets":[9],
                "mData": null,
                "mRender": function (data, type, full) {
                    return '<a class="edit" href="'+editPath+'/'+data[0]+'">Edycja</a>';
                }
            }
        ]
            
            
    });
    
    
});