<style type="text/css">
	
.today{
	border: 2px solid red;
}

#calendar{
	position: relative;
}

table{border-collapse: collapse;}

td{
	border-bottom: 1px solid black;
	border-right: 1px solid black;
}

.sunday{
	border-bottom: 2px solid black !important;
}

.weekend td{
	color: #339;
	background-color: #ddd;
	font-weight: bold;
}

.empty{
	background-color: #aaa !important;
}

.weekLabel{
	border-bottom: none;
}

.monthlabel{
	background-color: #6CF;
	text-transform: uppercase;
	text-align: center;
	font-weight: bold;
}

.event{
	display: inline-block;
	font-weight:  normal;
	padding-left: 10px;
	color: #000;
}

</style>
<div id='calendar'>
<table width="100%" height="100%" id="mainTable">
    <?php
    	$year = isset($_GET['year'])?$_GET['year']:date("Y");
		$firstDayOfYear = strtotime("first day ", mktime(0, 0, 0, 01, 0, $year));
		$lastDayOfYear = strtotime("last day ", mktime(0, 0, 0, 01, 0, $year+1));
		
		
		$yearlyDate = array();
		for($i = 1; $i <= 12; $i++){
			$lastDateOfMonth = date("d", mktime(0, 0, 0, ($i+1), 0, $year));
			$firstDayOfMonth = date("N", mktime(0, 0, 0, $i, 1, $year));
			for($j = 0; $j < $lastDateOfMonth; $j++){
				$yearlyDate[$i][$j+$firstDayOfMonth] = $j+1;
			}
		}
		$weekArray = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');
		$mh = "<tr><td width='2%'>&nbsp;</td>";
		$mf = "<tr><td width='2%'>&nbsp;</td>";
		for($k = 1; $k <= 12; $k++){
			$mon = date("F", mktime(0, 0, 0, ($k), 1, 1970));
			$mh .= "<td width='8%' class='monthlabel'>$mon</td>";
			$mf .= "<td width='8%' class='monthlabel'>$mon</td>";
		}
		$mh .= "<td width='2%'>&nbsp;</td></tr>";
		$mf .= "<td width='2%'>&nbsp;</td></tr>";
		echo $mh;
    	for($i = 1; $i <= 37; $i++){
			if($i%7 == 0 || $i%7 == 6){
				$class= 'class="weekend"';
				if($i%7 == 0){
					$class = 'class="weekend sunday"';
				}
			}else{
				$class= ' ';
			}
			echo "<tr $class>";
			for($j = 0; $j <= 13; $j++){
				if($j == 0 || $j == 13){
					echo "<td class='weekLabel'>".$weekArray[$i%7]."</td>"; 
				}else{
					$date = isset($yearlyDate[$j][$i]) ? $yearlyDate[$j][$i] : 0;
					//$id = "td_".$j."_".$date."_".$i;
					$id = "td_".$j."_".$date;
					$emptyClass = $date == 0 ? " class='empty'" : "";
					$date = $date == 0 ? "-" : $date;
					echo "<td id='$id'$emptyClass>".$date."<div class='event'></div></td>";
				}
			}
			
			echo "</tr>";
		}
		echo $mf;
	?>
    
    </table>
    </div>