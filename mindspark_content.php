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
			"movement_logic_within_container" => "if (active_element.result == 'success') NEXT_IN_SEQUENCE; if ((active_element.result == 'failure') && (active_element.failure_number == 1)) SAME_ELEMENT; if ((active_element.result == 'failure') && (active_element.failure_number == 2)) PREVIOUS_ELEMENT; if ((active_element.result == 'failure') && (active_element.failure_number == 3) && (exists(active_element.remedial_cluster)) call_element(active_element.remedial_cluster); if ((active_element.result == 'failure') && (active_element.failure_number == 4) && (exists(active_element.remedial_element)) call_element(active_element.remedial_element);" // "USER_SELECTION" | (NEXT_IN_SEQUENCE | RANDOM_FROM_UNATTEMPTED | RANDOM_WITH_REPEAT | USER_SELECTION)

);

// So we have to define active_element.id, active_element.result, active_element.failure_number, active_element.remedial_cluster, active_element.remedial_element, SAME_ELEMENT, PREVIOUS_ELEMENT, NEXT_IN_SEQUENCE, is_last_element_completed(), exists(), call_element(), is_cluster_passed(), last_element_status() 

$container_array[] = array("type" => "cluster", // cluster, game, teacher topic, SDL
			"id" => "FRA003",
			"name" => "Working with unit fractions",
			"contents" => array(1 => "FRA003_SDL_1", 2 => "FRA003_SDL_2", 3 => "FRA003_SDL_3", 4 => "FRA003_SDL_4", 5 => "FRA003_SDL_5", 6 => "FRA003_SDL_6", 7 => "FRA003_SDL_7", 8 => "FRA003_SDL_8", 9 => "FRA003_SDL_9", 10 => "FRA003_SDL_10", 11 => "FRA003_SDL_11", 12 => "FRA003_SDL_12", 13 => "FRA003_SDL_13", 14 => "FRA003_SDL_14", 15 => "FRA003_SDL_15","FRA003_SDL_16"),
			"remedial_action1" => "RFRA001",
			"remedial_action2" => "",			
			"status_criterion" => "(#student['element_performance']['FAILURE'] / #student['element_performance']['TOTAL'] > (1 - (#container_array[#container_key]['success_percent']))) ? 'FAILURE' : ((count(#student['unattempted_elements'])==0) ? 'SUCCESS' : 'IN_PROGRESS');",	// If success criterion cannot be met, mark as FAILURE; else if complete, mark SUCCESS or FAILURE, else IN_PROGRESS 
			"start_with" => "FIRST_ELEMENT",
			"success_percent" => 0.8,
			"movement_logic_within_container" => "'NEXT_IN_SEQUENCE';"		// NEXT_IN_SEQUENCE implies NEXT sibling
);

