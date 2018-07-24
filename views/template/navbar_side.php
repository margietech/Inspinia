<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>INSPINIA </title>
    <script type = "text/javascript" 
         src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
    </script>

    <link href="<?php echo CON_APP_URL.CON_ASSETS_DIR;?>/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    
    <!-- Toastr style -->
    <link href="<?php echo CON_APP_URL.CON_ASSETS_DIR;?>/css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="<?php echo CON_APP_URL.CON_ASSETS_DIR;?>/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
    <link href="<?php echo CON_APP_URL.CON_ASSETS_DIR;?>/css/animate.css" rel="stylesheet">
    <link href="<?php echo CON_APP_URL.CON_ASSETS_DIR;?>/css/style.css" rel="stylesheet">
    <!-- Bootstrap Date-Picker Plugin -->

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
   
    <!-- Bootstrap toogle -->
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <link rel="shortcut icon" href="#" />
    <!-- blockui script -->
    <script type="text/javascript" src="<?php echo CON_APP_URL.CON_ASSETS_DIR;?>/js/jquery.blockUI.js"></script>
    <!-- Bootstrap time-picker plugin -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script>
  <style>
    .loader {
        border: 5px solid #f3f3f3;
        border-radius: 50%;
        border-top: 5px solid #3498db;
        width: 25px;
        height: 25px;
        -webkit-animation: spin 2s linear infinite; /* Safari */
        animation: spin 2s linear infinite;
        }
  </style>  

</head>

<body>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="<?php echo CON_APP_URL.CON_ASSETS_DIR;?>/img/profile_small.jpg" />
                             </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">David Williams</strong>
                             </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="<?php echo CON_APP_URL.'Profile/' ?>"><?php echo $session_data['Profile']; ?></a></li>
                                <!-- <li><a href="contacts.html"><?php echo $session_data['Contacts']; ?></a></li>
                                <li><a href="mailbox.html"><?php echo $session_data['Mailbox']; ?></a></li> -->
                                <li class="divider"></li>
                                <li><a href="<?php echo CON_APP_URL.'login/' ?>"><?php echo $session_data['Logout']; ?></a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            IN+
                        </div>
                    </li>
                    <li class="active">
                        <a href="<?php echo CON_APP_URL.'dashboard' ?>"><i class="fa fa-th-large"></i> <span class="nav-label"><?php echo $session_data['Dashboard']; ?></span> </a>

                    </li>
                    <li>
                        <a href="<?php echo CON_APP_URL.'shareFile' ?>"><i class="fa fa-share-alt "></i> <span class="nav-label"><?php echo $session_data['Share']; ?></span></a>
                    </li>
                    <li id="usermanagement" style="display:none">
                        <a href="<?php echo CON_APP_URL.'userManagement' ?>"><i class="fa fa-users"></i> <span class="nav-label"><?php echo $session_data['User Management']; ?></span></a>
                    </li>
                    <li>
                        <a href="<?php echo CON_APP_URL.'employeeLeave' ?>"><i class="fa fa-edit"></i> <span class="nav-label"><?php echo $session_data['Leave']; ?></span></a>
                    </li>
                    <li id="allrequest" style="display:none">
                        <a href="<?php echo CON_APP_URL.'employeeLeave/getAllRequest'?>" ><i class="fa fa-table"></i> <span class="nav-label"><?php echo $session_data['Employee Leave Requests']; ?></span></a>
                    </li>
                    <li>
                        <a href="<?php echo CON_APP_URL.'dailyReport' ?>"><i class="fa fa-bar-chart"></i> <span class="nav-label"><?php echo $session_data['Daily Report']; ?></span></a>
                    </li>
                    <li id="empReport" style="display:none">
                        <a href="<?php echo CON_APP_URL.'dailyReport/getAllReport'?>" ><i class="fa fa-table"></i> <span class="nav-label"><?php echo $session_data['Employee Report']; ?></span></a>
                    </li>
                    <li>
                        <a href="<?php echo CON_APP_URL.'music' ?>"><i class="fa fa-music"></i> <span class="nav-label"><?php echo $session_data['Music']; ?></span></a>
                    </li>
                </ul>

            </div>
        </nav>
</div>
<script type = "text/javascript" language = "javascript">
    $(document).ready(function(){
        $(window).load(function() {
            $("#allrequest").hide();
            $("#usermanagement").hide();
            var user_type_id = <?php echo $this->session->userdata('user_type_id');?>;
            if(user_type_id ==1 || user_type_id ==3){
                $("#allrequest").show();
                $("#usermanagement").show();
                $("#empReport").show();
            }
        });  
    });
</script>