<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
<style type="text/css">
	
		#main_window_div
		{
			
			height:100%;
			margin:0px;
			overflow:hidden;
			
		}
		#Exam_Name_Header
		{
			
			color:#FFF;
			background-color:#3274B9;
			height:6%;
			font-size:4vh;
			text-align: center;
		}
		fieldset.scheduler-border
		{
		    border: 1px solid #000 !important;
		    padding: 0 0em 0em 1.4em !important;
		    
		   
		}

		legend.scheduler-border 
		{
		     width:inherit; /* Or auto */
    		padding:0 5px; /* To give a bit of padding on the left and right */
    		border-bottom:none;
    		font-size: 2.5vh;
    		margin-bottom: 0px;

		}
		.Exam_Section
		{
			
			
			background-color:#3274B9;
			text-align:center;
			font-size:1.2vw;
			color:#FFF;

			cursor:pointer;
			border:2px solid #3264B9;
		}
		hr
		{
			margin-top: 5px;
			margin-left:.3%;
			margin-right:.3%;
			margin-bottom: 7px;
		}
		.Exam_Section_after_click
		{
			background-color:#faa732;
			text-align:center;
			font-size:1.2vw;
			color:#FFF;
			border:2px solid #fa9732;
		}
		#Exam_Quetion_Show
		{
			
			border:1px solid #CCC;
			


		}
		#Exam_Quetion_Number
		{
			font-size:1vw;
			font-weight:bolder;
			
		}
		#Quetion_Pallete_Middle
		{
			
			
			background-color:#e4edf7;
			overflow:auto;
			
			text-align:center;
		}
		.Un_Answered_question
		{
		height:33.5px;
			width:34px;
			cursor:pointer;
			border:0px;
			outline:0px;
			margin-top:2%;
			margin-bottom:2%;
			margin-left:2%;
			margin-right:2%;
			
			background:url('<?=base_url()?>docs/images/question_not_answered.png');
			background-size:cover;
			border:none;
			color:#FFF;
		}

		.markednotanswered_question
		{
			height:33.5px;
			width:34px;
			cursor:pointer;
			border:0px;
			outline:0px;
			margin-top:2%;
			margin-bottom:2%;
			margin-left:2%;
			margin-right:2%;
		background:url('<?=base_url()?>docs/images/question_marked_selected.png');
			border-radius:17px;
			background-size:cover;
			border-color:#639;
			color:#FFF;
		}
		.markedanswered_question
		{
			height:33.5px;
			width:34px;

			cursor:pointer;
			border:0px;
			outline:0px;
			margin-top:2%;
			margin-bottom:2%;
			margin-left:2%;
			margin-right:2%;
		    background:url('<?=base_url()?>docs/images/question_marked_answered.png') ;
			
			background-size:cover;
			
			color:#FFF;
		}

		.Answered_question
		{
			height:33.5px;
			width:34px;
			cursor:pointer;
			border:0px;
			outline:0px;
			margin-top:2%;
			margin-bottom:2%;
			margin-left:2%;
			margin-right:2%;
			background:url('<?=base_url()?>docs/images/question_answered.png') no-repeat;
			background-size:cover;
			color:#FFF;
		}
		.button_answered_style
		{
			height:17px;
			width:19px;
			border:0px;
			outline:none;
			background:url('<?=base_url()?>docs/images/question_answered.png') no-repeat;
			background-size:cover;
			color:#FFF;
		}
		.button_unanswered_style
		{
		   height:17px;
			width:19px;
			border:0px;
			outline:none;
			background:url('<?=base_url()?>docs/images/question_not_answered.png') no-repeat;
			background-size:cover;
			color:#FFF;
			
		}

		.button_marked_style
		{
			 height:19px;
			width:19px;
			border:0px;
			outline:none;
			background:url('<?=base_url()?>docs/images/question_marked_selected.png') no-repeat;
			background-size:cover;
			color:#FFF;
		}

		.button_notvisited_style
		{
		 	height:17px;
			width:19px;
			border:0px;
			outline:none;
		     border-radius:3px;
			background-size:cover;
			color:#FFF;	
		}
		.leftSpace10
		{
			margin-left:12px;
			
		}
		.Quetion_pallete_margin
		{
			height:33.5px;
			width:34px;
			border-radius:7px;
			background-color:#e6e9ed;
			cursor:pointer;
			border:solid 1px #999999;
			margin-top:2%;
			margin-bottom:2%;
			margin-left:2%;
			margin-right:2%;
			
		}
		.Result_detail_button
		{
			height:33.5px;
			width:34px;
			border-radius:7px;
			background-color:#e6e9ed;
			cursor:pointer;
			border:solid 1px #999999;
			margin-top:10px;
			margin-bottom:10px;
			margin-left:20px;
			margin-right:20px;
			
		}
li.not_answered
{
	height:35px;
	background:url('<?=base_url()?>docs/images/question_not_answered.png') no-repeat left top;
    background-size:35px 35px;
	margin-top:10px;
	padding-left:49px;
	vertical-align:middle;
	padding-top:7px;
}
li.answered_save
{
	height:35px;
	background:url('<?=base_url()?>docs/images/question_answered.png') no-repeat left top;
    background-size:35px 35px;
	margin-top:10px;
	padding-left:49px;
	vertical-align:middle;
	padding-top:7px;
}
li.not_answere_marked
{
	height:35px;
	background:url('<?=base_url()?>docs/images/question_marked_selected.png') no-repeat left top;
    background-size:35px 35px;
	margin-top:10px;
	padding-left:49px;
	vertical-align:middle;
	padding-top:7px;
}
li.answere_marked
{
	height:35px;
	background:url('<?=base_url()?>docs/images/question_marked_answered.png') no-repeat left top;
    background-size:35px 35px;
	margin-top:10px;
	padding-left:49px;
	vertical-align:middle;
	padding-top:7px;
}
ul.no_bullet
 {
list-style-type: none;
padding: 0;
margin: 0;
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

</style>