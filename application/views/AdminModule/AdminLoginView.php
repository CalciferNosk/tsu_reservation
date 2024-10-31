<?= _headerLayout(['custom'], 'Admin Login') ?>

<body>
    <div class="container d-flex justify-content-center">
        <div class="card m-5">
            <div class="card-body">
                <h5 class="card-title" style="text-align: center;">ADMIN LOGIN</h5>
                <form action="#" method="post" id="loginAdminForm" enctype="multipart/form-data">
                    <div class="form-outline" data-mdb-input-init>
                        <input type="text" id="username" class="form-control" />
                        <label class="form-label" for="username">Username</label>
                    </div>
                    <br>
                    <div class="form-outline" data-mdb-input-init>
                        <input type="password" id="password" class="form-control" />
                        <label class="form-label" for="password">Admin</label>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary" data-mdb-ripple-init>Login</button>
                </form>

            </div>
        </div>
    </div>
</body>

<?= _footerLayout(['admin_login']) ?>
