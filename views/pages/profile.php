<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo $this->lang->line('profile_header');?></h2>
    </div>
    
</div></br>
<div class="ibox float-e-margins" id="profileDetail">
    <div class="ibox-content">
        <h3>Profile Detail</h3>
</br>

        <h4><strong><?php echo $displayData[0]['firstname'].' '.$displayData[0]['lastname']?></strong></h4>
        <p><i class="fa fa-map-marker"></i><?php if($displayData[0]['city']!=NULL){echo ' '.$displayData[0]['city'].', '.$displayData[0]['country'];}else{echo " Data not found.";}?></p>
        <p>
            <strong><?php echo $this->lang->line('email_lbl');?>:</strong><?php echo $displayData[0]['email'];?> 
        </p>
        <p>
            <strong><?php echo $this->lang->line('designation_lbl');?>:</strong><?php if($displayData[0]['city']!=NULL){echo $displayData[0]['designation'];}else{echo " Data not found.";}?> 
        </p>
        <button type="button" class="btn btn-success" onclick="edit_profile()"><?php echo $this->lang->line('edit_profile_btn');?></button>   
    </div>
</div>
<!-- modal for edit profile request -->
<div class="modal fade" id="model" role="dialog">
    <div class="modal-dialog">
    

    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo $this->lang->line('edit_profile_lbl');?></h4>
        </div>
        <div class="modal-body">
            <form class="form-horizontal" id="form">
                
                <!-- <input type="hidden" value="" name="id"/> -->         
                <div class="form-group">
                   <label class="control-label col-sm-2" for="city"><?php echo $this->lang->line('city_lbl');?>:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="city" name="city"> 
                        <div id="city_error" style="color:red"></div>
                   </div>
                </div>
                <div class="form-group">
                   <label class="control-label col-sm-2" for="country"><?php echo $this->lang->line('country_lbl');?>:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="country" name="country">
                        <div id="country_error" style="color:red"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="designation"><?php echo $this->lang->line('designation_lbl');?>:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="designation" name="designation"> 
                        <div id="designation_error" style="color:red"></div>
                    </div>
                </div>
                </br></br>
            </form>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" id="submitbtn"><?php echo $this->lang->line('submit_btn');?></button>
            <button type="button" class="btn btn-danger" id="closebtn" data-dismiss="modal"><?php echo $this->lang->line('close_btn');?></button>
        </div>
            
        
    </div>
    </div>
  
</div>
<script type = "text/javascript" language = "javascript">
    function edit_profile(){
        $("#form")[0].reset();
        $('#model').modal('show');       
    
    }
    $(document).ready(function(){
        $(document).on("click", "#submitbtn",function(event){
            event.preventDefault(); 
            var formData = new FormData(this.form);
            $.ajax({
                type:'POST',
                url:"<?php echo CON_APP_URL."profile/editProfile"?>",
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {  
                    if(!$.trim(res)){
                        alert("Profile data is sucessfully submitted...");
                        $('#model').modal('hide'); 
                        $('#profileDetail').load(document.URL +  ' #profileDetail');                      
                    }
                    else{
                        var res = JSON.parse(res);
                        $('#city_error').html(res.city);
                        $('#designation_error').html(res.designation);
                        $('#country_error').html(res.country); 
                        
                    }
                    //$('#profileDetail').load(document.URL +  ' #profileDetail');    
                },
                error: function(xhr,hjhkjh,err) {
                    console.log(err);
                }
            });
        });
        
        $(document).on("click", "#closebtn",function(event){
            $("#form")[0].reset();
            $('#city_error').html('');
            $('#designation_error').html(''); 
            $('#country_error').html('');
        });
    });
</script>