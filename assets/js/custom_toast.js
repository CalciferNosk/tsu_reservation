function requiredField() {
    Toastify({
        text: "Please Enter Required Field",
        duration: 3000,
        close: true,
        gravity: "top", // `top` or `bottom`
        position: "right", // `left`, `center` or `right`
        stopOnFocus: true, // Prevents dismissing of toast on hover
        style: {
            background: "linear-gradient(to right, #ff5f6d, #ffc371)",
        },
        onClick: function () {}, // Callback after click
    }).showToast();


}

function loginSuccess() {
    Toastify({
        text: "Login Success",
        duration: 3000,
        close: true,
        gravity: "top", // `top` or `bottom`
        position: "right", // `left`, `center` or `right`
        stopOnFocus: true, // Prevents dismissing of toast on hover
        style: {
            background: "linear-gradient(to right, #00b09b, #96c93d)",
        },
        onClick: function () {}, // Callback after click
    }).showToast();
}

function badCredentials() {
    Toastify({
        text: "Bad Credentials",
        duration: 3000,
        close: true,
        gravity: "top", // `top` or `bottom`
        position: "right", // `left`, `center` or `right`
        stopOnFocus: true, // Prevents dismissing of toast on hover
        style: {
            background: "linear-gradient(to right, #ff5f6d, #ffc371)",
        },
        onClick: function () {}, // Callback after click
    }).showToast();
}

function triesExceeded(mssg) {
    Toastify({
        text: mssg,
        duration: 3000,
        close: true,
        gravity: "top", // `top` or `bottom`
        position: "right", // `left`, `center` or `right`
        stopOnFocus: true, // Prevents dismissing of toast on hover
        style: {
            background: "linear-gradient(to right, #ff5f6d, #ffc371)",
        },
        onClick: function () {}, // Callback after click
    }).showToast();
}
function loginFailed() {
    Toastify({
        text: "Credentials do not match",
        duration: 3000,
        close: true,
        gravity: "top", // `top` or `bottom`
        position: "right", // `left`, `center` or `right`
        stopOnFocus: true, // Prevents dismissing of toast on hover
        style: {
            background: "linear-gradient(to right, #ff5f6d, #ffc371)",
        },
        onClick: function () {}, // Callback after click
    }).showToast();
}
