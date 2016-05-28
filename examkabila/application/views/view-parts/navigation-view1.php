<!-- start of register container -->
<?php $logged_in = $this->session->userdata('is_logged_in'); ?>

<style type="text/css">
  .download_section:hover
  {
      background-color: #4F8D05;
  }
  .myaccount_section:hover  
  {
   background-color: #E19416;
  }
  .header_logo
  {
    background-image: url("<?=base_url()?>docs/images/header_logo.png");
    background-repeat: no-repeat;
    background-position:center;
    background-size:cover;
    color:#fff;
    text-align:center;
  }


 .la-ball-clip-rotate,
.la-ball-clip-rotate > div {
    position: relative;
    -webkit-box-sizing: border-box;
       -moz-box-sizing: border-box;
            box-sizing: border-box;
}
.la-ball-clip-rotate {
    display: block;
    font-size: 0;
    color: #fff;
}
.la-ball-clip-rotate.la-dark {
    color: #333;
}
.la-ball-clip-rotate > div {
    display: inline-block;
    float: none;
    background-color: currentColor;
    border: 0 solid currentColor;
}
.la-ball-clip-rotate {
    width: 32px;
    height: 32px;
}
.la-ball-clip-rotate > div {
    width: 32px;
    height: 32px;
    background: transparent;
    border-width: 2px;
    border-bottom-color: transparent;
    border-radius: 100%;
    -webkit-animation: ball-clip-rotate .75s linear infinite;
       -moz-animation: ball-clip-rotate .75s linear infinite;
         -o-animation: ball-clip-rotate .75s linear infinite;
            animation: ball-clip-rotate .75s linear infinite;
}
.la-ball-clip-rotate.la-sm {
    width: 16px;
    height: 16px;
}
.la-ball-clip-rotate.la-sm > div {
    width: 16px;
    height: 16px;
    border-width: 1px;
}
.la-ball-clip-rotate.la-2x {
    width: 64px;
    height: 64px;
}
.la-ball-clip-rotate.la-2x > div {
    width: 64px;
    height: 64px;
    border-width: 4px;
}
.la-ball-clip-rotate.la-3x {
    width: 96px;
    height: 96px;
}
.la-ball-clip-rotate.la-3x > div {
    width: 96px;
    height: 96px;
    border-width: 6px;
}
/*
 * Animation
 */
@-webkit-keyframes ball-clip-rotate {
    0% {
        -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
    }
    50% {
        -webkit-transform: rotate(180deg);
                transform: rotate(180deg);
    }
    100% {
        -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
    }
}
@-moz-keyframes ball-clip-rotate {
    0% {
        -moz-transform: rotate(0deg);
             transform: rotate(0deg);
    }
    50% {
        -moz-transform: rotate(180deg);
             transform: rotate(180deg);
    }
    100% {
        -moz-transform: rotate(360deg);
             transform: rotate(360deg);
    }
}
@-o-keyframes ball-clip-rotate {
    0% {
        -o-transform: rotate(0deg);
           transform: rotate(0deg);
    }
    50% {
        -o-transform: rotate(180deg);
           transform: rotate(180deg);
    }
    100% {
        -o-transform: rotate(360deg);
           transform: rotate(360deg);
    }
}
@keyframes ball-clip-rotate {
    0% {
        -webkit-transform: rotate(0deg);
           -moz-transform: rotate(0deg);
             -o-transform: rotate(0deg);
                transform: rotate(0deg);
    }
    50% {
        -webkit-transform: rotate(180deg);
           -moz-transform: rotate(180deg);
             -o-transform: rotate(180deg);
                transform: rotate(180deg);
    }
    100% {
        -webkit-transform: rotate(360deg);
           -moz-transform: rotate(360deg);
             -o-transform: rotate(360deg);
                transform: rotate(360deg);
    }
}
#urgent_download:hover
{
	text-decoration:underline;
}
  
</style>

<script type="text/javascript">
  


</script>

