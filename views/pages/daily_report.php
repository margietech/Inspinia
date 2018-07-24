<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo $this->lang->line('daily_report_header');?></h2>
    </div>
    
</div>
</br>
<button type="button" class="btn btn-primary" onclick="add_report()"><?php echo $this->lang->line('add_report_lbl');?></button>
</br></br>
<div class="row"> 
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><?php echo $this->lang->line('my_daily_report_tbl');?></h5>
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
                                    
                                    <th><?php echo $this->lang->line('generalissue_lbl');?></th>
                                    <th>Total task</th>
                                    <th><?php echo $this->lang->line('action_colm');?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php  foreach($data as $array):?>

                                    <tr>
                                        <td><?php $date= $array['date'];
                                        $date = date('d-m-Y',strtotime($date));
                                        echo $date;?></td>

                                        <td><?php echo $array['generalIssue'];?></td>
                                        <td><?php echo $array['totalTask'];?></td>
                                        <td><button class="btn btn-success" id="editbtn" onclick="edit_task('<?php echo  $array['reportId'];?>')"><i class="fa fa-edit"></i></button>
                                        <button class="btn btn-danger" id="deleteBtn" onclick="delete_report('<?php echo  $array['reportId'];?>')"><i class="fa fa-trash"></i></button></td>
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
<!-- modal for new report -->
<div id="addReportModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo $this->lang->line('add_report_lbl');?></h4>
      </div>
      <div class="modal-body">
            <form class="form-horizontal" id="form">
                
                
                <div class="form-group">
                    
                    <label class="control-label col-sm-2" for="dateToday"><?php echo $this->lang->line('date_lbl');?>:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="dateToday" name="dateToday" value="<?php echo date('m/d/Y');?>"/> 
                    </div>
                </div>

                <div id="newtasks">
                <div class="panel panel-default">
                    <input id="totaltasks" name="totaltasks" type="hidden" value="1">
                    <div class="panel-heading"><?php echo $this->lang->line('task_lbl');?></div>
                    <div class="panel-body">
                        <div class="form-group">
                        
                            <label class="control-label col-sm-2" for="task"><?php echo $this->lang->line('task_lbl');?>:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="task" name="task[]">
                                <div name="task_error" style="color:red"></div> 
                        </div>
                        </div>
                        <div class="form-group">
                            
                            <label class="control-label col-sm-2" for="datetimes"><?php echo $this->lang->line('duration_lbl');?>:</label>
                                <div class="col-sm-4">
                                    <input id="startTime" name="startTime[]" type="text" class="form-control">
                                    <div name="duration_error" style="color:red"></div>
                                </div>
                                <label class="control-label col-sm-1" for="to">-</label>
                                <div class="col-sm-4">
                                    <input id="endTime" name="endTime[]" type="text" class="form-control">
                                </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="issue"><?php echo $this->lang->line('issue_lbl');?>:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="5" id="issue" name="issue[]"  placeholder="Optional"></textarea>
                            </div>
                        </div>
                    </div>   
                </div>
                </div>


                <div class="form-group"> 
                    <div class="col-sm-2">
                    <button type="button" class="btn btn-primary" id="addmorebtn" ><?php echo $this->lang->line('addmore_btn');?></button>
                    </div>
                </div>
                <div class="form-group">
                
                    <label class="control-label col-sm-2" for="generalissue"><?php echo $this->lang->line('generalissue_lbl');?>:</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="5" id="generalissue" name="generalissue" placeholder="Optional"></textarea>
                    </div>
                </div>
                
               
            </form>
        </div>
               
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" id="submitbtn"><?php echo $this->lang->line('submit_btn');?></button>
            <button type="button" class="btn btn-danger" id="closebtn" data-dismiss="modal"><?php echo $this->lang->line('close_btn');?></button>
        </div>
    </div>
  </div>
