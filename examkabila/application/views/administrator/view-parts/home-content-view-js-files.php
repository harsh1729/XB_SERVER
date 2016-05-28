<script type="text/javascript" src="<?=base_url();?>admin_docs/js/script.js"></script>
<script type="text/javascript" src="<?=base_url();?>docs/js/script.js"></script>
<script type="text/javascript" src="<?=base_url();?>plugins/ime_tool/libs/rangy/rangy-core.js"></script>
<script type="text/javascript" src="<?=base_url();?>plugins/ime_tool/src/jquery.ime.js"></script>
<script type="text/javascript" src="<?=base_url();?>plugins/ime_tool/src/jquery.ime.selector.js"></script>
<script type="text/javascript" src="<?=base_url();?>plugins/ime_tool/src/jquery.ime.preferences.js"></script>
<script type="text/javascript" src="<?=base_url();?>plugins/ime_tool/src/jquery.ime.inputmethods.js"></script>
<script type="text/javascript" src="<?=base_url();?>plugins/ime_tool/js/script.js"></script>
<script src="<?=base_url();?>plugins/dropzone/dropzone.js"></script>
<script type="text/javascript">







$(document).on('click','.get_gk',function(e)
{
    var id = $(this).data('id');
    if(id == 'next')
    {
        off_set = off_set-1;
        if(off_set == 1)
        {
            
            $('#next_button').prop('disabled', true);
        }
    }
    else
    {
        off_set = off_set+1;
        if(off_set >1)
        {
            $('#next_button').prop('disabled', false);
        }

    }


    

});




$(window).load(function(e){

    $.ajax(
            {
                 url :global_namespace.baseurl+"admin_request/blog/get_ajax_blog",
                 type: "POST",
                 data : "",
                 dataType:"json",
                 async:true,
                 success:function(response) 
                 {
                     $('#blog_selection').empty();
                    $('#blog_selection').append($('<option style="width:100px;">').text('select blog').prop('value',''));  
                    for(i=0;i<response.length;i++)
                    {
                            
                            $('#blog_selection').append($('<option style="width:100px;">').text("["+response[i].id+"] "+response[i].name).prop('value',response[i].id));                
                    }
                   
                 },
                 error: function(jqXHR, textStatus, errorThrown) 
                 {
                    $('#loading_bar').css("display","none");
                     
                    console.log(textStatus,errorThrown,jqXHR)   ;
                 }
            });
            e.preventDefault(); 
        

});
	$("#loading_bar").css("display","none");	

	var sub_flag = false;

	Dropzone.options.blogdropzone = {
            addRemoveLinks: true,
            parallelUploads: 1,
            acceptedFiles: 'image/*, audio/*, video/*',
            thumbnailWidth: 130,
            thumbnailHeight: 100,
            maxFiles: 1,
         //   previewTemplate: "<div class=\"dz-preview dz-file-preview\">\n  <div class=\"dz-details\">\n    <div class=\"dz-filename\"><span data-dz-name></span></div>\n    <div class=\"dz-size\" data-dz-size></div>\n    <img data-dz-thumbnail />\n  </div>\n <input type=\"text\" data-dz-doc-expiration-date class=\"dz-doc-input\" />\n <select class=\"dz-doc-input\" data-dz-doc-document-type-id  ></select>\n   <div class=\"dz-progress\"><span class=\"dz-upload\" data-dz-uploadprogress></span></div>\n  <div class=\"dz-success-mark\"><span>✔</span></div>\n  <div class=\"dz-error-mark\"><span>✘</span></div>\n  <div class=\"dz-error-message\"><span data-dz-errormessage></span></div>\n</div>",   
            uploadMultiple: false,
                init: function() {
                    _Bdropzone = this;
                    
                    
                  var blog_file_name;
                    
                  this.on("addedfile", function(file) {
                    
                    
                          }); 
                     
                     
                this.on("success", function(files, response) {
                       
                      console.log(response);
                        $('#status_link_image').val(response);
                        blog_file_name = response;
                
                    });
                          
                this.on("removedfile",function(file){
                    if(sub_flag != true)
                    {
                            var xmlhttp;
                            console.log("delete"+blog_file_name);
                        if (window.XMLHttpRequest)
                        {
                                 xmlhttp=new XMLHttpRequest();

                         }
                         else

                         {

                             xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

                         }

                        
                        xmlhttp.open("POST","<?=base_url()?>admin_request/blog/remove_image/"+blog_file_name,true);

                        xmlhttp.send();
                        $('#status_link_image').val("");
                    }
                            
                    });
                    
                    this.on("maxfilesexceeded", function(file){
                        this.removeAllFiles();
                        this.addFile(file);
                    });
 
                },          
          };


$('#blog_submit_form').submit(function(e){
        sub_flag = true;
        $('#loading_bar').css("display","block");
        var status_text = $('#status_text').html(); 
        var status_name = $('#status_name').html();
        var status_link_image =$('#status_link_image').val(); 
        var status_category = $( "#status_category" ).val();
        var status_language = $( "#status_language" ).val();
        var image_align = $('input[name=image_align]:checked').val()
        console.log(status_category);
        if($('#blog_text').html() == "")
        {
            $('#loading_bar').css("display","none");
            alert('blog text is empty');
            return false;
            
        }
            else
            {
              
                                        var formURL = $(this).attr("action");
                                        console.log(formURL);
                                        $.ajax(
                                            {
                                                url : formURL,
                                                type: "POST",
                                                data : {'status_text':status_text,'status_link_image':status_link_image,'status_name':status_name,'status_category':status_category,'status_language':status_language,'image_align':image_align},
                                                dataType:"json",
                                                async:true,
                                                success:function(data) 
                                                {
                                                $('#loading_bar').css("display","none");
                                                      
                                                        $("#status_link_image").val("");
                                                        $("#status_text").html("");
                                                        $('#status_name').html("");
                                                        $( "#status_category" ).val("");
                                                        $('#status_language').val("");
                                                        
                                                       
                                                       
                                                        
                                                            _Bdropzone.removeAllFiles();
                                                            alert(data);

                                                
                                                },
                                                error: function(jqXHR, textStatus, errorThrown) 
                                                {
                                                    $('#loading_bar').css("display","none");
                                                    alert("not success");  
                                                    console.log(textStatus,errorThrown,jqXHR)   ;
                                                }
                                            });
                                            e.preventDefault(); 
            }
                                                 
        
        

        
        
    });


</script>