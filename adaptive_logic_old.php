<?php
include './mindspark_content.php';

$max_ques = 10;				// Dummy to simulate, say, end of session
$current_student_id = 100;
$container_level = array();
$student_progress = array("current_learning_mode" => "skill", "is_pool_container" => 0, "correct_in_sequence" => 0, "wrong_in_sequence" => 0, 
						"active_container" => "",
						"container_array" => array(
							0 =>	array(	
									"id" 			=> "TT050",
									"attempt_num" 	=> 1,
									"trail"			=> "",					// The trail is used to locate the correct container (TT) and attempt number through 											// which this element was activated since a cluster can be in multiple TT's, etc.
								   	"status" 		=> "IN_PROGRESS",		// NOT_STARTED, IN_PROGRESS, COMPLETED, FAILURE, SUCCESS
								   	"failure_num"	=> 0,
								   	"element_performance" => array("SUCCESS" => 1, "FAILURE" => 0, "COMPLETED" => 0, "IN_PROGRESS" => 1, "UNATTEMPTED" => 23, "TOTAL" => 25),
								   	"attempted_elements" => array("FRA003" => "SUCCESS", "FRA004" => "IN_PROGRESS"),
								   	"unattempted_elements"	=> array(3 => 'FRA016', 4 => 'FRA012', 5 => 'WNC011', 6 => 'FRA006', 7 => 'FRA009', 8 => 'FRA010', 9 => 'FRA032', 10 => 'FRA010', 10 => 'FRA011', 12 => 'FRA010', 13 => 'FRA013', 14 => 'REA016', 15 => 'FRA013', 16 => 'FRA007', 17 => 'FRA006', 18 => 'FRA008', 19 => 'FRA005', 20 => 'FRA018', 21 => 'FRA014', 22 => 'REA036', 23 => 'REA062'),
								   	"last_element_status"	=> "IN_PROGRESS" // (UNDEFINED | NOT_STARTED | IN_PROGRESS | SUCCESS | FAILURE | COMPLETED)
								   	),

							1 =>	array(
			   						"id"			=> "FRA003",
			   						"attempt_num"	=> 1,
			   						"trail"			=> "TT050(1)",			// Meaning reached in the first attempt of TT050
			   						"status"		=> "SUCCESS",
			   						"failure_num"	=> 0,
			   						"element_performance" => array("SUCCESS" => 1, "FAILURE" => 0, "COMPLETED" => 0, "IN_PROGRESS" => 1, "UNATTEMPTED" => 14, "TOTAL" => 16),
			   						"attempted_elements" => array("FRA003_SDL_1" => "SUCCESS", "FRA003_SDL_2" => "IN_PROGRESS"),
			   						"unattempted_elements"	=> array(3 => "FRA003_SDL_3", 4 => "FRA003_SDL_4", 5 => "FRA003_SDL_5", 6 => "FRA003_SDL_6", 7 => "FRA003_SDL_7", 8 => "FRA003_SDL_8", 9 => "FRA003_SDL_9", 10 => "FRA003_SDL_10", 11 => "FRA003_SDL_11", 12 => "FRA003_SDL_12", 13 => "FRA003_SDL_13", 14 => "FRA003_SDL_14", 15 => "FRA003_SDL_15", 16 => "FRA003_SDL_16"),
			   						"last_element_status"	=> "IN_PROGRESS" 
			   					),

							2 =>	array(
					   				"id"			=> "FRA003_SDL_1",
			   						"attempt_num"	=> 1,
			   						"trail"			=> "TT050(1)|FRA003(1)",
			   						"status"		=> "SUCCESS",
			   						"failure_num"	=> 0,
			   						"element_performance" => array("SUCCESS" => 1, "FAILURE" => 1, "COMPLETED" => 0, "IN_PROGRESS" => 0, "UNATTEMPTED" => 1, "TOTAL" => 3),
			   						"attempted_elements"			=> array("7002" => "FAILURE", "7037" => "SUCCESS"),
			   						"last_element_status" => "SUCCESS",	
			   						"unattempted_elements"	=> array(7040),			   						
			   					),

							3 =>	array(
					   				"id"			=> "FRA003_SDL_2",
			   						"attempt_num"	=> 1,
			   						"trail"			=> "TT050(1)|FRA003(1)",
			   						"status"		=> "FAILURE",
			   						"failure_num"	=> 0,
			   						"element_performance" => array("SUCCESS" => 0, "FAILURE" => 3, "COMPLETED" => 0, "IN_PROGRESS" => 0, "UNATTEMPTED" => 0, "TOTAL" => 3),
			   						"attempted_elements" => array("7028" => "FAILURE", "7045" => "FAILURE", "7046" => "FAILURE"),
			   						"last_element_status" => "FAILURE",
			   						"unattempted_elements"	=> array(),			   						
			   					),							
							),
						"container_index" => array("TT050" => array(0), "FRA003" => array(2, 12), "FRA003_SDL_1" => array(3, 11)),
//						"current_positions_in_containers" => array(),
						"current_positions_in_containers" => array("TT050" => "TT050(1)|FRA003(1)|FRA003_SDL_2(1)|7045"),
						// For the above, earlier did "current_positions_in_containers" => array("TT050" => "FRA003", "FRA003" => "FRA003_SDL_3", "FRA003_SDL_3" => "7043"), but realised that would not work as a cluster could come in another TT also, so tried array("TT050" => array("FRA003" => array("FRA003_SDL_2" => "7045"))) before changing to the current
						// Also the element shown is the *element just asked / already asked* not the element *to be asked*
						"stack" => array() 

					);	

