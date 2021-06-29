<?php
include './mindspark_content.php';

$max_ques = 46;
$chosen_container = "TT050";

$position_array = array("levels_arr" => array(), "curr_level" => -1, "container_key" => -1, "container_id" => "", "is_container" => 0, "student_progress_key" => -1, "trail_str" => "", "trail_key" => -1, "attempt_num" => -1, "is_pool_container" => 0);
$student_progress = array("current_learning_mode" => "skill", "correct_in_sequence" => 0, "wrong_in_sequence" => 0, 
						"active_container" => "",
						"current_positions_in_containers" => array(),
						"container_array" => array(),
						"stack" => array() 
					);	

echo "<xmp>Line 14: ";
echo "position_array\n";
print_r($position_array);
echo "student_progress\n";
print_r($student_progress);
echo "</xmp><hr>";

$i = 0;

while (1)
{	while (($position_array["curr_level"] == -1) || ($position_array["is_container"] != -1))		// While item not available; i.e. till we have an item
	{	set_up_next_item();
	}
	update_current_position_in_containers_and_active_container();

	echo "<span style='color:red;'>Item ".($i+1).". ";
	ask_item_and_get_response();

$i++;
if ($i>$max_ques) break;	
}

echo "<xmp>Line 28: ";
echo "position_array\n";
print_r($position_array);
echo "student_progress\n";
print_r($student_progress);
echo "</xmp><hr>";

///////////////////////// FUNCTIONS ////////////////////////////

function set_up_next_item()
{	global $position_array, $student_progress, $container_array, $chosen_container;
	if ($position_array["curr_level"] == -1)
	{	$position_array["curr_level"] = 0;
		$attempt_number = get_last_attempt_num("", $chosen_container);
		$position_array["levels_arr"][$position_array["curr_level"]] = $chosen_container."(".($attempt_number+1).")";
		update_position_array();
		return;
	}	
	else
	{	$student = &$student_progress["container_array"][$position_array["student_progress_key"]]["trails"][$position_array["trail_key"]]["attempts"][$position_array["attempt_num"]];
//		echo "Line 56: ".str_replace("#", "$", "global #container_array; #action = ".$container_array[$position_array["container_key"]]["movement_logic_within_container"])."<br>";	
		eval(str_replace("#", "$", "global #container_array; #action = ".$container_array[$position_array["container_key"]]["movement_logic_within_container"]));	// Get Action Code
//		echo "Line 58: action for ".$position_array["container_id"]." = ".$action."<br>";
		
		take_action($action);
	}	
}

/* 
$position_array contains "levels_arr", "curr_level", "container_key", "container_id", "is_container", "student_progress_key", "trail_str", "trail_key", "attempt_num", "is_pool_container" and "pool_qno". Function update_position_array should be called whenever "levels_arr" or "curr_level" are changed and it will update all other keys. Updates happen based on changes to 'level_arr' and 'curr_level' (not other values). 

The function will also call add_container_or_trail_or_attempt_num_to_student_progress() which will add either a new container or a new trail for an existing container or a new attempt for an existing container's existing trail. It will also update "student_progress_key", "trail_key", "attempt_num" as needed in $position_array.
*/

function update_position_array()
{	global $position_array, $student_progress, $container_array;
	$position_array["container_id"] = "";
	$position_array["container_key"] = $position_array["is_container"] = $position_array["student_progress_key"] = $position_array["trail_key"] = $position_array["attempt_num"] = $position_array["is_pool_container"] = $position_array["trail_str"] = $position_array["pool_qno"] = -1;			// Initialise keys

	preg_match('/(.*)\((\d+)\)/', $position_array["levels_arr"][$position_array["curr_level"]], $matches);
	$position_array["container_id"] = isset($matches[1]) ? $matches[1] : $position_array["levels_arr"][$position_array["curr_level"]];
	$position_array["container_key"] = get_container_key($position_array["container_id"]);

	if ($position_array["container_key"] != -1) 
	{	$position_array["is_container"] = 1; 
		if (isset($container_array[$position_array["container_key"]]["is_pool_container"]))
		{	$position_array["is_pool_container"] = $container_array[$position_array["container_key"]]["is_pool_container"];
			$position_array["pool_qno"] = 0;
		}	
	} else $position_array["is_container"] = -1; 

	$temp_trail_str = ($position_array["trail_str"] == -1) ? "" : $position_array["trail_str"];
	for ($i=0; $i<$position_array["curr_level"]; $i++) $temp_trail_str .= $position_array["levels_arr"][$i]."|";
	$position_array["trail_str"] = substr($temp_trail_str,0,-1);

	foreach ($student_progress["container_array"] as $key => $value)
	{	if ($value["id"] == $position_array["container_id"]) 
		{	$position_array["student_progress_key"] = $key;
			break;
		}	
	}

	if ($position_array["student_progress_key"] == -1) 
	{	if ($position_array["is_container"] != -1)
			add_container_or_trail_or_attempt_num_to_student_progress();
	} else
	{	if (count($student_progress["container_array"][$position_array["student_progress_key"]]["trails"]) == 0) $position_array["trail_key"] = 0;
		else 
		{	foreach ($student_progress["container_array"][$position_array["student_progress_key"]]["trails"] as $key => $value)
			{	if ($value["trail_str"] == $position_array["trail_str"]) 
				{	$position_array["trail_key"] = $key;
					$position_array["attempt_num"] = (count($value["attempts"]) == 0) ? 1 : max(array_keys($value["attempts"]));
					break;
				}	
			}
		}	
	}
}