</div>
<!-- modal for edit task -->
<div class="modal fade" id="taskmodal" role="dialog">
    <div class="modal-dialog">
        

    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo $this->lang->line('edit_task_lbl');?></h4>
        </div>
        <div class="modal-body">
            <form class="form-horizontal" id="form">
            <input type="hidden" value="" name="reportId" id="reportId"/> 
            <input id="totaltask" name="totaltask" type="hidden">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="date"><?php echo $this->lang->line('date_lbl');?>:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="date" name="date">
                        
                    </div>         
                </div>

                <div id="newtasks"></div>
                
                <div class="form-group"> 
                    <div class="col-sm-2">
                    <button type="button" class="btn btn-primary" id="addmorebtn" ><?php echo $this->lang->line('addmore_btn');?></button>
                    </div>
                </div>
                <div class="form-group">                   
                    <label class="control-label col-sm-2" for="generalissue"><?php echo $this->lang->line('generalissue_lbl');?>:</label>
                    <div class="col-sm-10">          
                        <textarea class="form-control" id="generalissue" name="genissue"></textarea>
                    </div>
                </div>
            </form>
        </div>     

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" id="updatebtn"><?php echo $this->lang->line('update_btn');?></button>
            <button type="button" class="btn btn-danger" id="closebtn" data-dismiss="modal"><?php echo $this->lang->line('close_btn');?></button>
        </div>
            
    </div>
    </div>
    
