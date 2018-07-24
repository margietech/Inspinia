<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo $this->lang->line('leave_management_header');?></h2>
    </div>
    
</div>
<div class="row"> 
    <div class="col-lg-12" >
        <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><?php echo $this->lang->line('emp_leave_request_tbl');?></h5>
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
                                    <th><?php echo $this->lang->line('name_lbl');?></th>                                  
                                    <th><?php echo $this->lang->line('sub_lbl');?></th>
                                    <th><?php echo $this->lang->line('date_lbl');?></th>
                                    <th><?php echo $this->lang->line('leavetype_lbl');?></th>
                                    <th><?php echo $this->lang->line('status_lbl');?></th>
                                    <th><?php echo $this->lang->line('view_details_lbl');?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php  foreach($data as $array):?>

                                    <tr>
                                        <td><?php echo $array['firstname']." ".$array['lastname'];?></td>
                                        <td><?php echo $array['subject'];?></td>
                                        <td><?php $date_from = $array['date_from'];
                                        $date_to = $array['date_to'];
                                        $date_from = date('d-m-Y',strtotime($date_from));                    
                                        $date_to = date('d-m-Y',strtotime($date_to));
                                        echo $date_from." to ".$date_to;?></td>
                                        
                                        <td><?php echo $array['leave_type'];?></td>
                                        <td>
                                        
                                        <?php if($array['leave_status']=='Approve'):?>
                                        <?php echo $this->lang->line('approved_lbl')?>
                                        <?php elseif($array['leave_status']=='Reject'):?>
                                        <?php echo $this->lang->line('rejected_lbl')?>
                                        <?php else:?>
                                        <button class="btn btn-primary" id="approvebtn"><a href="<?php echo CON_APP_URL.'EmployeeLeave/approveRequest/'.$array['leave_id'];?>" style="color:white;text-decoration:none;"><?php echo $this->lang->line('approve_btn');?></a></button>
                                        <button class="btn btn-warning" id="rejectBtn"><a href="<?php echo CON_APP_URL.'EmployeeLeave/rejectRequest/'.$array['leave_id'];?>" style="color:white;text-decoration:none;"><?php echo $this->lang->line('reject_btn');?></a></button>
                                        <?php endif;?>
                                        </td>
                                        <td><button class="btn btn-info" onclick="view_detail(<?php echo $array['leave_id'];?>)"><i class="fa fa-eye"></i></button></td>
                                    </tr>

                                <?php endforeach;?>
                                <tr>
                                    <!-- pagination -->
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
</br>
</br></br>
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
</script>