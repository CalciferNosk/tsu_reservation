<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success</title>
</head>
<style>
    .success-message {
        background-color: #C6F4D6;
        border: 1px solid #34C759;
        padding: 20px;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
    }

    .success-message h2 {
        color: #34C759;
    }

    .success-message p {
        margin-bottom: 20px;
    }

    .close-button {
        background-color: #34C759;
        color: #fff;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
    }

    .close-button:hover {
        background-color: #2E865F;
    }
</style>

<body>
    <?php if ($result== 1) : ?>
        <div class="success-message">
            <h2>Success!</h2>
            <p><?= $mssg ?></p>
            <a class="close-button" type="button" href="<?= base_url() ?>">Home</button>
        </div>
    <?php else: ?>
        <center>
            <br>
            <br>
            <h2>Invalid Link</h2>
            <p><?= $mssg ?></p>
            <a class="" type="button" href="<?= base_url() ?>">Home</button>
        </center>
    <?php endif  ?>

    <script>
        Webcam.snap(function(data_uri) {
            $('#my_result').html('<img src="' + data_uri + '">');
            $('.success-message').fadeIn();
        });

    </script>
</body>

</html>