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
                        $('#blog_link').val(response);
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

                        console.log("<?=base_url()?>admin_request/blog/remove_image/"+blog_file_name);
                        xmlhttp.open("POST","<?=base_url()?>admin_request/blog/remove_image/"+blog_file_name,true);

                        xmlhttp.send();
                        $('#blog_link').val("");
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
        var blog_text = $('#blog_text').html(); 
        var blog_name = $('#blog_name').html();
        var blog_link =$('#blog_link').val(); 
        var blog_selection = $( "#blog_selection" ).val();
        console.log(blog_text);
        if($('#blog_text').text() == "")
        {
            $('#loading_bar').css("display","none");
            alert('blog text is empty');
            return false;
            
        }

        if(blog_selection == '')
        {
             var image_align = $('input[name=image_align]:checked').val()
       
                                        var formURL = $(this).attr("action");
                                        $.ajax(
                                            {
                                                url : formURL,
                                                type: "POST",
                                                data : {'blog_text':blog_text,'blog_link':blog_link,'image_align':image_align,'blog_name':blog_name},
                                                dataType:"json",
                                                async:true,
                                                success:function(data) 
                                                {
                                                $('#loading_bar').css("display","none");
                                                      
                                                        $("#blog_link").val("");
                                                        $("#blog_text").html("");
                                                        $('#blog_name').html("");
                                                       
                                                       
                                                        
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
        else
        {
            var image_align = $('input[name=image_align]:checked').val()
       
                                       
                                        $.ajax(
                                            {
                                                url :global_namespace.baseurl+"admin_request/blog/submit_sub_text",
                                                type: "POST",
                                                data : {'blog_text':blog_text,'blog_link':blog_link,'image_align':image_align,'blog_id':blog_selection},
                                                dataType:"json",
                                                async:true,
                                                success:function(data) 
                                                {
                                                $('#loading_bar').css("display","none");
                                                      
                                                        $("#blog_link").val("");
                                                        $("#blog_text").html("");
                                                        $('#blog_name').html("");
                                                       
                                                       
                                                        
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