$container_array[] = array("type" => "SDL", // cluster, game, teacher topic, SDL
			"id" => "FRA003_SDL_1",
			"name" => "FRA003_SDL_1",
			"contents" => array(7002, 7037, 7040),
			"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
			"start_with" => "RANDOM_FROM_UNATTEMPTED",
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
			"start_with" => "RANDOM_FROM_UNATTEMPTED",
			"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL", // cluster, game, teacher topic, SDL
			"id" => "FRA003_SDL_3",
			"name" => "FRA003_SDL_3",
			"contents" => array(7027, 7048, 7049),
			"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
			"start_with" => "RANDOM_FROM_UNATTEMPTED",
			"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL", // cluster, game, teacher topic, SDL
			"id" => "FRA003_SDL_4",
			"name" => "FRA003_SDL_4",
			"contents" => array(7033, 7055, 7058),
			"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
			"start_with" => "RANDOM_FROM_UNATTEMPTED",
			"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL", // cluster, game, teacher topic, SDL
			"id" => "FRA003_SDL_5",
			"name" => "FRA003_SDL_5",
			"contents" => array(7034, 7064, 7065),
			"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
			"start_with" => "RANDOM_FROM_UNATTEMPTED",
			"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL", // cluster, game, teacher topic, SDL
			"id" => "FRA003_SDL_6",
			"name" => "FRA003_SDL_6",
			"contents" => array(7041, 7085, 7086),
			"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
			"start_with" => "RANDOM_FROM_UNATTEMPTED",
			"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL", // cluster, game, teacher topic, SDL
			"id" => "FRA003_SDL_7",
			"name" => "FRA003_SDL_7",
			"contents" => array(7039, 7087, 7088),
			"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
			"start_with" => "RANDOM_FROM_UNATTEMPTED",
			"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL", // cluster, game, teacher topic, SDL
			"id" => "FRA003_SDL_8",
			"name" => "FRA003_SDL_8",
			"contents" => array(7036, 7089, 7090),
			"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
			"start_with" => "RANDOM_FROM_UNATTEMPTED",
			"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL", // cluster, game, teacher topic, SDL
			"id" => "FRA003_SDL_9",
			"name" => "FRA003_SDL_9",
			"contents" => array(7053, 7094, 7096),
			"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
			"start_with" => "RANDOM_FROM_UNATTEMPTED",
			"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL", // cluster, game, teacher topic, SDL
			"id" => "FRA003_SDL_10",
			"name" => "FRA003_SDL_10",
			"contents" => array(7029, 7098, 7101),
			"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
			"start_with" => "RANDOM_FROM_UNATTEMPTED",
			"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL", // cluster, game, teacher topic, SDL
			"id" => "FRA003_SDL_11",
			"name" => "FRA003_SDL_11",
			"contents" => array(7031, 7104, 7105),
			"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
			"start_with" => "RANDOM_FROM_UNATTEMPTED",
			"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL", // cluster, game, teacher topic, SDL
			"id" => "FRA003_SDL_12",
			"name" => "FRA003_SDL_12",
			"contents" => array(7059, 7106, 7107),
			"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
			"start_with" => "RANDOM_FROM_UNATTEMPTED",
			"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL", // cluster, game, teacher topic, SDL
			"id" => "FRA003_SDL_13",
			"name" => "FRA003_SDL_13",
			"contents" => array(7060, 7108, 7109),
			"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
			"start_with" => "RANDOM_FROM_UNATTEMPTED",
			"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL", // cluster, game, teacher topic, SDL
			"id" => "FRA003_SDL_14",
			"name" => "FRA003_SDL_14",
			"contents" => array(7056, 7110, 7111),
			"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
			"start_with" => "RANDOM_FROM_UNATTEMPTED",
			"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL", // cluster, game, teacher topic, SDL
			"id" => "FRA003_SDL_15",
			"name" => "FRA003_SDL_15",
			"contents" => array(7061, 7112, 7113),
			"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
			"start_with" => "RANDOM_FROM_UNATTEMPTED",
			"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "ASSET_test", // cluster, game, teacher topic, SDL
						"id" => "ASSET_19C",
						"name" => "ASSET English Winter 2006",
						"contents" => array(12775,12778,12779,12783,12784,12782,12781,13250,12871,12875,12876,12869,12868,12873,12874,12877,12872,12852,12855,12856,12854,12858,12861,12853,12851,12792,12793,12800,12788,12802,12795,12790,12823,12824,12862,12863,12864,12865,12866,12804,12816,12770,12765,12769,12773,12772,12768,12809,12803,13157,13158,12844,12846,12847,12848,13251,13188,13189,13190,13191,13192,13193,12813,12810,13249,12808,12805,12806,12807,12812),
						"success_criterion" => "is_last_element_completed()",
						"start_with" => "FIRST_ELEMENT",
						"movement_logic" => "NEXT_IN_SEQUENCE",
						"is_pool_container" => 1
);

$container_array[] = array("type" => "ASSET_test", // cluster, game, teacher topic, SDL
						"id" => "ASSET_26J",
						"name" => "ASSET Maths Summer 2010",
						"contents" => array(22621,22824,22882,22874,20756,22838,20174,22869,22841,22828,22848,22817,22832,22842,22880,22847,22914,22846,22605,22870,22830,22837,22877,22881,22876,22826,22890,22891,22822,22819,22904,22818,22887,22840,18241,22909,22893,22835,22892,22894),
						"success_criterion" => "is_last_element_completed()",
						"start_with" => "FIRST_ELEMENT",
						"movement_logic" => "NEXT_IN_SEQUENCE",
						"is_pool_container" => 1
);


$container_array[] = array("type" => "test", // cluster, game, teacher topic, SDL
						"id" => "DA_43449939887782021_2",
						"name" => "",
						"contents" => array(72360,70765,12937,70810,70744,70838,70874,70718,70738,70830,70713,70742,70745,70741,70764,72304,72232,12939,70746),
						"success_criterion" => "is_last_element_completed()",
						"start_with" => "FIRST_ELEMENT",
						"movement_logic" => "UNATTEMPTED_ELEMENT",
						"is_pool_container" => 1
);

$container_array[] = array("type" => "test", // cluster, game, teacher topic, SDL
						"id" => "DA_26449939887782305_4",
						"name" => "",
						"contents" => array(39990,66142,24024,59805,44006,50923,55878,65723,64109,45523,47727,32096,20234,41401,13512,20488,7597,24129,24123,40414,22966,43685,50859,28775,17356),
						"success_criterion" => "is_last_element_completed()",
						"start_with" => "FIRST_ELEMENT",
						"movement_logic" => "UNATTEMPTED_ELEMENT",
						"is_pool_container" => 1
);

?>