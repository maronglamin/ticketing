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
            <div class="signup-form">
            <h2 class="form-title">Page of <span style="color:blue">404</span></h2>

                <p>The requested page <strong><?=$_SERVER['REQUEST_URI']?></strong> could not be found in our directory.</p>
                <h5>Try out the following</h5>
                    <ul>
                        <li>Check for the correct spelling of the address</li>
                        <li>Request for the new address to the intended page</li>
                        <li>Contact the system admin about the issue.</li>
                    </ul>
                    <a href="/agrobusiness/student/enrolled" class="form-submit">Home</a>

            </div>
            
            <div class="signup-image">
                <figure><img src="<?=root()?>/public/session/images/signup-image.jpg" alt="sing up image"></figure>
                <a href="/agrobusiness/student/enrolled" class="signup-image-link">Go to HOME to start afresh</a>
            </div>

    </div>
</div>
</section>
</div>
<script src="/agrobusiness/public/session/vendor/jquery/jquery.min.js"></script>
<script src="/agrobusiness/public/session/js/main.js"></script>