<!-- fixed variables in vebsite which are fixed at on palace all the time -->
 <!--<div id="facebook_container" class="" style="padding:20px;display:none;border-radius:50px; color:#fff;height:100px;width:100px;position:fixed;background-color:#E21A10;cursor:pointer;z-index:500;left:-50px;">
  </div>-->
<!-- <div class="share_button" id="facebook_container"  style="padding:20px;display:none;border-radius:50px; color:#fff;height:100px;width:100px;position:fixed;background-color:#E21A10;cursor:pointer;z-index:500;left:-50px;" data-image="<?=base_url()?>docs/images/fb_image.png" data-content="examkabila.com" data-links="http://examkabila.com"></div>
<div id="fb-root" style=""></div>

  <div class="text-center"  id="bank_notice_container_click" style="display:none;cursor:pointer;font-weight:bold;color:#fff;padding:25px 25px;height:100px;width:100px;position:fixed;left:-50px;background-color:#E21A10;z-index:500; border-radius:50px;">
  </div>
     <div id="bank_notice_container"  style="top:100px;height:520px;width:250px;position:fixed;background-color:#F5F5F5;left:-250px;cursor:pointer;z-index:500;border-top:1px solid #E21A10;border-right:1px solid #E21A10;border-bottom:1px solid #E21A10;">
      <img src="<?=base_url()?>docs/images/cancelbtn.png" align="right" style="height:20px;width:20px;" id="notice_container_cancel">
      <div style="width:100%;color:#fff;background-color:#E21A10;padding:5px 0px;font-weight:bold;" class="text-center">
            Exam Alert
        </div>
      <div id="bank_notice_container_content" class="nicescroll" style="width:100%;padding:10px;margin-top:50px;color:#000;overflow-y:auto;">
        
      </div>
  </div> -->



 <div id="loading_div" style="height:100%;width:100%;background-color:rgba(0,0,0,0.6);position:fixed;z-index:1200;text-align:center;"> <div style="color: #fff;margin-left:47vw;margin-top:47vh;" class="la-ball-clip-rotate la-3x">
  <div></div>
</div></div>

<div id="cart" style="height:350px;width:350px;background-color:#7ADBF0;position:fixed;z-index:2050;right:0px;bottom:0px;display:none;">
  <center><div style=" color:#fff;padding:5px;font-size:18px;border-bottom:1px solid #fff;">Cart</div></center>
  <div  id="cart_content" style="width:100%;height:250px;overflow-y:auto;overflow-x:hidden;">
    
  </div>

  <div style="position:absolute;bottom:10px;width:100%;font-size:16px;background-color:#7ADBF0;padding-top:8px;"><div style="color:#fff;margin-bottom:5px;font-weight:bold;"><span>Total:</span><span id="cart_total_items" style='margin-left:50px;'></span><span id="cart_total_money" style='margin-left:80px;'></span> </div><center><a href="<?=base_url()?>Cart/purchase_item"><button type="button" id="cart_buy_button" class="btn btn-sm" style=" color:#fff;background-color:#faa519">Buy</button></a><button type="button" id="cart_cancel" class="btn btn-sm" style="margin-left:10px; color:#fff;background-color:#faa519">cancel</button></center></div>
  
</div>


<!-- end of fixed variables -->

