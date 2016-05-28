$(document).ready(function($){
	var i =0;

      var images = ['image/bankpo.jpg','image/np.jpg','image/xx.jpg','image/patient-at-dentist.jpg','image/main_screen.jpg'];
      var text = ['POCKET SIZE STYDY','NEWS ON FINGERS','YOUR 6 SENCE DEVICE','i DENTIST','WE RECAST TECHNOLOGY WITH COLOURS'];
      var sub_text = ['Userfriendly Examination App Can Change Your Study Style','A quick-witted News Paper App that bring Moming on your Fingers','Call Tracking App Tracks the Mobile Phones Calls, Message and Social Media Activies of Clients,Agents and of any one','An Expert App like Dentist, helps to know your teeth desease','simplify Complexities,generate new Opportunities for innovation and Growth'];

      var image = $('.bg');
      var text_container = $('#main_page_text_container');
      var sub_text_container =$('#main_page_subtext_container');

                    //Initial Background image setup
                    image.data('ibg-bg','image/main_screen.jpg'); 
                  interactive_bg_reference= image.interactive_bg();
                  
   // image.css('background-image', 'url(image1.png)');

                    //Change image at regular intervals

        setInterval(function(){  

       image.fadeOut(1000, function () {

    //   image.css('background-image', 'url(' + images [i++] +')');
    text_container.text(text[i]);
       sub_text_container.text(sub_text[i]);
       
       $('.ibg-bg').remove();
       image.data('ibg-bg',images[i++]);
       interactive_bg_reference.stop(); 
       interactive_bg_reference=image.interactive_bg();
       
       image.fadeIn(1000);

       });

       if(i == images.length)

        i = 0;

      }, 10000);           

 

});