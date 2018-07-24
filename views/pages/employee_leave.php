<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo $this->lang->line('leave_requests_header');?></h2>
    </div>
    
</div>
</br>
<button type="button" class="btn btn-success" onclick="leave_request()"><?php echo $this->lang->line('request_leave_btn');?></button>
</br></br>
<!-- table of leave requests -->
<div class="row"> 
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><?php echo $this->lang->line('my_leave_request_tbl');?></h5>
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
                        <table class="table table-hover no-margins" id="leavetable" style="background-color:white;">
                            <thead>
                                <tr>
                                    <th><?php echo $this->lang->line('sub_lbl');?></th>
                                    <th><?php echo $this->lang->line('date_lbl');?></th>
                                    <th><?php echo $this->lang->line('leavetype_lbl');?></th>
                                    <th><?php echo $this->lang->line('status_lbl');?></th>
                                    <th><?php echo $this->lang->line('action_colm');?></th>
                                    <th><?php echo $this->lang->line('view_details_lbl');?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php  foreach($data as $array):?>

                                    <tr>
                                        <td><?php echo $array['subject'];?></td>
                                        <td><?php $date_from = $array['date_from'];
                                        $date_from = date('d-m-Y',strtotime($date_from));
                                        $date_to = $array['date_to']; 
                                        $date_to = date('d-m-Y',strtotime($date_to));
                                        echo $date_from." to ".$date_to;?></td>
                                        <td><?php echo $array['leave_type'];?></td>
                                        <td><?php echo $array['leave_status'];?></td>
                                        <?php if(strtotime($date_to)<strtotime(date('Y-m-d'))):?>
                                        <td></td>
                                        <?php else:?>
                                        <td>
                                        <button class="btn btn-danger" id="cancelBtn" onclick="delete_request('<?php echo  $array['leave_id'];?>')"><?php echo $this->lang->line('cancel_btn');?></button>
                                        </td>
                                        <?php endif;?>
                                        <td><button class="btn btn-info" id="viewDeatilBtn" onclick="view_detail(<?php echo $array['leave_id'];?>)"><i class="fa fa-eye"></i></button></td>
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

<!-- modal for new leave request -->
<div class="modal fade" id="model" role="dialog">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo $this->lang->line('add_request_lbl');?></h4>
        </div>
        <div class="modal-body">
            <form class="form-horizontal" id="form">
                
                <!-- <input type="hidden" value="" name="id"/> -->      
                
                <div class="form-group">
                <label class="control-label col-sm-2" for="daterange"><?php echo $this->lang->line('date_lbl');?>:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="daterange" value="mm/dd/yyyy - mm/dd/yyyy" id="daterange"/>
                    </div>
                </div>
                <div class="form-group">
                 <label class="control-label col-sm-2" for="subject"><?php echo $this->lang->line('sub_lbl');?>:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="subject" name="subject"> 
                        <div id="sub_error" style="color:red"></div>
                   </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="description"><?php echo $this->lang->line('desc_lbl');?>:</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="5" id="description" name="description"></textarea>
                        <div id="descrp_error" style="color:red"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="leavetype"><?php echo $this->lang->line('leavetype_lbl');?>:</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="leavetype" id="leavetype">
                            <option for="leavetype"><?php echo $this->lang->line('cl_lbl');?></option>
                            <option for="leavetype"><?php echo $this->lang->line('sl_lbl');?></option>
                        </select>  
                    </div>
                </div>
            </form>
        </div>
                </br>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" id="requestbtn"><?php echo $this->lang->line('request_btn');?></button>
            <button type="button" class="btn btn-danger" id="closebtn" data-dismiss="modal"><?php echo $this->lang->line('close_btn');?></button>
        </div>
            
        
    </div>
    </div>
</div>
<!-- modal foe leave details -->
<div id="viewDetail" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo $this->lang->line('leave_detail_lbl');?></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
            <div class="form-group">
                        <label class="control-label col-sm-2" for="subject"><?php echo $this->lang->line('leave_id_lbl');?>:</label>
                            <div class="col-sm-10"><div id="leaveid"></div></div>
            </div>
            <div class="form-group">
                        <label class="control-label col-sm-2" for="detail"><?php echo $this->lang->line('details_lbl');?>:</label>
                            <div class="col-sm-10"><div id="detail"></div></div>
            </div>
                
        </form> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

  <script type = "text/javascript" language = "javascript">
    function leave_request(){
        $("#form")[0].reset();
        $('#model').modal('show');       
    
    }
    function show_table(){
        $.ajax({
            type: 'POST',
            url:"<?php echo CON_APP_URL."EmployeeLeave/"?>",
            success: function(res) {
                $('#leavetable').load(document.URL +  ' #leavetable');
            },
            error: function(xhr,hjhkjh,err) {
                console.log(err);
            }
        });        
    }
    function delete_request(id){
        $.ajax({
                type:'POST',
                url:"<?php echo CON_APP_URL."EmployeeLeave/cancelRequest"?>/"+id,
                
                success: function(res) {
                    alert("are you sure You want to cancel request?")
                    show_table();    
                },
                error: function(xhr,hjhkjh,err) {
                    console.log(err);
                }
        });
    }
    function view_detail(id){
        $.ajax({
                type:'POST',
                url:"<?php echo CON_APP_URL."EmployeeLeave/viewDetail"?>/"+id,
                // dataType: "JSON",
                success: function(res) {
                    var res = JSON.parse(res);
                    console.log(res);
                    $('#leaveid').html(res[0].leave_id);
                    $('#detail').html(res[0].description);
                    $('#viewDetail').modal('show'); 
  
                },
                error: function(xhr,hjhkjh,err) {
                    console.log(err);
                }
        });
    }
    $(document).ready(function(){
        $("#form")[0].reset();

        $(window).load(function() {
            show_table();
            
        });
    
        $(function() {
            $('input[name="daterange"]').daterangepicker({
                opens: 'left',
                format:'mm/dd/yyyy',
                startDate: new Date(),
                minDate: new Date(),
            });
        });
        $(document).on("click", "#requestbtn",function(event){
            event.preventDefault(); 
            var formData = $('form').serialize();
            $.ajax({
                type:'POST',
                url:"<?php echo CON_APP_URL."EmployeeLeave/addLeave"?>",
                data: formData,
                success: function(res) {  
                    if(!$.trim(res)){
                        alert("Leave is sucessfully submitted...");
                        $('#model').modal('hide');                       
                     }
                     else{
                        var res = JSON.parse(res);
                        $('#sub_error').html(res.subject);
                        $('#descrp_error').html(res.description); 
                        
                    }
                        
                },
                error: function(xhr,hjhkjh,err) {
                    console.log(err);
                }
            });
            show_table();
        });
        
        $(document).on("click", "#closebtn",function(event){
            $("#form")[0].reset();
            $('#sub_error').html('');
            $('#descrp_error').html(''); 
        });
    });
  </script>
  