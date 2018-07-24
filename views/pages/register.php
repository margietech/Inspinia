<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register</title>

    <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen   animated fadeInDown">
        <div>
            <!-- <div>

                <h1 class="logo-name">IN+</h1>

            </div> -->
            <h3>Register to IN+</h3>
            <p>Create account to see it in action.</p>
            <?php echo form_open('Register/sendMail'); ?>
            <div style="color:red"><?php echo $msg;?></div>
                <div class="form-group">
                    <div style="color:red"><?php echo form_error('firstname');?></div>
                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Firstname">
                </div>
                <div class="form-group">
                    <div style="color:red"><?php echo form_error('lastname');?></div>
                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Lastname">
                </div>
                <div class="form-group">
                    <div style="color:red"><?php echo form_error('username');?></div>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                </div>
                <div class="form-group">
                    <div style="color:red"><?php echo form_error('email');?></div>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                </div>
                <div class="form-group">
                        <div class="checkbox i-checks"><label> <input type="checkbox"><i></i> Agree the terms and policy </label></div>
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Register</button>

                <p class="text-muted text-center"><small>Already have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="<?php echo CON_APP_URL.'Login/' ?>">Login</a>
            </form>
            <p class="m-t"> <small>Inspinia &copy; 2018</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="js/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>
</body>

</html>
