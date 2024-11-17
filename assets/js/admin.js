// Graph
var ctx = document.getElementById("myChart");



$(document).on('click','.nav-action',function(){
  var dashboard = $(this).data('nav');
  $('.nav-action').removeClass('active');
  $(this).addClass('active');
  console.log('hello');
  $('.dashboard-content').hide();
  $('#dashboard-' + dashboard).show();
})

$(document).ready(function () {
  $('#usertable').dataTable();
  $('#event_table_list').dataTable();

  $(document).on('click', '.edit-user', function () {
      var data = $(this).data('user');
      data = atob(data);
      data = JSON.parse(data);
    console.log(data);
      $('#edit-fname').val(data.Fname)
      $('#edit-lname').val(data.Lname)
      $('#edit-mname').val(data.Mname)
      $('#edit-email').val(data.Email)
      $('#edit-username').val(data.Username)
      $('#edit-gender').val(data.GenderId);
      $('#edit-role').val(data.Role)
      $('#save-update').attr('data-id', data.id);
      $('#EditUser').modal('show');
  })
  
  $(document).on("click", "#save-update", function () {
		var Fname = $("#edit-fname").val();
		var Lname = $("#edit-lname").val();
		var Mname = $("#edit-mname").val();
		var Emain = $("#edit-email").val();
		var Username = $("#edit-username").val();
		var GenderId = $("#edit-gender").val();
		var Role = $("#edit-role").val();
		var id = $(this).data("id");

		var formdata = new FormData();
		formdata.append("Lname", Lname);
		formdata.append("Mname", Mname);
		formdata.append("Email", Emain);
		formdata.append("Username", Username);
		formdata.append("GenderId", GenderId);
		formdata.append("Role", Role);
		formdata.append("Fname", Fname);
		formdata.append("id", id);
		Swal.fire({
			title: "Are you sure?",
			text: "Please confirm to update!",
			// icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#3085d6",
			cancelButtonColor: "#d33",
			confirmButtonText: "Update!",
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: base_url + "update-user",
					type: "POST",
					data: formdata,
					contentType: false,
					processData: false,
					dataType: "json",
					success: function (response) {
            if(response == 1){
              Swal.fire({
                icon: "success",
                title: "Success!",
                text: "User updated successfully!",
                showCancelButton: false,
              });
              setInterval(function () {
                location.reload();
              }, 1800);
              
            }
					},
				});
			}
		});
	});


  $(document).on('click','.reset-password',function(){
    var username = $(this).data('username');
    var systemid = $(this).data('sysid');
    if(username != '' && systemid != ''){
      $('#resetPassword').modal('show');
    }
    console.log(username,systemid);
  })
})