<div id="Resiter_form_container" style="height:100%; width:100%;background-color:rgba(0,0,0,0.6);position:fixed;z-index:1000;display:none;    ">
  <div class="row">
      <div class="col-md-12 text-right">
          <input type="button" id="Resiter_form_cancel_button" style="background:url(<?=base_url()?>docs/images/cancelbutton.png);background-size:cover;border:none; margin-right:10px;margin-top:5px; height:40px; width:40px;" />
        </div>
    </div>
    <div class="container-fluid2">
    <div class="row-fluid fullheight" >
            <form role="form" class="form-horizontal" id="Resiterform" action="<?=base_url()?>client_requests/user_info/user_register" method="post">
                  <div class="col-lg-12 col-md-12" style="">
                      
                      <div class="row">
                          <div class="col-lg-3 col-md-3">
                          </div>
                          <div class="col-lg-6 col-md-6 background_form" >
                                <div class="row" style="text-align:center;background-color:#7ADBF0;color:#FFF;border-top-left-radius:5px;border-top-right-radius:5px;">
                                      <h3>SIGN UP</h3>
                                    </div>
                            
                                <div class="input-group margin_row">
                          <span class="input-group-addon" style="border:solid 1px #999999; background-color:#7ADBF0"><span style="color:#FFF;" class="glyphicon glyphicon-user"></span></span>
                            <input  class="input_size "  placeholder="Name" required name="Resiter_Name" type="text" maxlength="30" pattern=".{3,30}" title="3 characters minimum" aria-required="true" pattern="[A-Za-z-0-9]+" />
 
 
                      </div>   
                                    
                                    <div class="input-group margin_row">
                            <span class="input-group-addon" style="border:solid 1px #999999; background-color:#7ADBF0"><span style="color:#FFF;" class="glyphicon glyphicon-envelope"></span></span>
                            <input required name="Resiter_email" placeholder="Email Id" class="input_size" type="email"  /><br />
                      </div> 
                                    <div class="input-group margin_row">
                            <span class="input-group-addon" style="border:solid 1px #999999; background-color:#7ADBF0"><span style="color:#FFF;" class="glyphicon glyphicon-phone"></span></span>
                            <input required name="Resiter_Phone_No" placeholder="Contact Number" class="input_size" maxlength="12" pattern=".{10,}" pattern="[0-9]+" type="text" />
                      </div> 
                                  <div class="input-group margin_row">
                            <span class="input-group-addon" style="border:solid 1px #999999; background-color:#7ADBF0"><span style="color:#FFF;" class="glyphicon glyphicon-user"></span></span>
                            <input required name="Resiter_username" placeholder="User Name" class="input_size" maxlength="20" pattern=".{4,}" title="4 characters minimum" type="text" />
                      </div> 
                                     <div class="input-group margin_row">
                            <span class="input-group-addon" style="border:solid 1px #999999; background-color:#7ADBF0"><span style="color:#FFF;" class="glyphicon glyphicon-lock"></span></span>
                            <input required name="Resiter_password" id="Resiter_password" placeholder="Password" class="input_size" pattern=".{6,}" title="4 characters minimum" type="text" />
                      </div> 
                                    <div id="error_massage_registered" style="color:#F00;"></div>
                                    <div class="row margin_row">
                                      <div class="col-lg-4 col-md-4">
                                        </div>
                                        <div class="col-lg-4 col-md-4">
                                          <button type="submit" id="register_button" class="submit_button" style="padding:5px;" ><span class="glyphicon glyphicon-log-in"></span> Submit</button>
                                        </div>
                                        <div class="col-lg-4 col-md-4">
                                        </div>
                                        
                                    </div>
                                       
                              
                          </div>
                          
                         
                          <div class="col-lg-3 col-md-4">
                          </div>  
            </div>
                  
                  
                  </div>
        </form> 
        </div>                            
  </div>

</div>

<!-- end of register container -->


<!-- start of login container -->