$count = 0;
while(1)
{	if (isset($exceptional_condition[$current_student_id])) 
	{	handle_exceptional_condition($exceptional_condition[$current_student_id]);
		break;
	}	
	if ($student_progress["is_pool_container"] && (count($student_progress["pool_items"]) > 0)) get_next_pool_element();
	if ($student_progress["current_learning_mode"] == "exposure") exposure_logic();

	if (!isset($student_progress["active_container"]) || ($student_progress["active_container"] == ""))
	{	echo "Choose a TT (TT050, TT051, TT052)...<br>...Assuming TT050 chosen<br>";
		$active_container = "TT050";
		set_active_container($active_container, $student_progress);

		if (isset($student_progress["current_positions_in_containers"][$active_container]))		// Check if there is already a prior position in this container
		{	$container_levels = $student_progress["current_positions_in_containers"][$active_container];	// If so, get the full array till the final element in $container_level
			$levels_arr = explode("|", $container_levels);	// Get logic from container element at $container[$num_levels-2] (SDL) ($container[$num_levels-1] is the question)
			$num_level = count($levels_arr);
			$curr_level = $num_level-2;

			find_next_element($levels_arr, $curr_level);		// Return updated $levels_arr which will contain next element OR 'ACTIVE_CONTAINER_COMPLETE' (TT complete))
		} 
		else 
		{	$levels_arr = array(0 => $active_container."(1)");
			$curr_level = 0;
			$curr_attempt = create_container_progress_record($levels_arr, $curr_level, "", $student_progress);
echo "Line 93: <xmp> levels_arr = ";
print_r($student_progress);
echo "</xmp><hr>";
			
			get_first_element($levels_arr, $curr_level);		// First time this active container (TT) being started so slightly different function for that
		}

		$curr_level = count($levels_arr) - 1;
	echo "Line 94: curr_level = ".$curr_level."<xmp> levels_arr = ";
	print_r($levels_arr); 
	echo "</xmp>";

		// Update $student_progress["current_positions_in_containers"]
		// Ask the question
		// Get response
		// Update records accordingly
		$student_response = ask_item_and_get_response($levels_arr, $curr_level, $student_progress);		
	}

// Check if there is already a position in this active container. 
// If yes
//		Go there, to the item level
//		Check the continuation logic for the innermost container
//		Store those positions and ask the item	
// If no
//		Check the start logic for the container, its container, etc., till an item is reached
// 		Store those positions and ask the item


	$count++;
	echo "Line 119: count = ".$count."<br>";
	if ($count == $max_ques) $exceptional_condition[$current_student_id] = "SESSION_END";
}


function find_next_element(&$levels_arr, &$curr_level)
{	global $container_array, $student_progress;
	echo "Line 126 Entering find_next_element: curr_level = ".$curr_level."<xmp>";
	print_r($levels_arr);
	echo "</xmp>";
	list($container_key, $student_progress_key) = get_student_progress_key($levels_arr[$curr_level]);	// like FRA003_SDL_2(2)
	echo "Line 118 container_key: ".$container_key." | student_progress_key: ".$student_progress_key."<br>";
	$student = $student_progress['container_array'][$student_progress_key];

	echo "student[status] = ".$student['status']."<br>";
	eval(str_replace("#", "$", "global #container_array; #action = ".$container_array[$container_key]["movement_logic_within_container"]));	// Get Action Code
	echo "Line 124 - ".$action."<br>";
											// Put a function here instead of a switch case as was there earlier
	take_action($levels_arr, $curr_level, $action);
}

