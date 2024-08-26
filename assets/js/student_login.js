$(document).ready(function() {
    console.log("hello");
    $('form').on('submit', function(e) {
        e.preventDefault();
        var email = $('#email').val();
        var password = $('#password').val();
        if(email == "" ){
            toastify('Email is required');
            $('#email').focus();
            return false;
        }
        if(password == "" ){
            toastify('Password is required');
            $('#password').focus();
            return false;
        }
       $('.tsu-btn').attr('disabled', true);
       $('.tsu-btn').text('Please wait...');
        $.ajax({
            type: "POST",
            url: base_url + 'login/student',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.status == 200) {
                    toastify(response.message,'green');
                    $('.tsu-btn').text('Redirecting...');
                    setInterval(() => {
                        // console.log('redirecting');
                        window.location = base_url + 'main-view';
                    }, 2000);
                   
                } else {
                    $('.tsu-btn').removeAttr('disabled');
                    $('.tsu-btn').text('LOGIN');
                    toastify(response.message);
                }
            }
        });
       
    });


    function toastify(msg,color="red",bg_color="white") {
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
              color : color
            },
            onClick: function(){} // Callback after click
          }).showToast();
          
    }
})