<div id="login_form_container" style="height:100%; width:100%;background-color:rgba(0,0,0,0.6);position:fixed;z-index:1000;display:none; ">
    <div class="row">
      <div class="col-md-12 text-right">
          <input type="button" id="login_form_cancel_button" style="background:url(<?=base_url()?>docs/images/cancelbutton.png);background-size:cover;border:none; margin-right:10px;margin-top:5px; height:40px; width:40px;" />
        </div>
    </div>
    <div class="container-fluid1">
  
  <div class="row-fluid fullheight" style="">
    <div class="col-md-4 col-sm-4 col-xs-2"></div>
    <div class="col-md-4 col-sm-4 col-xs-8">
          
              
                <div class="row" style="margin-top:-250px;">
                       <div class="col-md-1">
                       </div>
                       <span style="color:#FFF;">Login first please ! </span>
                       <div class="col-md-10 textalign">
                            <div class="row">

                                    <div class="col-md-1 col-sm-1 col-xs-1"></div>

                                    <div class="col-md-10 col-sm-10 col-xs-10 background-check ">

                                            <div class="row">
                                            <div class="col-lg-12 loginheader lead">LogIn</div>
                                        </div>
                                                <div class="row">
                                                    <div class="col-lg-12 text-left ">
                                                        <span id="login_error_message" class="text-danger"></span>
                                                        </div>
                                                </div>
                                            <form id="Longinform"  action="<?=base_url()?>client_requests/user_info/user_login" method="post">
                                                <input style="" id="username" type="text" class="form-control textfield" required="required" placeholder="username"/>
                              <input id="password" style="" type="password" class="form-control" required="required" placeholder="password"/>
                                    <button type="submit" id="login_button" class="btn btn-lg loginbottom" ><span class="glyphicon glyphicon-log-in"></span> LogIn</button>
                                            </form>
                                            <div class="row">
                                      <div class="col-sm-1">
                                        
                                      </div>
                                      <div class="col-sm-10 text-right" style="padding:10px;">
                                          
                                             <a class="signup" style="color:#000;cursor:pointer;"><b> Signup Now </b></a> 
                                        
                                            
                                      </div>
                                      <div class="col-sm-1">
                                        
                                      </div>
                                  </div>
                                </div>
                                        </div>
                                       
                                        <div class="col-md-1 col-sm-1 col-xs-1"></div>
                        	
                                 
                        </div>
                       <div class="col-md-1">

                       </div>
                </div>
            
    </div>
    <div class="col-md-4 col-sm-4 col-xs-2"></div>
        
  </div>
</div>
</div>

<!-- end of login container -->

