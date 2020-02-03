
$(document).ready(function() {
    $('#example').DataTable({
    	"iDisplayLength": 3,
    	"lengthMenu": [ 3, 6, 9 ],
    	"lengthChange": true,
    	"bInfo":false,
    	"dom": '<"top"p>frt<"bottom"l>',
    	"scrollX": true
    }
    );
} );

