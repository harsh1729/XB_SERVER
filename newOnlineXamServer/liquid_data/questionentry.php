<?php
session_start();
if(!isset($_SESSION['newonlineserver_login_id']))
    header("location:index.php");
?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="ime_work/css/jquery.ime.css" rel="stylesheet"  />
    <link href="ui/jquery-ui.css" rel="stylesheet"/>
    <link href="dropzone/dropzone.css" rel="stylesheet">
</head>
<style>

#Qdropzone.dropzone {

  padding: 1.3em;
  
}
.dropzone {

  padding:0px;
  padding-left:25px;
  padding-top:2px;
}
#Qdropzone.dropzone .dz-preview .dz-details,
#Qdropzone.dropzone-previews .dz-preview .dz-details{
  width: 130px;
  height: 100px;
}
#Qdropzone.dropzone .dz-preview .dz-details img,
#Qdropzone.dropzone-previews .dz-preview .dz-details img {
  width: 130px;
  height: 100px;
}

#Qdropzone.dropzone .dz-default.dz-message {
  background-image: url(dropzone/images/spritemap_small.png);
  background-size:contain	;
  background-position:center;
}

/* style for options */
.dropzone .dz-preview .dz-details,
.dropzone-previews .dz-preview .dz-details{
  width: 130px;
  height: 30px;
}
.dropzone .dz-preview .dz-details img,
.dropzone-previews .dz-preview .dz-details img {
  width: 130px;
  height: 0px;
}

.dropzone .dz-default.dz-message {
  background-image: url(dropzone/images/spritemap_small.png);
  background-size:contain	;
  background-position:center;
}
.btn_tab
{
	height:40PX;
	width:40PX;
	margin-top:3px;
	font-size:24px;
	padding:3px 2px;
}

</style>
<body>
<div id="loading_bar" style="height:100%;width:100%; background-color:rgba(102,102,102,.5); z-index:1100; position:fixed; display:none;">
		<img src="ui/ajax-loader.gif" style="margin-top:18%; margin-left:45%;">
