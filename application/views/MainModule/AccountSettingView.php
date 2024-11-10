<?=

_headerLayout(['account-setting'], 'ACCOUNT | SETTINGS')
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
        <div class="row">
            <div class="col-md-4">
                <div class="form-outline" data-mdb-input-init>
                    <input type="text" id="fname" class="form-control form-control-sm" value="<?= $user_data->Fname ?>" />
                    <label class="form-label" for="fname">Firstname</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-outline" data-mdb-input-init>
                    <input type="text" id="mname" class="form-control form-control-sm" value="<?= $user_data->Mname ?>" />
                    <label class="form-label" for="mname">Middlename</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-outline" data-mdb-input-init>
                    <input type="text" id="lname" class="form-control form-control-sm" value="<?= $user_data->Lname ?>" />
                    <label class="form-label" for="lname">Lastname</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-outline" data-mdb-input-init>
                    <input type="text" id="username" class="form-control form-control-sm" value="<?= $user_data->Username ?>" disabled readonly />
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
        <hr>
        <center>
            <h4>Change Password</h4>
        </center>
        <div class="row">
            <div class="form-outline" data-mdb-input-init>
                <input type="text" id="access" class="form-control form-control-sm" value="<?= _getWorkgroupAccessbyRole($user_data->Role) ?>" disabled readonly />
                <label class="form-label" for="access">Current Password</label>
            </div>
        </div>
        <div class="row">

        </div>
        <div class="row">

        </div>
    </div>
    </div>

    <?= _footerLayout(['main-view']) ?>
</body>