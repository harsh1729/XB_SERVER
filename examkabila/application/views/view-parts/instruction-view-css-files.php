<style rel="stylesheet" type="text/css">

body
{
	overflow:hidden;
	padding:0px;
	margin:0px;
}
#Exam_Name_Header
{
	
	color:#FFF;
	background-color:#3274B9;
	height:6%;
	width:100%;

	
	font-size:4vh;
}

a
{
	color:#000;
	text-decoration:none;
	font-weight:bold;
}
a:hover
{
	color:#09F;
	
}
#next_button
{
	border:solid 1px #666666;
	padding:5px;
}
#next_button:hover
{
	border:solid 1px #09F;
	padding:5px;
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