</div>
<div id="vartual_key" style="width:420px; height:300px; padding:6px 12px; position:absolute;z-index:1000; background-color:#0FC;display:none;">
	<div id="tabs">
  <ul>
    <li><a href="#tabs-1">math</a></li>
    <li><a href="#tabs-2">greek</a></li>
    <li><a href="#tabs-4">letter</a></li>
    <li><a href="#tabs-3">other</a></li>
    
  </ul>
  <div id="tabs-1" style="overflow-y:auto; height:82%;">
  	<div class="btn btn-info btn_tab" data-code='0x00B9'>x<sup>1</sup></div>
    <div class="btn btn-info btn_tab" data-code='0x00B2'>x<sup>2</sup></div>
    <div class="btn btn-info btn_tab" data-code='0x00B3'>x<sup>3</sup></div>
    <div class="btn btn-info btn_tab" data-code='0x2074'>x<sup>4</sup></div>
    <div class="btn btn-info btn_tab" data-code='0x2075'>x<sup>5</sup></div>
    <div class="btn btn-info btn_tab" data-code='0x2076'>x<sup>6</sup></div>
    <div class="btn btn-info btn_tab" data-code='0x2077'>x<sup>7</sup></div>
    <div class="btn btn-info btn_tab" data-code='0x2078'>x<sup>8</sup></div>
    <div class="btn btn-info btn_tab" data-code='0x2079'>x<sup>9</sup></div>
    <div class="btn btn-info btn_tab" data-code='0x2070'>x<sup>0</sup></div>
    
    <div class="btn btn-info btn_tab" data-code='0x2081'>x<sub>1</sub></div>
    <div class="btn btn-info btn_tab" data-code='0x2082'>x<sub>2</sub></div>
    <div class="btn btn-info btn_tab" data-code='0x2083'>x<sub>3</sub></div>
    <div class="btn btn-info btn_tab" data-code='0x2084'>x<sub>4</sub></div>
    <div class="btn btn-info btn_tab" data-code='0x2085'>x<sub>5</sub></div>
    <div class="btn btn-info btn_tab" data-code='0x2086'>x<sub>6</sub></div>
    <div class="btn btn-info btn_tab" data-code='0x2087'>x<sub>7</sub></div>
    <div class="btn btn-info btn_tab" data-code='0x2088'>x<sub>8</sub></div>
    <div class="btn btn-info btn_tab" data-code='0x2089'>x<sub>9</sub></div>
    <div class="btn btn-info btn_tab" data-code='0x2080'>x<sub>0</sub></div>
    <div class="btn btn-info btn_tab" data-code='0x17F8'>x&#8260;</div>
    
    <div class="btn btn-info btn_tab" data-code='0x00B1'>&#x00B1;</div>
    <div class="btn btn-info btn_tab" data-code='0x2260'>&#x2260;</div>
    <div class="btn btn-info btn_tab" data-code='0x2044'>&#x2044;</div>
    <div class="btn btn-info btn_tab" data-code='0x221A'>&#x221A;</div>
    <div class="btn btn-info btn_tab" data-code='0x221B'>&#x221B;</div>
    <div class="btn btn-info btn_tab" data-code='0x221C'>&#x221C;</div>
    <div class="btn btn-info btn_tab" data-code='0x221E'>&#x221E;</div>
    <div class="btn btn-info btn_tab" data-code='0x192'>&#x192;</div>
    <div class="btn btn-info btn_tab" data-code='0x207A'>x&#x207A;</div>
    <div class="btn btn-info btn_tab" data-code='0x207B'>x&#x207B;</div>
    <div class="btn btn-info btn_tab" data-code='0x207C'>x&#x207C;</div>
    <div class="btn btn-info btn_tab" data-code='0x207D'>x&#x207D;</div>
    <div class="btn btn-info btn_tab" data-code='0x207E'>x&#x207E;</div>
    <div class="btn btn-info btn_tab" data-code='0x207F'>x&#x207F;</div>
    <div class="btn btn-info btn_tab" data-code='0x208A'>x&#x208A;</div>
    <div class="btn btn-info btn_tab" data-code='0x208B'>x&#x208B;</div>
    <div class="btn btn-info btn_tab" data-code='0x208C'>x&#x208C;</div>
    <div class="btn btn-info btn_tab" data-code='0x208D'>x&#x208D;</div>
    <div class="btn btn-info btn_tab" data-code='0x208E'>x&#x208E;</div>
    
    
    
  </div>
  <div id="tabs-2" style="overflow-y:scroll; height:82%;">
  
		<div class="btn btn-info btn_tab" data-code='0x03B1'>&#x03B1;</div>
        <div class="btn btn-info btn_tab" data-code='0x03B2'>&#x03B2;</div>
        <div class="btn btn-info btn_tab" data-code='0x03B3'>&#x03B3;</div>
        <div class="btn btn-info btn_tab" data-code='0x03B4'>&#x03B4;</div>
        <div class="btn btn-info btn_tab" data-code='0x03B5'>&#x03B5;</div>
        <div class="btn btn-info btn_tab" data-code='0x03B6'>&#x03B6;</div>
        <div class="btn btn-info btn_tab" data-code='0x03B7'>&#x03B7;</div>
        <div class="btn btn-info btn_tab" data-code='0x03B8'>&#x03B8;</div>
        <div class="btn btn-info btn_tab" data-code='0x03B9'>&#x03B9;</div>
        <div class="btn btn-info btn_tab" data-code='0x03BA'>&#x03BA;</div>
        <div class="btn btn-info btn_tab" data-code='0x03BB'>&#x03BB;</div>
        <div class="btn btn-info btn_tab" data-code='0x03BC'>&#x03BC;</div>
        <div class="btn btn-info btn_tab" data-code='0x03BD'>&#x03BD;</div>
        <div class="btn btn-info btn_tab" data-code='0x03BE'>&#x03BE;</div>
        <div class="btn btn-info btn_tab" data-code='0x03BF'>&#x03BF;</div>
        <div class="btn btn-info btn_tab" data-code='0x03C0'>&#x03C0;</div>
        <div class="btn btn-info btn_tab" data-code='0x03C1'>&#x03C1;</div>
        <div class="btn btn-info btn_tab" data-code='0x03C2'>&#x03C2;</div>
        <div class="btn btn-info btn_tab" data-code='0x03C3'>&#x03C3;</div>
        <div class="btn btn-info btn_tab" data-code='0x03C4'>&#x03C4;</div>
        <div class="btn btn-info btn_tab" data-code='0x03C5'>&#x03C5;</div>
        <div class="btn btn-info btn_tab" data-code='0x03C6'>&#x03C6;</div>
        <div class="btn btn-info btn_tab" data-code='0x03C7'>&#x03C7;</div>
        <div class="btn btn-info btn_tab" data-code='0x03C8'>&#x03C8;</div>
        <div class="btn btn-info btn_tab" data-code='0x03C9'>&#x03C9;</div>
        <div class="btn btn-info btn_tab" data-code='0x03A0'>&#x03A0;</div>
        <div class="btn btn-info btn_tab" data-code='0x03A3'>&#x03A3;</div>
        <div class="btn btn-info btn_tab" data-code='0x03F3'>&#x03F3;</div>
        <div class="btn btn-info btn_tab" data-code='0x0394'>&#x0394;</div>
  		<div class="btn btn-info btn_tab" data-code='0x03D5'>&#x03D5;</div>
        <div class="btn btn-info btn_tab" data-code='0x03A9'>&#x03A9;</div>
        <div class="btn btn-info btn_tab" data-code='0x03EE'>&#x03EE;</div>
        <div class="btn btn-info btn_tab" data-code='0x2109'>&#x2109;</div>
  
    	<div class="btn btn-info btn_tab" data-code='0x2308'>&#x2308;</div>
        <div class="btn btn-info btn_tab" data-code='0x2309'>&#x2309;</div>
        <div class="btn btn-info btn_tab" data-code='0X230A'>&#x230A;</div>
        <div class="btn btn-info btn_tab" data-code='0x230B'>&#x230B;</div>
       
        <div class="btn btn-info btn_tab" data-code='0x222B'>&#x222B;</div>
        <div class="btn btn-info btn_tab" data-code='0x00B0'>&#x00B0;</div>
        
        <div class="btn btn-info btn_tab" data-code='0x1D69'>x&#x1D69;</div>
        <div class="btn btn-info btn_tab" data-code='0x1D67'>x&#x1D67;</div>
        <div class="btn btn-info btn_tab" data-code='0x1D66'>x&#x1D66;</div>
        <div class="btn btn-info btn_tab" data-code='0x2093'>x&#x2093;</div>
        <div class="btn btn-info btn_tab" data-code='0x1D65'>x&#x1D65;</div>
        <div class="btn btn-info btn_tab" data-code='0x1D64'>x&#x1D64;</div>
        <div class="btn btn-info btn_tab" data-code='0x1D63'>x&#x1D63;</div>
        <div class="btn btn-info btn_tab" data-code='0x1D62'>x&#x1D62;</div>
        <div class="btn btn-info btn_tab" data-code='0x2092'>x&#x2092;</div>
        <div class="btn btn-info btn_tab" data-code='0x2091'>x&#x2091;</div>
        <div class="btn btn-info btn_tab" data-code='0x2090'>x&#x2090;</div>
        
  </div>
  <div id="tabs-3" style="overflow-y:scroll; height:82%;">
  		
        <div class="btn btn-info btn_tab" data-code='0x2190'>&#x2190;</div>
        <div class="btn btn-info btn_tab" data-code='0x2191'>&#x2191;</div>
        <div class="btn btn-info btn_tab" data-code='0x2192'>&#x2192;</div>
        <div class="btn btn-info btn_tab" data-code='0x2193'>&#x2193;</div>
        <div class="btn btn-info btn_tab" data-code='0x2195'>&#x2195;</div>
        <div class="btn btn-info btn_tab" data-code='0x2196'>&#x2196;</div>	   
        <div class="btn btn-info btn_tab" data-code='0x2197'>&#x2197;</div>	   
        <div class="btn btn-info btn_tab" data-code='0x2198'>&#x2198;</div>	   
        <div class="btn btn-info btn_tab" data-code='0x2199'>&#x2199;</div>	   
        <div class="btn btn-info btn_tab" data-code='0x219C'>&#x219C;</div>	   
        <div class="btn btn-info btn_tab" data-code='0x219D'>&#x219D;</div>
        <div class="btn btn-info btn_tab" data-code='0x219E'>&#x219E;</div>	   	   
        <div class="btn btn-info btn_tab" data-code='0x219F'>&#x219F;</div>	   
        <div class="btn btn-info btn_tab" data-code='0x21A1'>&#x21A1;</div>	   
        <div class="btn btn-info btn_tab" data-code='0x21A4'>&#x21A4;</div>	   
        <div class="btn btn-info btn_tab" data-code='0x21A5'>&#x21A5;</div>	   
        <div class="btn btn-info btn_tab" data-code='0x21A7'>&#x21A7;</div>	   
        <div class="btn btn-info btn_tab" data-code='0x21B0'>&#x21B0;</div>
        <div class="btn btn-info btn_tab" data-code='0x21B1'>&#x21B1;</div>	   	   
        <div class="btn btn-info btn_tab" data-code='0x21B2'>&#x21B2;</div>	   
        <div class="btn btn-info btn_tab" data-code='0x21B3'>&#x21B3;</div>	   
        <div class="btn btn-info btn_tab" data-code='0x21B4'>&#x21B4;</div>	   
        <div class="btn btn-info btn_tab" data-code='0x21B5'>&#x21B5;</div>	   
        <div class="btn btn-info btn_tab" data-code='0x21B6'>&#x21B6;</div>	   
        <div class="btn btn-info btn_tab" data-code='0x21B7'>&#x21B7;</div>	   
        <div class="btn btn-info btn_tab" data-code='0x21B8'>&#x21B8;</div>	   
        <div class="btn btn-info btn_tab" data-code='0x21B9'>&#x21B9;</div>	   
        <div class="btn btn-info btn_tab" data-code='0x21BA'>&#x21BA;</div>	   
        <div class="btn btn-info btn_tab" data-code='0x21BB'>&#x21BB;</div>	   
        <div class="btn btn-info btn_tab" data-code='0x21C4'>&#x21C4;</div>	   
        <div class="btn btn-info btn_tab" data-code='0x21C5'>&#x21C5;</div>
        <div class="btn btn-info btn_tab" data-code='0x21C6'>&#x21C6;</div>
        <div class="btn btn-info btn_tab" data-code='0x21C7'>&#x21C7;</div>
        <div class="btn btn-info btn_tab" data-code='0x21C8'>&#x21C8;</div>
        <div class="btn btn-info btn_tab" data-code='0x21C9'>&#x21C9;</div>
        <div class="btn btn-info btn_tab" data-code='0x21CA'>&#x21CA;</div>
        <div class="btn btn-info btn_tab" data-code='0x21CD'>&#x21CD;</div>
        <div class="btn btn-info btn_tab" data-code='0x21D0'>&#x21D0;</div>
        <div class="btn btn-info btn_tab" data-code='0x21D1'>&#x21D1;</div>	   
        <div class="btn btn-info btn_tab" data-code='0x21D3'>&#x21D3;</div>
		<div class="btn btn-info btn_tab" data-code='0x2234'>&#x2234;</div>	
        <div class="btn btn-info btn_tab" data-code='0x0024'>&#x0024;</div>   
        <div class="btn btn-info btn_tab" data-code='0x00A2'>&#x00A2;</div>
        <div class="btn btn-info btn_tab" data-code='0x00A3'>&#x00A3;</div>
        <div class="btn btn-info btn_tab" data-code='0x00A5'>&#x00A5;</div>
        <div class="btn btn-info btn_tab" data-code='0x20A0'>&#x20A0;</div>
        <div class="btn btn-info btn_tab" data-code='0x20AC'>&#x20AC;</div>
   
    
  </div>
  <div id="tabs-4" style="overflow-y:scroll; height:82%;">
 		<div class="btn btn-info btn_tab" data-code='0x24B6'>&#x24B6;</div>
        <div class="btn btn-info btn_tab" data-code='0x24B7'>&#x24B7;</div>
        <div class="btn btn-info btn_tab" data-code='0x24B8'>&#x24B8;</div>
        <div class="btn btn-info btn_tab" data-code='0x24B9'>&#x24B9;</div>
        <div class="btn btn-info btn_tab" data-code='0x24BA'>&#x24BA;</div>
        <div class="btn btn-info btn_tab" data-code='0x24BB'>&#x24BB;</div>
        <div class="btn btn-info btn_tab" data-code='0x24BC'>&#x24BC;</div>
        <div class="btn btn-info btn_tab" data-code='0x24BD'>&#x24BD;</div>
        <div class="btn btn-info btn_tab" data-code='0x24BE'>&#x24BE;</div>
        <div class="btn btn-info btn_tab" data-code='0x24BF'>&#x24BF;</div>
        <div class="btn btn-info btn_tab" data-code='0x24C0'>&#x24C0;</div>
        <div class="btn btn-info btn_tab" data-code='0x24C1'>&#x24C1;</div>
        <div class="btn btn-info btn_tab" data-code='0x24C2'>&#x24C2;</div>
        <div class="btn btn-info btn_tab" data-code='0x24C3'>&#x24C3;</div>
        <div class="btn btn-info btn_tab" data-code='0x24C4'>&#x24C4;</div>
        <div class="btn btn-info btn_tab" data-code='0x24C5'>&#x24C5;</div>
        <div class="btn btn-info btn_tab" data-code='0x24C6'>&#x24C6;</div>
        <div class="btn btn-info btn_tab" data-code='0x24C7'>&#x24C7;</div>
        <div class="btn btn-info btn_tab" data-code='0x24C8'>&#x24C8;</div>
        <div class="btn btn-info btn_tab" data-code='0x24C9'>&#x24C9;</div>
        <div class="btn btn-info btn_tab" data-code='0x24CA'>&#x24CA;</div>
        <div class="btn btn-info btn_tab" data-code='0x24CB'>&#x24CB;</div>
        <div class="btn btn-info btn_tab" data-code='0x24CC'>&#x24CC;</div>
        <div class="btn btn-info btn_tab" data-code='0x24CD'>&#x24CD;</div>
        <div class="btn btn-info btn_tab" data-code='0x24CE'>&#x24CE;</div>
        <div class="btn btn-info btn_tab" data-code='0x24CF'>&#x24CF;</div>
        
        <div class="btn btn-info btn_tab" data-code='0x24D0'>&#x24D0;</div>
        <div class="btn btn-info btn_tab" data-code='0x24D1'>&#x24D1;</div>
        <div class="btn btn-info btn_tab" data-code='0x24D2'>&#x24D2;</div>
        <div class="btn btn-info btn_tab" data-code='0x24D3'>&#x24D3;</div>
        <div class="btn btn-info btn_tab" data-code='0x24D4'>&#x24D4;</div>
        <div class="btn btn-info btn_tab" data-code='0x24D5'>&#x24D5;</div>
        <div class="btn btn-info btn_tab" data-code='0x24D6'>&#x24D6;</div>
        <div class="btn btn-info btn_tab" data-code='0x24D7'>&#x24D7;</div>
        <div class="btn btn-info btn_tab" data-code='0x24D8'>&#x24D8;</div>
        <div class="btn btn-info btn_tab" data-code='0x24D9'>&#x24D9;</div>
        <div class="btn btn-info btn_tab" data-code='0x24DA'>&#x24DA;</div>
        <div class="btn btn-info btn_tab" data-code='0x24DB'>&#x24DB;</div>
        <div class="btn btn-info btn_tab" data-code='0x24DC'>&#x24DC;</div>
        <div class="btn btn-info btn_tab" data-code='0x24DD'>&#x24DD;</div>
        <div class="btn btn-info btn_tab" data-code='0x24DE'>&#x24DE;</div>
        <div class="btn btn-info btn_tab" data-code='0x24DF'>&#x24DF;</div>
        <div class="btn btn-info btn_tab" data-code='0x24E0'>&#x24E0;</div>
        <div class="btn btn-info btn_tab" data-code='0x24E1'>&#x24E1;</div>
        <div class="btn btn-info btn_tab" data-code='0x24E2'>&#x24E2;</div>
        <div class="btn btn-info btn_tab" data-code='0x24E3'>&#x24E3;</div>
        <div class="btn btn-info btn_tab" data-code='0x24E4'>&#x24E4;</div>
        <div class="btn btn-info btn_tab" data-code='0x24E5'>&#x24E5;</div>
        <div class="btn btn-info btn_tab" data-code='0x24E6'>&#x24E6;</div>
        <div class="btn btn-info btn_tab" data-code='0x24E7'>&#x24E7;</div>
        <div class="btn btn-info btn_tab" data-code='0x24E8'>&#x24E8;</div>
        <div class="btn btn-info btn_tab" data-code='0x24E9'>&#x24E9;</div>
        
        <div class="btn btn-info btn_tab" data-code='0x2460'>&#x2460;</div>
        <div class="btn btn-info btn_tab" data-code='0x2461'>&#x2461;</div>
        <div class="btn btn-info btn_tab" data-code='0x2462'>&#x2462;</div>
        <div class="btn btn-info btn_tab" data-code='0x2463'>&#x2463;</div>
        <div class="btn btn-info btn_tab" data-code='0x2464'>&#x2464;</div>
        <div class="btn btn-info btn_tab" data-code='0x2465'>&#x2465;</div>
        <div class="btn btn-info btn_tab" data-code='0x2466'>&#x2466;</div>
        <div class="btn btn-info btn_tab" data-code='0x2467'>&#x2467;</div>
        <div class="btn btn-info btn_tab" data-code='0x2468'>&#x2468;</div>
        <div class="btn btn-info btn_tab" data-code='0x2469'>&#x2469;</div>
        <div class="btn btn-info btn_tab" data-code='0x246A'>&#x246A;</div>
        <div class="btn btn-info btn_tab" data-code='0x246B'>&#x246B;</div>
        <div class="btn btn-info btn_tab" data-code='0x246C'>&#x246C;</div>
        <div class="btn btn-info btn_tab" data-code='0x246D'>&#x246D;</div>
        <div class="btn btn-info btn_tab" data-code='0x246E'>&#x246E;</div>
        <div class="btn btn-info btn_tab" data-code='0x246F'>&#x246F;</div>
        <div class="btn btn-info btn_tab" data-code='0x2470'>&#x2470;</div>
        <div class="btn btn-info btn_tab" data-code='0x2471'>&#x2471;</div>
        <div class="btn btn-info btn_tab" data-code='0x2472'>&#x2472;</div>
        <div class="btn btn-info btn_tab" data-code='0x2473'>&#x2473;</div>
        <div class="btn btn-info btn_tab" data-code='0x24EA'>&#x24EA;</div>
        
        
  </div>