function take_action(&$levels_arr, &$curr_level, $action)
{	global $container_array, $student_progress;

	list($container_key, $student_progress_key) = get_student_progress_key($levels_arr[$curr_level]);	// like FRA003_SDL_2(2)
	$student = $student_progress['container_array'][$student_progress_key];

	switch ($action)
	{	case "END":		unset($levels_arr[$curr_level+1]); 
						$curr_level--;
						find_next_element($levels_arr, $curr_level);
						break;

		case "NEXT":	$next_key = min(array_keys($student['unattempted_elements']));
						if ($next_key === false)
						{	$curr_level--;
							find_next_element($levels_arr, $curr_level);
							break;
						}	
						$next_val = $student['unattempted_elements'][$next_key];			// But not removing from unattempted_elements till actually asked
						if (get_container_key($next_val) != -1)		// meaning this IS a container
						{	$curr_attempt = create_container_progress_record($levels_arr, $curr_level, $next_val, $student_progress);		// Create a new container_array under student_progress, return attempt number, also update "container_index"
							$curr_level++;
							$levels_arr[$curr_level] = $next_val."(".$curr_attempt.")";
							get_first_element($levels_arr, $curr_level);
						} else $levels_arr[$curr_level+1] = $next_val;		// If it is just an item

						break;

		case "RANDOM_FROM_UNATTEMPTED":
						$next_key = array_rand($student['unattempted_elements']);
						if ($next_key === false)
						{	$curr_level--;
							find_next_element($levels_arr, $curr_level);
							break;
						}			
						$next_val = $student['unattempted_elements'][$next_key];			// But not removing from unattempted_elements till actually asked
						if (get_container_key($next_val) != -1)		// meaning this IS a container
						{	$curr_attempt = create_container_progress_record($levels_arr, $curr_level, $next_val, $student_progress);		// Create a new container_array under student_progress, return attempt number, also update "container_index"
							$curr_level++;
							$levels_arr[$curr_level] = $next_val."(".$curr_attempt.")";
							get_first_element($levels_arr, $curr_level);
						} else $levels_arr[$curr_level+1] = $next_val;		// If it is just an item

	echo "Line 185 In RANDOM_FROM_UNATTEMPTED: curr_level = ".$curr_level."<xmp>";
	print_r($levels_arr);
	echo "</xmp>";

						break;

	}
}

function create_container_progress_record($levels_arr, $curr_level, $container_id, &$student_progress)
{	global $container_array;				// $student_progress['container_index'] will have to be updated, hence passing by reference

echo "Line 196 Entering create_container_progress_record: curr_level = ".$curr_level."<xmp>";
print_r($levels_arr);
echo "</xmp>";
	$this_trail = "";

	if ($container_id == "")			// This means this is a highest level container and the container_id is the same as the Levels_arr[0]. Also, $this_trail = ""
	{	preg_match('/(.*)\((\d+)\)/', $levels_arr[$curr_level], $matches);
		$container_id = $matches[1];
		$top_con_attempt_num = $matches[2];
	}
	else 
	{	for ($i=0; $i<=$curr_level; $i++) $this_trail .= $levels_arr[$i]."|";
		$this_trail = substr($this_trail, 0, -1);
	}	

echo "Line 208 in create_container_progress_record: container_id = ".$container_id."<br>";

	$max_past_attempt = 0;
	$max_past_failure_this_trail = -1;

	$new_key = max(array_keys($student_progress['container_array'])) + 1;
	$container_key = get_container_key($container_id);
	$elements = $container_array[$container_key]['contents'];
	$total_elements = count($elements);

	// Get max_past_attempt and ax_past_failure_this_trail numbers
	if (isset($student_progress['container_index'][$container_id]))
	{	foreach ($student_progress['container_index'][$container_id] as $this_key)
		{	$temp_past_attempt = $student_progress['container_array'][$this_key]['attempt_num'];
			if ($temp_past_attempt > $max_past_attempt) $max_past_attempt = $temp_past_attempt;
			if ($student_progress['container_array'][$this_key]['trail'] == $this_trail)		// failure_num consider only $this_trail
			{	$temp_past_failure_this_trail = $student_progress['container_array'][$this_key]['failure_num'];
				if ($temp_past_failure_this_trail > $max_past_failure_this_trail) $max_past_failure_this_trail = $temp_past_failure_this_trail;
			}	
		}	
	}

	$student_progress['container_array'][$new_key] = array(
			"id"			=> $container_id,
			"attempt_num"	=> $max_past_attempt+1,
			"trail"			=> $this_trail,
			"status"		=> "NOT STARTED",						// Or should it be IN_PROGRESS?
			"failure_num"	=> $max_past_failure_this_trail + 1,
			"element_performance" => array("SUCCESS" => 0, "FAILURE" => 0, "COMPLETED" => 0, "IN_PROGRESS" => 0, "UNATTEMPTED" => $total_elements, "TOTAL" => $total_elements),
			"attempted_elements" => array(),
			"unattempted_elements"	=> $elements,
			"last_element_status"	=> "NOT_STARTED" 
		);

	$student_progress['container_index'][$container_id][] = $new_key;

	return($max_past_attempt+1);

}

