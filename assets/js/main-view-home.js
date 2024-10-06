$(document).ready(function () {
	console.log("home load");
	sessionStorage.setItem("ids", JSON.stringify(""));
	
	fetchHomeContent();
	// var home_content = false;

	// $(document).on('click','#nav_home', function() { 
	//   if (!home_content) {
	//     home_content = true;
	//     fetchHomeContent();
	//   }
	// });
	$(document).on("click", "#load_more", function () {
		fetchHomeContent();
	});
	
	$(document).on("click", ".view_event", function () {
		var event_id = $(this).data("eventid");
		var reserve_data = $(this).data("reservedata");
		var row_data = $(this).data("rowdata");
		row_data = JSON.parse(atob(row_data));
		var status = $(this).data("status");
		var reserve_start = $(this).data("start");
		var attendees = JSON.parse(atob(reserve_data));
		console.log(row_data);
		$("#attendees_list_body").html("");
		var tr = "";
		var count_slot = 0;
		var attendees_count = 0;
		$.each(attendees, function (key, value) {
			if (value.Username == username) {
				count_slot++;
			}
			attendees_count++;
			tr += `
                <tr ${value.Username == username ? 'style="font-weight: bold;color:green"' : ''}>
                    <td>${value.id}</td>
                    <td>${value.FullName}</td>
                    <td>${value.Username }</td>
                    <td>${value.CreatedDate}</td>
                </tr>`;
		});

		var description = `
			<center><h5>EVENT DETAILS</h5></center>
			<table>
				<tr>
					<td style="text-align:right;"><b>Event Description</b></td>
					<td>: ${row_data.Description}</td>
				</tr>
				<tr>
					<td style="text-align:right;"><b>Event Start</b></td>
					<td>: ${row_data.EventStart}</td>
				</tr>
				<tr>
					<td style="text-align:right;"><b>Event End</b></td>
					<td>: ${row_data.EventEnd}</td>
				</tr>
				<tr>
					<td style="text-align:right;"><b>Location</b></td>
					<td>: ${row_data.LocationName}</td>
				</tr>
			</table>
		`;

		$('#exampleModalLabel').text(row_data.EventName);
		$("#event_description").html(description);
		if(attendees_count >= row_data.EventSlot){
			$("#reserve_event_slot_div").html(
				`<span class="badge rounded-pill badge-primary">Slot is full</span>`
			);
		}
		else if(count_slot > 0){
			$("#reserve_event_slot_div").html(
				`<span class="badge rounded-pill badge-success">Slot reserved!</span>`
			);
		}
		else if  (reserve_start == 0) {
			$("#reserve_event_slot_div").html(
				`<span class="badge rounded-pill badge-light">Start Soon</span>`
			);
		}
		else if (status == 1){
			$("#reserve_event_slot_div").html(
				`<button type="button" class="btn btn-success" id="reserve_slot" data-slotcount="${row_data.EventSlot}" data-eventid="${event_id}">Reserve</button>`
			);
		}
		else{
			$("#reserve_event_slot_div").html(
				`<span class="badge rounded-pill badge-light">RESERVATION CLOSED</span>`
			);
		}

		$("#attendees_list_body").html(tr);
		$("#viewEventModal").modal("show");
	});

	$(document).on('click','#reserve_slot',function(){
		var event_id = $(this).data("eventid");
		var slot = $(this).data("slotcount");
		Swal.fire({
			title: "Are you sure?",
			text: "Please confirm your reservation!",
			// icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#3085d6",
			cancelButtonColor: "#d33",
			confirmButtonText: "Reserve!"
		  }).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: base_url + "reserve-event-slot",
					type: "POST",
					data: {
						valid: 1,
						event_id: event_id,
						slot: slot
					},
					dataType: "json",
					success: function (response) {
						if (response.reserve_status == 1) {
							if(response.result == 1){
								Swal.fire({
									icon: "success",
									title: "Success!",
									text: 'Slot reserved successfully!',
									showCancelButton: false
								});
								setInterval(function () {
									location.reload();
								},1800)
							}else{
								Swal.fire({
									icon: "error",
									title: "Oops...",
									text: 'Something went wrong!Please Try again!'
								});
							}
						}else{
							Swal.fire({
								icon: "error",
								title: "Oops...",
								text: 'Sorry, No slots left!',
								showCancelButton: false
							});
							setInterval(function () {
								location.reload();
							},1800)
						}
					},
				});
			}
		  });
	
	})

	
	
	function fetchHomeContent() {
		var url = base_url + "fetch-home-content";
		$.ajax({
			url: url,
			type: "POST",
			data: {
				valid: 1,
				ids: JSON.parse(sessionStorage.getItem("ids")),
			},
			dataType: "json",
			success: function (response) {
				if (response.result.length == 0) {
					$("#load_more").hide();
				}
				sessionStorage.setItem("ids", JSON.stringify(response.ids)); //JSON.stringify(response.ids);
				$("#home_content_feed").append(response.html);
			},
		});
	}


	
});