</div>
</div>

<form role="form" action="session_destroy.php">
    <?php
if($_SESSION['newonlineserver_login_id']== 4 &&  $_SESSION['Application_Id'] == 5 || $_SESSION['newonlineserver_login_id']== 10 &&  $_SESSION['Application_Id'] == 5 || $_SESSION['newonlineserver_login_id']== 3 &&  $_SESSION['Application_Id'] == 5 )
{
    echo "<div class='row'>";
       echo "<div class='col-md-2' >";
           echo  "<select id='secect_qustion_tutorial' class='form-control' style='margin-left:10px; margin-top:10px;'>";
		   	echo "<option> enter question</option>";
			echo "<option>enter tutorial</option>";
                
            echo "</select>";
        echo "</div>";
        echo "<div class='col-md-7'>";
        echo "</div>";
        echo "<div class='col-md-1'>";
            echo "<a href='show_newonlineserver_tutorial.php?page=0'><input type='button' class='btn btn-info btn-lg' value='tutorial' style='margin-right:10px;margin-top:10px;'></a>";
        echo "</div>";
        echo "<div class='col-md-2'>";
   echo "<a href='show_newonlineserver_data.php?page=0'><input type='button' class='btn btn-info btn-lg' value='check' style='margin-right:10px;margin-top:10px;'></a>";
    echo "  <input type='submit' class='btn btn-danger btn-lg' value='logout' style='margin-right:12px; margin-top:10px;'>";
     echo "</div>";
	echo "</div>";
    
}
else
{

     echo "<div class='row'>";
       echo "<div class='col-md-10'>";
          
        echo "</div>";
        echo "<div class='col-md-2'>";
   echo "<a href='show_newonlineserver_data.php?page=0'><input type='button' class='btn btn-info btn-lg' value='check' style='margin-right:10px;margin-top:10px;'></a>";
    echo "  <input type='submit' class='btn btn-danger btn-lg' value='logout' style='margin-right:12px; margin-top:10px;'>";
     echo "</div>";
    echo "</div>";
}
?>
</form>

