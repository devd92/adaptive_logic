<?php
$container_types = array("Teacher Topic", "Cluster", "Timed Test");
$element_types = array("Game", "Question", "Challenge Question", "Remedial");
$learning_modes = array("exposure", "skill");
$exceptional_condition = array();
$CLUSTER_SUCCESS_PERcEnT = 80;

$container_array = array();

$container_array[] = array("type" => "Teacher Topic", 
			"id" => "TT050",
			"name" => "Fractions - Basic Concepts", 
			"contents" => array(1 => 'FRA003', 2 => 'FRA004', 3 => 'FRA016', 4 => 'FRA012', 5 => 'WNC011', 6 => 'FRA006', 7 => 'FRA009', 8 => 'FRA010', 9 => 'FRA032', 10 => 'FRA010', 10 => 'FRA011', 12 => 'FRA010', 13 => 'FRA013', 14 => 'REA016', 15 => 'FRA013', 16 => 'FRA007', 17 => 'FRA006', 18 => 'FRA008', 19 => 'FRA005', 20 => 'FRA018', 21 => 'FRA014', 22 => 'REA036', 23 => 'REA062'),
			"status_criterion" => "<to write as per comment>",	// if last_element completed, mark as COMPLETED, else IN_PROGRESS
			"start_with" => "FIRST_ELEMENT",			// FIRST_ELEMENT, RANDOM_FROM_UNATTEMPTED
			"movement_logic_within_container" => "if (active_element.result == 'success') NEXT_ELEMENT; if ((active_element.result == 'failure') && (active_element.failure_number == 1)) SAME_ELEMENT; if ((active_element.result == 'failure') && (active_element.failure_number == 2)) PREVIOUS_ELEMENT; if ((active_element.result == 'failure') && (active_element.failure_number == 3) && (exists(active_element.remedial_cluster)) call_element(active_element.remedial_cluster); if ((active_element.result == 'failure') && (active_element.failure_number == 4) && (exists(active_element.remedial_element)) call_element(active_element.remedial_element);" // "USER_SELECTION" | (NEXT | RANDOM_FROM_UNATTEMPTED | RANDOM_WITH_REPEAT | USER_SELECTION)

);

// So we have to define active_element.id, active_element.result, active_element.failure_number, active_element.remedial_cluster, active_element.remedial_element, SAME_ELEMENT, PREVIOUS_ELEMENT, NEXT_ELEMENT, is_last_element_completed(), exists(), call_element(), is_cluster_passed(), last_element_status() 

$container_array[] = array("type" => "cluster", // cluster, game, teacher topic, SDL
			"id" => "FRA003",
			"name" => "Working with unit fractions",
			"contents" => array(1 => "FRA003_SDL_1", 2 => "FRA003_SDL_2", 3 => "FRA003_SDL_3", 4 => "FRA003_SDL_4", 5 => "FRA003_SDL_5", 6 => "FRA003_SDL_6", 7 => "FRA003_SDL_7", 8 => "FRA003_SDL_8", 9 => "FRA003_SDL_9", 10 => "FRA003_SDL_10", 11 => "FRA003_SDL_11", 12 => "FRA003_SDL_12", 13 => "FRA003_SDL_13", 14 => "FRA003_SDL_14", 15 => "FRA003_SDL_15","FRA003_SDL_16"),
			"remedial_action1" => "RFRA001",
			"remedial_action2" => "",			
			"status_criterion" => "(#student['element_performance']['FAILURE'] / #student['element_performance']['TOTAL'] > (1 - (#container_array[#container_key]['success_percent']))) ? 'FAILURE' : ((count(#student['unattempted_elements'])==0) ? 'SUCCESS' : 'IN_PROGRESS');",	// If success criterion cannot be met, mark as FAILURE; else if complete, mark SUCCESS or FAILURE, else IN_PROGRESS 
			"start_with" => "FIRST_ELEMENT",
			"success_percent" => 0.8,
			"movement_logic_within_container" => "'NEXT';"		// NEXT implies NEXT sibling
);

