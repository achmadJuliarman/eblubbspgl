<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eBLU - BBSPGL</title>
    <link rel="icon" type="image/x-icon" href="assets/esdm.png">
    <link href="<?php echo base_url();?>assets/new/dist/css/style.css" rel="stylesheet">
    <!-- This page CSS -->
    <link href="<?php echo base_url();?>assets/new/dist/css/pages/authentication.css" rel="stylesheet">
    <!-- This page CSS -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- <script src="https://www.google.com/recaptcha/api.js?render=6LfdJqYZAAAAAOZ0aNTAhv8RVVp90sH6SQTDMcO5"></script> -->
</head>

<body>
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="loader">
                <div class="loader__figure"></div>
                <p class="loader__label">Monika ESDM</p>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url(<?php echo base_url();?>assets/new/images/big/Back.jpg) no-repeat left center;">
            <div class="container">
                <div class="row">
                    <div class="col s12 l8 m6 demo-text">
                        <!-- <span class="db"><img src="<?php echo base_url();?>assets/new/images/logo-icon.png" alt="logo" /></span>
                        <span class="db"><img src="<?php echo base_url();?>assets/new/images/logo-text.png" alt="logo" /></span> -->
                        <!-- <h1 class="font-light m-t-40">Welcome to the <span class="font-medium black-text">Material Admin</span></h1>
                        <p>This is just a demo text which you can change as per your requeirment, so change once you get chance. this is default text.</p>
                        <a class="btn btn-round red m-t-5">Know more</a> -->
                    </div>
                </div>
                <div class="auth-box auth-sidebar">
                    <div id="loginform">
                        <div class="p-l-10">
                            <h5 class="font-medium m-b-0 m-t-40">Sign In to Admin</h5>
                            <small>Just login to your account </small>
                        </div>
                        <div class="row">
                          <?php echo form_open_multipart('login/do_login','class="col s12"');?>
                          <!-- <form class="col s12" action="login/test" method="post"> -->
                          <input id="token" name="token" type="text" hidden>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="email" type="email" class="validate" required name="username">
                                        <label for="email">Email</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="password" type="password" class="validate" required name="password">
                                        <label for="password">Password</label>
                                        <button class="btn-large w100 blue accent-4" id="submit" type="submit">Login</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url();?>assets/new/libs/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/new/dist/js/materialize.min.js"></script>
    <script>
    $(function() {
        $(".preloader").fadeOut();
    });
    </script>
    <!-- <script>
     //recaptchaResponse.value=0;
        grecaptcha.ready(function() {
        grecaptcha.execute('6LfdJqYZAAAAAOZ0aNTAhv8RVVp90sH6SQTDMcO5', {action: 'submit'})
        .then(function(token) {
           console.log(token);
           document.getElementById('token').value = token;
       });
     });
</script> -->
</body>

</html>
