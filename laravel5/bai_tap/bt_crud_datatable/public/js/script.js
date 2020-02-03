$(document).ready(function(){
	
	

	$('.select_of_model').click(function(){
		$('.dropdown_group li input[type=radio]').each(function(index,value){
			group_name = $(this).attr('id');
			
			if($("#"+group_name).is(":checked")){  // check radio checked 
				// mapping-master
				$('#select_group').attr('value',$("#"+group_name).val()); // get value ( id ) to insert parent_id
				$('#select_group').css('color','white'); 
				$('#select_group').siblings('label').text($("#"+group_name).siblings('label').text());  // get value push to label
				
				// $('#select_group').siblings('label').css({'position':'absolute','top':'8px','left':'25px'});  // overwrite on value to hide value


				//choose group machine
				$('#select_group').children().attr('value',$("#"+group_name).val());
			}
		});
		

		$('#createGroupModal').modal('hide');
	})

	var msg = $('#msg').val();

	if(msg){

		$.confirm({
			title:'',
		    content: '<div style="text-align:center">'+ msg +'</div>',
		    buttons: {
		        confirm:  {
		            btnClass: 'btn-blue btn_center',
		            text :'Quay lại'
		        },
		        
		       
		    }
		});
	}
	
	
	// delete

	$('.select_action_delete').change(function(){
		
		var val = $(this).val();
		
		if(val){
			$(this).parent().siblings().children().removeClass('disable');
		}else{
			$(this).parent().siblings().children().addClass('disable');
		}
	})
	
	$('.btn_delete').click(function(e){  // delete one , var : toan cuc , let : cuc bo
		e.preventDefault();
		var href = $(this).attr('href');
		var machineName = $(this).data('name');
		var machineId = $(this).data('id');
		let warningContent = '';
		warningContent += '<div style="text-align:center;font-size:20px">Bạn có chắc chắn muốn xóa?</div>';
		warningContent += '<div>' + machineId + '. ' + machineName +'</div>';
		$.confirm({
			title:'',
			content : warningContent,
			buttons: {
		        confirm: {
		            text: 'Có',
		            btnClass: 'btn-blue',
		            action: function action(){

		                window.location = href;
		            }
		        },
		        cancel: {
		            text : 'Không',
		            btnClas: 'btn-defalut'
		        }
		      
		    }

		})
	})

	$('.btn_action_delete').click(function(e){  // delete multip
		e.preventDefault();
		var href = $(this).attr('href');
		
	
		if($('input.child[type="checkbox"]').is(":checked")){

			let warningContent = '';
			warningContent += '<div style="text-align:center;font-size:20px">Bạn có chắc chắn muốn xóa?</div>';
			$('input.child[type="checkbox"]:checked').each(function(){
				warningContent += '<li>'+ $(this).data('id') + '. ' + $(this).data('name') +'</li>';
			})
			$.confirm({
				title:'',
				content : warningContent,

				buttons: {
			        confirm: {
			            text: 'Có',
			            btnClass: 'btn-blue',
			            action: function action(){

			                $('#form_delete_machine').submit();
			            }
			        },
			        cancel: {
			            text : 'Không',
			            btnClas: 'btn-defalut'
			        }
			      
			    }

			})

		}else{
			$.confirm({
				title : '',
				content :'<div style="text-align:center">Vui lòng chọn record để xóa</div>',
				buttons: {
					ok : {
						text: 'Quay lại',
						btnClass :'btn-default'
					}
				}
			});

		}
	})

	//search

	$('#search_group').click(function(){
		$('#form-search-group').submit();
	})

	

	// checkbox
	$('#select_all').click(function(){
		if(this.checked){   // this.checked: only javascript, this is a DOM element
			$('input.child[type="checkbox"]').each(function(){
				this.checked = true;
			})
		}else{
			$('input.child[type="checkbox"]').each(function(){
				this.checked = false;
			})
		}
	})

	$('input.child[type="checkbox"]').click(function(){
		if($('input.child[type="checkbox"]:checked').length == $('input.child[type="checkbox"]').length){
			$("#select_all").prop('checked',true);
		}else{
			$('#select_all').prop('checked',false);
		}

	})


	// data-tables
    var table = $('#example1').DataTable({
        "lengthChange": false,
        "searching": false,
        "language": {
        
            // "zeroRecords": "Nothing found - sorry",
            "info": "Hiển thị trang _PAGE_ trên _PAGES_",
            // "infoEmpty": "No records available",
            
            "paginate": {
              "previous": "Lùi",
              "next"  : 'Tiến'
            },
            "emptyTable": "Không có dữ liệu trong bảng"
        },
        "columnDefs": [ {
              "targets": 'no-sort',
              "orderable": false,

        } ],
        "order": [], // hide sort icon column 0
        "pageLength": 5,
    });
    
   
    function updateDataTableSelectAllCtrl(){
       
       var $chkbox_all        = $('tbody input[type="checkbox"]');
       var $chkbox_checked    = $('tbody input[type="checkbox"]:checked');
       var chkbox_select_all  = $('thead input[name="select_all"]').get(0);

       // If none of the checkboxes are checked
       if($chkbox_checked.length === 0){
          chkbox_select_all.checked = false;
          if('indeterminate' in chkbox_select_all){
             chkbox_select_all.indeterminate = false;
          }

       // If all of the checkboxes are checked
       } else if ($chkbox_checked.length === $chkbox_all.length){
          chkbox_select_all.checked = true;
          if('indeterminate' in chkbox_select_all){
             chkbox_select_all.indeterminate = false;
          }

       // If some of the checkboxes are checked
       } else {
          chkbox_select_all.checked = true;
          if('indeterminate' in chkbox_select_all){
             chkbox_select_all.indeterminate = true;
          }
       }
    }
    // Handle table draw event
    table.on('draw', function(){
      // Update state of "Select all" control
      updateDataTableSelectAllCtrl();
    });
	

})