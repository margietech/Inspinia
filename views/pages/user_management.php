<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo $this->lang->line('user_management_header');?></h2>
    </div>
    
</div>
</br>
<button type="button" class="btn btn-primary" onclick="add_user()"><?php echo $this->lang->line('add_user_btn');?></button>
</br></br>
<div id="msg"></div>
<!-- table of user -->
<div class="row"> 
    <div class="col-lg-12" >
        <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><?php echo $this->lang->line('user_master_tbl');?></h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <table class="table table-hover no-margins" id="usertable" style="background-color:white;">
                            <thead>
                                <tr>
                                    <th><?php echo $this->lang->line('name_lbl');?></th>
                                    <th><?php echo $this->lang->line('email_lbl');?></th>
                                    <th><?php echo $this->lang->line('username_lbl');?></th>
                                    <th><?php echo $this->lang->line('status_lbl');?></th>
                                    <th><?php echo $this->lang->line('action_colm');?></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php  foreach($data as $array):?>

                                <tr>
                                    <td><?php echo $array['firstname']." ".$array['lastname'];?></td>
                                    <td><?php echo $array['email'];?></td>
                                    <td><?php echo $array['username'];?></td>
                                    <td>
                                        <?php if($array['status'] == 'Active'):?>
                                            <input type="checkbox" checked id="toggle-one" data-toggle="toggle" data-on="Active" data-off="Inactive" data-size="small" onchange="change_status(<?php echo $array['id'];?>,'Inactive')">
                                        <?php else:?>
                                        <input type="checkbox" checked id="toggle-two" data-toggle="toggle" data-on="Inactive" data-off="Active" data-size="small" onchange="change_status(<?php echo $array['id'];?>,'Active')">
                                        <?php endif;?>
                                    
                                    </td>
                                    
                                    <td>
                                    <button class="btn btn-success" id="editbtn" onclick="edit_user('<?php echo  $array['id'];?>')"><i class="fa fa-edit"></i></button>
                                    <button class="btn btn-danger" id="deleteBtn" onclick="delete_user('<?php echo  $array['id'];?>')"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>

                            <?php endforeach;?>
                               <tr>
                                    <!-- pagination demo -->
                                    <div id="pagination">
                                    <td colspan="5" class="footable-visible">
                                    <ul class="pagination pull-right">

                                    <!-- Show pagination links -->
                                    <?php foreach ($links as $link) {
                                        echo "<li class='footable-page-arrow'>". $link."</li>";
                                    } ?>
                                    </ul></td>
                                    </div>
                                </tr>
                            <tbody>
                        </table>
                    </div>
        </div>
    </div>
</div>

<!-- modal for edit and add user -->
  <div class="modal fade" id="model" role="dialog">
    <div class="modal-dialog">
    

    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo $this->lang->line('add_user_lbl');?></h4>
        </div>
        <div class="modal-body">
            <form class="form-horizontal" id="form">
                
                <input type="hidden" value="" name="id"/>
                
                <div class="form-group">
                    <label class="control-label col-sm-2" for="firstname"><?php echo $this->lang->line('fname_lbl');?>:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo set_value('firstname'); ?>">
                        <div id="fname_error" style="color:red"></div>
                    </div>         
                </div>
                <div class="form-group">
                        <label class="control-label col-sm-2" for="lastname"><?php echo $this->lang->line('lname_lbl');?>:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo set_value('lastname'); ?>">
                            <div id="lname_error" style="color:red"></div>
                        </div>
                </div>
                <div class="form-group">
                   <label class="control-label col-sm-2" for="email"><?php echo $this->lang->line('email_lbl');?>:</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo set_value('email'); ?>">
                        <div id="email_error" style="color:red"></div>
                    </div>
                </div>
                <div class="form-group">                   
                    <label class="control-label col-sm-2" for="username"><?php echo $this->lang->line('username_lbl');?>:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo set_value('username'); ?>">
                        <div id="uname_error" style="color:red"></div>
                    </div>
                </div>
                <div class="form-group">                   
                    <label class="control-label col-sm-2" for="pwd"><?php echo $this->lang->line('pwd_lbl');?>:</label>
                    <div class="col-sm-10">          
                        <input type="text" class="form-control" id="password" name="password" value="<?php echo set_value('password'); ?>" disabled>
                        <div id="pwd_error" style="color:red"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="status"><?php echo $this->lang->line('status_lbl');?>:</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="status" id="status">
                            <option for="status"><?php echo $this->lang->line('active_lbl');?></option>
                            <option for="status"><?php echo $this->lang->line('inactive_lbl');?></option>
                        </select>  
                    </div>
                </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" id="submitbtn"><?php echo $this->lang->line('submit_btn');?></button>
            <button type="button" class="btn btn-danger" id="closebtn" data-dismiss="modal"><?php echo $this->lang->line('close_btn');?></button>
        </div>
            </form>
        </div>
      </div>
    </div>
  </div>

