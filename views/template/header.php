<div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <p style="font-weight:bold;"><?php $name = $this->session->userdata('name');
                    echo "Welcome ". $name;?></p>
                </li>
                
                <li>
                    <a href="<?php echo CON_APP_URL.'Login'?>">
                        <i class="fa fa-sign-out"></i><?php echo $session_data['Logout']; ?>
                    </a>
                </li>
                
            </ul>

        </nav>
        </div>