
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo $this->lang->line('share_file_header');?></h2>
    </div>
    
</div>
</br>

<div class="col-lg-12" id="demo">
            <div class="ibox float-e-margins">
                <div class="ibox-content text-center p-md">
                    <center>
                    <form class="form-horizontal" id="frm" enctype="multipart/form-data" mrthod="POST">
                        <div class="form-group">
                            <!-- <lable><h4><?php echo $this->lang->line('Select_file_label');?>:</h4></lable> -->
                            <input type="file" name="userfile" id="userfile"/>
                        </div>
                        
                        <input type="button" id="btnUpload" class="btn btn-success" value="<?php echo $this->lang->line('upload_btn');?>" />
                        <div class="loader" hidden></div>
                    </form>
                    </center>
                </div>
            </div>
</div>


</br></br>



<div class="row"> 
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><?php echo $this->lang->line('file_upload_tbl');?></h5>
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
                        <table class="table table-hover no-margins" id="filetable" style="background-color:white;">
                            <thead>
                                <tr>
                                <th><?php echo $this->lang->line('file_colm');?></th>
                                <th><?php echo $this->lang->line('size_colm');?></th>
                                <th><?php echo $this->lang->line('time_colm');?></th>
                                <th><?php echo $this->lang->line('action_colm');?></th>  </tr>
                            </thead>
                            <tbody>
                                <?php  foreach($data as $array_name=>$array):?>

                                <tr>
                                    <td style="text-align:left;"><?php echo $array['file'];?></td>
                                    <td><?php echo size_converter($array['size']);?></td>
                                    <td><?php $date = $array['uploadtime'];
                                                echo date('d-m-Y H:i:s',strtotime($date));
                                        ?></td>
                                    <td><button class="btn btn-success" id="downloadbtn"><a href="<?php echo CON_APP_URL.$array['filePath'];?>" style="color:white;text-decoration:none;" download><i class="fa fa-download"></i></a></button>
                                    <button class="btn btn-danger" id="deleteBtn" onclick="deleteFile('<?php echo  $array['id'];?>','<?php echo $array['file'];?>')"><i class="fa fa-trash"></i></button></td>
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


<script type = "text/javascript" language = "javascript">
    function showTable(){
        $.ajax({
            type: 'POST',
            url:"<?php echo CON_APP_URL."/shareFile/"?>",
            success: function(res) {
                $('#filetable').load(document.URL +  ' #filetable');
            },
            error: function(xhr,hjhkjh,err) {
                console.log(err);
                //$('#filetable').html('showtable');
            }
        });        
    }
    function deleteFile(id,filename){
        $.ajax({
                type:'POST',
                url:"<?php echo CON_APP_URL."/shareFile/deleteFile"?>/"+id+"/"+filename,
                
                success: function(res) {
                    showTable();    
                },
                error: function(xhr,hjhkjh,err) {
                    console.log(err);
                }
        });
    }
           
    $(document).ready(function() {
        $(window).load(function() {
            showTable();
            $('#btnUpload').prop('disabled', true);
            
        });
    
        $(document).on("click", "#btnUpload",function(event){
            $('#btnUpload').prop('disabled', true);
            $('.loader').show();
            // $('#demo').block({ 
            //         message: '<h1>Processing</h1>', 
            //         css: { border: '3px solid #a00'}
            //         });
             event.preventDefault(); 
            var formData = new FormData(this.form);
            //console.log(formData),
            $.ajax({
                type: 'POST',
                url:"<?php echo CON_APP_URL."shareFile/doUpload"?>" , 
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    $('.loader').hide();
                    $('#userfile').val('');
                    $('#btnUpload').prop('disabled', true);
                    alert('file is sucessfully uploaded.')
                    showTable();
                },
                error: function(xhr,hjhkjh,err) {
                    console.log(err);
                }
                
            });
        });
        // $(document).on('click','#userfile',function(){
        //     $.ajax({
        //         type: 'POST', 
        //     });
        // });
        $(document).on('change', '#userfile',function () {
            if ($(this).val() != '') {
                // $('#userfile').prop('disabled', true);
                 
                $('#btnUpload').prop('disabled', false);
            }
            else {
                // $('#userfile').prop('disabled', false);
                $('#btnUpload').prop('disabled', true);
            }
        });
        
    
    });
 
    
</script>