$container_array[] = array("type" => "SDL", // cluster, game, teacher topic, SDL
			"id" => "FRA003_SDL_1",
			"name" => "FRA003_SDL_1",
			"contents" => array(7002, 7037, 7040),
			"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
			"start_with" => "'RANDOM_FROM_UNATTEMPTED';",
			"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

// Mark the SDL as succeeded if last question answered correctly
// If SDL not succeeded and unattempted element exists, ask that
// else check logic with cluster

$container_array[] = array("type" => "SDL", // cluster, game, teacher topic, SDL
			"id" => "FRA003_SDL_2",
			"name" => "FRA003_SDL_2",
			"contents" => array(7028,7045,7046),
			"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
			"start_with" => "'RANDOM_FROM_UNATTEMPTED';",
			"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL", // cluster, game, teacher topic, SDL
			"id" => "FRA003_SDL_3",
			"name" => "FRA003_SDL_3",
			"contents" => array(7027, 7048, 7049),
			"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
			"start_with" => "'RANDOM_FROM_UNATTEMPTED';",
			"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL", // cluster, game, teacher topic, SDL
			"id" => "FRA003_SDL_4",
			"name" => "FRA003_SDL_4",
			"contents" => array(7033, 7055, 7058),
			"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
			"start_with" => "'RANDOM_FROM_UNATTEMPTED';",
			"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL", // cluster, game, teacher topic, SDL
			"id" => "FRA003_SDL_5",
			"name" => "FRA003_SDL_5",
			"contents" => array(7034, 7064, 7065),
			"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
			"start_with" => "'RANDOM_FROM_UNATTEMPTED';",
			"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL", // cluster, game, teacher topic, SDL
			"id" => "FRA003_SDL_6",
			"name" => "FRA003_SDL_6",
			"contents" => array(7041, 7085, 7086),
			"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
			"start_with" => "'RANDOM_FROM_UNATTEMPTED';",
			"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL", // cluster, game, teacher topic, SDL
			"id" => "FRA003_SDL_7",
			"name" => "FRA003_SDL_7",
			"contents" => array(7039, 7087, 7088),
			"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
			"start_with" => "'RANDOM_FROM_UNATTEMPTED';",
			"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL", // cluster, game, teacher topic, SDL
			"id" => "FRA003_SDL_8",
			"name" => "FRA003_SDL_8",
			"contents" => array(7036, 7089, 7090),
			"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
			"start_with" => "'RANDOM_FROM_UNATTEMPTED';",
			"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL", // cluster, game, teacher topic, SDL
			"id" => "FRA003_SDL_9",
			"name" => "FRA003_SDL_9",
			"contents" => array(7053, 7094, 7096),
			"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
			"start_with" => "'RANDOM_FROM_UNATTEMPTED';",
			"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL", // cluster, game, teacher topic, SDL
			"id" => "FRA003_SDL_10",
			"name" => "FRA003_SDL_10",
			"contents" => array(7029, 7098, 7101),
			"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
			"start_with" => "'RANDOM_FROM_UNATTEMPTED';",
			"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL", // cluster, game, teacher topic, SDL
			"id" => "FRA003_SDL_11",
			"name" => "FRA003_SDL_11",
			"contents" => array(7031, 7104, 7105),
			"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
			"start_with" => "'RANDOM_FROM_UNATTEMPTED';",
			"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL", // cluster, game, teacher topic, SDL
			"id" => "FRA003_SDL_12",
			"name" => "FRA003_SDL_12",
			"contents" => array(7059, 7106, 7107),
			"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
			"start_with" => "'RANDOM_FROM_UNATTEMPTED';",
			"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL", // cluster, game, teacher topic, SDL
			"id" => "FRA003_SDL_13",
			"name" => "FRA003_SDL_13",
			"contents" => array(7060, 7108, 7109),
			"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
			"start_with" => "'RANDOM_FROM_UNATTEMPTED';",
			"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL", // cluster, game, teacher topic, SDL
			"id" => "FRA003_SDL_14",
			"name" => "FRA003_SDL_14",
			"contents" => array(7056, 7110, 7111),
			"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
			"start_with" => "'RANDOM_FROM_UNATTEMPTED';",
			"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL", // cluster, game, teacher topic, SDL
			"id" => "FRA003_SDL_15",
			"name" => "FRA003_SDL_15",
			"contents" => array(7061, 7112, 7113),
			"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
			"start_with" => "'RANDOM_FROM_UNATTEMPTED';",
			"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);



/*
//$userDetails = array();
//$last_10_attempted = array();


$cluster_params = array("$SDL_params"=>array("pass_on"=>"accuracy", "pass_on_attempt"=>),"on_fail_count"=>array("repeat","remedial_element", "remedial_cluster", "first_element_in_TT"));
//there is a flow stack (where you are WITHIN a flow and how you got there) and an item stack (last 10 units, which can be Qs, games etc.)
//suppose the logic says 'now start element x' the type of x and what it implies should be clear; the stacking logic should be generic enough that it has high interoperability between subjects
//there is an on_fail array which can be at a student level, cluster level, flow level and/or subject level. It can go in order of these levels and the lowest denominator can override the larger set


// elements of what we did earlier for the adaptive logic 

//list of TTs for a grade, flow, and for each topic
$teacherTopic['CBSE'][5] = array(	'Fractions'=>array('TT050','TT052','TT054','TT62784','TT62785','TT62786','TT62787','TT62811','TT62976','TT62997','TT63055','TT63056','TT63058','TT63059','TT63061'), 
									'Decimals'=>array('TT053','TT146','TT62778','TT62779','TT62781','TT62812','TT62813','TT62902','TT63062','TT63064'));

//list of elements in a TT
$teacherTopic['CBSE'][5]['Fractions']['TT050'] = array('label'=>'Fractions - Basic Concepts', 'enrichment' => 50,
	'clusters' =>array(1=> array('FRA003', 'repeat' => 'No', 'game' => 17, 'challenge_qs' => array(2875, 1866, 2261, 9889)), 
			   2=> array('FRA004', 'rem_cl' => 'FRA016', 'challenge_qs' => array(928, 1986, 2986)), 
			   3=> array('FRA012', 'rem_cl' => 'WNC011', 'game' => 52), 
			   4=>array('FRA006'), 
			   5=>array('FRA009', 'timed_test' => 'TFRA009'),
			   6=>array('FRA010'), 
			   7=>array('FRA032', 'rem_cl' => 'FRA010'),
			   8=> array('FRA011', 'rem_cl' => 'FRA010', 'remedial' => 'RFRA001', 'timed_test' => 'TFRA011', 'game' => 100), 
			   9=>array('FRA013', 'remedial' => 'RFRA005B', 'game' => 162),
			   10=>array('REA016', 'rem_cl' => 'FRA013', 'remedial' => 'RFRA005A', 'timed_test' => 'TREA017', 'game' => 163), 
			   11=>array('FRA007', 'rem_cl' => 'FRA006', 'game' => 174), 
			   12=>'FRA008', 13=>'FRA005', 14=>'FRA018', 15=>'FRA014', 16=>'REA036', 17=>'REA062');


*/

?>