function add_container_or_trail_or_attempt_num_to_student_progress()		// Creates container entries in $student_progress. Changes $student_progress and $position_array
{	global $position_array, $container_array, $student_progress;

	$elements = $container_array[$position_array["container_key"]]["contents"];
	$total_elements = count($elements);
	$attempt_array = array(	"status" => "NOT_STARTED",							// Will switch to IN_PROGRESS once first question is answered
							"element_performance" => array("SUCCESS" => 0, "FAILURE" => 0, "COMPLETED" => 0, "IN_PROGRESS" => 0, "UNATTEMPTED" => $total_elements, "TOTAL" => $total_elements),
							"attempted_elements" => array(),
							"unattempted_elements"	=> $elements,
							"last_element_status"	=> "NOT_STARTED" 
						  );

	if ($position_array["student_progress_key"] == -1) 							// No entry exists in $student_progress for the container itself
	{	update_student_progress(array("id" => $position_array["container_id"], "trails" => array()));	// $position_array["student_progress_key"] will be updated
		update_student_progress(array("trail_str" => $position_array["trail_str"], "failure_num" => 0, "attempts" => array()));
		update_student_progress($attempt_array);
	}

	if ($position_array["trail_key"] == -1) 									// Container entry exists in $student_progress but this is a new trail (Top level containers have only 1 trail but a cluster, for example, can be in different TTs and be the current cluster in both)
	{	update_student_progress(array("trail_str" => $position_array["trail_str"], "failure_num" => 0, "attempts" => array()));
		update_position_array($position_array);									// As the previous statement updates attempt_num
		update_student_progress($attempt_array);
	}	

	if ($position_array["attempt_num"] == -1)									// Container and trail exist in $student_progress but this is a new attempt.
	{	update_student_progress($attempt_array);
	}

	if ($position_array["is_pool_container"] == 1)
	{	update_student_progress(array("is_pool_container" => 1));
		$position_array["unattempted_pool_elements"] = $attempt_array["unattempted_elements"];
	}	
}

function update_student_progress($key_value_changes)
{	global $position_array, $student_progress;

	if (($position_array["student_progress_key"] == -1) && ($position_array["is_container"] != -1)) 							// If new container, add it.
	{	$student_progress["container_array"][] = $key_value_changes;
		$position_array["student_progress_key"] = max(array_keys($student_progress["container_array"]));
		$position_array["trail_key"] = 0;
		$position_array["attempt_num"] = 1;
		return;
	}

	if (isset($student_progress["container_array"][$position_array["student_progress_key"]]["trails"][$position_array["trail_key"]]["attempts"]))
	{	$student = &$student_progress["container_array"][$position_array["student_progress_key"]]["trails"][$position_array["trail_key"]]["attempts"][$position_array["attempt_num"]];

		if (!isset($student_progress["container_array"][$position_array["student_progress_key"]]["trails"][$position_array["trail_key"]]["attempts"][$position_array["attempt_num"]]))
		{	$student_progress["container_array"][$position_array["student_progress_key"]]["trails"][$position_array["trail_key"]]["attempts"][$position_array["attempt_num"]] = array();
		} 
	}

	foreach ($key_value_changes as $key => $value)
	{	switch ($key)
		{	case "current_learning_mode":
			case "is_pool_container": 
			case "correct_in_sequence": 
			case "wrong_in_sequence":
			case "active_container":
			case "current_positions_in_containers":	
			case "stack":				$student_progress[$key] = $value;
										break;

			case "id":					
			case "trails":				$student_progress["container_array"][$position_array["student_progress_key"]][$key] = $value;
										break;

			case "failure_num":
			case "trail_str":
			case "attempts":
										$student_progress["container_array"][$position_array["student_progress_key"]]["trails"][$position_array["trail_key"]][$key] = $value;
										break;
		}

		if (isset($student))
		{	switch ($key)
			{	case "status":
				case "element_performance": 
				case "attempted_elements": 
				case "unattempted_elements":
				case "last_element_status":	
										$student[$key] = $value;
										break;
			}							 
		}									
	}
}

