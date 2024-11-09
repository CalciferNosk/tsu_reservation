$(document).ready(function () {

   
	$(document).on("submit", "#loginAdminForm", function (e) {
		e.preventDefault();
		var username = $("#username").val();
		var password = $("#password").val();

		if (username == "" || password == "") {
			requiredField();
			return false;
		}
		var formData = new FormData();
		formData.append("username", username);
		formData.append("password", password);
		$.ajax({
			type: "POST",
			url: base_url + "admin/auth",
			data: formData,
			dataType: "json",
			contentType: false,
			cache: false,
			processData: false,
			success: function (result) {

                if(result.tries == 0) {
                    triesExceeded(result.tries_mssg) 
				}
                else{
                    if (result.result == 1) {
                        loginSuccess();
                        setInterval(function () {
                            window.location.href = base_url + "admin/dashboard";
                        }, 2000);
                    } 
                    else {
                        loginFailed();
                        $("#loginAdminForm").trigger("reset");
                    }
                }
				
			},
		});
	});
});
