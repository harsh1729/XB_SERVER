<div class="row">
	<?php if( sizeof($all_daily_test[0]) > 0) { ?>
	<div class="col-sm-3">
		
			<div class="text-center" style="margin-bottom:10px;font-size:16px;">
				<span class="glyphicon glyphicon-list-alt	"></span><span style="color:#f00;font-size:18px;"> Quiz</span>
			</div>
			<div style="height:500px;overflow:auto;" id="daily_curren_gk_test_name_container">
			<?php if(isset($date)){ ?>
			<input id="impdate" type="hidden" value="<?=$date?>">
			<?php } else { ?>
			<input id="impdate" type="hidden" value="">
			<?php } ?>
			<?php foreach ($all_daily_test[0] as $index => $row) : ?>
				<?php
				   	if(sizeof($all_daily_test) >1)
				   	{
						$day = substr($row,-2);
						$month = substr($row,5,2);
						$year = substr($row,0,4);
						if($month == '01')
						{
							$month_name = 'Jan';
						}
						elseif($month == '02')
						{
							$month_name = 'Feb';
						}
						elseif ($month == '03')
						{
							$month_name = 'Mar';
						}
						elseif ($month == '04')
						{
							$month_name = 'Apr';
						}
						elseif ($month == '05')
						{
							$month_name = 'May';
						}
						elseif ($month == '06')
						{
							$month_name = 'Jun';
						}
						elseif ($month == '07')
						{
							$month_name = 'Jul';
						}
						elseif ($month == '08')
						{
							$month_name = 'Aug';
						}
						elseif ($month == '09')
						{
							$month_name = 'Sep';
						}
						elseif ($month == '10')
						{
							$month_name = 'Oct';
						}
						elseif ($month == '11')
						{
							$month_name = 'Nov';
						}
						elseif ($month == '12')
						{
							$month_name = 'Dec';
						}
					}	

				 ?>
				<?php if(sizeof($all_daily_test) >1) { ?>
				<?php if(isset($date)){ ?>

						<?php if($row==$date){ ?>
						<div class="text-center daily_curren_gk_test_name" data-date="<?=$row?>" style="color:#000000;padding:10px;background-color:#ccc">
							&gt; Daily Current GK Quiz <?=$day?>-<?=$month_name?>-<?=$year	?>
						</div>
						<?php } else{ ?>
						<div class="text-center daily_curren_gk_test_name" data-date="<?=$row?>" style="color:#000000;padding:10px;">
							&gt; Daily Current GK Quiz <?=$day?>-<?=$month_name?>-<?=$year	?>
						</div>
						<?php } ?>
				<?php } else{ ?>
							<div class="text-center daily_curren_gk_test_name" data-date="<?=$row?>" style="color:#000000;padding:10px;">
							&gt; Daily Current GK Quiz <?=$day?>-<?=$month_name?>-<?=$year	?>
						</div>
						<?php } ?>
				<?php } else { ?>
					
					<div class="text-center daily_curren_gk_test_name" data-testno="<?=$row['test_no']?>" data-category="<?=$row['category']?>" data-date="<?=$row['date']?>" style="color:#000000;padding:10px;">
						&gt; Daily <?=$row['name']?> Quiz <?=$index+1?>
					</div>
				<?php } ?>
				<hr style="margin:0px;">
			<?php endforeach; ?>	
		</div>	
	</div>
	<div class="col-sm-9">
		<div class="row">
			<div class="col-sm-9" style="padding-left:0px;padding-right:0px;">
					<div id="solution_div" style="position:relative;border:1px solid #ccc;display:none;padding:10px;width:100%;">
						
					</div>
					<div id="test_name" class="text-center" style="font-weight:bold;color:#f00;font-size:16px;text-decoration:underline;">
						
					</div>
					<div style="width:100%;height:500px;margin-top:22px;border:1px solid #eee;">
						<div id="question_no" style="font-weight:bold;padding-left:10px;">
							Question No.1
						</div>
						<center><hr style="border-top: 2px solid #999;width:98%;margin-top:10px;"></center>	
						<div id="question_text" style="width:100%;padding:0px 10px;">
						
						</div>
						<div id="option_div" style="margin-top:30px;padding:10px;">
								
						</div>
						<div class="text-center" style="position:absolute;bottom:10px;width:100%;">
							<button id="pre_button" class="btn btn-info btn-lg" style="width:80px;vertical-align: baseline;"><span style='font-size:15px;' class='glyphicon glyphicon-menu-left'></span> Pre</button>
							<button id="next_button" class="btn btn-info btn-lg" style="width:8	0px;margin-left:30px; vertical-align: baseline;">Next <span style='font-size:15px;' class='glyphicon glyphicon-menu-right	'></span></button>
						</div>
						
					</div>
						
			</div>

			<!-- e4edf7  faa519 -->
			<div class="col-sm-3" style="">
				<div style="background-color:#7ADBF0;height:500px;margin-top:45px;">
					<div style="font-weight:bold;padding:5px;" class="text-center">
						Question Pallet
					</div>
					<div id="question_pallet_button" class="text-center" style="padding:10px;">
						
					</div>
				</div>
			</div>
		</div>
		
	</div>
	<?php } else { ?>
		<div class="col-sm-12 text-center">

			 <h1 style="margin-top:100px;"> There is no test </h1>
		</div>
	<?php } ?>
	
</div>