function get_last_attempt_num($trail_str, $element_id)			// Has to get the last attempt number not of the element in $position_array but $element_id 
{	global $student_progress;
	
	if (get_container_key($element_id) == -1) return(0);

	$trail_key = -1;
	$student_progress_key = get_student_progress_key($element_id);
	if ($student_progress_key == -1) return(0);

	foreach($student_progress["container_array"][$student_progress_key]["trails"] as $key => $trail_array) 
	{	if ($trail_array["trail_str"] != $trail_str) continue;
		$trail_key = $key;
		break;
	}

	if ($trail_key == -1) return(0);
	$last_attempt_num = max(array_keys($trail_array["attempts"]));
	return ($last_attempt_num);
} 

function get_student_progress_key($element_id)					// Function that returns student_progress_key based on $element_id NOT $position_array
{	global $student_progress;

	$student_progress_key = -1;
	foreach($student_progress["container_array"] as $key => $value) if ($value["id"] == $element_id) $student_progress_key = $key;
	return($student_progress_key);
}

function get_container_key($container_id)						// like TT005 or FRA003
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

function take_action($action)
{	global $position_array, $container_array, $student_progress;

	$student = &$student_progress["container_array"][$position_array["student_progress_key"]]["trails"][$position_array["trail_key"]]["attempts"][$position_array["attempt_num"]];

	switch ($action)
	{
		case "END":					// END means 'go to parent and find next child' which is same as 'find sibling of element currently pointed to'
									$temp_container_id = $position_array["container_id"];			// Update details for current item and result...
									$temp_status = $student["status"];
									$position_array["curr_level"]--;								// ...but changes must be made in the parent's status
									update_position_array();
									update_student_progress_container_parameters($temp_container_id, $temp_status);
									set_up_next_item();
									break;

		case "NEXT_IN_SEQUENCE":	// NEXT_IN_SEQUENCE means next child (using 'MOVEMENT_WITHIN_CONTAINER') Use case: Next SDL after one is failed (or suceeded)
									if (count($student["unattempted_elements"]) == 0)
									{	take_action("END");
										break;
									}	
									else $min_key = min(array_keys($student["unattempted_elements"]));
									$next_element_id = $student["unattempted_elements"][$min_key];		// But not removing from unattempted_elements yet
									$position_array["curr_level"]++;
									if (get_container_key($next_element_id) != -1)						// meaning this IS a container
									{	$trail_str = $position_array["trail_str"]."|".$position_array["levels_arr"][$position_array["curr_level"]-1];
										$last_attempt_num = get_last_attempt_num($trail_str, $next_element_id);
										$position_array["levels_arr"][$position_array["curr_level"]] = $next_element_id."(".($last_attempt_num+1).")";
									} else $position_array["levels_arr"][$position_array["curr_level"]] = $next_element_id;		// If it is just an item

									update_position_array($position_array);
									break;

		case "RANDOM_FROM_UNATTEMPTED":	// means pick next child at random Use case: Question answered wrongly gets next q in same SDL
									if (count($student["unattempted_elements"]) == 0)
									{	take_action("END");
										break;
									}	

									$next_key = array_rand($student["unattempted_elements"]);
									$next_element_id = $student["unattempted_elements"][$next_key];		// But not removing from unattempted_elements yet
									$position_array["curr_level"]++;
									if (get_container_key($next_element_id) != -1)						// meaning this IS a container
									{	$trail_str = $position_array["trail_str"]."|".$position_array["levels_arr"][$position_array["curr_level"]-1];
										$last_attempt_num = get_last_attempt_num($trail_str, $next_element_id);
										$position_array["levels_arr"][$position_array["curr_level"]] = $next_element_id."(".($last_attempt_num+1).")";
									} else $position_array["levels_arr"][$position_array["curr_level"]] = $next_element_id;		// If it is just an item

									update_position_array($position_array);
									break;
	}
}

