<?php
include './mindspark_content.php';

echo "Usage: <span style='font-family:monospace;'>adaptive_logic.php?max_ques=15&logic=MS</span>&nbsp;&nbsp;|&nbsp;&nbsp;MS can be replaced by ASSET or DA.<hr>";

$max_ques = (isset($_REQUEST['max_ques'])) ? $_REQUEST['max_ques'] : 17;
$logic = (isset($_REQUEST['logic'])) ? $_REQUEST['logic'] : "MS";

$current_student_id = 100;
$position_array = array("levels_arr" => array(), "curr_level" => -1, "container_id" => "", "is_container" => 0, "student_progress_key" => -1, "trail_str" => "", "trail_key" => -1, "attempt_num" => -1, "is_pool_container" => 0);
$student_progress = array("current_learning_mode" => "skill", "correct_in_sequence" => 0, "wrong_in_sequence" => 0, 
						"active_container" => "",
						"current_positions_in_containers" => array(),
						"container_array" => array(),
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
	if (isset($student_progress["is_pool_container"]) && ($student_progress["is_pool_container"] == 1)) 		 			// Will not be true the first time for a pool container (as it has not yet been set) which is fine
	{	if (!get_next_pool_element($position_array))
		{	record_pool_container_data($position_array);
			break;
		}	
		continue;
	}
		
	if ($student_progress["current_learning_mode"] == "exposure") exposure_logic();
 
	// No active container means for example that no Teacher Topic is currently active
	if (!isset($student_progress["active_container"]) || ($student_progress["active_container"] == ""))
	{	echo "Line 41 logic = ".$logic."<br>";
		switch ($logic)
		{	case "ASSET":	$active_container = "ASSET_19C";
							break;

			case "DA":		$active_container = "DA_43449939887782021_2";
							break;

			default:		echo "<hr>(Temp) Max questions = ".$max_ques."<br>";
							echo "Choose a TT (TT050, TT051, TT052)...<br>...Assuming TT050 chosen<hr>";
							$active_container = "TT050";
		}

		$position_array['trail_str'] = "";		// trail_str will be "" for a teacher topic or assessment, something like "TT050(1)|FRA003(2)" for an SDL, etc. 

		if (isset($student_progress["current_positions_in_containers"][$active_container]))		// If this TT has a current position (i.e. is not complete) 
		{	$position_array['levels_arr'] = explode("|", $student_progress["current_positions_in_containers"][$active_container]);	
			$position_array['curr_level'] = count($position_array['levels_arr']) - 1;
			// Sample [levels_arr]: array([0] => 'TT050(1)', [1] => 'FRA003(1)', [2] => 'FRA003_SDL_1(2)', [3] => 9027 if qcode 9027 was last asked $curr_level = 3
			update_position_array($position_array);					// This would update all other values of $position_array based on $levels_arr and $curr_level 
		} else
		{	$position_array['curr_level'] = 0;
			$position_array['levels_arr'][$position_array['curr_level']] = $active_container."(1)";			// Attempt number will be 1 if no record in "current_positions_in_containers"
			update_position_array($position_array);
		}	
	}

	if ($position_array["is_pool_container"])
	{	echo "<hr>";
		create_container_progress_record($position_array);
		continue;
	}	

	while ($position_array['is_container'])
	{	create_container_progress_record($position_array);
		add_first_element($position_array);
	}
	update_current_position_in_containers_and_active_container($position_array);

	echo "<span style='color:red;'>Item ".($count+1).". ";
	ask_item_and_get_response($position_array);
	find_next_child($position_array); 

	$count++;
	if ($count == $max_ques) $exceptional_condition[$current_student_id] = "SESSION_END";
}

echo "<hr><xmp>FINAL";
print_r($student_progress);
print_r($position_array);
echo "</xmp>";

echo "Reached program end<br>";

///////////////////////// FUNCTIONS ////////////////////////////