<div class="container-fluid" style="background-color:#fff;">


  
  <div class="row" style="background-color:#7ADBF0;color:#fff;">
     <div class="col-xs-1">
      
    </div>

      <div class="hidden-xs col-sm-2">
      <div style="height:75px;width:100%;background-color:#7ADBF0;color:#000;" >
        <!-- <a href="<?= base_url(); ?>Home">  <div style="height:2.5vw;width:68%;background-color:#7ADBF0;color:#000;margin-top:15px;position:absolute;cursor:pointer;" class="header_logo"> -->

        <a href="<?= base_url(); ?>Bankpo">  <div style="height:2.5vw;width:68%;background-color:#7ADBF0;color:#000;margin-top:15px;position:absolute;cursor:pointer;" class="header_logo">
         
        </div></a>
        
      </div>
    </div>
    <!-- <div class="col-md-3 col-sm-2 col-xs-2">
      <div class="fb-like" style="margin-top:50px;position:absolute;z-index:2000;" data-href="https://www.facebook.com/Exam-Kabila-786375854763781/timeline/" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>
        <div id="fb-root"></div>
    </div> --> 
    <div class="col-md-9 col-sm-9 col-xs-11" >
       <?php if($this->session->userdata('is_logged_in')) { ?>
        <div id="menu_container" style="height:75px;background-color:#7ADBF0;color:#fff;display:none;" >
         
            <div class="custom_menu my_account" style="cursor:pointer;height:75px;position:relative;border-top:10px solid #faa519;float:right;">
              <div id="custom_acount" class="text-center" style=" width:100%;background-color:#faa519;position:absolute;display:none;z-index:2;">
                <a href="<?=base_url()?>Bankpo/results" style="color:#fff;text-decoration:none;">
                    <div class="myaccount_section" style="margin-top:65px;padding:7px 0px;" >
                      Results
                    </div>
                  </a>
                  <a href="<?=base_url()?>Bankpo/purchageditem" style="text-decoration:none;color:#fff;">
                    <div class="myaccount_section" style="padding:7px 0px;display:none;" >
                      Purcheses
                    </div>
                  </a> 
                  <a href="<?=base_url()?>Bankpo/bankposetpdf" style="text-decoration:none;color:#fff;">
                    <div class="myaccount_section" style="padding:7px 0px;display:none;" >
                      Videos
                    </div>
                  </a>  
                  
                  <a href="<?=base_url()?>client_requests/user_info/logout" style="text-decoration:none;color:#fff;">
                    <div class="myaccount_section" style="padding:7px 0px;" >
                      Logout
                    </div>
                  </a>
              </div>
              <div style="height:65px;z-index:3;font-size:20px;font-weight:normal;letter-spacing:-2px; position:relative;padding:15px 25px;">
                My Account
              </div>
            
            </div>
            <div class="custom_menu video" style="height:75px;cursor:pointer;position:relative;border-top:10px solid #8063C5;float:right;display:none;">
              <div style="height:65px; width:100%;background-color:#8063C5;position:absolute;display:none;">
              
              </div>
              <div style="height:65px;letter-spacing:-2px;z-index:2;font-size:25px;position:relative;padding:15px 25px;">
                Vedio
              </div>
            
            </div>
              <a href="<?=base_url()?>Blog" style="color:#fff;">
              <div class="custom_menu blog" style="height:75px;position:relative;cursor:pointer;border-top:10px solid #E21A10;float:right;">
                <div style="height:65px; width:100%;background-color:#E21A10;position:absolute;display:none;">
                
                </div>
                <div style="height:65px;z-index:2;font-size:20px;position:relative;letter-spacing:-2px;padding:15px 25px;">
                  Blog
                </div>
              
              </div>
             </a> 
            <div class="custom_menu download" style="height:75px;cursor:pointer;position:relative;border-top:10px solid #7BB635;float:right;">
              <div class="text-center" style="width:100%;background-color:#7BB635;position:absolute;display:none;z-index:100;">
                 <a href="<?=base_url()?>Bankpo/lastyearpdf" style="text-decoration:none;color:#fff;">
                    <div class="download_section" style="margin-top:65px;padding:7px 0px;display:none;">
                    Last Year Paper PDF
                    </div>
                  </a>
                  <a href="<?=base_url()?>Bankpo/bankinggkpdf" style="text-decoration:none;color:#fff;">
                    <div class="download_section" style="padding:7px 0px;margin-top:65px;" >
                    Current Affairs PDF
                    </div>
                  </a> 
                  <a href="<?=base_url()?>Bankpo/bankposetpdf" style="text-decoration:none;color:#fff;">
                    <div class="download_section" style="padding:7px 0px;">
                    Bank PO Set PDF
                    </div>
                  </a>  
                   <a href="<?=base_url()?>Bankpo/importantpdf" style="text-decoration:none;color:#fff;">
                    <div class="download_section" style="padding:7px 0px;" >
                    Important PDF
                    </div>
                  </a>  
              </div>
              <div style="height:65px;z-index:101;font-size:20px;letter-spacing:-2px;position:relative;padding:15px 25px;">
                Download
              </div>
            
            </div>
            <a href="<?=base_url('bankpo/current_affaires')?>" style="color:#fff;">
              <div class="custom_menu current_affaires" style="height:75px;position:relative;cursor:pointer;border-top:10px solid #faa519;float:right;">
                <div style="height:65px; width:100%;background-color:#faa519;position:absolute;display:none;">
                
                </div>
                <div style="height:65px;z-index:2;font-size:20px;position:relative;letter-spacing:-2px;padding:15px 25px;">
                  Current Affairs
                </div>
              
              </div>
             </a>
            <a href="<?=base_url()?>Bankpo" style="color:#fff;">
              <div class="custom_menu home" style="height:75px;position:relative;cursor:pointer;border-top:10px solid #E21A10;float:right;">
                <div style="height:65px; width:100%;background-color:#E21A10;position:absolute;display:none;">
                
                </div>
                <div style="height:65px;z-index:2;font-size:20px;position:relative;letter-spacing:-2px;padding:15px 25px;">
                  Home
                </div>
              
              </div>
             </a> 
           
        </div>
             
      </div>
      <?php } else { ?>


          <div id="menu_container" style="height:75px;background-color:#7ADBF0;color:#fff;display:none;" >
        
            <div class="custom_menu my_account" style="cursor:pointer;height:65px;position:relative;border-top:10px solid #faa519;float:right;">
              <div id="custom_acount" class="text-center" style=" width:100%;background-color:#faa519;position:absolute;display:none;z-index:2;">
                
                    <div class="myaccount_section not_logged_in" data-controller="Bankpo/results" style="margin-top:65px;padding:7px 0px;" >
                      Results
                    </div>
                    
                    <div class="myaccount_section not_logged_in" data-controller="Bankpo/purchageditem" style="padding:7px 0px;display:none;" >
                      Purcheses
                    </div>
                  
                  
                    <div class="myaccount_section not_logged_in" data-controller="Bankpo/lastyearpdf" style="padding:7px 0px;display:none;" >
                      Videos
                    </div>
                  
                   
                  
              </div>
              <div style="height:65px;z-index:3;font-size:20px;font-weight:normal;letter-spacing:-2px; position:relative;padding:15px 25px;">
                My Account
              </div>
            
            </div>
            <div class="custom_menu video" style="height:75px;cursor:pointer;position:relative;border-top:10px solid #8063C5;float:right;display:none;">
              <div style="height:65px; width:100%;background-color:#8063C5;position:absolute;display:none;">
              
              </div>
              <div style="height:65px;letter-spacing:-2px;z-index:2;font-size:25px;position:relative;padding:15px 25px;">
                Vedio
              </div>
            
            </div>
             <a href="<?=base_url()?>Blog" style="color:#fff;">
              <div class="custom_menu blog" style="height:75px;position:relative;cursor:pointer;border-top:10px solid #E21A10;float:right;">
                <div style="height:65px; width:100%;background-color:#E21A10;position:absolute;display:none;">
                
                </div>
                <div style="height:65px;z-index:2;font-size:20px;position:relative;letter-spacing:-2px;padding:15px 25px;">
                  Blog
                </div>
              
              </div>
             </a> 
            <div class="custom_menu download" style="height:75px;cursor:pointer;position:relative;border-top:10px solid #7BB635;float:right;">
              <div class="text-center" style="width:100%;background-color:#7BB635;position:absolute;display:none;z-index:100;">
                 
                    <div class="download_section not_logged_in" data-controller="Bankpo/lastyearpdf" style="margin-top:65px;padding:7px 0px;display:none;" >
                    Last Year Paper PDF
                    </div>
                 
                  
                    <div class="download_section not_logged_in" data-controller="Bankpo/bankinggkpdf" style="padding:7px 0px;margin-top:65px;" >
                    Current Affairs PDF
                    </div>
                  
                  
                    <div class="download_section not_logged_in" data-controller="Bankpo/bankposetpdf" style="padding:7px 0px;" >
                    Bank PO Set PDF
                    </div>
                    
                    <div class="download_section not_logged_in" data-controller="Bankpo/importantpdf" style="padding:7px 0px;" >
                    Important PDF
                    </div>
                  
              </div>
              <div style="height:65px;z-index:101;font-size:20px;letter-spacing:-2px;position:relative;padding:15px 25px;">
                Download
              </div>
            
            </div>
            <a href="<?=base_url('bankpo/current_affaires')?>" style="color:#fff;">
              <div class="custom_menu current_affaires" style="height:75px;position:relative;cursor:pointer;border-top:10px solid #faa519;float:right;">
                <div style="height:65px; width:100%;background-color:#faa519;position:absolute;display:none;">
                
                </div>
                <div style="height:65px;z-index:2;font-size:20px;position:relative;letter-spacing:-2px;padding:15px 25px;">
                  Current Affairs
                </div>
              
              </div>
             </a>
            <a href="<?=base_url()?>Bankpo" style="color:#fff;">
              <div class="custom_menu home" style="height:75px;position:relative;cursor:pointer;border-top:10px solid #E21A10;float:right;z-index:10;">
                <div style="height:65px; width:100%;background-color:#E21A10;position:absolute;display:none;">
                
                </div>
                <div style="height:65px;z-index:2;font-size:20px;position:relative;letter-spacing:-2px;padding:15px 25px;">
                  Home
                </div>
              
              </div>
             </a> 
           
           
           
        </div>
             
      </div>

       <?php } ?>   
  </div>


