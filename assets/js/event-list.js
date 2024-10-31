$(document).ready(function () {
    $("#attendees_list_table").DataTable({
        "lengthChange": false,
        "searching": false
      });

      $('#event_table_list').DataTable({
          "lengthChange": false,
          "searching": true,
          "pageLength": 5,
          responsive: {
            details: {
              display: $.fn.dataTable.Responsive.display.modal({
                header: function (row) {
                  var data = row.data();
                  return  data[0];
                }
              }),
              type: 'column',
              className: 'none',
                targets: [1,2]
            }
          },
          columnDefs: [
            {
              targets: [7,8], // hide columns 3, 4, 5 on mobile devices
              className: 'none'
            }
          ]
        });


	$(document).on("click", ".event-edit", function (e) {

   
        var event_data = $(this).data("rowdata");
        var data = JSON.parse(atob(event_data));
        console.log(data.EventStart);
       $('#edit-event-name').val(data.EventName);
       $('#edit-event-location').val(data.EventLocationId);
       $('#edit-event-organizer').val(data.EventOrganizer);
       $('#edit-event-slot').val(data.EventSlot);
       $('#edit-event-start').val(data.EventStart);
       $('#edit-event-end').val(data.EventEnd);
       $('#edit-event-reservation_start').val(data.EventReservationStart);
       $('#edit-event-reservation_end').val(data.EventReservationEnd);
       $('#edit-event-description').summernote('code',data.Description);
       $('#edit-event-id').val(data.EventId);
		$("#editEventModal").modal("show");
	});

    $(document).on('submit','#editEventForm',function(e){
        e.preventDefault();
        console.log("edit event submit");
      var edit_event_name             =   $('#edit-event-name').val();
      var edit_event_location         =  $('#edit-event-location').val();
      var edit_event_organizer        =  $('#edit-event-organizer').val();
      var edit_event_slot             =  $('#edit-event-slot').val();
      var edit_event_start      =  $('#edit-event-start').val();
      var edit_event_end        =  $('#edit-event-end').val();
      var edit_reservation_start=  $('#edit-event-reservation_start').val();
      var edit_reservation_end  =  $('#edit-event-reservation_end').val();
      var edit_event_description=  $('#edit-event-description').val();
      var edit_event_id         =  $('#edit-event-id').val();

      var formdata = new FormData();
      formdata.append('edit_name',edit_event_name);
      formdata.append('edit_location',edit_event_location);
      formdata.append('edit_organizer',edit_event_organizer);
      formdata.append('edit_slot',edit_event_slot);
      formdata.append('edit_event_start',edit_event_start);
      formdata.append('edit_event_end',edit_event_end);
      formdata.append('edit_reservation_start',edit_reservation_start);
      formdata.append('edit_reservation_end',edit_reservation_end);
      formdata.append('edit_event_description',edit_event_description);
      formdata.append('edit_event_id',edit_event_id);

      Swal.fire({
        title: "Are you sure?",
        text: "Please confirm to Update event!",
        // icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Update!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: base_url + "update-event",
                type: "POST",
                data: formdata,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (response) {
                    if (response == 1) {
                        Swal.fire({
                            icon: "success",
                            title: "Success!",
                            text: "Event updated successfully!",
                            showCancelButton: false,
                        });
                        setInterval(function () {
                            location.reload();
                        }, 2000);
                    }
                },
            });
        }
    });

    })
	$(document).on("click", "#create_event", function () {
		$("#addEventModal").modal("show");
	});
	$(document).on("click", ".event-delete", function () {
		var event_id = $(this).data("eventid");
		Swal.fire({
			title: "Are you sure?",
			text: "Please confirm to delete!",
			// icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#3085d6",
			cancelButtonColor: "#d33",
			confirmButtonText: "Delete!",
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: base_url + "delete-event",
					type: "POST",
					data: {
						valid: 1,
						event_id: event_id,
					},
					dataType: "json",
					success: function (response) {
						if (response == 1) {
							Swal.fire({
								icon: "success",
								title: "Success!",
								text: "Event deleted successfully!",
								showCancelButton: false,
							});
							setInterval(function () {
								location.reload();
							}, 1800);
						} else {
							Swal.fire({
								icon: "error",
								title: "Oops...",
								text: "Something went wrong!Please Try again!",
							});
						}
					},
				});
			}
		});
	});

	$(document).on("submit", "#newEventForm", function (event) {
		event.preventDefault();
        var event_name = $("#new-event-name").val();
        var location = $("#new-event-location").val();
        var organizer = $("#new-event-organizer").val();
        var event_slot = $("#new-event-name").val();
        var event_start = $("#new-event-start").val();
        var event_end = $("#new-event-end").val();
        var reservation_start = $("#new-event-reservation_start").val();
        var reservation_end = $("#new-event-reservation_end").val();
        var description = $("#new-event-description").val();
        var fileInput = $("#fileInput")[0].files[0];
     
        if( event_name == ""){
            toastifyError('Event name is required');
            $("#new-event-name").focus();
            return false; 
        }
        if( location == null){
            toastifyError('Location is required');
            $("#new-event-location").focus();
            return false; 
        }
        
        if( organizer == null){
            toastifyError('Organizer is required');
            $("#new-event-organizer").focus();
            return false; 
        }
        if( event_slot == ''){
            toastifyError('Event slot is required');
            $("#new-event-name").focus();
            return false; 
        }
        if( event_start == ""){
            toastifyError('Event start date is required');
            $("#new-event-start").focus();
            return false; 
        }
        if( event_end == ""){
            toastifyError('Event end date is required');
            $("#new-event-end").focus();
            return false; 
        }
        if( reservation_start == ""){
            toastifyError('Reservation start date is required');
            $("#new-event-reservation_start").focus();
            return false; 
        }
        if( reservation_end == ""){
            toastifyError('Reservation end date is required');
            $("#new-event-reservation_end").focus();
            return false; 
        }
        if( description == ""){
            toastifyError('Description is required');
            $("#new-event-description").focus();
            return false; 
        }

        if(checkDatePast(null, event_start,false) == false){
            toastifyError('Event start date should be greater than date today',3000);
            $("#new-event-start").focus();
            return false; 
        }
        if(checkDatePast(event_start, event_end,) == false){
            toastifyError('Event end date should be greater than event start date',3000);
            $("#new-event-end").focus();
            return false; 
        }
        if(checkDatePast(null, reservation_start,false) == false){
            toastifyError('Reservation start date should be greater than date today',3000);
            $("#new-event-reservation_start").focus();
            return false; 
        }
        if(checkDatePast( reservation_start,event_start,true) == false){
            toastifyError('Please select reservation start date greater than event start date',3000);
            $("#new-event-reservation_start").focus();
            return false; 
        }
        if(checkDatePast(reservation_start, reservation_end,true) == false){
            toastifyError('Please select reservation end date greater than reservation event start date',3000);
            $("#new-event-reservation_end").focus();
            return false; 
        }
        if(checkDatePast(reservation_end,event_start,true) == false){
            toastifyError('Reservation end date should not be greater than event start date',3000);
         
            $("#new-event-reservation_end").focus();
            return false;
        }


        var formData = new FormData();
        formData.append("event_name", event_name);
        formData.append("location", location);
        formData.append("organizer", organizer);
        formData.append("event_slot", event_slot);
        formData.append("event_start", event_start);
        formData.append("event_end", event_end);
        formData.append("reservation_start", reservation_start);
        formData.append("reservation_end", reservation_end);
        formData.append("description", description);
        var file_mssg ='';
        if( fileInput == null){
            file_mssg = '<b>Save without image?</b> ';
          
        }
        else{
            formData.append("file", fileInput);
        }
        Swal.fire({
			title: "Are you sure?",
			text: file_mssg+"Please confirm to save event!",
			// icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#3085d6",
			cancelButtonColor: "#d33",
			confirmButtonText: "yes Save!",
		}).then((result) => {
			if (result.isConfirmed) {
				storeEvent(formData)
			}
		});
      
       
	});
    function storeEvent(data){
        $.ajax({
            type: "POST",
            url: base_url + "add-event",
            data: data,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function (response) {
                
                if(response.result == 1){
                    toastifySuccess("Event added successfully");
                    setInterval(function () {
                        $('#nav_home').click();
                        location.reload();
                    },1500)
                }
                else{
                    toastifyError("Something went wrong,Please try again");
                }
            }
        });
    }
    function checkDatePast(date1, date2,isEqual) {
        
        var date1 = date1 == null ? new Date() : new Date(date1);
        var date2 = new Date(date2);
        if(isEqual == true){
            if (date2 <= date1) {
                return false;
             } else {
                 return true;
             }
        }
        else{
            if (date2 < date1) {
                return false;
             } else {
                 return true;
             }
        }
       
    }
    function toastifyError(messg,timer = 1500) {
        const Toast = Swal.mixin({
            toast: true,
            position: "top-right",
            showConfirmButton: false,
            timer: timer,
            timerProgressBar: false,
            didOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer);
                toast.addEventListener("mouseleave", Swal.resumeTimer);
            },

        });

        Toast.fire({
            icon: "error",
            title: "Oops...",
            text: messg,
        });
    }
    function toastifySuccess(messg) {
        const Toast = Swal.mixin({
            toast: true,
            position: "top-center",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer);
                toast.addEventListener("mouseleave", Swal.resumeTimer);
            },

        });

        Toast.fire({
            icon: "success",
            title: "Success!",
            text: messg,
        });
    }
});
