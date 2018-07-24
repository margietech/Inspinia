<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo $this->lang->line('emp_report_header');?></h2>
    </div>
    
</div>
</br>

</br></br>
<div class="row"> 
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><?php echo $this->lang->line('emp_report_tbl');?></h5>
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
                        <table class="table table-hover no-margins" id="tasktable" style="background-color:white;">
                            <thead>
                                <tr>
                                    <th><?php echo $this->lang->line('date_lbl');?></th>
                                    <th><?php echo $this->lang->line('emp_name_lbl');?></th>
                                    <th>Total task</th>
                                    <th><?php echo $this->lang->line('view_details_lbl');?></th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php  foreach($data as $array):?>

                                    <tr>
                                        <td><?php $date= $array['date'];
                                        $date = date('d-m-Y',strtotime($date));
                                        echo $date;?></td>
                                        <td><?php echo $array['firstname']." ".$array['lastname'];?></td>
                                        <td><?php echo $array['totalTask'];?></td>
                                        <td><button class="btn btn-info" id="viewDeatilBtn" onclick="view_detail(<?php echo $array['reportId'];?>)"><i class="fa fa-eye"></i></button></td>
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
<div id="viewDetail" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo $this->lang->line('report_detail_lbl');?></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
            <div class="form-group">
                        <label class="control-label col-sm-2" for="reportid"><?php echo $this->lang->line('report_id_lbl');?>:</label>
                            <div class="col-sm-10"><div id="reportid"></div></div>
            </div>
            <div id="tasks"></div>  
            <div class="form-group">
                        <label class="control-label col-sm-2" for="generalissue"><?php echo $this->lang->line('generalissue_lbl');?>:</label>
                            <div class="col-sm-10"><div id="generalissue"></div></div>
            </div> 
                    
        </form>
        </div>
  

      <div class="modal-footer">
        <button type="button" id="closebtn" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script type = "text/javascript" language = "javascript">
    function view_detail(report_id){
        $.ajax({
                type:'POST',
                url:"<?php echo CON_APP_URL."dailyReport/getTask"?>/"+report_id,
                // dataType: "JSON",
                success: function(res) {
                    var res = JSON.parse(res);
                    // console.log(res);
                    $('#reportid').html(res[0].reportId);
                    for(var i=0;i<res[0].totalTask;i++){
                        var appendStep = '<div id="appendtask"><div class="form-group"><label class="control-label col-sm-2" for="task"><?php echo $this->lang->line('task_lbl');?>:</label><div class="col-sm-10"><span id="task[]" name="task['+i+']"></span></div></div><div class="form-group"><label class="control-label col-sm-2" for="duration"><?php echo $this->lang->line('duration_lbl');?>:</label><div class="col-sm-4"><p id="startTime[]" name="startTime['+i+']"></p></div><div class="col-sm-2">-</div><div class="col-sm-4"><p id="endTime[]" name="endTime['+i+']"></p></div></div><div class="form-group"><label class="control-label col-sm-2" for="issue"><?php echo $this->lang->line('issue_lbl');?>:</label><div class="col-sm-10"><div id="issue[]" name="issue['+i+']"></div></div></div></div>';   
                        $("[id='tasks']").append(appendStep);
                    }
                    for(var i=0;i<res[0].totalTask;i++){
                        $('[name="task['+i+']"]').html(res[i].task);
                        $('[name="startTime['+i+']"]').html(res[i].startTime);
                        $('[name="endTime['+i+']"]').html(res[i].endTime);
                        $('[name="issue['+i+']"]').html(res[i].issue);
                    }
                    
                    $('#generalissue').html(res[0].generalIssue);
                    $('#viewDetail').modal('show'); 
  
                },
                error: function(xhr,hjhkjh,err) {
                    console.log(err);
                }
        });
        $(document).on("click", "#closebtn",function(event){
            $("div[id='appendtask']").remove();
        });
    }
</script>