<!--	<div class="row">
	<div class="col-sm-12">
		<marquee  scrollamount="10" onmouseover="this.stop();" onmouseout="this.start();" style="float:left;"><a href="http://www.examkabila.com/Bankpo/importantpdf"><span  id="urgent_download" style="background-color:#faa519;color:#fff;cursor:pointer;width:auto;font-size:18px;padding:2px 10px;"><b>Click me!! Download Important GK Capsule (IBPS Clerk Mains Exam 2-3 Jan 2016)</b></span></a><a href="http://www.examkabila.com/Bankpo/importantpdf"><span  id="urgent_download" style="background-color:#faa519;color:#fff;cursor:pointer;width:auto;font-size:18px;padding:2px 10px;margin-left:600px;"><b>Click me!! IBPS CWE Clerk mains guess paper  (2-3 Jan 2016)</b></span></a></marquee>
		
	</div>
</div> -->

  
   <?php if(!$logged_in){ ?>
      <div class="row" style="margin-top:5px;">
        <div class="col-sm-2">
          <div id="language_container" style="display:none;">
             <select id="web_language" class="form-control">
              <?php if($this->session->userdata('web_language') == 'hi') { ?>
               <option value="hi" selected="true">Hindi</option>
               <option value="en">English</option>
               <?php } else { ?>
               <option value="hi">Hindi</option>
               <option value="en" selected="true">English</option>
               <?php } ?>
             </select>
           </div>   
        </div>
         <div class="col-sm-5">
         </div> 

        <div class="col-sm-1" style="margin-top:5px;" >
          <div class="fb-like" style="position:absolute;z-index:2000;" data-href="https://www.facebook.com/Exam-Kabila-786375854763781/timeline/" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>
                <div id="fb-root"></div>
        </div>
        <div class="col-sm-4 text-right" >
           <span id="login_button1"  style="margin-right:15px;font-size:18px;cursor:pointer;">Login</span>
            <span id="signup_button"  style="margin-right:10px;font-size:18px;cursor:pointer;">SignUp</span>
        </div>
      
      </div>
  <?php } else { ?>
      <div class="row" style="margin-top:5px;">
        <div class="col-sm-2">
          <div id="language_container" style="display:none;">
             <select id="web_language" class="form-control">
              <?php if($this->session->userdata('web_language') == 'hi') { ?>
               <option value="hi" selected="true">Hindi</option>
               <option value="en">English</option>
               <?php } else { ?>
               <option value="hi">Hindi</option>
               <option value="en" selected="true">English</option>
               <?php } ?>
             </select> 
           </div>  
        </div>
        <div class="col-sm-5">
         </div> 

        <div class="col-sm-1" style="margin-top:5px;" >
          <div class="fb-like" style="position:absolute;z-index:2000;" data-href="https://www.facebook.com/Exam-Kabila-786375854763781/timeline/" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>
                <div id="fb-root"></div>
        </div>
        
        <div class="col-sm-4 text-right" >
           
            <span id=""  style="margin-right:10px;font-size:18px;cursor:pointer;">Welcome <?= $this->session->userdata('name'); ?></span>
        </div>
      
      </div>
  <?php } ?>  

</div>