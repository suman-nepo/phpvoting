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
        			<div id="voteResultBlock">  
						<div style="text-align:right;">
					    	<input type="button" class="goback" name="backResult" id="Button1" value="Go Back" onclick="window.location.href = 'index.php?pollsid=<?php echo $pollsid; ?>';" />
					    </div>
						<?php 
						$statusmsg=$_GET['status'];
						if($statusmsg == 1){
							$msg = "Thank You For Voting!";
						}else{
							$msg = "You have already voted. Thanks!";
						}
						?>
						<div id="div_msg" class='msg'><?php echo $msg; ?></div>
						<span class="subtitle">Here are the  results so far! </span>
						<?php 
						$numRows = 11;
						$sum = 0;
						$start_date="01/26/2016";
						$end_date="01/30/2016";
						for($i = 1; $i <= 10; $i++){
							$strsql = "SELECT voted_for, count(voter_ip) as total FROM tblusertransaction where pollsid = '".$pollsid."' AND voted_for = '".$i."' AND ent_Date >= '".$start_date."'";
							$query = mysql_query($strsql);
							echo $strsql;
							$result = mysql_fetch_object($query);
							$arrayData[$i][1] = $result->voted_for;
							$arrayData[$i][2] = $result->total;
							$sum = $sum + $result->total;
						}
						//echo '<pre>';
						//print_r($arrayData);
						?>
						<br /><br>
					    <table class="datatables" cellspacing="0" cellpadding="0">
					    <colgroup>
					    	<col width="8%" />
					        <col />
					    </colgroup>
					    <?php 
					    for($k=1;$k<=$numRows;$k++){
					    	if($k % 2 == 0){
					    		$trclass = 'even';
					    	}else{
					    		$trclass = 'odd';	
					    	}
					    ?>
					    	<tr class="<?php echo $trclass; ?>">
					    		<td class="dot">
					    			<div class="id"><?php echo $arrayData[$k][1]; ?></div>
					    		</td>
					    		<td class="dot">
					    			<?php 
					    			if($sum > 0){
					    				$total = ($arrayData[$k][2] / $sum) * 100;
					    				echo $total;
					    			}
					    			?>
					    		</td>
					    	</tr>
					    <?php 
					    }
					    ?>
					</div>
        		</div>
        	</div>
        <?php 
 		}
        ?>
        </div>
    </div>
</body>
</html>