<form action="back_end_question_entry.php" method="post" id="submit_form" >
<div class="container-fluid" id="one">
  
	<div class="row" style="margin-top:20px;">
				<div class="col-lg-2 col-md-2">
					Choose category:-<select class="form-control" name="category"  id="category">
						
					</select>
				</div>
				<div class="col-lg-2 col-md-2">
					Choose Subcategory:-<select class="form-control" name="subcategory"  id="subcategory">
						
					</select>
				</div>
				<div class="col-lg-2 col-md-2">
					Choose Language:-<select class="form-control" name="language" id="language"></select>
				</div>
				<div class="col-lg-2 col-md-2">
					Choose inputmethod:-<select class="form-control" name="inputmethod" id="imeSelector"></select>
				</div>
				
			
                <?php
                    if($_SESSION['newonlineserver_login_id']== 4 &&  $_SESSION['Application_Id'] == 5)
                    {       
                        echo    "<div class='col-lg-2 col-md-2'>";
			            echo	"	Reference:-<input type='text' class='form-control lang_class' id='reference' name='reference'/>";
				        echo "</div>";
                      echo "<div class='col-lg-2 col-md-2'>";
        		            echo	"year:-<input type='text' class='form-control' id='year' maxlength='4' pattern='[0-9]+' title='only 				numbers allowed'  name='year'/>";
			            echo "</div>";
                    }
                    else
                    {
	                    echo "<div class='col-lg-2 col-md-2'>";
			            echo		"Bank Name:-<input type='text' class='form-control lang_class' id='bankname' name='bankname'/>";
			            echo	"</div>";
                        echo "<div class='col-lg-2 col-md-2'>";
    			            echo	"year:-<input type='text' class='form-control' id='year' maxlength='4' pattern='[0-9]+' title='only 				numbers allowed'  name='year'/>";
			            echo "</div>";
                    }
                ?>

				
			</div>
    <div class="row" style="margin-top:20px;">
    	<div class="col-lg-10 col-md-10">
        	<div class="row">
            	<div class="col-md-12">
        			Enter The Question:-<textarea class="form-control lang_class"  required="required" rows="10" name="question_text" id="question_text" style="resize:none;"></textarea>
       			</div>
            </div>
            <div class="row text-right">
            	<div class="col-md-12">
	            	<input type="button" value="symbol" id="btn_qkeyboard"/>
    			</div>
            </div>
        </div>
        <input type="hidden" id="imgquestion" name="imgquestion">
        <div class="col-lg-2 col-md-2">
        	Enter the image:-<div id="Qdropzone" class="question dropzone text-center " action="Back_end_imageupload.php" style="height:210px; background-color:#aaaaaa;border:1px solid #666666;border-radius:10px;">
            </div>
        </div>
    </div>
    
    <!-- row first of options.................. -->
    
    <div class="row" style="margin-top:50px;">
    	
        <div class="col-lg-3 col-md-3">
        	<div class="row">
            	<div class="col-md-12">
                	<textarea rows="5" style="resize:none;" class="form-control lang_class" required id="option1" name="option1" placeholder=" Enter option1"></textarea>
                </div>
            </div>
        	<div class="row">
            	<div class="col-md-12 text-right">
	                <input type="button" value="symbol" id="btn_opt1kyboard" class="">
                </div>
            </div>
            
        	
        </div>
        <input type="hidden" id="imgoption1" name="imgoption1">
        <div class="col-lg-1 col-md-1">
        	<input type="radio" class="form-group-lg form-control" id="radio_opt1" required value="1" name="answer" style="margin-top:40px;"/>
        </div>
        <div class="col-lg-2 col-md-2">
        	<div id="Odropzone1" class="dropzone text-center" action="Back_end_imageupload.php" style="height:105px; background-color:#aaaaaa;border:1px solid #666666;border-radius:10px;">
            </div>
        </div>
        
       
        <div class="col-lg-3 col-md-3">
        	<div class="row">
            	<div class="col-md-12">
                	<textarea rows="5" style="resize:none;" class="form-control lang_class" required id="option2" name="option2" placeholder="Enter option2" ></textarea>
                </div>
            </div>
        	<div class="row">
            	<div class="col-md-12 text-right">
	                <input type="button" value="symbol" id="btn_opt2kyboard" class="">
                </div>
            </div>
        	
        </div>
        <input type="hidden" id="imgoption2" name="imgoption2">
        <div class="col-lg-1 col-md-1">
        	<input type="radio" class="form-group-lg form-control" id="radio_opt2" value="2" required name="answer" style="margin-top:40px;"/>
        </div>
        <div class="col-lg-2 col-md-2">
        	<div id="Odropzone2" class="dropzone text-center" action="Back_end_imageupload.php" style="height:105px; background-color:#aaaaaa;border:1px solid #666666;border-radius:10px;">
            </div>
        </div>
    </div>
    
    <!--  row second of options..................-->
    
    <div class="row" style="margin-top:50px;" id="second_row">
    	
        <div class="col-lg-3 col-md-3">
        	<div class="row">
            	<div class="col-md-12">
                	<textarea rows="5" style="resize:none;" class="form-control lang_class" required id="option3" name="option3" placeholder="Enter option3" /></textarea>
                </div>
            </div>
        	<div class="row">
            	<div class="col-md-12 text-right">
	                <input type="button" value="symbol" id="btn_opt3kyboard" class="">
                </div>
            </div>
        	
        </div>
        <input type="hidden" id="imgoption3" name="imgoption3">
        <div class="col-lg-1 col-md-1">
        	<input type="radio" class="form-group-lg form-control" id="radio_opt3" required value="3" name="answer" style="margin-top:40px;"/>
        	
        </div>
        <div class="col-lg-2 col-md-2">
        	<div id="Odropzone3" class="dropzone text-center" action="Back_end_imageupload.php" style="height:105px; background-color:#aaaaaa;border:1px solid #666666;border-radius:10px;">
            </div>
        </div>
        
       
        <div class="col-lg-3 col-md-3">
        	<div class="row">
            	<div class="col-md-12">
                	<textarea rows="5" style="resize:none;" class="form-control lang_class" required id="option4" name="option4" placeholder="Enter option4" ></textarea>
                </div>
            </div>
        	<div class="row">
            	<div class="col-md-12 text-right">
	                <input type="button" value="symbol" id="btn_opt4kyboard" class="">
                </div>
            </div>
        	
        </div>
        <input type="hidden" id="imgoption4" name="imgoption4">
        <div class="col-lg-1 col-md-1 " >
         	<div style="height:3em;">
        		<input type="radio" class="form-group-lg form-control" id="radio_opt4" required value="4" name="answer" style="margin-top:40px;"/>
        	</div>
        </div>
        <div class="col-lg-2 col-md-2">
        	<div id="Odropzone4" class="dropzone text-center" action="Back_end_imageupload.php" style="height:105px; background-color:#aaaaaa;border:1px solid #666666;border-radius:10px;">
            </div>
        </div>
       
    </div>
    
    <!--  row third of options.................-->
    
     <div class="row" style="margin-top:50px;" id="second_row">
    	<div id="coption5" style="display:none;">
            <div class="col-lg-3 col-md-3">
            	<div class="row">
            		<div class="col-md-12">
                		<textarea rows="5" style="resize:none;"  id="option5" class="form-control lang_class" name="option5" placeholder="Enter option5" /></textarea>
                	</div>
            	</div>
        		<div class="row">
            		<div class="col-md-12 text-right">
	                	<input type="button" value="symbol" id="btn_opt5kyboard" class="">
                	</div>
            	</div>
                
            </div>
            <input type="hidden" id="imgoption5" name="imgoption5">
            <div class="col-lg-1 col-md-1">
                <input type="radio" class="form-group-lg form-control" id="radio_opt5" required value="5" name="answer" style="margin-top:40px;"/>
                
            </div>
            <div class="col-lg-2 col-md-2">
                <div id="Odropzone5" class="dropzone text-center" action="Back_end_imageupload.php" style="height:105px; background-color:#aaaaaa;border:1px solid #666666;border-radius:10px;">
                </div>
            </div>
        </div>
        <div id="coption6" style="display:none;">
            <div class="col-lg-3 col-md-3">
            	<div class="row">
            		<div class="col-md-12">
                		<textarea rows="5" style="resize:none;"  id="option6" class="form-control lang_class"  name="option6" placeholder="Enter option6" ></textarea>
                	</div>
            	</div>
        		<div class="row">
            		<div class="col-md-12 text-right">
	                	<input type="button" value="symbol" id="btn_opt6kyboard" class="">
                	</div>
            	</div>
                
            </div>
            <input type="hidden" id="imgoption6" name="imgoption6">
            <div class="col-lg-1 col-md-1 " >
                <div style="height:3em;">
                    <input type="radio" class="form-group-lg form-control" id="radio_opt6" required value="6" name="answer" style="margin-top:40px;"/>
                </div>
            </div>
            <div class="col-lg-2 col-md-2">
                <div id="Odropzone6" class="dropzone text-center" action="Back_end_imageupload.php" style="height:105px; background-color:#aaaaaa;border:1px solid #666666;border-radius:10px;">
                </div>
            </div>
       </div>
    </div>
    
    <div class="row" style="margin-top:20px;" id="solution_container">
    	<div class="col-lg-10 col-md-10">
        	<div class="row">
            		<div class="col-md-12">
                		Enter Solution:-<textarea rows="5" class="form-control lang_class" id="solution" name="solution" style="resize:none;"> </textarea>
                	</div>
            	</div>
        		<div class="row">
            		<div class="col-md-12 text-right">
	                	<input type="button" value="symbol" id="btn_solkyboard" class="">
                	</div>
            	</div>
        	
            <input type="hidden" id="hidden" name="hidden"/>
            <input type="hidden" id="imgsolution" name="imgsolution">
        </div>
        <div class="col-lg-2 col-md-2">
        	</br>
            <div id="Sdropzone" class="dropzone text-center" action="Back_end_imageupload.php" style="height:105px; background-color:#aaaaaa;border:1px solid #666666;border-radius:10px;">
                </div>
        </div>
    </div>
    <div class="row" style="margin-top:20px;">
    	<div class="col-lg-2 col-md-2">
        	<input type="submit" class="btn btn-lg btn-success btn-block" id="save_btn" value="save" />
        </div>
        <div class="col-lg-6 col-md-6">
        </div>
        <div class="col-lg-2 col-md-2">
        	<div class="btn btn-lg btn-info btn-block" id="option_add_btn">
             	Add option
            </div>
        </div>
        <div class="col-lg-2 col-md-2">
        	<div class="btn btn-lg btn-danger btn-block" id="option_delete_btn">
             	delete option
            </div>
        </div>
    </div>
