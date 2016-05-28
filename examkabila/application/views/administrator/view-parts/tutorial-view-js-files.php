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
	$("#loading_bar").css("display","none");


	var sub_flag = false;

	Dropzone.options.tutorialdropzone = {
            addRemoveLinks: true,
            parallelUploads: 1,
            acceptedFiles: 'image/*, audio/*, video/*',
            thumbnailWidth: 130,
            thumbnailHeight: 100,
            maxFiles: 1,
         //   previewTemplate: "<div class=\"dz-preview dz-file-preview\">\n  <div class=\"dz-details\">\n    <div class=\"dz-filename\"><span data-dz-name></span></div>\n    <div class=\"dz-size\" data-dz-size></div>\n    <img data-dz-thumbnail />\n  </div>\n <input type=\"text\" data-dz-doc-expiration-date class=\"dz-doc-input\" />\n <select class=\"dz-doc-input\" data-dz-doc-document-type-id  ></select>\n   <div class=\"dz-progress\"><span class=\"dz-upload\" data-dz-uploadprogress></span></div>\n  <div class=\"dz-success-mark\"><span>✔</span></div>\n  <div class=\"dz-error-mark\"><span>✘</span></div>\n  <div class=\"dz-error-message\"><span data-dz-errormessage></span></div>\n</div>",   
            uploadMultiple: false,
                init: function() {
                    _Tdropzone = this;
                    
                    
                  var tutorial_file_name;
                    
                  this.on("addedfile", function(file) {
                    
                    
                          }); 
                     
                     
                this.on("success", function(files, response) {
                       
                      console.log(response);
                        $('#tutorial_link').val(response);
                        tutorial_file_name = response;
                
                    });
                          
                this.on("removedfile",function(file){
                    if(sub_flag != true)
                    {
                            var xmlhttp;
                            console.log("delete"+tutorial_file_name);
                        if (window.XMLHttpRequest)
                        {
                                 xmlhttp=new XMLHttpRequest();

                         }
                         else

                         {

                             xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

                         }

                        
                        xmlhttp.open("POST","<?=base_url()?>admin_request/tutorial/remove_image/"+tutorial_file_name,true);

                        xmlhttp.send();
                        $('#tutorial_link').val("");
                    }
                            
                    });
                    
                    this.on("maxfilesexceeded", function(file){
                        this.removeAllFiles();
                        this.addFile(file);
                    });
 
                },          
          };


          $('#tutorial_submit_form').submit(function(e){
        sub_flag = true;
        $('#loading_bar').css("display","block");
        var tutorial_name = $('#tutorial_name').text(); 
        var tutorial_text =$('#tutorial_text').text(); 
        var tutorial_link = $('#tutorial_link').val();
       
                                        var formURL = $(this).attr("action");
                                        $.ajax(
                                            {
                                                url : formURL,
                                                type: "POST",
                                                data : {'tutorial_name':tutorial_name,'tutorial_text':tutorial_text,'tutorial_link':tutorial_link},
                                                dataType:"json",
                                                async:true,
                                                success:function(data) 
                                                {
                                               	$('#loading_bar').css("display","none");
                                                      
                                                        $("#tutorial_link").val("");
                                                        $("#tutorial_text").html("");
                                                        $("#tutorial_name").html("");
                                                       
                                                       
                                                        
                                            				_Tdropzone.removeAllFiles();
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
        
    });
</script>