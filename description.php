<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>BKFK Voting</title>
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="css/style.css" media="all" />

    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/canvasjs.min.js"></script>
</head>
<body>
    <div id="middle">
        <div class="mid_content">
        <?php
        include 'lib/connection.php';
        ?>
        <?php 
        $pollsid = $_GET['pollsid'];
 		if(isset($pollsid) && $pollsid <> ""){
        ?>
        	<input type="hidden" name="hdnpollsid" id="hdnpollsid" value="<?php echo $pollsid; ?>" />
        	<div id="div_vote">
        		<div id="content">
					<div id="div_description">
						<?php 
						$ideaid = $_GET['ideaid'];
						$strsql = 'SELECT idea_name, idea_username, idea_description, idea_img, user_img1, user_age, description_img1, description_img2, additional_file, additional_file2, additional_file1, Video_link FROM tblideapoll WHERE pollsid="'.$pollsid.'" AND ideaid="'.$ideaid.'" order by idea_name';
						$query = mysql_query($strsql);
						$result = mysql_fetch_object($query);
						//print_r($result);
						//die();
						?>
						<img class="headbanner" src="">
					    <div id="div_describe">
					    	<table cellspacing="0" cellpadding="0" class="Descdatatables">
					    		<colgroup>
					    			<col width="6%">
					    			<col>
					    			<col width="32%">
					    		</colgroup>
					    		<tbody>
					    			<tr>
					    				<td align="right" colspan="3">
						    				<input type="button" onclick="window.location.href='index.php?pollsid=<?php echo $pollsid; ?>';" value="Go Back" id="backDesc" name="back" class="goback">&nbsp;&nbsp;
						    				<button class="votebtn" onclick="castVote(<?php echo $ideaid; ?>, this.id)" id="img_des1" name="img_des1">Vote</button>
					    				</td>
					    			</tr>
					    			<tr>
						    			<td valign="top" class="description_head" rowspan="2">
						    				<div class="id"><?php echo $ideaid; ?></div>
						    			</td>
						    			<td class="headsection" colspan="2">
						    				<div id="picture">
						    					<img src="<?php echo $result->user_img1; ?>" title="<?php echo $result->idea_username; ?>">
						    				</div>
						    				<div class="headtitle">
						    					<h1><?php echo $result->idea_name?></h1><br>
						    					<?php echo $result->idea_username; ?><br>
						    					Age: <?php echo $result->user_age; ?>
						    				</div>
					    				</td>
					    			</tr>
					    			<tr>
					    				<td valign="top" class="descridoption_text">
					    					<p><?php echo $result->idea_description; ?>
					    					<span style="height:5px; clear:both;"></span><br><br>
					    					</p>
					    				</td>
					    				<td class="addition_files">
					    					<div id="descpic1">
					    						<img height="150" src="<?php echo $result->description_img1; ?>" onclick="mypopup1('<?php echo $result->description_img1; ?>');"><br>
					    						Click on the photo to enlarge.
					    					</div>
					    					<div style="background-image:url('<?php echo $result->description_img1; ?>');" id="video_td">
					    						<div class="videoBlock">
					    							<a onclick="video_pop()" class="links">Watch Video <img src="images/right_arrow.png"></a>
					    						</div>
					    						<object style="height: 315px; width: 420px; margin:10px auto;display:none;" id="ytplayer">   
					    							<?php echo $result->Video_link?>
					    						</object>
					    					</div>
					    				</td>
					    			</tr>
					    		</tbody>
					    	</table>
					    </div>
					</div>
				</div>
			</div>
		<?php 
 		}
		?>
		</div>
	</div>
	<script src="js/iframeResizer.contentWindow.min.js"></script>
</body>
</html>