</div>
<script type = "text/javascript" language = "javascript">
    var method;
    function add_report(){
        method = "insert";
        $("#form")[0].reset();
        $('#addReportModal').modal('show');       
    
    }
    function show_table(){
        $.ajax({
            type: 'POST',
            url:"<?php echo CON_APP_URL."dailyReport/"?>",
            success: function(res) {
                $('#tasktable').load(document.URL +  ' #tasktable');
            },
            error: function(xhr,hjhkjh,err) {
                console.log(err);
            }
        });        
    }
    
    function edit_task(report_id){
        
        method="update";
        $.ajax({
            url : "<?php echo CON_APP_URL.'dailyReport/getTask'?>/" + report_id ,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                console.log(data);
                $('input[name="reportId"]').val(data[0].reportId);
                $('input[name="date"]').val(data[0].date);
                $('input[name="totaltask"]').val(data[0].totalTask);
                for(var i=0;i<data[0].totalTask;i++){
                    var appendStep = ' <div class="panel panel-default" id="editTask"><div class="panel-heading"><?php echo $this->lang->line('task_lbl');?><button type="button" id="deletebtn" class="pull-right" onclick="delete_task()"><i class="fa fa-trash"></i></button></div><div class="panel-body"><input type="hidden" value="" name="taskId['+i+']" id="taskId"/><div class="form-group"><label class="control-label col-sm-2" for="task"><?php echo $this->lang->line('task_lbl');?>:</label><div class="col-sm-10"><input type="text" class="form-control" id="taskEdit" name="taskEdit['+i+']"><div name="task_error" style="color:red"></div></div></div><div class="form-group"><label class="control-label col-sm-2" for="datetimes"><?php echo $this->lang->line('duration_lbl');?>:</label><div class="col-sm-4"><input id="startTimePicker" name="startTimePicker['+i+']" type="text" class="form-control"><div name="duration_error" style="color:red"></div></div><label class="control-label col-sm-1" for="to">-</label><div class="col-sm-4"><input id="endTimePicker" name="endTimePicker['+i+']" type="text" class="form-control"></div></div><div class="form-group"><label class="control-label col-sm-2" for="issueEdit"><?php echo $this->lang->line('issue_lbl');?>:</label><div class="col-sm-10"><textarea class="form-control" rows="5" id="issueEdit" name="issueEdit['+i+']"  placeholder="Optional"></textarea></div></div></div></div>';
                    $("[id='newtasks']").append(appendStep);
                }
                for(var i=0;i<data[0].totalTask;i++){
                    $('input[name="taskEdit['+i+']"]').val(data[i].task);
                    $('input[name="startTimePicker['+i+']"]').val(data[i].startTime);
                    $('input[name="endTimePicker['+i+']"]').val(data[i].endTime);
                    $('textarea[name="issueEdit['+i+']"]').val(data[i].issue);
                    $('input[name="taskId['+i+']"]').val(data[i].taskId);
                }
                $('textarea[name="genissue"]').val(data[0].generalIssue);     
                $('#taskmodal').modal('show');
                $('input[id="startTimePicker"]').timepicker();
                $('input[id="endTimePicker"]').timepicker();
                $('input[name="date"]').daterangepicker({
                    singleDatePicker: true, 
                    locale: {
                        format: 'YYYY-MM-DD'
                    },
                });
               
            },
            error: function (jqXHR, textStatus, err)
            {
                console.log(err);
            }
        });
        
    }
    function delete_task(){
        var task_id = $('input[id="taskId"]').val();
        var report_id = $('input[id="reportId"]').val();
        // console.log(task_id);
        $.ajax({
                type:'POST',
                url:"<?php echo CON_APP_URL."dailyReport/deleteTask"?>/"+task_id+"/"+report_id,
                
                success: function(res) {
                    alert("are you sure You want to delete task?");
                    $('#taskmodal').modal('hide');
                    $("div[id='editTask']").remove();
                    $("div[id='newTask']").remove();
                    show_table();
                },
                error: function(xhr,hjhkjh,err) {
                    console.log(err);
                }
        });
    }
    function delete_report(report_id){
        $.ajax({
                type:'POST',
                url:"<?php echo CON_APP_URL."dailyReport/deleteReport"?>/"+report_id,
                
                success: function(res) {
                    alert("are you sure You want to delete report?");
                    
                    show_table();
                    
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
            $('#timepicker1').timepicker();
            
        });
        // timepicker for duration
        $(function() {
            $("#startTime").timepicker();
            $("#endTime").timepicker();
        });
              
        $(function() { //datepicker for date
            $('input[name="dateToday"]').daterangepicker({
                singleDatePicker: true, 
                
            });
        });
        
        $("#totaltasks").val("1");
        var addStep = 1;
        $("[id='addmorebtn']").click(function (e) {
            e.preventDefault(); 
            addStep += 1;
            $("#totaltasks").val(addStep);
            var appendStep = ' <div class="panel panel-default" id="newTask"><div class="panel-heading"><?php echo $this->lang->line('task_lbl');?><button type="button" id="remove" class="pull-right"><i class="fa fa-close"></i></button></div><div class="panel-body"><div class="form-group"><label class="control-label col-sm-2" for="task"><?php echo $this->lang->line('task_lbl');?>:</label><div class="col-sm-10"><input type="text" class="form-control" id="task" name="task[]"><div name="task_error" style="color:red"></div></div></div><div class="form-group"><label class="control-label col-sm-2" for="datetimes"><?php echo $this->lang->line('duration_lbl');?>:</label><div class="col-sm-4"><input id="startTime" name="startTime[]" type="text" class="form-control"><div name="duration_error" style="color:red"></div></div><label class="control-label col-sm-1" for="to">-</label><div class="col-sm-4"><input id="endTime" name="endTime[]" type="text" class="form-control"></div></div><div class="form-group"><label class="control-label col-sm-2" for="issue"><?php echo $this->lang->line('issue_lbl');?>:</label><div class="col-sm-10"><textarea class="form-control" rows="5" id="issue" name="issue[]"  placeholder="Optional"></textarea></div></div></div></div>';
            $("[id='newtasks']").append(appendStep);
            $(function() {
                $('input[name="startTime[]"]').timepicker();
                $('input[name="endTime[]"]').timepicker();
                
            });
            
        });
        $(document).on("click","#remove", function(e){ //user click on remove button
            e.preventDefault(); 
            $(this).parent('div').parent('div').remove(); 
            addStep--;
            
        })
        console.log(addStep);
        $(document).on("click", "#submitbtn",function(event){
            event.preventDefault(); 
            var task=[],startTime=[],endTime=[],issue=[];
            var task = $("input[name='task[]']").map(function(){return $(this).val();}).get();
            var startTime = $("input[name='startTime[]']").map(function(){return $(this).val();}).get();
            var endTime = $("input[name='endTime[]']").map(function(){return $(this).val();}).get();
            var issue = $("textarea[name='issue[]']").map(function(){return $(this).val();}).get();
            console.log(addStep);
            
            startTime.splice(addStep,addStep+1);
            endTime.splice(addStep,addStep+1);
            task.splice(addStep,addStep+1);
            issue.splice(addStep,addStep+1);
            // console.log(startTime);
            // console.log(endTime);
            // console.log(task);
            // console.log(issue);
            $.ajax({
                type:'POST',
                url:"<?php echo CON_APP_URL."dailyReport/newReport"?>",
                data: {
                    dateToday: $('#dateToday').val(),
                    task:task,
                    startTime:startTime,
                    endTime:endTime,
                    issue:issue,
                    generalissue:$('#generalissue').val(),
                    totalTask:addStep,
                    
                },
                success: function(res) {  
                    if(!$.trim(res)){
                        alert("Report is sucessfully submitted...");
                        $('#addReportModal').modal('hide'); 
                        location.reload();                      
                     }
                     else{
                        var res = JSON.parse(res);
                        $('[name="task_error"]').html(res.task);
                        $('[name="duration_error"]').html(res.endTime);
                        $('[name="duration_error"]').html(res.startTime);
                       
                    }
                        
                },
                error: function(xhr,hjhkjh,err) {
                    console.log(err);
                }
            });
            show_table();
        });
        $(document).on("click", "#updatebtn",function(event){
           
            event.preventDefault();
            var task=[],startTime=[],endTime=[],issue=[],taskId=[];
            var task = $("input[id='taskEdit']").map(function(){return $(this).val();}).get();
            var startTime = $("input[id='startTimePicker']").map(function(){return $(this).val();}).get();
            var endTime = $("input[id='endTimePicker']").map(function(){return $(this).val();}).get();
            var issue = $("textarea[id='issueEdit']").map(function(){return $(this).val();}).get();
            var taskId = $("input[id='taskId']").map(function(){return $(this).val();}).get();
            var totaltask = $("input[name='totaltask']").val();
            console.log(totaltask);
            startTime.splice(0,totaltask);
            endTime.splice(0,totaltask);
            task.splice(0,totaltask);
            issue.splice(0,totaltask);
            taskId.splice(0,totaltask);
            // console.log(task);
            // console.log(startTime);
            // console.log(endTime);
            // console.log(issue);
            // console.log(taskId);
            var newtask = $("input[name='task[]']").map(function(){return $(this).val();}).get();
            var newstartTime = $("input[name='startTime[]']").map(function(){return $(this).val();}).get();
            var newendTime = $("input[name='endTime[]']").map(function(){return $(this).val();}).get();
            var newissue = $("textarea[name='issue[]']").map(function(){return $(this).val();}).get();
            newstartTime.splice(0,addStep);
            newendTime.splice(0,addStep);
            newtask.splice(0,addStep);
            newissue.splice(0,addStep);
            // console.log(newtask);
            // console.log(newstartTime);
            // console.log(newendTime);
            // console.log(newissue);
            // console.log(addStep);
            
            $.ajax({
                type:'POST',
                url:"<?php echo CON_APP_URL."dailyReport/editTask"?>",
                data: {
                    date: $('#date').val(),
                    task:task,
                    startTime:startTime,
                    endTime:endTime,
                    issue:issue,
                    generalissue:$('textarea[name="genissue"]').val(),
                    reportId:$('#reportId').val(),
                    taskId:taskId,
                    newTotalTask:addStep-1,
                    edittask:totaltask,
                    newtask:newtask,
                    newstartTime:newstartTime,
                    newendTime:newendTime,
                    newissue:newissue,
                },
                success: function(res) {  
                    if(!$.trim(res)){
                        alert("data is sucessfully updated...");
                        $('#taskmodal').modal('hide');  
                        $("div[id='editTask']").remove();
                        $("div[id='newTask']").remove();                     
                     }
                     else{
                        // var res = JSON.parse(res);
                        // $('input[name="task_error[]"]').html(res.task);
                        // $('input[name="duration_error"]').html(res.endTime);
                        // $('input[name="duration_error"]').html(res.startTime);
                        
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
            $('[name="duration_error"]').html(''); 
            $('[name="task_error"]').html('');
            $("div[id='editTask']").remove();
            $("div[id='newTask']").remove();
        });
    });
    
   
</script>