function update_position_array(&$position_array)		// Should be called after any change to elements of $position_array so all elements can be updated. 
{	global $student_progress, $container_array; 		// Updates happen based on changes to 'level_arr' and 'curr_level' (not other values)
														// Also gets the appropriate keys ("student_progress_key", "trail_key" and "max_attempt_num" for any position
	$position_array['trail_str'] = "";
	$position_array["student_progress_key"] = $position_array["trail_key"] = $position_array["attempt_num"] = -1;		// Initialise some of the values

	preg_match('/(.*)\((\d+)\)/', $position_array['levels_arr'][$position_array['curr_level']], $matches);
	$position_array['container_id'] = isset($matches[1]) ? $matches[1] : $position_array['levels_arr'][$position_array['curr_level']];
	$container_key = get_container_key($position_array['container_id']);
	
	$position_array['is_container'] = 0;
	if ($container_key != -1) 
	{	$position_array['is_container'] = 1; 
		if (isset($container_array[$container_key]['is_pool_container']))
		{	$position_array['is_pool_container'] = $container_array[$container_key]['is_pool_container'];
			$position_array['pool_qno'] = 0;
		}	
	}
	for ($i=0; $i<$position_array['curr_level']; $i++) $position_array['trail_str'] .= $position_array['levels_arr'][$i]."|";
	$position_array['trail_str'] = substr($position_array['trail_str'],0,-1);

	foreach ($student_progress["container_array"] as $key => $value)
	{	if ($value["id"] == $position_array['container_id']) 
		{	$position_array['student_progress_key'] = $key;
			break;
		}	
	}

	if ($position_array['student_progress_key'] != -1)
	{	if (count($student_progress["container_array"][$position_array['student_progress_key']]['trails']) == 0) $position_array['trail_key'] = 0;
		else 
		{	foreach ($student_progress["container_array"][$position_array['student_progress_key']]['trails'] as $key => $value)
			{	if ($value["trail_str"] == $position_array['trail_str']) 
				{	$position_array["trail_key"] = $key;
					$position_array["attempt_num"] = (count($value["attempts"]) == 0) ? 1 : max(array_keys($value["attempts"]));
					break;
				}	
			}
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

function create_container_progress_record(&$position_array)		// Creates container entries in $student_progress. Changes $student_progress and $position_array
{	global $container_array, $student_progress;

	$container_key = get_container_key($position_array['container_id']);		// Read in the element details from $container_array
	$elements = $container_array[$container_key]['contents'];
	$total_elements = count($elements);
	$attempt_array = array(	"status" => "NOT STARTED",							// Will switch to IN_PROGRESS once first question is answered
							"element_performance" => array("SUCCESS" => 0, "FAILURE" => 0, "COMPLETED" => 0, "IN_PROGRESS" => 0, "UNATTEMPTED" => $total_elements, "TOTAL" => $total_elements),
							"attempted_elements" => array(),
							"unattempted_elements"	=> $elements,
							"last_element_status"	=> "NOT_STARTED" 
						  );

	if ($position_array['student_progress_key'] == -1) 							// No entry exists in $student_progress for the container itself
	{	update_student_progress($position_array, array("id" => $position_array['container_id'], "trails" => array()));
		update_position_array($position_array);									// As the previous statement will cause a "student_progress_key to be set"
		update_student_progress($position_array, array("trail_str" => $position_array['trail_str'], "failure_num" => 0, "attempts" => array()));
		update_position_array($position_array);									// As the previous statement updates attempt_num"
		update_student_progress($position_array, $attempt_array);
	}

	if ($position_array['trail_key'] == -1) 									// Container entry exists in $student_progress but this is a new trail (Top level containers have only 1 trail but a cluster, for example, can be in different TTs and be the current cluster in both)
	{	update_student_progress($position_array, array("trail_str" => $position_array['trail_str'], "failure_num" => 0, "attempts" => array()));
		update_position_array($position_array);
		update_student_progress($position_array, $attempt_array);
	}	

	if ($position_array['attempt_num'] == -1)									// Container and trail exist in $student_progress but this is a new attempt.
	{	update_student_progress($position_array, $attempt_array);
	}

	if ($position_array['is_pool_container'] == 1)
	{	update_student_progress($position_array, array("is_pool_container" => 1));
		$position_array['unattempted_pool_elements'] = $attempt_array["unattempted_elements"];
	}	
}

function update_student_progress($position_array, $key_value_changes)
{	global $student_progress;

	if (($position_array['student_progress_key'] == -1) && ($position_array['is_container'])) 							// If new container, add it.
	{	$student_progress['container_array'][] = $key_value_changes;
		return;
	}

	if (isset($student_progress['container_array'][$position_array['student_progress_key']]['trails'][$position_array['trail_key']]['attempts']))
	{	$student = &$student_progress['container_array'][$position_array['student_progress_key']]['trails'][$position_array['trail_key']]['attempts'][$position_array['attempt_num']];

		if (!isset($student_progress['container_array'][$position_array['student_progress_key']]['trails'][$position_array['trail_key']]['attempts'][$position_array['attempt_num']]))
		{	$student_progress['container_array'][$position_array['student_progress_key']]['trails'][$position_array['trail_key']]['attempts'][$position_array['attempt_num']] = array();
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
			case "trails":				$student_progress['container_array'][$position_array['student_progress_key']][$key] = $value;
										break;

			case "failure_num":
			case "trail_str":
			case "attempts":
										$student_progress['container_array'][$position_array['student_progress_key']]['trails'][$position_array['trail_key']][$key] = $value;
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

function add_first_element(&$position_array)
{	global $container_array;

	$container_key = get_container_key($position_array['container_id']);
	$action = $container_array[$container_key]["start_with"];
	take_action($position_array, $action);
}

function take_action(&$position_array, $action)
{	global $container_array, $student_progress;

	$position_array['trail_str'] = "";
	preg_match('/(.*)\((\d+)\)/', $position_array['levels_arr'][$position_array['curr_level']], $matches);
	$position_array['container_id'] = isset($matches[1]) ? $matches[1] : $position_array['levels_arr'][$position_array['curr_level']];
	$container_key = get_container_key($position_array['container_id']);

	for ($i=0; $i<$position_array['curr_level']; $i++) $position_array['trail_str'] .= $position_array['levels_arr'][$i]."|";
	$position_array['trail_str'] = substr($position_array['trail_str'],0,-1);
	$student = &$student_progress['container_array'][$position_array['student_progress_key']]['trails'][$position_array['trail_key']]['attempts'][$position_array['attempt_num']];

	switch ($action)
	{	case "FIRST_ELEMENT":		$content_array = $container_array[$container_key]["contents"];		// Use case: Get first element of a container
									$min_key = min(array_keys($content_array));
									$first_element_id = $content_array[$min_key];
									$trail_str = $position_array["trail_str"]."|".$position_array["levels_arr"][$position_array["curr_level"]];
									$last_attempt_num = get_last_attempt_num($trail_str, $first_element_id);

									$position_array['curr_level']++;
									$position_array['levels_arr'][$position_array['curr_level']] = $first_element_id."(".(($last_attempt_num == -1) ? 1 : $last_attempt_num+1).")";
									update_position_array($position_array);

									break;

		case "RANDOM_FROM_UNATTEMPTED":																	// Use case: Question answered wrongly gets next q in same SDL
									$next_key = array_rand($student['unattempted_elements']);
									if ($next_key === false)
									{	$action = "END";
										take_action($position_array, $action);
									}	
									$next_val = $student['unattempted_elements'][$next_key];	// But not removing from unattempted_elements till actually asked
									$position_array['curr_level']++;
									$position_array['levels_arr'][$position_array['curr_level']] = $next_val;
									update_position_array($position_array);		
									break;

		case "END":									// END means 'go to parent and find next child' which is same as 'find sibling of element currently pointed to'
									update_student_progress_container_parameters($position_array, $position_array["container_id"], $student['status']);
									find_next_child($position_array);
									break;

		case "NEXT_IN_SEQUENCE":	
									$min_key = min(array_keys($student['unattempted_elements']));		// Use case: Next SDL after one is failed (or suceeded)
									if ($min_key === false)
									{	$position_array['curr_level']--;
										update_position_array($position_array);	
										take_action($position_array, "END");
										break;
									}	
									$next_element_id = $student['unattempted_elements'][$min_key];		// But not removing from unattempted_elements yet
									if (get_container_key($next_element_id) != -1)							// meaning this IS a container
									{	create_container_progress_record($position_array);			// Create a new container_array under student_progress
										$trail_str = $position_array["trail_str"]."|".$position_array["levels_arr"][$position_array["curr_level"]];
										$last_attempt_num = get_last_attempt_num($trail_str, $next_element_id);
										$position_array['curr_level']++;
										$position_array['levels_arr'][$position_array['curr_level']] = $next_element_id."(".(($last_attempt_num == -1) ? 1 : $last_attempt_num+1).")";
									} else $position_array['levels_arr'][$position_array['curr_level']+1] = $next_element_id;		// If it is just an item
									update_position_array($position_array);
									break;
	}
}

function get_last_attempt_num($trail_str, $element_id)			// Has to get the last attempt number not of the element in $position_array but $element_id 
{	global $student_progress;
	
	$trail_key = -1;
	$student_progress_key = get_student_progress_key($element_id);
	if ($student_progress_key == -1) return(-1);

	foreach($student_progress['container_array'][$student_progress_key]['trails'] as $key => $trail_array) 
	{	if ($trail_array['trail_str'] != $trail_str) continue;
		$trail_key = $key;
		break;
	}

	if ($trail_key == -1) return(-1);

	$last_attempt_num = max(array_keys($trail_array['attempts']));

	return ($last_attempt_num);
} 

function get_student_progress_key($element_id)					// Function that returns student_progress_key based on $element_id NOT $position_array
{	global $student_progress;

	$student_progress_key = -1;
	foreach($student_progress["container_array"] as $key => $value) if ($value["id"] == $element_id) $student_progress_key = $key;
	return($student_progress_key);
}

function find_next_child(&$position_array)					// Finds sibling of element currently pointed to. Will temporarily do curr_level-- and then restore it
{	global $container_array, $student_progress;

	$i = $position_array['curr_level']+1;
	while (isset($position_array['levels_arr'][$i]))
	{	unset($position_array['levels_arr'][$i]); 	// Use case: Question answered correctly ends SDL
		$i++;
	}

	$container_key = get_container_key($position_array['container_id']);
	$student = &$student_progress['container_array'][$position_array['student_progress_key']]['trails'][$position_array['trail_key']]['attempts'][$position_array['attempt_num']];

	eval(str_replace("#", "$", "global #container_array; #action = ".$container_array[$container_key]["movement_logic_within_container"]));	// Get Action Code
echo "action = ".$action."<br>";

	take_action($position_array, $action);
}

function update_current_position_in_containers_and_active_container($position_array)
{	global $student_progress;
	preg_match('/(.*)\((\d+)\)/', $position_array['levels_arr'][0], $matches);			// Get top level container
	$top_container_id = isset($matches[1]) ? $matches[1] : $position_array['levels_arr'][$position_array['curr_level']];

	$change_array = array($top_container_id => $position_array['trail_str']."|".$position_array['container_id']);
	update_student_progress($position_array, array("current_positions_in_containers" => $change_array, "active_container" => $top_container_id));
}

function set_active_container(&$position_array)
{	global $student_progress;
	$key_value_changes = array("active_container" => $position_array['container_id']);
	if (is_pool_container($position_array['container_id'])) $key_value_changes["is_pool_container"] = true; else unset($key_value_changes["is_pool_container"]);
	update_student_progress($position_array, $key_value_changes);
} 

function ask_item_and_get_response(&$position_array)
{	global $container_array, $student_progress;

	// Dummy to get correct answer 75% of the time 
	$element_result = (rand(1,100) < 75) ? "SUCCESS" : "FAILURE";
	$response = array(	"result" => $element_result,				
					"parameters" => array()		// Optional details like maybe a score, game paramters, misconceptions, etc. 
			);
	// End of Dummy

	$this_item = $position_array['levels_arr'][$position_array['curr_level']];
echo "Asked item ".$this_item." in ".$position_array['levels_arr'][$position_array['curr_level']-1]." and the result was ... ".$element_result."</span><br>";

	update_student_progress_container_parameters($position_array, $this_item, $element_result);

	return ($response);								// Considered directly updating $student_progress. But other updates will be needed. So let calling program do. 
}

function update_student_progress_container_parameters(&$position_array, $element_completed, $element_result)
{	global $container_array, $student_progress;

	$element_was_item = (!$position_array["is_container"]); 					// Check if item asked or completed was an item (else it was an SDL, cluster, etc)

	$position_array["curr_level"]--;											// Set parent as container whose values are to be set. 
	update_position_array($position_array);
	$student = &$student_progress['container_array'][$position_array['student_progress_key']]['trails'][$position_array['trail_key']]['attempts'][$position_array['attempt_num']];
	$container_key = get_container_key($position_array['container_id']);

	// Remove item from 'unattempted_elements' and add it to attempted_elements() with the result
	$this_key = array_search($element_completed, $student['unattempted_elements']);
	unset($student['unattempted_elements'][$this_key]);
	$new_attempted = $student['attempted_elements'];
	$new_attempted[$element_completed] = $element_result;
	$array_to_write['attempted_elements'] = $new_attempted; 
	$array_to_write['unattempted_elements'] = $student['unattempted_elements'];

	// Update 'last_element_status' and 'element_performance'
	$array_to_write['last_element_status'] = $element_result;	
	$new_performance = $student['element_performance'];
	$new_performance['UNATTEMPTED']--;
	$new_performance[$element_result]++;
	$array_to_write['element_performance'] = $new_performance; 

	// Write the array because last_element_status has to be updated for status to get updated
	update_student_progress($position_array, $array_to_write);

	// Update 'status'
	eval(str_replace("#", "$", "global #container_array; #new_status = ".$container_array[$container_key]["status_criterion"]));	// Updated (parent) container status
	$array_to_write['status'] = $new_status; 
echo "Status of ".$position_array["container_id"]." = ".$new_status." | ";
 
	// Update 'correct_in_sequence' and 'wrong_in_sequence' in $student_progress
	if ($element_was_item)
	{	if ($element_result == "SUCCESS")
		{	$array_to_write['correct_in_sequence'] = $student_progress['correct_in_sequence'] + 1;
			$array_to_write['wrong_in_sequence'] = 0;
		} elseif ($element_result == "FAILURE")
		{	$array_to_write['correct_in_sequence'] = 0;
			$array_to_write['wrong_in_sequence'] = $student_progress['wrong_in_sequence'] + 1;
		}	

		// Update 'current_positions_in_containers' in $student_progress
		$curr_pos = "";
		foreach ($position_array['levels_arr'] as $key => $value) $curr_pos .= $value."|";
		$array_to_write['current_positions_in_containers'] = substr($curr_pos, 0, -1);
	}

	// Write the array
	update_student_progress($position_array, $array_to_write);
}

function is_pool_container($position_array)
{	global $container_array, $student_progress;	$container_key = get_container_key($position_array['container_id']);
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

function get_attempt_number($position_array)
{	global $student_progress; 
	return (($position_array['attempt_num'] == -1) ? 1 : $position_array['attempt_num']+1);				// if unattempted, return 1, else last attempt number + 1
}

function get_next_pool_element(&$position_array)
{	$a = rand(1,100);
	$element_result = ($a < 50) ? "SUCCESS" : (($a < 90) ? "FAILURE" : "SKIPPED");

	$i = $position_array["pool_qno"];
	if (isset($position_array["unattempted_pool_elements"][$i]))
	{	echo "<span style='color:red'>".($i+1).". Asked item ".$position_array["unattempted_pool_elements"][$i]." and the result was... ".$element_result."</span><br>";
		$position_array["attempted_pool_elements"][] = array($position_array["unattempted_pool_elements"][$i] => $element_result);
		unset($position_array["unattempted_pool_elements"][$i]);
		$position_array["pool_qno"] = ++$i;
		return(true);
	}
	else return(false);
}

function record_pool_container_data(&$position_array)
{	update_student_progress($position_array, array("attempted_elements" => $position_array["attempted_pool_elements"], "unattempted_elements" => array()));
	unset($position_array["attempted_pool_elements"]);
	unset($position_array["unattempted_pool_elements"]);
	unset($position_array["pool_qno"]);
	unset($position_array["is_pool_container"]);
}

?>