function get_first_element(&$levels_arr, &$curr_level)
{	global $container_array, $student_progress;
	echo "Line 235 Entering get_first_element: curr_level = ".$curr_level."<xmp>";
	print_r($levels_arr);
	echo "</xmp>";
	list($container_key, $student_progress_key) = get_student_progress_key($levels_arr[$curr_level]);	// like FRA003_SDL_2(2)


	eval(str_replace("#", "$", "global #container_array; #action = ".$container_array[$container_key]["start_with"]));	// Get Action Code
	echo "Line 240 - ".$action."<br>";
	take_action($levels_arr, $curr_level, $action);


}

function get_student_progress_key($container_id_with_attempt_num)		// like TT005(2)
{	global $student_progress; 
	echo "Line 247: container_id_with_attempt_num = ".$container_id_with_attempt_num."<br>";
	preg_match('/(.*)\((\d+)\)/', $container_id_with_attempt_num, $matches);
	$container_id = $matches[1];
	$attempt_num = $matches[2];

	$container_key = get_container_key($container_id);
	foreach ($student_progress["container_array"] as $key => $value)
	{	if (($value["id"] == $container_id) && ($value["attempt_num"] == $attempt_num)) 
			return(array($container_key, $key));
	}
	return(-1);

//	return(substr($container_id_with_attempt_num, 0, strpos($container_id_with_attempt_num, "(")));

}
function set_active_container($container_id, &$student_progress)
{	$student_progress["active_container"] = $container_id; 
	$student_progress["is_pool_container"] = is_pool_container($container_id, $student_progress);
} 

function is_pool_container($container_id, &$student_progress)
{	$key = get_container_key($container_id);
	if ($key == -1) return(-1); 
	if (isset($container_array[$key]["is_pool_container"])) $student_progress["is_pool_container"] = 1; else unset($GLOBALS['student_progress']['is_pool_container']);
}

function handle_exceptional_condition($exceptional_code)
{	switch ($exceptional_code)
	{	case "SESSION_END":		echo "End of session<br>";
								break;

	}
}