<script type = "text/javascript" language = "javascript">
    var method;//to decide insert or update
    function showTable(){
        $('#toggle-one').bootstrapToggle();
        $('#toggle-two').bootstrapToggle();
        $.ajax({
            type: 'POST',
            url:"<?php echo CON_APP_URL."userManagement/"?>",
            success: function(res) {
                $('#usertable').load(document.URL +  ' #usertable');
                $('#usertable').load($('#toggle-one').bootstrapToggle()); 
                $('#usertable').load($('#toggle-two').bootstrapToggle());
            },
            error: function(xhr,hjhkjh,err) {
                console.log(err);
            }
        }); 
              
    }
    function delete_user(id){
        $.ajax({
                type:'POST',
                url:"<?php echo CON_APP_URL."userManagement/deleteUser"?>/"+id,
                
                success: function(res) {
                    alert("are you sure You want to delete data?")
                    showTable(); 
                    $('#toggle-one').bootstrapToggle();   
                },
                error: function(xhr,hjhkjh,err) {
                    console.log(err);
                }
        });
    }
    function change_status(id,status){
        $.ajax({
                type:'POST',
                url:"<?php echo CON_APP_URL."userManagement/changeStatus"?>/"+id+"/"+status,
                
                success: function(res) {
                    location.reload();    
                },
                error: function(xhr,hjhkjh,err) {
                    console.log(err);
                }
        });
    }
    function edit_user(id)
    {
        method='update';
        $("#form")[0].reset();
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo CON_APP_URL.'userManagement/editUser'?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id"]').val(data.id);
            $('[name="firstname"]').val(data.firstname);
            $('[name="lastname"]').val(data.lastname);
            $('[name="email"]').val(data.email);
            $('[name="username"]').val(data.username);
            $('[name="password"]').val(data.password);
            $('[name="cpassword"]').val(data.password);
            $('[name="status"]').val(data.status);
            $('#model').modal('show'); 

        },
        error: function (jqXHR, textStatus, err)
        {
            console.log(err);
        }
     });
    }
    function add_user()
    {
        $("#form")[0].reset();
        method='insert';
        $('#model').modal('show');
    }
           
    $(document).ready(function() {
        $('#toggle-one').bootstrapToggle();
        $('#toggle-two').bootstrapToggle();
        $("#form")[0].reset();
        // $(function() {
                
            // });
        $(window).load(function() {
            //showTable();
            $('#toggle-one').bootstrapToggle(); 
        });
    
        $(document).on("click", "#submitbtn",function(event){
            
            var url;
            if(method=='insert'){
                url = "<?php echo CON_APP_URL."userManagement/addUser"?>";
            }
            else if(method='update'){
                url = "<?php echo CON_APP_URL."/userManagement/updateUser"?>";
            }
            
            event.preventDefault(); 
            var formData = new FormData(this.form);
            
            $.ajax({
                type: 'POST',
                url: url,
                //dataType: "JSON", 
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    if(!$.trim(res)){
                        alert("Data is successfully submitted.");
                        $('#toggle-one').bootstrapToggle();
                        $('#toggle-two').bootstrapToggle();
                        $('#model').modal('hide');                       
                     }
                     else{
                        var res = JSON.parse(res);
                        $('#fname_error').html(res.firstname);
                        $('#lname_error').html(res.lastname); 
                        $('#email_error').html(res.email);
                        $('#uname_error').html(res.username);
                        $('#pwd_error').html(res.password);
                        $('#cpwd_error').html(res.cpassword);
                    }
            
                },
                error: function(xhr,hjhkjh,err) {
                    console.log(err);
                }
                
            });
            $('#toggle-one').bootstrapToggle();
            showTable();  
            //  location.reload();
             
        });
        $(document).on("click", "#closebtn",function(event){
            $("#form")[0].reset();
            $('#fname_error').html('');
            $('#lname_error').html(''); 
            $('#email_error').html('');
            $('#uname_error').html('');
            $('#pwd_error').html('');
            $('#cpwd_error').html('');
            $('#msg').html('');

        });
        
    
    });
 
    
</script>