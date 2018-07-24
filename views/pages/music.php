
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo $this->lang->line('music_header');?></h2>
    </div>
    
</div>
</br>

<div class="col-lg-12" id="demo">
            <div class="ibox float-e-margins">
                <div class="ibox-content text-center p-md">
                    <center>
                    <form class="form-horizontal" id="frm" enctype="multipart/form-data" mrthod="POST">
                        <div class="form-group">
                            
                            <input type="file" name="mp3file" id="mp3file"/>
                        </div>
                        
                        <input type="button" id="btnUpload" class="btn btn-success" value="<?php echo $this->lang->line('upload_btn');?>" />
                        <div class="loader" hidden></div>
                        </br></br>
                        
                    </form>
                    </center>
                </div>
            </div>
</div>
<div class="row"> 
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><?php echo $this->lang->line('audio_tbl');?></h5>
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
                        <table class="table table-hover no-margins" id="audiotable" style="background-color:white;">
                            <thead>
                                <tr>
                                    <th><?php echo $this->lang->line('title_lbl');?></th>
                                    <th><?php echo $this->lang->line('artist_lbl');?></th> 
                                    <th><i class="fa fa-clock-o"></i></th>
                                    <th><?php echo $this->lang->line('action_colm');?></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php  foreach($data as $array_name=>$array):?>

                                <tr>
                                    <td style="text-align:left;"><?php echo $array['audioTitle'];?></td>
                                    <td style="text-align:left;"><?php echo $array['audioArtist'];?></td>
                                    <td style="text-align:left;"><?php echo $array['audioDuration'];?></td>
                                    <td>
                                        <button class="btn btn-primary" id="playbtn" onclick="play_audio('<?php echo $array['audioId'];?>')"><i class="fa fa-play"></i></button>
                                        
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
<div id="audiomodal" style="display:none;background-color:#f3f3f4">    
</div>       
     
<script type = "text/javascript" language = "javascript">
    function show_table(){
        $.ajax({
            type: 'POST',
            url:"<?php echo CON_APP_URL."/music/"?>",
            success: function(res) {
                $('#audiotable').load(document.URL +  ' #audiotable');
            },
            error: function(xhr,hjhkjh,err) {
                console.log(err);
               
            }
        });        
    }
    function play_audio(audio_id){
        $('#audiomodal').hide();
        $.ajax({
            type: 'POST',
            url:"<?php echo CON_APP_URL."/music/getData/"?>"+audio_id,
            success: function(res) {
                $('#audiotag').remove();
                var res = JSON.parse(res);
                // console.log(res);
                var url ='<?php echo CON_APP_URL;?>'+res[0].audioFilePath;
                var file = res[0].audioTitle;
               
                console.log(url);
                $('#audiomodal').append('<div class="well well-sm" id="audiotag"><div class="row"><div class="col-sm-4" style="height:54px;line-height:45px;text-align:center;"><strong>'+file+'</strong></div><div class="col-sm-8"><audio controls style="width:90%" autoplay><source id="sourceid" src="'+url+'"></audio><button type="button" class="close" id="closebtn"><i class="fa fa-close"></i></button></div></div></div>');
                $('#audiomodal').css({bottom:0,position:'fixed',width:'100%',top:'auto',right:0,left:'auto','z-index':1000}).show();
            },
            error: function(xhr,hjhkjh,err) {
                console.log(err);
               
            }
        });      
    }
    $(document).ready(function() {
        $(window).load(function() {
            show_table();
        });
        $(document).on("click", "#btnUpload",function(event){
            event.preventDefault(); 
            var formData = new FormData(this.form);
            //console.log(formData),
            $.ajax({
                type: 'POST',
                url:"<?php echo CON_APP_URL."music/doUpload"?>" , 
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    // $('.loader').hide();
                    $('#mp3file').val('');
                    $('#btnUpload').prop('disabled', true);
                    alert('file is sucessfully uploaded.')
                    show_table();
                },
                error: function(xhr,hjhkjh,err) {
                    console.log(err);
                }
                
            });
        });
        $(document).on('change', '#mp3file',function () {
            if ($(this).val() != '') {
                // $('#userfile').prop('disabled', true);
                 
                $('#btnUpload').prop('disabled', false);
            }
            else {
                // $('#userfile').prop('disabled', false);
                $('#btnUpload').prop('disabled', true);
            }
        });
        // $(document).on('click', '#playbtn',function (event) {
        //     // $('#modal').modal('show');
        //     $('#audiomodal').css({bottom:0,position:'fixed',width:'100%',top:'auto',right:0,left:0}).show();
             
        // });
        $(document).on('click', '#closebtn',function (event) {
            $(this).css({right:'40px'})
            $('#audiomodal').hide();
            $('#audiotag').remove();
        });
    });
</script>