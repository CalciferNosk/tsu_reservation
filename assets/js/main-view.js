$(document).ready(function () {
	$(document).on("click", ".nav-link", function () {
		var content = $(this).data("content");
		$(".nav-link").removeClass("active");
		$(this).addClass("active");
		$(".content_div").hide();
		sessionStorage.setItem("nav", content);
		$("#" + content + "_content").show();
	});

	$(document).on("submit", "#newUserForm", function (e) {
		e.preventDefault();

		var empty_input = 0;
		$.each($(".user_setup_input"), function (v, k) {
			if ($(k).val() == "" || $(k).val() == null) {
				empty_input++;
				$(this).css("border", "1px solid red");
			} else {
				$(this).css("border", "1px solid #ced4da");
			}
		});
		if (empty_input > 0) {
			toastify("Please fill all required fields");
			return false;
		}

		if ($("#user_accept_policy").is(":checked") == false) {
			toastify("Please accept the terms and conditions");
			return false;
		}
		var form = $(this);
		var data = form.serialize();
		var url = base_url + "user-setup";
		Swal.fire({
			title: "Are you sure?",
			text: "You won't be able to revert this!",
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#3085d6",
			cancelButtonColor: "#d33",
			confirmButtonText: "Yes, Save it!",
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: url,
					type: "POST",
					data: data,

					dataType: "json",
					success: function (response) {

                        if(response.status == 200){
                            Swal.fire({
                                title: "Success!",
                                text: "User updated successfully.",
                                icon: "success",
                            });
    
                            setTimeout(function () {
                                location.reload();
                            }, 2000);
                        }
                        else{
                            toastify(response.error_msg);
                        }
						
					},
				});
			}
		});
	});

	function toastify(msg, color = "red", bg_color = "white") {
		Toastify({
			text: msg,
			duration: 3000,
			destination: base_url,
			newWindow: true,
			close: true,
			gravity: "top", // `top` or `bottom`
			position: "right", // `left`, `center` or `right`
			stopOnFocus: true, // Prevents dismissing of toast on hover
			style: {
				background: "linear-gradient(to right, white, white)",
				color: color,
			},
			onClick: function () {}, // Callback after click
		}).showToast();
	}
});

//  $(document).ready(function() {
//         // Initialize TUI Calendar using jQuery wrapper
//         var $calEl = $('#calendar').tuiCalendar({
//             defaultView: 'month',
//             taskView: true,
//             scheduleView: true,
//             useDetailPopup: true,  // Enables detail popup for schedule creation
//             theme: 'default',
//             isReadOnly: false,
//             template: {
//                 monthDayname: function(dayname) {
//                     return '<span class="calendar-week-dayname-name">' + dayname.label + '</span>';
//                 }
//                 // You can customize more templates if needed
//             }
//         });

//         // Get the calendar instance
//         var calendarInstance = $calEl.data('tuiCalendar');

//         // Add some example schedules
//         calendarInstance.createSchedules([
//             {
//                 id: '1',
//                 calendarId: '1',
//                 title: 'Meeting with John',
//                 start: '2024-09-01T10:00:00',
//                 end: '2024-09-01T11:00:00',
//                 category: 'time',  // Event category
//                 dueDateClass: ''
//             },
//             {
//                 id: '2',
//                 calendarId: '2',
//                 title: 'Conference Call',
//                 start: '2024-09-02T14:00:00',
//                 end: '2024-09-02T15:00:00',
//                 category: 'time',
//                 dueDateClass: ''
//             }
//         ]);
//     });