function ask_item_and_get_response()
{	global $position_array, $container_array, $student_progress;
	// Dummy to get correct answer 75% of the time 
	$element_result = (rand(1,100) < 75) ? "SUCCESS" : "FAILURE";
	$response = array("result" => $element_result, "parameters" => array());		// Optional details like maybe a score, game paramters, misconceptions, etc. 
	// End of Dummy

	$this_item = $position_array["levels_arr"][$position_array["curr_level"]];
	echo "Asked item ".$this_item." in ".$position_array["levels_arr"][$position_array["curr_level"]-1]." and the result was ... ".$element_result."</span><br>";

	$position_array["curr_level"]--;
	update_position_array();

	update_student_progress_container_parameters($this_item, $element_result);

	return ($response);								// Considered directly updating $student_progress. But other updates will be needed. So let calling program do. 
}

function update_current_position_in_containers_and_active_container()
{	global $position_array, $student_progress;
	preg_match('/(.*)\((\d+)\)/', $position_array["levels_arr"][0], $matches);			// Get top level container
	$top_container_id = isset($matches[1]) ? $matches[1] : $position_array["levels_arr"][$position_array["curr_level"]];
	$change_array = array($top_container_id => $position_array["trail_str"]."|".$position_array["container_id"]);

	update_student_progress(array("current_positions_in_containers" => $change_array, "active_container" => $top_container_id));
}

function update_student_progress_container_parameters($element_completed, $element_result)
{	global $position_array, $container_array, $student_progress;

	$element_was_item = (!$position_array["is_container"]); 					// Check if item asked or completed was an item (else it was an SDL, cluster, etc)

	$student = &$student_progress["container_array"][$position_array["student_progress_key"]]["trails"][$position_array["trail_key"]]["attempts"][$position_array["attempt_num"]];
	$container_key = get_container_key($position_array["container_id"]);

	// Remove item from 'unattempted_elements' and add it to attempted_elements() with the result
	$this_key = array_search($element_completed, $student["unattempted_elements"]);
	unset($student["unattempted_elements"][$this_key]);
	$new_attempted = $student["attempted_elements"];
	$new_attempted[$element_completed] = $element_result;
	$array_to_write["attempted_elements"] = $new_attempted; 
	$array_to_write["unattempted_elements"] = $student["unattempted_elements"];

	// Update 'last_element_status' and 'element_performance'
	$array_to_write["last_element_status"] = $element_result;	
	$new_performance = $student["element_performance"];
	$new_performance["UNATTEMPTED"] = count($student["unattempted_elements"]);
	$new_performance["SUCCESS"] = $new_performance["FAILURE"] = $new_performance["COMPLETED"] = $new_performance["IN_PROGRESS"] = $new_performance["TOTAL"] = 0;
	foreach ($new_attempted as $this_element => $this_result)
	{	$new_performance["TOTAL"]++;
		$new_performance[$this_result]++;
	}	
	$new_performance["TOTAL"] += $new_performance["UNATTEMPTED"];
	$array_to_write["element_performance"] = $new_performance; 

	// Write the array because last_element_status has to be updated for status to get updated
	update_student_progress($array_to_write);

	// Update 'status'
//echo "Line 347: ".str_replace("#", "$", "global #container_array; #new_status = ".$container_array[$container_key]["status_criterion"]);	
	eval(str_replace("#", "$", "global #container_array; #new_status = ".$container_array[$container_key]["status_criterion"]));	// Updated (parent) container status
	$array_to_write["status"] = $new_status; 
//echo "Line 350: Status of ".$position_array["container_id"]." = ".$new_status." | ";
 
	// Update 'correct_in_sequence' and 'wrong_in_sequence' in $student_progress
	if ($element_was_item)
	{	if ($element_result == "SUCCESS")
		{	$array_to_write["correct_in_sequence"] = $student_progress["correct_in_sequence"] + 1;
			$array_to_write["wrong_in_sequence"] = 0;
		} elseif ($element_result == "FAILURE")
		{	$array_to_write["correct_in_sequence"] = 0;
			$array_to_write["wrong_in_sequence"] = $student_progress["wrong_in_sequence"] + 1;
		}	

		// Update 'current_positions_in_containers' in $student_progress
		$curr_pos = "";
		foreach ($position_array["levels_arr"] as $key => $value) $curr_pos .= $value."|";
		$array_to_write["current_positions_in_containers"] = substr($curr_pos, 0, -1);
	}

	// Write the array
	update_student_progress($array_to_write);

	$curr_level = $position_array["curr_level"];	// Save curr_level before we reduce it to update status, last_element_status & attempted/unattempted of parent containers

	if ($position_array["curr_level"] > 0)			// Parent container status will be set thru 1 recursive call
	{	$temp_status = $new_status;
		$temp_element = $position_array["container_id"];
		$position_array["curr_level"]--;
		update_position_array();
		update_student_progress_container_parameters($temp_element, $temp_status);
	}	
	$position_array["curr_level"] = $curr_level;
	update_position_array();
}



?>