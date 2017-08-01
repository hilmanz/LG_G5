<!DOCTYPE html>
<html>
<head>
    <title>Title</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="<?php echo asset('css/kube.min.css') ?>" />

</head>
<body style="width:80%;margin:40px auto">
    <div class="units-container">

        <form method="post" action="register" class="forms">
            <h3>Form Registrasi</h3>
            <label>
                Email <span class="error"></span>
                <input type="text" name="email" value="" class="width-50" />
            </label>
            <label>
                Password <span class="error"></span>
                <input type="password" name="password" value="" class="width-50" />
            </label>
            <label>
                Password Confirmation <span class="error"></span>
                <input type="password" name="password_confirmation" value="" class="width-50" />
            </label>
            <input type="submit" class="btn" value="Submit">

        </form>

    </div>
</body>
</html>