</div>
</form>
<script src="js/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="ui/jquery-1.10.2.js"></script>
<script src="ui/jquery-ui.js"></script>
<script src="ime_work/libs/rangy/rangy-core.js" ></script>
<script src="ime_work/src/jquery.ime.js"></script>
<script src="ime_work/src/jquery.ime.selector.js"></script>
<script src="ime_work/src/jquery.ime.preferences.js"></script>
<script src="ime_work/src/jquery.ime.inputmethods.js"></script>
<script src="ime_work/js/script.js"></script>
<script src="dropzone/dropzone.js"></script>
<script>
var option_no = 4;
var row_no =2;
var flag = false;
var text_id="";
var sub_flag = false;
var  _Qdropzone;
var _Odropzone1;
var _Odropzone2;
var _Odropzone3;
var _Odropzone4;
var _Odropzone5;
var _Odropzone6;
var _Sdropzone;
$(window).load(function(e) {
	$( "#tabs" ).tabs();
    if(option_no<=4)
	{
		$('#option_delete_btn').attr('disabled','disabled');
		$('#hidden').val(option_no);
	}
	$.ajax({
			  	type :'POST',
				url :'back_end_category.php',
				data: "",
				dataType: 'json',
				async:false,
				success:function(response)
				{
					
					$.each(response, function(index, value) 
					{

     					$('#category').append($('<option>').text(value.name).prop('value',value.id));
					});
				},
				error:function(jqXHR,textStatus,errorThrown)
				{
					console.log("Error:"+errorThrown);
				}
	});
	
		
		var QuesCatId = $('#category option:selected').val();
		$.ajax({
			  	type :'POST',
				url :'back_end_subcategory.php',
				data: {"QuesCatId":QuesCatId},
				dataType: 'json',
				success:function(response)
				{
					
					$.each(response, function(index, value) 
					{
					
     					$('#subcategory').append($('<option>').text(value.name).prop('value',value.id));
					});
				},
				error:function(jqXHR,textStatus,errorThrown)
				{
					console.log("Error:"+errorThrown);
				}
	});

});

$(document).ready(function(e){
    
    $('#secect_qustion_tutorial').on('change', function() {
 
  if(this.value == 'enter question')
  {
   window.location = "http://xercesblue.in/newonlinexamserver/liquid_data/questionentry.php";
  }
  else
  {
    window.location ="http://xercesblue.in/newonlinexamserver/liquid_data/entertutorial.php";
  }
});
});

$(document).ready(function(e) {
    $('#category').change(function()
		{
			var QuesCatId = $('#category option:selected').val();
		$.ajax({
			  	type :'POST',
				url :'back_end_subcategory.php',
				data: {"QuesCatId":QuesCatId},
				dataType: 'json',
				success:function(response)
				{
					;
					$.each(response, function(index, value) 
					{
						
     					$('#subcategory').append($('<option>').text(value.name).prop('value',value.id));
					});
				},
				error:function(jqXHR,textStatus,errorThrown)
				{
					console.log("Error:"+errorThrown);
				}
			});

			
	 		
		});
});
 
 $('.btn_tab').on('click',function(){
	 console.log(String.fromCharCode($(this).data("code")));
	 var unicode = $(this).data("code");
	 var currentIdSelect = "#"+text_id;
		var data=	$(currentIdSelect).val();
		$(currentIdSelect).focus().val(data + String.fromCharCode(unicode));
 });

