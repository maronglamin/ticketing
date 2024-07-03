<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="/agrobusiness/public/img/favicon.ico" />
    <title>MLagroness</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="/agrobusiness/public/session/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="/agrobusiness/public/session/css/style.css">
</head>
<body>
<div class="main">
    <section class="signup">
        <div class="container">
            <div class="signup-content">
                <div class="signin-image">
                    <figure><img src="<?=root()?>/public/session/images/signin-image.jpg" alt="sing up image"></figure>
                    <a href="<?=$_SERVER["HTTP_REFERER"]?>" class="signup-image-link">Back and continue</a>
                </div>
                <div class="signup-form">
                <h2 class="form-title"><span style="color:blue">403</span> Record</h2>

                    <p>No matching record for the request and hence unauthorized</p>
                    <h5>We recommended the following</h5>
                    <ul>
                        <li>Record do not exist for that record</li>
                        <li>Entry misbehavior and was not extected for the current user</li>
                        <li>Contact the system admin about issue.</li>
                    </ul>
                    <br>
                    <a href="<?=$_SERVER["HTTP_REFERER"]?>" class="form-submit">Contiune</a>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="/agrobusiness/public/session/vendor/jquery/jquery.min.js"></script>
<script src="/agrobusiness/public/session/js/main.js"></script>

