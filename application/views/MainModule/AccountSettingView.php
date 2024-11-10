<?=

_headerLayout(['account-settings'], 'ACCOUNT | SETTINGS')
?>
<style>
    .col-md-4 {
        margin-bottom: 10px;
    }
</style>

<body>
    <div class="container-fluid">
        <center>
            <h3>Account Settings</h3>
        </center>
        <hr>
        <h4>User Details</h4>

        <form action="#" method="POST" id="updateUserForm" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-outline" data-mdb-input-init>
                        <input type="text" id="fname" name="Fname" class="form-control form-control-sm" value="<?= $user_data->Fname ?>" required />
                        <label class="form-label" for="fname">Firstname</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-outline" data-mdb-input-init>
                        <input type="text" id="mname" name="Mname" class="form-control form-control-sm" value="<?= $user_data->Mname ?>" />
                        <label class="form-label" for="mname">Middlename</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-outline" data-mdb-input-init>
                        <input type="text" id="lname" name="Lname" class="form-control form-control-sm" value="<?= $user_data->Lname ?>" required/>
                        <label class="form-label" for="lname">Lastname</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-outline" data-mdb-input-init>
                        <input type="text" id="username" name="username" class="form-control form-control-sm" value="<?= $user_data->Username ?>" disabled readonly />
                        <label class="form-label" for="username">Username</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-outline" data-mdb-input-init>
                        <input type="text" id="email" class="form-control form-control-sm" value="<?= $user_data->Email ?>" disabled readonly />
                        <label class="form-label" for="email">Email</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-outline" data-mdb-input-init>
                        <input type="text" id="gender" class="form-control form-control-sm" value="<?= _getGenderNameById($user_data->GenderId)   ?>" disabled readonly />
                        <label class="form-label" for="gender">Gender</label>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-outline" data-mdb-input-init>
                        <input type="text" id="role" class="form-control form-control-sm" value="<?= _getUserRole($user_data->Username)  ?>" disabled readonly />
                        <label class="form-label" for="role">Role</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-outline" data-mdb-input-init>
                        <input type="text" id="access" class="form-control form-control-sm" value="<?= _getWorkgroupAccessbyRole($user_data->Role) ?>" disabled readonly />
                        <label class="form-label" for="access">Access</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-outline" data-mdb-input-init>
                        <input type="text" id="Enrolldate" class="form-control form-control-sm" value="<?= $user_data->CreatedDate ?>" disabled readonly />
                        <label class="form-label" for="Enrolldate">System Enroll Date</label>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update Details</button>
        </form>
        <hr>


        <div class="row justify-content-between">
            <div class="col-md-4 m-3">
                <h4>Change Password</h4>
                <form action="#" method="POST" id="updatePasswordForm" enctype="multipart/form-data">
                    <div class="row mb-2">
                        <div class="form-outline" data-mdb-input-init>
                            <input type="password" id="current" class="form-control form-control-sm" value="" />
                            <label class="form-label" for="current">Current Password</label>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="form-outline" data-mdb-input-init>
                            <input type="password" id="newpassword" class="form-control form-control-sm" value="" />
                            <label class="form-label" for="newpassword">New Password</label>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="form-outline" data-mdb-input-init>
                            <input type="password" id="confirmpassword" class="form-control form-control-sm" value="" />
                            <label class="form-label" for="confirmpassword">Confirm Password</label>
                        </div>
                    </div>
                    <span id="error"></span>
                    <br>
                    <button type="submit" class="btn btn-primary">Update Password</button>
                </form>
            </div>

            <div class="col-md-6 row">
                <h4>Change Profile</h4>
                <div class="col-md-6">
                    <img width="300" style="border: 5px solid #000;" id="profile_photo" class="img-fluid" src="<?= base_url() ?>assets/user_profile/<?= _getUserProfile($user_data->Username) ?>" alt="">
                </div>
                <div class="col-md-6">
                    <input class="form-control form-control-sm" id="profile_input" type="file" />
                    <br>
                    <div id="profile_btn_save" style="display: none;">
                        <button type="button" class="btn btn-primary" id="profile_save">Save Profile</button>
                    </div>
                </div>

            </div>

        </div>
    </div>
    </div>


    <?= _footerLayout(['account-settings']) ?>

    <script>
        $(document).ready(function() {
            $(document).on('blur', '#confirmpassword', function() {
                let newpassword = $('#newpassword').val();
                let confirmpassword = $('#confirmpassword').val();
                if (newpassword != confirmpassword) {
                    $('#error').html('Password does not match');
                } else {
                    $('#error').html('');
                }
            })
            $(document).on('click', '#profile_save', function(e) {
                e.preventDefault();
                var profile = $('#profile_input')[0].files[0];
                swal.fire({
                    title: "Are you sure?",
                    text: "You want to save this profile?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    var form_data = new FormData();
                    form_data.append('profile', profile);
                    form_data.append('username', '<?= $user_data->Username ?>');
                    if (willDelete) {
                        $.ajax({
                            url: base_url + 'save-profile',
                            method: 'POST',
                            data: form_data,
                            contentType: false,
                            cache: false,
                            processData: false,
                            dataType: 'json'
                        }).done(function(data) {
                            if (data.result == true) {
                                location.reload();
                            }
                        })

                    }
                })
            })
            $(document).on('submit', '#updateUserForm', function(e) {
                e.preventDefault();
                var form_data = new FormData(this);
                form_data.append('username', '<?= $user_data->Username ?>');
                swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Update it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: base_url + 'update-details',
                            method: 'POST',
                            data: form_data,
                            contentType: false,
                            cache: false,
                            processData: false,
                            dataType: 'json'
                        }).done(function(data) {
                            if(data == 1){
                                location.reload();
                            }
                            else{
                                alert('Something went wrong,Please try again');
                            }
                        })
                    }
                })
            })
            $(document).on('change', '#profile_input', function(event) {

                var file = event.target.files[0];
                var reader = new FileReader();

                if (file && file.type.match('image.*')) {
                    reader.onload = function(e) {
                        $('#profile_photo').attr('src', e.target.result).show();
                    };
                    $('#profile_btn_save').show();
                    reader.readAsDataURL(file);
                } else {
                    alert('Please select an image file');
                    $('#profile_input').val('');
                    $('#profile_photo').hide();
                }

            })
            $(document).on('submit', '#updatePasswordForm', function(e) {
                e.preventDefault();
                let current = $('#current').val();
                let newpassword = $('#newpassword').val();
                let confirmpassword = $('#confirmpassword').val();
                if (current == '') {
                    alert('Please enter current password');
                    return false;
                }
                if (newpassword == '') {
                    alert('Please enter new password');
                    return false;
                }
                if (confirmpassword == '') {
                    alert('Please enter confirm password');
                    return false;
                }
                if (current == confirmpassword) {
                    alert('New password and confirm password should not be same');
                    return false;
                }
                if (newpassword == confirmpassword) {

                    swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, change it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: base_url + 'change-password',
                                method: 'POST',
                                data: {
                                    current: current,
                                    newpassword: newpassword,
                                    confirmpassword: confirmpassword
                                }
                            }).done(function(data) {
                                if (data == 1) {
                                    alert('Password updated successfully');
                                    location.reload();
                                } else {
                                    alert('Password update failed');
                                }
                            })
                        }
                    })

                } else {
                    alert('Password does not match');
                }

            })
        })
    </script>
</body>