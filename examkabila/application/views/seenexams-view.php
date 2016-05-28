<div class="row">
 	
	<div class="col-md-6 " style="border-right:1px solid #999;height:540px;">

		<div class="row">
			<div class="col-md-12 text-center">
				<div style="height:30px;padding-top:3px;padding-bottom:3px;background-color:#faa519;color:#fff;">Exams</div>

			</div>
			
		</div>

		<div class="row">
			<div class="col-md-12" id="" style="padding:right;color:#fff;">
				<div class="" style="background-color:#faa519;height:30px;width:100%;padding-top:4px;padding-bottom:4px;">

					<div class="text-center" style="float:left;width:13%;">Exam</div>
					<span style="float:left;">|</span>
					<div class="text-center" style="float:left;width:18%;">Q.Attempt</div>
					<span style="float:left;">|</span>
					<div class="text-center" style="float:left;width:17%;">Q.Wrong</div>
					<span style="float:left;">|</span>
					<div class="text-center" style="float:left;width:17%;">Q.Right</div>
					<span style="float:left;">|</span>
					<div class="text-center" style="float:left;width:14%;">Marks</div>
					<span style="float:left;">|</span>
					<div class="text-center" style="float:left;width:17%;">Date</div>
					
				</div>
						
			</div>
		</div>
		<div id="seenexam_container" class="nicescroll" style="height:88%;width:100%;padding-bottom:30px;overflow-y:auto;overflow-x:hidden;">
		<?php if(count($allexams) > 0)
				 for($i=1;$i<=$allexams[0]['no_of_set'];$i++): ?>
					

				<div class="row">
					<div class="col-md-12"  style="padding:right;cursor:pointer; color:#fff;margin-bottom:5px;">
						<div class="seenexam" data-language="<?=$allexams[$i-1]['language']?>" id="exam<?=$allexams[$i-1]['id']?>" style="background-color:#E21A10;height:30px;width:100%;padding-top:4px;padding-bottom:4px;">
							<div class="text-center" style="float:left;width:13%;">Exam<?= $i ?></div>
							<span style="float:left;">|</span>
							<div class="text-center" style="float:left;width:18%;"><?=$allexams[$i-1]['total_attempt']?></div>
							<span style="float:left;">|</span>
							<div class="text-center" style="float:left;width:17%;"><?=$allexams[$i-1]['attempt_wrong']?></div>
							<span style="float:left;">|</span>
							<div class="text-center" style="float:left;width:17%;"><?=$allexams[$i-1]['attempt_right']?></div>
							<span style="float:left;">|</span>
							<div class="text-center" style="float:left;width:14%;"><?=$allexams[$i-1]['marks']?></div>
							<span style="float:left;">|</span>
							<div class="text-center" style="float:left;width:17%;"><?=$allexams[$i-1]['date']?></div>
							
						</div>
						
					</div>
				</div>


				<?php endfor; ?>
		</div>
	</div>
	<div class="col-md-6">
		<div class="row">
			<div class="col-md-12 text-center" >
				<div style="width:100%;height:30px;padding-top:3px;padding-bottom:3px;background-color:#faa519;color:#fff;">Questions</div>
				<div id="question_detail_container">
					<div id="question_detail" style="width:100%;height:250px;position:relative;background-color:#fff;display:none;border:2px solid #999;overflow:auto;">
 		
 					</div>
 				</div>
			</div>
			
		</div>
		<div id="seenquestion_container" class="nicescroll" style="height:505px;width:100%;padding-bottom:30px;overflow-y:auto;overflow-x:hidden;">
			
		</div>
	</div>
</div>