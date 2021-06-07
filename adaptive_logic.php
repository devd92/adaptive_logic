<?php
include './mindspark_content.php';

$max_ques = 10;				// Dummy to simulate, say, end of session
$current_student_id = 100;
$container_level = array();
$student_progress = array("current_learning_mode" => "skill", "is_pool_collection" => 0, "correct_in_sequence" => 0, "wrong_in_sequence" => 0, 
						"active_container" => "",
						"collection_array" => array(
							0 =>	array(	
									"id" 			=> "TT050",
									"attempt_num" 	=> 1,
									"trail"			=> "",					// The trail is used to locate the correct collection (TT) and attempt number through 											// which this element was activated since a cluster can be in multiple TT's, etc.
								   	"status" 		=> "IN_PROGRESS",		// NOT_STARTED, IN_PROGRESS, COMPLETED, FAILURE, SUCCESSFUL
								   	"elements"		=> array("FRA003" => "SUCCESSFUL", "FRA004" => "IN_PROGRESS"),
								   	"last_item_status"	=> "IN_PROGRESS"
								   	),

							1 =>	array(
			   						"id"			=> "FRA003",
			   						"attempt_num"	=> 1,
			   						"trail"			=> "TT050(1)",			// Meaning reached in the first attempt of TT050
			   						"status"		=> "SUCCESS",
			   						"elements"		=> array("FRA003_SDL_1" => "SUCCESSFUL", "FRA003_SDL_2" => "IN_PROGRESS"),
			   						"last_item_status"	=> "IN_PROGRESS"
			   					),

							2 =>	array(
					   				"id"			=> "FRA003_SDL_1",
			   						"attempt_num"	=> 1,
			   						"trail"			=> "TT050(1)|FRA003(1)",
			   						"status"		=> "SUCCESS",
			   						"items"			=> array("7002" => "FAILURE", "7037" => "SUCCESS"),
			   						"last_item_status"	=> "SUCCESS"
			   					),

							3 =>	array(
					   				"id"			=> "FRA003_SDL_2",
			   						"attempt_num"	=> 1,
			   						"trail"			=> "TT050(1)|FRA003(1)",
			   						"status"		=> "IN_PROGRESS",
			   						"items"			=> array("7028" => "FAILURE", "7045" => "FAILURE"),
			   						"last_item_status"	=> "FAILURE"
			   					),							
							),
						"collection_index" => array("TT050" => "0", "FRA003" => "2, 12", "FRA003_SDL_1" => "3, 11"),
//						"current_positions_in_containers" => array(),
						"current_positions_in_containers" => array("TT050" => "TT050(1)|FRA003(1)|FRA003_SDL_2(1)|7045"),
						// For the above, earlier did "current_positions_in_containers" => array("TT050" => "FRA003", "FRA003" => "FRA003_SDL_3", "FRA003_SDL_3" => "7043"), but realised that would not work as a cluster could come in another TT also, so tried array("TT050" => array("FRA003" => array("FRA003_SDL_2" => "7045"))) before changing to the current
						// Also the item shown is the *item just asked / already asked* not the item *to be asked*
						"stack" => array() 

					);	

$count = 0;
while(1)
{	if (isset($exceptional_condition[$current_student_id])) 
	{	handle_exceptional_condition($exceptional_condition[$current_student_id]);
		break;
	}	
	if ($student_progress["is_pool_collection"] && (count($student_progress["pool_items"]) > 0)) get_next_pool_element();
	if ($student_progress["current_learning_mode"] == "exposure") exposure_logic();

	if (!isset($student_progress["active_container"]) || ($student_progress["active_container"] == ""))
	{	echo "Choose a TT (TT050, TT051, TT052)...<br>...Assuming TT050 chosen<br>";
		$active_container = "TT050";
		set_active_container($active_container, $student_progress);

		$level = 0;

		if (isset($student_progress["current_positions_in_containers"][$active_container]))		// Check if there is already a prior position in this container
		{	$container_levels = $student_progress["current_positions_in_containers"][$active_container];	// If so, get the full array till the final item in $container_level

			$response_array = get_next_item($container_levels);		// Return updated $container_level array and (next item OR 'ACTIVE_CONTAINER_COMPLETE' (TT complete))
		} 
		else $response_array = ask_first_item($active_container);		// First time this active container (TT) being started so slightly different function for that

		// Update $student_progress["current_positions_in_containers"]
		// Ask the question
		// Get response
		// Update records accordingly
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
	echo $count."<br>";
	if ($count == $max_ques) $exceptional_condition[$current_student_id] = "SESSION_END";
}

function get_next_item($container_levels)
{	$levels_arr = explode("|", $container_levels);	// Get logic from collection element at $container[$num_levels-2] (SDL) ($container[$num_levels-1] is the question)
	$num_level = count($levels_arr);
	$student_progress_key = get_student_progress_key($levels_arr[$num_level-2]);	// like FRA003_SDL_2(2)
	echo "Line 112 student_progress_key: ".$student_progress_key."<br>";
}

function get_student_progress_key($container_id_with_attempt_num)		// like TT005(2)
{	global $student_progress;
	preg_match('/(.*)\((\d+)\)/', $container_id_with_attempt_num, $matches);
	$container_id = $matches[1];
	$attempt_num = $matches[2];
	foreach ($student_progress["collection_array"] as $key => $value)
	{	if (($value["id"] == $container_id) && ($value["attempt_num"] == $attempt_num)) 
			return($key);
	}
	return(-1);

//	return(substr($container_id_with_attempt_num, 0, strpos($container_id_with_attempt_num, "(")));

}
function set_active_container($container_id, &$student_progress)
{	$student_progress["active_container"] = $container_id; 
	$student_progress["is_pool_collection"] = is_pool_collection($container_id, $student_progress);
} 

function is_pool_collection($container_id, &$student_progress)
{	$key = get_container_key($container_id);
	if ($key == -1) return(-1); 
	if (isset($collection_array[$key]["is_pool_collection"])) $student_progress["is_pool_collection"] = 1; else unset($GLOBALS['student_progress']['is_pool_collection']);
}

function handle_exceptional_condition($exceptional_code)
{	switch ($exceptional_code)
	{	case "SESSION_END":		echo "End of session<br>";
								break;

	}
}

function check_student_response($item_id, $student_response)
{	// Processing depending on the item and correct response
	$response = array(	"result" => 1,				// 0, 1, 2 representing FAILURE, SUCCESS and COMPLETED respectively
						"parameters" => array()		// Optional details like maybe a score, game paramters, misconceptions, etc. 
				);
	return ($response);								// Considered directly updating $student_progress. But other updates will be needed. So let calling program do. 
}

function get_container_key($container_id)
{	global $collection_array;
	foreach ($collection_array as $key => $value)
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