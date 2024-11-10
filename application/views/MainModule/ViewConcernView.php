<?=

_headerLayout(['view-concern'], 'VIEW | CONCEARN')
?>

<body>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4><?= str_pad($result->id, 5, '0', STR_PAD_LEFT) ?> | <?= $result->Title ?> | <?= $result->Status ?></h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-1">
                        <a type="button" href="<?= base_url() ?>" class="btn btn-primary">Back</a>
                    </div>
                    <div class="col-md-1">
                        <a type="button" class="btn btn-primary">Edit</a>
                    </div>
                    <div class="col-md-1" style="display: none;">
                        <a type="button" class="btn btn-primary">Cancel</a>
                    </div>
                    <div class="col-md-1" style="display: none;">
                        <a type="button" class="btn btn-primary">Save</a>
                    </div>
                    <div class="col-md-2">
                        <div class="dropdown">
                            <a
                                class="btn btn-primary dropdown-toggle"
                                href="#"
                                role="button"
                                id="dropdownMenuLink"
                                data-mdb-dropdown-init
                                data-mdb-ripple-init
                                aria-expanded="false">
                                Dropdown link
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <table style="width: 100%;">
                        <tr>
                            <td style="width: 100px;">Date Created</td>

                            <td>:<?= $result->CreatedDate ?></td>
                        </tr>
                        <tr>
                            <td style="width: 100px;">Title</td>

                            <td>:<?= $result->Title ?></td>
                        </tr>
                        <tr>
                            <td style="width: 100px;">Description</td>

                            <td> :
                                <?= strip_tags($result->Description) ?>

                        </tr>

                    </table>
                </div>
            </div>
        </div>
    </div>


    <?= _footerLayout(['account-settings']) ?>
</body>