function ask_item_and_get_response(&$levels_arr, &$curr_level, &$student_progress)
{	global $container_array;

	list($container_key, $student_progress_key) = get_student_progress_key($levels_arr[$curr_level-1]);	// like FRA003_SDL_2(2)
	$student = &$student_progress['container_array'][$student_progress_key]; // Processing depending on the item and correct response

echo "Line 305: student_progress_key = ".$student_progress_key."<br>";

$rand_result = (rand(1,100) < 75) ? "SUCCESS" : "FAILURE";
$response = array(	"result" => $rand_result,				
					"parameters" => array()		// Optional details like maybe a score, game paramters, misconceptions, etc. 
			);
	$this_item = $levels_arr[$curr_level];
	echo "Line 288 - Asked item ".$this_item." in ".$levels_arr[$curr_level-1]." and the result was ... ".$rand_result."<br>";

	// Remove item from 'unattempted_elements' and add it to attempted_elements() with the result
	$this_key =array_search($this_item, $student['unattempted_elements']);
	unset($student['unattempted_elements'][$this_key]);
	$student['attempted_elements'][$this_item] = $rand_result;

	// Update 'last_element_status' and 'element_performance'
	$student['last_element_status'] = $rand_result;	
	$student['element_performance']['UNATTEMPTED']--;
	$student['element_performance'][$rand_result]++;

	echo "Line 322 rand_result = ".$rand_result. " | last_element_status: ".$student['last_element_status']."<br>";


	// Update 'status'
	echo "Line 323: ".str_replace("#", "$", "global #container_array; #student['status'] = ".$container_array[$container_key]["status_criterion"])."<br>";
	eval(str_replace("#", "$", "global #container_array; #student['status'] = ".$container_array[$container_key]["status_criterion"]));	// Updated (parent) container status
	echo "Line 325 status: ".$student['status']."<br>";

	// Update 'correct_in_sequence' and 'wrong_in_sequence' in $student_progress
	if ($rand_result == "SUCCESS")
	{	$student_progress['correct_in_sequence']++;
		$student_progress['wrong_in_sequence'] = 0;
	} elseif ($rand_result == "FAILURE")
	{	$student_progress['correct_in_sequence'] = 0;
		$student_progress['wrong_in_sequence']++;
	}	

	// Update 'current_positions_in_containers' in $student_progress
	$curr_pos = "";
	foreach ($levels_arr as $key => $value) $curr_pos .= $value."|";
	$student_progress['current_positions_in_containers'] = substr($curr_pos, 0, -1);

	return ($response);								// Considered directly updating $student_progress. But other updates will be needed. So let calling program do. 
}

function get_container_key($container_id)
{	global $container_array;
	foreach ($container_array as $key => $value)
	{	if ($value["id"] == $container_id) return($key);
	}
	return(-1);

}

echo "<xmp>";
print_r($student_progress);
echo "</xmp>";
/* 
Pool Element: Pool elements are fixed tests, timed tests, worksheets, etc, where except for an exceptional condition, the pool will be completed element by element.
So when a pool element is active, "in_pool_element" will be 1, and the entire pool will be copied into "pool_items"

Issues of Active Container and Stack: While current positions can be there in multiple containers (Mindspark Maths TTs), the 'active' container can be only 1.
Is there any situation where a student in Mindspark Maths is NOT in a TT (can't think of any) 

There can be only one active container. As long as we only consider Teacher Topics, this is fine. But if we allow students to choose 'non-flow games' by going to 
a 'Game Zone' or similarly choose to (or be assigned to) work on a Worksheet, then what is the 'Container'?

The issue of Stack is related. A Stack works First-In Last-Out (FILO) and records the place to which control should return.

Some other actions: 
choose_topic() 				[This will show the Topic Selection Screen]
show_session_report() 		[This will show the Session Report]

*****
Should current_positions_in_containers be stored as nested arrays or a string. Currently favouring the latter, the older code in the former case was:

	if (isset($student_progress["current_positions_in_containers"][$active_container]))		// Check if there is already a prior position in this container
	{	$current_level = $student_progress["current_positions_in_containers"];				// If so, get the full array till the final item in $container_level

		while (isset($current_level))
		{	if (is_array($current_level))
			{	$container_level[$level++] = key($current_level);
				$current_level = reset($current_level);
			} else
			{	$container_level[$level++] = $current_level;
				$last_item_id = $current_level;
				unset($current_level);
			}	
		}
	.
	}


*/






/************************
 * A basic element can be run (eg. game) or 'asked' (eg. question, challenge question)
 * A container element contains basic elements or containers in sequential, partly sequential or non-sequential order eg. SDL, timed test, cluster, TT, etc
 * Every container element has a Failed_Elements_Array recording the elements that were not cleared. It also has total_elements, attempted_elements, correct_elements
 * 
 * Consider a cluster and an SDl. Both are container elements. In fact a cluster is typically made up of SDLs
 * 
 * 
 * A cluster contains SDLs is sequential order while an SDL contains questions in non-sequential order
 * Adaptive logic of cluster:
 * 	 - SDL success when any element of the SDl (question) is answered correctly 
 * 	 - On SDL success, move to next SDL
 *   - On SDL 'no_elements_left_to_ask', move to nextt SDL
 *   - On SDL failure, ask another question (not asked) from SDL
 * 
 * Adaptive logic 1 of SDL:
 *   - On Question success, exit SDL
 * 
 * Adaptive logic 2 of SDL:
 *   - On attempted_elements = 0.8 * total_elements, exit SDL
 *   
 ***********************/




echo "Reached program end<br>";

?>