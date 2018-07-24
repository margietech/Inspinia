<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register</title>

    <link href="<?php echo CON_APP_URL.CON_ASSETS_DIR;?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo CON_APP_URL.CON_ASSETS_DIR;?>/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo CON_APP_URL.CON_ASSETS_DIR;?>/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="<?php echo CON_APP_URL.CON_ASSETS_DIR;?>/css/animate.css" rel="stylesheet">
    <link href="<?php echo CON_APP_URL.CON_ASSETS_DIR;?>/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen   animated fadeInDown">
        <div>
            <!-- <div>

                <h1 class="logo-name">IN+</h1>

            </div> -->
            <h3>Register to IN+</h3>
            <p>Set your password to create an account.</p>
            <?php $email = $this->input->get('email');
            echo form_open('Set_password/validate/'); 
            ?>
            <?php echo $msg;?>
            <?php echo $email;?>
                
                <div class="form-group">
                    <div style="color:red"><?php echo form_error('password');?></div>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <div style="color:red"><?php echo form_error('cpassword');?></div>
                    <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password">
                </div>
                
                <button type="submit" class="btn btn-primary block full-width m-b">Register</button>
            </form>
            <p class="m-t"> <small>Inspinia &copy; 2018</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="<?php echo CON_APP_URL.CON_ASSETS_DIR;?>/js/jquery-2.1.1.js"></script>
    <script src="<?php echo CON_APP_URL.CON_ASSETS_DIR;?>/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo CON_APP_URL.CON_ASSETS_DIR;?>/js/plugins/iCheck/icheck.min.js"></script>
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
