<?php
	$TT = isset($_REQUEST['TT'])? $_REQUEST['TT'] : "TT050";
?>
<html>
<form name="Details" id="Details" action="" method="POST">
	<td>TT:</td>
	<input name="TT" id="TT" value="<?=$TT?>"/>
	<input name="submit" type="submit" value="Submit" />
</form>

<?php

IF(ISSET($_POST['TT'])) {

include 'msm_db.php';
Echo "<br>//Output for $TT<br>";
$fetch_clusters = "SELECT tc.teacherTopicCode as 'TT', tm.teacherTopicDesc as 'name', group_concat(DISTINCT '\"',q.clusterCode,'\"') as 'clusters'
					FROM educatio_adepts.adepts_questions q, educatio_adepts.adepts_teacherTopicClusterMaster tc, educatio_adepts.adepts_teacherTopicMaster tm
					where q.clusterCode = tc.clusterCode
					and tc.teacherTopicCode = tm.teacherTopicCode
					AND tc.teacherTopicCode = '$TT'

					group by tc.teacherTopicCode
					order by tc.teacherTopicCode, q.clusterCode asc;";

$result1 = mysqli_query($conn, $fetch_clusters);
$container_array['id'] = array();
$container_array['id']['contents'] = array();
while($row = mysqli_fetch_assoc($result1)){
echo '$container_array[] = array("type" => "Teacher Topic", // cluster, game, teacher topic, SDL<br>
			"id" => "'.$row['TT'].'",<br>
			"name" =>"'.$row['name'].'" ,<br>
			"contents" => array('.$row['clusters'].'),<br>
			"status_criterion" => "<to write as per comment>",	// if last_element completed, mark as COMPLETED, else IN_PROGRESS<br>
			"start_with" => "FIRST_ELEMENT",			// FIRST_ELEMENT, RANDOM_FROM_UNATTEMPTED<br>
			"movement_logic_within_container" => "if (active_element.result == "success") NEXT_IN_SEQUENCE; if ((active_element.result == \'failure\') && (active_element.failure_number == 1)) SAME_ELEMENT; if ((active_element.result == \'failure\') && (active_element.failure_number == 2)) PREVIOUS_ELEMENT; if ((active_element.result == \'failure\') && (active_element.failure_number == 3) && (exists(active_element.remedial_cluster)) call_element(active_element.remedial_cluster); if ((active_element.result == \'failure\') && (active_element.failure_number == 4) && (exists(active_element.remedial_element)) call_element(active_element.remedial_element);" // "USER_SELECTION" | (NEXT_IN_SEQUENCE | RANDOM_FROM_UNATTEMPTED | RANDOM_WITH_REPEAT | USER_SELECTION)<br><br>';
}

echo "<br>//Now the clusters<br>";
$fetch_SDLs = "SELECT cm.cluster as 'name',  q.clusterCode as 'cluster',group_concat(DISTINCT concat('\"',q.clusterCode, '_',ROUND(q.subDifficultyLevel,1),'\"') ORDER BY q.subdifficultylevel asc) as 'SDL'
				FROM educatio_adepts.adepts_questions q, educatio_adepts.adepts_teacherTopicClusterMaster tc, educatio_adepts.adepts_clusterMaster cm
				where q.clusterCode = tc.clusterCode
				AND tc.teacherTopicCode = '$TT'
				AND q.clusterCode = cm.clusterCode
				group by q.clusterCode
				order by q.clusterCode, q.subdifficultylevel asc;";

$result2 = mysqli_query($conn, $fetch_SDLs);
while($row = mysqli_fetch_assoc($result2)){
echo '$container_array[] = array("type" => "cluster", 
			"id" => "'.$row['cluster'].'",<br>
			"name" => "'.$row['name'].'",<br>
			"contents" => array('.$row['SDL'].'),<br>
			"remedial_action1" => "RFRA001",<br>
			"remedial_action2" => "",		<br>	
			"status_criterion" => "(#student[\'element_performance\'][\'FAILURE\'] / #student[\'element_performance\'][\'TOTAL\'] > (1 - (#container_array[#container_key][\'success_percent\']))) ? \'FAILURE\' : ((count(#student[\'unattempted_elements\'])==0) ? \'SUCCESS\' : \'IN_PROGRESS\');",
			"start_with" => "FIRST_ELEMENT",<br>
			"success_percent" => 0.8,<br>
			"movement_logic_within_container" => "\'NEXT_IN_SEQUENCE\';"
);<br><br>';
}
echo "<br>//Now the SDLs<br>";
$fetch_Qs = "SELECT concat(q.clusterCode, '_',ROUND(q.subDifficultyLevel,1)) as 'SDL', group_concat(q.qcode) as 'qcodes'
				FROM educatio_adepts.adepts_questions q, educatio_adepts.adepts_teacherTopicClusterMaster tc
				where q.clusterCode = tc.clusterCode
				AND tc.teacherTopicCode = '$TT'
				group by SDL
				order by SDL, q.subdifficultylevel asc;";

$result3 = mysqli_query($conn, $fetch_Qs);
while($row = mysqli_fetch_assoc($result3)){
echo '$container_array[] = array("type" => "SDL",<br>
			"id" => "'.$row['SDL'].'",<br>
			"name" => "'.$row['SDL'].'",<br>
			"contents" => array('.$row['qcodes'].'),<br>
			"status_criterion" => "(#student[\'last_element_status\'] == \'SUCCESS\') ? \'SUCCESS\' : ((count(#student[\'unattempted_elements\'])==0) ? \'FAILURE\' : \'IN PROGRESS\');",<br>
			"start_with" => "RANDOM_FROM_UNATTEMPTED",<br>
			"movement_logic_within_container" => "(#student[\'last_element_status\'] == \'SUCCESS\') ? \'END\' : (count(#student[\'unattempted_elements\'])==0) ? \'END\' : \'RANDOM_FROM_UNATTEMPTED\';"<br>
);<br><br>';
}

$conn->close();
}
?>
</html>