$(document).ready(function(e) {
	
		// ************* button for questin keyboard ***********************/////////////	
	
	$('#btn_qkeyboard').click(function(e)
	{
		text_id = "question_text";
		if(!flag)
		{
			$('#vartual_key').css("display","block");
			$('#vartual_key').insertAfter('#question_text');
			$('#question_text').focus();
			flag=true;		
		}
		else
		{
			$('#vartual_key').css("display","none");	
			flag=false;
		}
	});
	
			// ************* button for option1 keyboard ***********************/////////////
	
	$('#btn_opt1kyboard').click(function(e){
		
		text_id = "option1";
		if(!flag)
		{
			$('#vartual_key').css("display","block");
			$('#vartual_key').insertAfter('#option1');
			$('#option1').focus();
			flag=true;		
		}
		else
		{
			$('#vartual_key').css("display","none");	
			flag=false;
		}
	});
	
			// ************* button for option2 keyboard ***********************/////////////
			
	$('#btn_opt2kyboard').click(function(e){
		text_id = "option2";
		if(!flag)
		{
			$('#vartual_key').css("display","block");
			$('#vartual_key').insertAfter('#option2');
			$('#option2').focus();
			flag=true;		
		}
		else
		{
			$('#vartual_key').css("display","none");	
			flag=false;
		}
	});
	
			// ************* button for option3 keyboard ***********************/////////////
			
	$('#btn_opt3kyboard').click(function(e){
		text_id = "option3";
		if(!flag)
		{
			$('#vartual_key').css("display","block");
			$('#vartual_key').insertAfter('#option3');
			$('#option3').focus();
			flag=true;		
		}
		else
		{
			$('#vartual_key').css("display","none");	
			flag=false;
		}
	});
	
			// ************* button for option4 keyboard ***********************/////////////
			
	$('#btn_opt4kyboard').click(function(e){
		text_id = "option4";
		if(!flag)
		{
			$('#vartual_key').css("display","block");
			$('#vartual_key').insertAfter('#option4');
			$('#option4').focus();
			flag=true;		
		}
		else
		{
			$('#vartual_key').css("display","none");	
			flag=false;
		}
	});
	
	
			// ************* button for option5 keyboard ***********************/////////////
			
	$('#btn_opt5kyboard').click(function(e){
		text_id = "option5";
		if(!flag)
		{
			$('#vartual_key').css("display","block");
			$('#vartual_key').insertAfter('#option5');
			$('#option5').focus();
			flag=true;		
		}
		else
		{
			$('#vartual_key').css("display","none");	
			flag=false;
		}
	});
	
	
			// ************* button for option6 keyboard ***********************/////////////
			
	$('#btn_opt6kyboard').click(function(e){
		text_id = "option6";
		if(!flag)
		{
			$('#vartual_key').css("display","block");
			$('#vartual_key').insertAfter('#option6');
			$('#option6').focus();
			flag=true;		
		}
		else
		{
			$('#vartual_key').css("display","none");	
			flag=false;
		}
	});
	
	
			// ************* button for solution keyboard ***********************/////////////
			
	$('#btn_solkyboard').click(function(e){
		text_id = "solution";
		if(!flag)
		{
			$('#vartual_key').css("display","block");
			$('#vartual_key').insertAfter('#solution');
			$('#solution').focus();
			flag=true;		
		}
		else
		{
			$('#vartual_key').css("display","none");	
			flag=false;
		}
	});
	
	
			// ************* button for option add ***********************/////////////
			
	 $('#option_add_btn').click(function()
	{
		if(option_no<6)
		{
		option_no = option_no+1;
		$('#coption'+option_no+'').css("display","block");
		$('#option'+option_no+'').prop('required',true);
		}
		else
		{
			$('#option_add_btn').attr("disabled","disabled");
		}
			$('#option_delete_btn').removeAttr('disabled');
			$('#hidden').val(option_no);
		
	});
	
			// ************* button for option delete ***********************/////////////
			
	$('#option_delete_btn').click(function(){
		if(option_no>4)
		{
		
		$('#coption'+option_no+'').css("display","none")
		$('#option'+option_no+'').removeAttr('required');
		option_no=option_no-1;
		}
		if(option_no<=4)
		{
			$('#option_delete_btn').attr('disabled','disabled');
		}
		if(option_no<6)
		{
			$('#option_add_btn').removeAttr('disabled');
		}
		$('#hidden').val(option_no);
	});
	
	
	
	
	//   dropzone for question ...........////////////////////////////////////////
	
	Dropzone.options.Qdropzone = {
			addRemoveLinks: true,
			parallelUploads: 1,
            acceptedFiles: 'image/*, audio/*, video/*',
            thumbnailWidth: 130,
            thumbnailHeight: 100,
            maxFiles: 1,
         //   previewTemplate: "<div class=\"dz-preview dz-file-preview\">\n  <div class=\"dz-details\">\n    <div class=\"dz-filename\"><span data-dz-name></span></div>\n    <div class=\"dz-size\" data-dz-size></div>\n    <img data-dz-thumbnail />\n  </div>\n <input type=\"text\" data-dz-doc-expiration-date class=\"dz-doc-input\" />\n <select class=\"dz-doc-input\" data-dz-doc-document-type-id  ></select>\n   <div class=\"dz-progress\"><span class=\"dz-upload\" data-dz-uploadprogress></span></div>\n  <div class=\"dz-success-mark\"><span>✔</span></div>\n  <div class=\"dz-error-mark\"><span>✘</span></div>\n  <div class=\"dz-error-message\"><span data-dz-errormessage></span></div>\n</div>",   
            uploadMultiple: false,
	            init: function() {
                    _Qdropzone = this;
                    
                    
                  var qdelete_file_name;
                    
    	          this.on("addedfile", function(file) {
                    
                    
            			  }); 
                     
                     
                this.on("success", function(files, response) {
                       
                   	   console.log(response);
						$('#imgquestion').val(response);
						qdelete_file_name = response;
    			
                    });
						  
				this.on("removedfile",function(file){
                    if(sub_flag != true)
                    {
    						var xmlhttp;
							console.log("delete"+qdelete_file_name);
						if (window.XMLHttpRequest)
						{
								 xmlhttp=new XMLHttpRequest();

						 }
						 else

						 {

							 xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

						 }

						
						xmlhttp.open("POST","dropzone_delete.php?fid="+qdelete_file_name,true);

						xmlhttp.send();
						$('#imgquestion').val("");
                    }
    						
					});
                    
                    this.on("maxfilesexceeded", function(file){
                        this.removeAllFiles();
                        this.addFile(file);
                    });
 
				},			
          };
		  
		//   dropzone for option1 ...........////////////////////////////////////////	  
		  
		  Dropzone.options.Odropzone1 = {
			addRemoveLinks: true,
			parallelUploads: 1,
            acceptedFiles: 'image/*, audio/*, video/*',
            thumbnailWidth: 0,
            thumbnailHeight: 0,
            maxFiles: 1,
         //   previewTemplate: "<div class=\"dz-preview dz-file-preview\">\n  <div class=\"dz-details\">\n    <div class=\"dz-filename\"><span data-dz-name></span></div>\n    <div class=\"dz-size\" data-dz-size></div>\n    <img data-dz-thumbnail />\n  </div>\n <input type=\"text\" data-dz-doc-expiration-date class=\"dz-doc-input\" />\n <select class=\"dz-doc-input\" data-dz-doc-document-type-id  ></select>\n   <div class=\"dz-progress\"><span class=\"dz-upload\" data-dz-uploadprogress></span></div>\n  <div class=\"dz-success-mark\"><span>✔</span></div>\n  <div class=\"dz-error-mark\"><span>✘</span></div>\n  <div class=\"dz-error-message\"><span data-dz-errormessage></span></div>\n</div>",   
            uploadMultiple: false,
	            init: function() {
                    _Odropzone1 = this;
                   
                    var delete_file_option1;
                  
                    
    	          this.on("addedfile", function(file) {
                    
                    
            			  }); 
                     
                     
                this.on("success", function(files, response) {
                       
                   	   console.log(response);
						$('#imgoption1').val(response);
						delete_file_option1=response;
    			
                    });
						  
				this.on("removedfile",function(file){
                    if(sub_flag != true)
                    {
    						var xmlhttp;
							console.log("delete"+delete_file_option1);
						if (window.XMLHttpRequest)
						{
								 xmlhttp=new XMLHttpRequest();

						 }
						 else

						 {

							 xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

						 }

						
						xmlhttp.open("POST","dropzone_delete.php?fid="+delete_file_option1,true);

						xmlhttp.send();
						$('#imgoption1').val("");
                    }
    						
					});
                    
                    this.on("maxfilesexceeded", function(file){
                        this.removeAllFiles();
                        this.addFile(file);
                    });
 
				},			
          };
		  
		  	//   dropzone for option2 ...........////////////////////////////////////////
		  
		  Dropzone.options.Odropzone2 = {
			addRemoveLinks: true,
			parallelUploads: 1,
            acceptedFiles: 'image/*, audio/*, video/*',
            thumbnailWidth: 0,
            thumbnailHeight: 0,
            maxFiles: 1,
         //   previewTemplate: "<div class=\"dz-preview dz-file-preview\">\n  <div class=\"dz-details\">\n    <div class=\"dz-filename\"><span data-dz-name></span></div>\n    <div class=\"dz-size\" data-dz-size></div>\n    <img data-dz-thumbnail />\n  </div>\n <input type=\"text\" data-dz-doc-expiration-date class=\"dz-doc-input\" />\n <select class=\"dz-doc-input\" data-dz-doc-document-type-id  ></select>\n   <div class=\"dz-progress\"><span class=\"dz-upload\" data-dz-uploadprogress></span></div>\n  <div class=\"dz-success-mark\"><span>✔</span></div>\n  <div class=\"dz-error-mark\"><span>✘</span></div>\n  <div class=\"dz-error-message\"><span data-dz-errormessage></span></div>\n</div>",   
            uploadMultiple: false,
	            init: function() {
                    _Odropzone2 = this;
                   
                    var delete_file_option2;
                  
                    
    	          this.on("addedfile", function(file) {
                    
                    
            			  }); 
                     
                     
                this.on("success", function(files, response) {
                       
                   	   console.log(response);
						$('#imgoption2').val(response);
						delete_file_option2=response;
    			
                    });
						  
				this.on("removedfile",function(file){
    				    if(sub_flag != true)
                    {
    						var xmlhttp;
							console.log("delete"+delete_file_option2);
						if (window.XMLHttpRequest)
						{
								 xmlhttp=new XMLHttpRequest();

						 }
						 else

						 {

							 xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

						 }

						
						xmlhttp.open("POST","dropzone_delete.php?fid="+delete_file_option2,true);

						xmlhttp.send();
						$('#imgoption2').val("");
                    }
					});
                    
                    this.on("maxfilesexceeded", function(file){
                        this.removeAllFiles();
                        this.addFile(file);
                    });
 
				},			
          };
	
	
		//   dropzone for option3 ...........////////////////////////////////////////
	
	
	Dropzone.options.Odropzone3 = {
			addRemoveLinks: true,
			parallelUploads: 1,
            acceptedFiles: 'image/*, audio/*, video/*',
            thumbnailWidth: 0,
            thumbnailHeight: 0,
            maxFiles: 1,
         //   previewTemplate: "<div class=\"dz-preview dz-file-preview\">\n  <div class=\"dz-details\">\n    <div class=\"dz-filename\"><span data-dz-name></span></div>\n    <div class=\"dz-size\" data-dz-size></div>\n    <img data-dz-thumbnail />\n  </div>\n <input type=\"text\" data-dz-doc-expiration-date class=\"dz-doc-input\" />\n <select class=\"dz-doc-input\" data-dz-doc-document-type-id  ></select>\n   <div class=\"dz-progress\"><span class=\"dz-upload\" data-dz-uploadprogress></span></div>\n  <div class=\"dz-success-mark\"><span>✔</span></div>\n  <div class=\"dz-error-mark\"><span>✘</span></div>\n  <div class=\"dz-error-message\"><span data-dz-errormessage></span></div>\n</div>",   
            uploadMultiple: false,
	            init: function() {
                    _Odropzone3 = this;
                 
                    var delete_file_option3;
                  
                    
    	          this.on("addedfile", function(file) {
                    
                    
            			  }); 
                     
                     
                this.on("success", function(files, response) {
                       
                   	   console.log(response);
						$('#imgoption3').val(response);
						delete_file_option3=response;
    			
                    });
						  
				this.on("removedfile",function(file){
    				    if(sub_flag != true)
                    {
    					var xmlhttp;
							console.log("delete"+delete_file_option3);
						if (window.XMLHttpRequest)
						{
								 xmlhttp=new XMLHttpRequest();

						 }
						 else

						 {

							 xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

						 }

						
						xmlhttp.open("POST","dropzone_delete.php?fid="+delete_file_option3,true);

						xmlhttp.send();	
						$('#imgoption3').val("");
                    }
					});
                    
                    this.on("maxfilesexceeded", function(file){
                        this.removeAllFiles();
                        this.addFile(file);
                    });
 
				},			
          };
	
	//   dropzone for option4 ...........////////////////////////////////////////
	
   Dropzone.options.Odropzone4 = {
			addRemoveLinks: true,
			parallelUploads: 1,
            acceptedFiles: 'image/*, audio/*, video/*',
            thumbnailWidth: 0,
            thumbnailHeight: 0,
            maxFiles: 1,
         //   previewTemplate: "<div class=\"dz-preview dz-file-preview\">\n  <div class=\"dz-details\">\n    <div class=\"dz-filename\"><span data-dz-name></span></div>\n    <div class=\"dz-size\" data-dz-size></div>\n    <img data-dz-thumbnail />\n  </div>\n <input type=\"text\" data-dz-doc-expiration-date class=\"dz-doc-input\" />\n <select class=\"dz-doc-input\" data-dz-doc-document-type-id  ></select>\n   <div class=\"dz-progress\"><span class=\"dz-upload\" data-dz-uploadprogress></span></div>\n  <div class=\"dz-success-mark\"><span>✔</span></div>\n  <div class=\"dz-error-mark\"><span>✘</span></div>\n  <div class=\"dz-error-message\"><span data-dz-errormessage></span></div>\n</div>",   
            uploadMultiple: false,
	            init: function() {
                    _Odropzone4 = this;
                 
                   var delete_file_option4; 
                  
                    
    	          this.on("addedfile", function(file) {
                    
                    
            			  }); 
                     
                     
                this.on("success", function(files, response) {
                       
                   	   console.log(response);
						$('#imgoption4').val(response);
						delete_file_option4=response;
    			
                    });
						  
				this.on("removedfile",function(file){
                    if(sub_flag != true)
                    {
    					var xmlhttp;
							console.log("delete"+delete_file_option4);
						if (window.XMLHttpRequest)
						{
								 xmlhttp=new XMLHttpRequest();

						 }
						 else

						 {

							 xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

						 }

						
						xmlhttp.open("POST","dropzone_delete.php?fid="+delete_file_option4,true);

						xmlhttp.send();
						$('#imgoption4').val("");
                    }
    						
					});
                    
                    this.on("maxfilesexceeded", function(file){
                        this.removeAllFiles();
                        this.addFile(file);
                    });
 
				},			
          };
	
   //   dropzone for option5 ...........////////////////////////////////////////
   
   Dropzone.options.Odropzone5 = {
			addRemoveLinks: true,
			parallelUploads: 1,
            acceptedFiles: 'image/*, audio/*, video/*',
            thumbnailWidth: 0,
            thumbnailHeight: 0,
            maxFiles: 1,
         //   previewTemplate: "<div class=\"dz-preview dz-file-preview\">\n  <div class=\"dz-details\">\n    <div class=\"dz-filename\"><span data-dz-name></span></div>\n    <div class=\"dz-size\" data-dz-size></div>\n    <img data-dz-thumbnail />\n  </div>\n <input type=\"text\" data-dz-doc-expiration-date class=\"dz-doc-input\" />\n <select class=\"dz-doc-input\" data-dz-doc-document-type-id  ></select>\n   <div class=\"dz-progress\"><span class=\"dz-upload\" data-dz-uploadprogress></span></div>\n  <div class=\"dz-success-mark\"><span>✔</span></div>\n  <div class=\"dz-error-mark\"><span>✘</span></div>\n  <div class=\"dz-error-message\"><span data-dz-errormessage></span></div>\n</div>",   
            uploadMultiple: false,
	            init: function() {
                    _Odropzone5 = this;
                
                   var delete_file_option5; 
                  
                    
    	          this.on("addedfile", function(file) {
                    
                    
            			  }); 
                     
                     
                this.on("success", function(files, response) {
                       
                   	   console.log(response);
						$('#imgoption5').val(response);
						delete_file_option5=response;
    			
                    });
						  
				this.on("removedfile",function(file){
    				if(sub_flag != true)
                    {
    						var xmlhttp;
							console.log("delete"+delete_file_option5);
						if (window.XMLHttpRequest)
						{
								 xmlhttp=new XMLHttpRequest();

						 }
						 else

						 {

							 xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

						 }

						
						xmlhttp.open("POST","dropzone_delete.php?fid="+delete_file_option5,true);

						xmlhttp.send();
						$('#imgoption5').val("");
                    }
					});
                    
                    this.on("maxfilesexceeded", function(file){
                        this.removeAllFiles();
                        this.addFile(file);
                    });
 
				},			
          };
	
	//   dropzone for option6 ...........////////////////////////////////////////
	
	Dropzone.options.Odropzone6 = {
			addRemoveLinks: true,
			parallelUploads: 1,
            acceptedFiles: 'image/*, audio/*, video/*',
            thumbnailWidth: 0,
            thumbnailHeight: 0,
            maxFiles: 1,
         //   previewTemplate: "<div class=\"dz-preview dz-file-preview\">\n  <div class=\"dz-details\">\n    <div class=\"dz-filename\"><span data-dz-name></span></div>\n    <div class=\"dz-size\" data-dz-size></div>\n    <img data-dz-thumbnail />\n  </div>\n <input type=\"text\" data-dz-doc-expiration-date class=\"dz-doc-input\" />\n <select class=\"dz-doc-input\" data-dz-doc-document-type-id  ></select>\n   <div class=\"dz-progress\"><span class=\"dz-upload\" data-dz-uploadprogress></span></div>\n  <div class=\"dz-success-mark\"><span>✔</span></div>\n  <div class=\"dz-error-mark\"><span>✘</span></div>\n  <div class=\"dz-error-message\"><span data-dz-errormessage></span></div>\n</div>",   
            uploadMultiple: false,
	            init: function() {
                    _Odropzone6 = this;
                  
                  var delete_file_option6;  
                  
                    
    	          this.on("addedfile", function(file) {
                    
                    
            			  }); 
                     
                     
                this.on("success", function(files, response) {
                       
                   	   console.log(response);
						$('#imgoption6').val(response);
						delete_file_option6=response;
    			
                    });
						  
				this.on("removedfile",function(file){
    				    if(sub_flag != true)
                    {
    						var xmlhttp;
							console.log("delete"+delete_file_option6);
						if (window.XMLHttpRequest)
						{
								 xmlhttp=new XMLHttpRequest();

						 }
						 else

						 {

							 xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

						 }

						
						xmlhttp.open("POST","dropzone_delete.php?fid="+delete_file_option6,true);

						xmlhttp.send();
						$('#imgoption6').val("");
                    }
					});
                    
                    this.on("maxfilesexceeded", function(file){
                        this.removeAllFiles();
                        this.addFile(file);
                    });
 
				},			
          };
		  
		  
		  
		  Dropzone.options.Sdropzone = {
			addRemoveLinks: true,
			parallelUploads: 1,
            acceptedFiles: 'image/*, audio/*, video/*',
            thumbnailWidth: 0,
            thumbnailHeight: 0,
            maxFiles: 1,
         //   previewTemplate: "<div class=\"dz-preview dz-file-preview\">\n  <div class=\"dz-details\">\n    <div class=\"dz-filename\"><span data-dz-name></span></div>\n    <div class=\"dz-size\" data-dz-size></div>\n    <img data-dz-thumbnail />\n  </div>\n <input type=\"text\" data-dz-doc-expiration-date class=\"dz-doc-input\" />\n <select class=\"dz-doc-input\" data-dz-doc-document-type-id  ></select>\n   <div class=\"dz-progress\"><span class=\"dz-upload\" data-dz-uploadprogress></span></div>\n  <div class=\"dz-success-mark\"><span>✔</span></div>\n  <div class=\"dz-error-mark\"><span>✘</span></div>\n  <div class=\"dz-error-message\"><span data-dz-errormessage></span></div>\n</div>",   
            uploadMultiple: false,
	            init: function() {
                    _Sdropzone = this;
        
                  var delete_file_solution;  
                  
                    
    	          this.on("addedfile", function(file) {
                    
                    
            			  }); 
                     
                     
                this.on("success", function(files, response) {
                       
                   	   console.log(response);
						$('#imgsolution').val(response);
						delete_file_solution=response;
    			
                    });
						  
				this.on("removedfile",function(file){
    				    if(sub_flag != true)
                    {
    						var xmlhttp;
							console.log("delete"+delete_file_solution);
						if (window.XMLHttpRequest)
						{
								 xmlhttp=new XMLHttpRequest();

						 }
						 else

						 {

							 xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

						 }

						
						xmlhttp.open("POST","dropzone_delete.php?fid="+delete_file_solution,true);

						xmlhttp.send();
						$('#imgsolution').val("");
                    }
					});
                    
                    this.on("maxfilesexceeded", function(file){
                        this.removeAllFiles();
                        this.addFile(file);
                    });
 
				},			
          };
	
	$('#submit_form').submit(function(e){
		sub_flag = true;
		$('#loading_bar').css("display","block");
		var postData = $(this).serializeArray();
										var formURL = $(this).attr("action");
										$.ajax(
											{
												url : formURL,
												type: "POST",
												data : postData,
												dataType:"html",
												success:function(data) 
												{
                                               
													$('#loading_bar').css("display","none");
													alert("insert successfully");
												//	$('#bankname').val("");
													$('#year').val("");
													$('#question_text').val("");
													for(i=1;i<=option_no;i++)
													{
														$('#option'+i+'').val("");
														$('#radio_opt'+i+'').attr('checked', false);
														$('#imgoption'+i+'').val("");
														
													}
                                                    
													$('#solution').val("");
													$('#imgquestion').val("");
													$('#imgsolution').val("");
												//	 $('div.dz-success').remove();
													 _Qdropzone.removeAllFiles();
                                                     _Odropzone1.removeAllFiles();
                                                _Odropzone2.removeAllFiles();
                                                _Odropzone3.removeAllFiles();
                                                _Odropzone4.removeAllFiles();
                                                _Odropzone5.removeAllFiles();
                                                _Odropzone6.removeAllFiles();
                                                _Sdropzone.removeAllFiles();
												},
												error: function(jqXHR, textStatus, errorThrown) 
												{
													$('#loading_bar').css("display","none");
													alert("not success");     
												}
											});
											e.preventDefault(); 
		
	});
	
	
	$(document).mouseup(function (e)
{
    var container = $('#vartual_key');

    if (!container.is(e.target) // if the target of the click isn't the container...
        && container.has(e.target).length === 0) // ... nor a descendant of the container
    {
        container.hide();
        flag = false;
    }
	 
});
});

</script>
</body>
</html>