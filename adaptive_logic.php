<?php
include './mindspark_content.php';

$max_ques = 10;				// Dummy to simulate, say, end of session
$current_student_id = 100;
$container_level = array();
$student_progress = array("current_learning_mode" => "skill", "is_pool_container" => 0, "correct_in_sequence" => 0, "wrong_in_sequence" => 0, 
						"active_container" => "",
						"container_array" => array(),
						"current_positions_in_containers" => array(),
						"stack" => array() 
					);	

echo "<xmp>";
print_r($student_progress);
echo "</xmp>";

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
		$trail = "";
		set_active_container($active_container);
		$attempt_number = get_attempt_number($active_container, $trail);
	}
		
	if (isset($student_progress["current_positions_in_containers"][$active_container]))
	{	$container_levels = $student_progress["current_positions_in_containers"][$active_container];	
		$levels_arr = explode("|", $container_levels);	
		$curr_level = count($levels_arr) - 1;
	} else
	{	$curr_level = 0;
		$levels_arr[$curr_level] = $active_container."(".$attempt_number.")";
		create_container_progress_record($levels_arr, $curr_level);

		while (is_container($levels_arr, $curr_level))
		{	find_first_element_and_set_trail($levels_arr, $curr_level, $trail);
			create_container_progress_record($levels_arr, $curr_level);		
		}	
	}

	find_next_element($levels_arr, $curr_level-1); // Get logic from container element at $container[$num_levels-2] (SDL) (the question is at $num_levels-1)
	ask_item_and_get_response($levels_arr, $curr_level);

	$count++;
	echo "Item ".$count."<br>";
	if ($count == $max_ques) $exceptional_condition[$current_student_id] = "SESSION_END";
}

echo "<xmp>";
print_r($student_progress);
echo "</xmp>";

echo "Reached program end<br>";

///////////////////////// FUNCTIONS ////////////////////////////

function set_active_container($container_id)
{	$key_value_changes = array("active_container" => $container_id);
	if (is_pool_container($container_id)) $key_value_changes["is_pool_container"] = true; else $key_value_changes["is_pool_container"] = false;
	update_student_progress($student_progress, $container_id, 0, 0, $key_value_changes);
} 

function update_student_progress(&$student_progress, $container_id, $trail_num, $attempt_num, $key_value_changes)
{	list($container_key, $student_progress_key) = get_container_and_student_progress_keys($container_id);
	$student = &$student_progress['container_array'][$student_progress_key]['trails'][$trail_num]['attempts'][$attempt_num];

	foreach ($key_value_changes as $key => $value)
	{	switch ($key)
		{	case "current_learning_mode":
			case "is_pool_container": 
			case "correct_in_sequence": 
			case "wrong_in_sequence":
			case "active_container":	$student_progress[$key] = $value;
										break;

			case "latest_attempt":		$student_progress['container_array'][$student_progress_key]['latest_attempt'] = $value;
										break;

			case "failure_num":			$student_progress['container_array'][$student_progress_key]['trails'][$trail_num] = $value;
										break;

			default:					if (!isset($student[$key]))
										{	echo "Line 69: Invalid key ".$key."<br>";
											break;
										} 
										$student[$key] = $value;
										break;
		}
	}
}

function get_container_key($container_id)		// like TT005 or FRA003
{	global $container_array; 
	$container_key = -1;

	foreach ($container_array as $key => $value)
	{	if ($value["id"] == $container_id) 
		{	$container_key = $key;
			break;
		}	
	}

	return($container_key);
}

function student_progress_keys($container_id, $options)		// $container_id - TT005 or FRA003. Options array - $trail/$attempt_num, corresponding keys returned
{	global $student_progress; 
	$student_progress_key = -1;

	foreach ($student_progress["container_array"] as $key => $value)
	{	if ($value["id"] == $container_id) 
		{	$student_progress_key = $key;
			break;
		}	
	}

	return(array($student_progress_key));
}

function is_pool_container($container_id)
{	global $container_array, $student_progress; 
	list($container_key, $student_progress_key) = get_container_and_student_progress_keys($container_id);
	if ((isset($container_array[$container_key]["is_pool_container"])) && ($container_array[$container_key]["is_pool_container"])) 
		return true; 
	else return false;
}

function handle_exceptional_condition($exceptional_code)
{	switch ($exceptional_code)
	{	case "SESSION_END":		echo "End of session<br>";
								break;

	}
}

function get_attempt_number($active_container, $trail)
{	global $container_array, $student_progress; 
	list($container_key, $student_progress_key) = get_container_and_student_progress_keys($container_id);



}


/*********************/
/*

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
$this_trail = "";

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


*/
?>