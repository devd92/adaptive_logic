<?php
$container_types = array("Teacher Topic", "Cluster", "Timed Test");
$element_types = array("Game", "Question", "Challenge Question", "Remedial");
$learning_modes = array("exposure", "skill");
$exceptional_condition = array();
$CLUSTER_SUCCESS_PERcEnT = 80;

$container_array = array();

// So we have to define active_element.id, active_element.result, active_element.failure_number, active_element.remedial_cluster, active_element.remedial_element, SAME_ELEMENT, PREVIOUS_ELEMENT, NEXT_IN_SEQUENCE, is_last_element_completed(), exists(), call_element(), is_cluster_passed(), last_element_status() 


//Output for TT050
$container_array[] = array("type" => "Teacher Topic", // cluster, game, teacher topic, SDL
"id" => "TT050",
"name" =>"Fractions - basic concepts, equivalence and comparison" ,
"contents" => array("FRA003","FRA004","FRA005","FRA006","FRA007","FRA008","FRA009","FRA010","FRA011","FRA012","FRA013","FRA014","FRA018","FRA032","FRA035","REA016","REA036","REA062"),
"status_criterion" => "", // if last_element completed, mark as COMPLETED, else IN_PROGRESS
"start_with" => "FIRST_ELEMENT", // FIRST_ELEMENT, RANDOM_FROM_UNATTEMPTED
"movement_logic_within_container" => "if (active_element.result == "success") NEXT_IN_SEQUENCE; if ((active_element.result == 'failure') && (active_element.failure_number == 1)) SAME_ELEMENT; if ((active_element.result == 'failure') && (active_element.failure_number == 2)) PREVIOUS_ELEMENT; if ((active_element.result == 'failure') && (active_element.failure_number == 3) && (exists(active_element.remedial_cluster)) call_element(active_element.remedial_cluster); if ((active_element.result == 'failure') && (active_element.failure_number == 4) && (exists(active_element.remedial_element)) call_element(active_element.remedial_element);" // "USER_SELECTION" | (NEXT_IN_SEQUENCE | RANDOM_FROM_UNATTEMPTED | RANDOM_WITH_REPEAT | USER_SELECTION)


//Now the clusters
$container_array[] = array("type" => "cluster", "id" => "FRA003",
"name" => "Working with unit fractions",
"contents" => array("FRA003_1.0","FRA003_2.0","FRA003_3.0","FRA003_4.0","FRA003_5.0","FRA003_6.0","FRA003_7.0","FRA003_8.0","FRA003_9.0","FRA003_10.0","FRA003_11.0","FRA003_12.0","FRA003_13.0","FRA003_14.0","FRA003_15.0","FRA003_16.0"),
"remedial_action1" => "RFRA001",
"remedial_action2" => "",
"status_criterion" => "(#student['element_performance']['FAILURE'] / #student['element_performance']['TOTAL'] > (1 - (#container_array[#container_key]['success_percent']))) ? 'FAILURE' : ((count(#student['unattempted_elements'])==0) ? 'SUCCESS' : 'IN_PROGRESS');", "start_with" => "FIRST_ELEMENT",
"success_percent" => 0.8,
"movement_logic_within_container" => "'NEXT_IN_SEQUENCE';" ); // NEXT_IN_SEQUENCE implies NEXT sibling

$container_array[] = array("type" => "cluster", "id" => "FRA004",
"name" => "Understanding fractions as part of a collection",
"contents" => array("FRA004_1.0","FRA004_2.0","FRA004_3.0","FRA004_4.0","FRA004_5.0","FRA004_6.0","FRA004_7.0","FRA004_8.0","FRA004_9.0","FRA004_10.0","FRA004_11.0"),
"remedial_action1" => "RFRA001",
"remedial_action2" => "",
"status_criterion" => "(#student['element_performance']['FAILURE'] / #student['element_performance']['TOTAL'] > (1 - (#container_array[#container_key]['success_percent']))) ? 'FAILURE' : ((count(#student['unattempted_elements'])==0) ? 'SUCCESS' : 'IN_PROGRESS');", "start_with" => "FIRST_ELEMENT",
"success_percent" => 0.8,
"movement_logic_within_container" => "'NEXT_IN_SEQUENCE';" );

$container_array[] = array("type" => "cluster", "id" => "FRA005",
"name" => "Problems based on basic fraction concepts",
"contents" => array("FRA005_1.0","FRA005_1.1","FRA005_2.0","FRA005_3.0","FRA005_4.0","FRA005_5.0","FRA005_6.0","FRA005_7.0","FRA005_8.0","FRA005_9.0","FRA005_10.0","FRA005_11.0","FRA005_11.5","FRA005_12.0"),
"remedial_action1" => "RFRA001",
"remedial_action2" => "",
"status_criterion" => "(#student['element_performance']['FAILURE'] / #student['element_performance']['TOTAL'] > (1 - (#container_array[#container_key]['success_percent']))) ? 'FAILURE' : ((count(#student['unattempted_elements'])==0) ? 'SUCCESS' : 'IN_PROGRESS');", "start_with" => "FIRST_ELEMENT",
"success_percent" => 0.8,
"movement_logic_within_container" => "'NEXT_IN_SEQUENCE';" );

$container_array[] = array("type" => "cluster", "id" => "FRA006",
"name" => "Understanding mixed numbers",
"contents" => array("FRA006_1.0","FRA006_2.0","FRA006_2.5","FRA006_3.0","FRA006_4.0","FRA006_5.0","FRA006_6.0","FRA006_6.1","FRA006_7.0","FRA006_8.0","FRA006_9.0","FRA006_10.0","FRA006_11.0","FRA006_12.0","FRA006_13.0","FRA006_14.0"),
"remedial_action1" => "RFRA001",
"remedial_action2" => "",
"status_criterion" => "(#student['element_performance']['FAILURE'] / #student['element_performance']['TOTAL'] > (1 - (#container_array[#container_key]['success_percent']))) ? 'FAILURE' : ((count(#student['unattempted_elements'])==0) ? 'SUCCESS' : 'IN_PROGRESS');", "start_with" => "FIRST_ELEMENT",
"success_percent" => 0.8,
"movement_logic_within_container" => "'NEXT_IN_SEQUENCE';" );

$container_array[] = array("type" => "cluster", "id" => "FRA007",
"name" => "Understanding improper fractions",
"contents" => array("FRA007_0.5","FRA007_1.0","FRA007_2.0","FRA007_3.0","FRA007_4.0","FRA007_6.0","FRA007_6.5","FRA007_6.7","FRA007_7.0","FRA007_8.0","FRA007_9.0","FRA007_10.0","FRA007_11.0","FRA007_12.0","FRA007_13.0","FRA007_14.0"),
"remedial_action1" => "RFRA001",
"remedial_action2" => "",
"status_criterion" => "(#student['element_performance']['FAILURE'] / #student['element_performance']['TOTAL'] > (1 - (#container_array[#container_key]['success_percent']))) ? 'FAILURE' : ((count(#student['unattempted_elements'])==0) ? 'SUCCESS' : 'IN_PROGRESS');", "start_with" => "FIRST_ELEMENT",
"success_percent" => 0.8,
"movement_logic_within_container" => "'NEXT_IN_SEQUENCE';" );

$container_array[] = array("type" => "cluster", "id" => "FRA008",
"name" => "Writing mixed numbers as improper fractions and vice versa",
"contents" => array("FRA008_1.0","FRA008_2.0","FRA008_3.0","FRA008_5.0","FRA008_6.0","FRA008_7.0","FRA008_10.0","FRA008_11.0","FRA008_12.0","FRA008_13.0","FRA008_14.0","FRA008_16.0","FRA008_17.0","FRA008_18.0","FRA008_19.0","FRA008_19.5","FRA008_20.0","FRA008_20.5"),
"remedial_action1" => "RFRA001",
"remedial_action2" => "",
"status_criterion" => "(#student['element_performance']['FAILURE'] / #student['element_performance']['TOTAL'] > (1 - (#container_array[#container_key]['success_percent']))) ? 'FAILURE' : ((count(#student['unattempted_elements'])==0) ? 'SUCCESS' : 'IN_PROGRESS');", "start_with" => "FIRST_ELEMENT",
"success_percent" => 0.8,
"movement_logic_within_container" => "'NEXT_IN_SEQUENCE';" );

$container_array[] = array("type" => "cluster", "id" => "FRA009",
"name" => "Introduction to addition and subtraction of fractions (proper and mixed fractions)",
"contents" => array("FRA009_1.0","FRA009_2.0","FRA009_3.0","FRA009_4.0","FRA009_5.0","FRA009_6.0","FRA009_7.0","FRA009_8.0","FRA009_9.0","FRA009_10.0","FRA009_11.0","FRA009_12.0","FRA009_13.0"),
"remedial_action1" => "RFRA001",
"remedial_action2" => "",
"status_criterion" => "(#student['element_performance']['FAILURE'] / #student['element_performance']['TOTAL'] > (1 - (#container_array[#container_key]['success_percent']))) ? 'FAILURE' : ((count(#student['unattempted_elements'])==0) ? 'SUCCESS' : 'IN_PROGRESS');", "start_with" => "FIRST_ELEMENT",
"success_percent" => 0.8,
"movement_logic_within_container" => "'NEXT_IN_SEQUENCE';" );

$container_array[] = array("type" => "cluster", "id" => "FRA010",
"name" => "Understanding equivalence of fractions",
"contents" => array("FRA010_1.0","FRA010_1.5","FRA010_2.0","FRA010_3.0","FRA010_4.0","FRA010_5.0","FRA010_6.0","FRA010_7.0","FRA010_8.0","FRA010_9.0","FRA010_10.0","FRA010_11.0","FRA010_12.0","FRA010_13.0"),
"remedial_action1" => "RFRA001",
"remedial_action2" => "",
"status_criterion" => "(#student['element_performance']['FAILURE'] / #student['element_performance']['TOTAL'] > (1 - (#container_array[#container_key]['success_percent']))) ? 'FAILURE' : ((count(#student['unattempted_elements'])==0) ? 'SUCCESS' : 'IN_PROGRESS');", "start_with" => "FIRST_ELEMENT",
"success_percent" => 0.8,
"movement_logic_within_container" => "'NEXT_IN_SEQUENCE';" );

$container_array[] = array("type" => "cluster", "id" => "FRA011",
"name" => "Finding equivalent fractions, and reducing fractions",
"contents" => array("FRA011_1.0","FRA011_2.0","FRA011_3.0","FRA011_4.0","FRA011_5.0","FRA011_6.0","FRA011_7.0","FRA011_8.0","FRA011_8.5","FRA011_8.7","FRA011_9.0","FRA011_10.0","FRA011_12.0","FRA011_13.0","FRA011_14.0"),
"remedial_action1" => "RFRA001",
"remedial_action2" => "",
"status_criterion" => "(#student['element_performance']['FAILURE'] / #student['element_performance']['TOTAL'] > (1 - (#container_array[#container_key]['success_percent']))) ? 'FAILURE' : ((count(#student['unattempted_elements'])==0) ? 'SUCCESS' : 'IN_PROGRESS');", "start_with" => "FIRST_ELEMENT",
"success_percent" => 0.8,
"movement_logic_within_container" => "'NEXT_IN_SEQUENCE';" );

$container_array[] = array("type" => "cluster", "id" => "FRA012",
"name" => "Understanding fractions on the number line",
"contents" => array("FRA012_1.0","FRA012_2.0","FRA012_3.0","FRA012_4.0","FRA012_5.0","FRA012_6.0","FRA012_7.0"),
"remedial_action1" => "RFRA001",
"remedial_action2" => "",
"status_criterion" => "(#student['element_performance']['FAILURE'] / #student['element_performance']['TOTAL'] > (1 - (#container_array[#container_key]['success_percent']))) ? 'FAILURE' : ((count(#student['unattempted_elements'])==0) ? 'SUCCESS' : 'IN_PROGRESS');", "start_with" => "FIRST_ELEMENT",
"success_percent" => 0.8,
"movement_logic_within_container" => "'NEXT_IN_SEQUENCE';" );

$container_array[] = array("type" => "cluster", "id" => "FRA013",
"name" => "Introduction to comparison of fractions",
"contents" => array("FRA013_1.0","FRA013_2.0","FRA013_3.0","FRA013_4.0","FRA013_5.0","FRA013_6.0","FRA013_7.0","FRA013_9.0","FRA013_9.1","FRA013_9.2","FRA013_10.0"),
"remedial_action1" => "RFRA001",
"remedial_action2" => "",
"status_criterion" => "(#student['element_performance']['FAILURE'] / #student['element_performance']['TOTAL'] > (1 - (#container_array[#container_key]['success_percent']))) ? 'FAILURE' : ((count(#student['unattempted_elements'])==0) ? 'SUCCESS' : 'IN_PROGRESS');", "start_with" => "FIRST_ELEMENT",
"success_percent" => 0.8,
"movement_logic_within_container" => "'NEXT_IN_SEQUENCE';" );

$container_array[] = array("type" => "cluster", "id" => "FRA014",
"name" => "Estimating the value of fractional numbers",
"contents" => array("FRA014_1.0","FRA014_2.0","FRA014_3.0","FRA014_4.0","FRA014_5.0","FRA014_6.0","FRA014_7.0","FRA014_8.0","FRA014_9.0","FRA014_10.0","FRA014_11.0","FRA014_13.0","FRA014_14.0","FRA014_15.0","FRA014_16.0"),
"remedial_action1" => "RFRA001",
"remedial_action2" => "",
"status_criterion" => "(#student['element_performance']['FAILURE'] / #student['element_performance']['TOTAL'] > (1 - (#container_array[#container_key]['success_percent']))) ? 'FAILURE' : ((count(#student['unattempted_elements'])==0) ? 'SUCCESS' : 'IN_PROGRESS');", "start_with" => "FIRST_ELEMENT",
"success_percent" => 0.8,
"movement_logic_within_container" => "'NEXT_IN_SEQUENCE';" );

$container_array[] = array("type" => "cluster", "id" => "FRA018",
"name" => "Fractions as a notation of division",
"contents" => array("FRA018_0.5","FRA018_0.8","FRA018_1.0","FRA018_2.0","FRA018_3.0","FRA018_6.5","FRA018_6.6","FRA018_6.8","FRA018_7.0"),
"remedial_action1" => "RFRA001",
"remedial_action2" => "",
"status_criterion" => "(#student['element_performance']['FAILURE'] / #student['element_performance']['TOTAL'] > (1 - (#container_array[#container_key]['success_percent']))) ? 'FAILURE' : ((count(#student['unattempted_elements'])==0) ? 'SUCCESS' : 'IN_PROGRESS');", "start_with" => "FIRST_ELEMENT",
"success_percent" => 0.8,
"movement_logic_within_container" => "'NEXT_IN_SEQUENCE';" );

$container_array[] = array("type" => "cluster", "id" => "FRA032",
"name" => "Express equivalent fractions with base 10 and base 100",
"contents" => array("FRA032_1.0","FRA032_2.0","FRA032_3.0","FRA032_4.0","FRA032_5.0","FRA032_6.0"),
"remedial_action1" => "RFRA001",
"remedial_action2" => "",
"status_criterion" => "(#student['element_performance']['FAILURE'] / #student['element_performance']['TOTAL'] > (1 - (#container_array[#container_key]['success_percent']))) ? 'FAILURE' : ((count(#student['unattempted_elements'])==0) ? 'SUCCESS' : 'IN_PROGRESS');", "start_with" => "FIRST_ELEMENT",
"success_percent" => 0.8,
"movement_logic_within_container" => "'NEXT_IN_SEQUENCE';" );

$container_array[] = array("type" => "cluster", "id" => "FRA035",
"name" => "Equal shares of identical wholes need not have the same shape",
"contents" => array("FRA035_2.0","FRA035_3.0","FRA035_4.0","FRA035_5.0","FRA035_6.0","FRA035_7.0","FRA035_8.0","FRA035_9.0"),
"remedial_action1" => "RFRA001",
"remedial_action2" => "",
"status_criterion" => "(#student['element_performance']['FAILURE'] / #student['element_performance']['TOTAL'] > (1 - (#container_array[#container_key]['success_percent']))) ? 'FAILURE' : ((count(#student['unattempted_elements'])==0) ? 'SUCCESS' : 'IN_PROGRESS');", "start_with" => "FIRST_ELEMENT",
"success_percent" => 0.8,
"movement_logic_within_container" => "'NEXT_IN_SEQUENCE';" );

$container_array[] = array("type" => "cluster", "id" => "REA016",
"name" => "Comparing fractions by finding common denominator",
"contents" => array("REA016_1.0","REA016_2.0","REA016_3.0","REA016_4.0","REA016_5.0","REA016_6.0","REA016_7.0","REA016_8.0","REA016_9.0","REA016_11.0","REA016_13.0","REA016_13.5","REA016_14.0","REA016_15.0"),
"remedial_action1" => "RFRA001",
"remedial_action2" => "",
"status_criterion" => "(#student['element_performance']['FAILURE'] / #student['element_performance']['TOTAL'] > (1 - (#container_array[#container_key]['success_percent']))) ? 'FAILURE' : ((count(#student['unattempted_elements'])==0) ? 'SUCCESS' : 'IN_PROGRESS');", "start_with" => "FIRST_ELEMENT",
"success_percent" => 0.8,
"movement_logic_within_container" => "'NEXT_IN_SEQUENCE';" );

$container_array[] = array("type" => "cluster", "id" => "REA036",
"name" => "Comparison of proper fractions by generating equivalent fractions on the number line",
"contents" => array("REA036_1.0","REA036_2.0","REA036_3.0","REA036_4.0","REA036_5.0","REA036_6.0","REA036_7.0","REA036_8.0","REA036_8.5","REA036_9.0"),
"remedial_action1" => "RFRA001",
"remedial_action2" => "",
"status_criterion" => "(#student['element_performance']['FAILURE'] / #student['element_performance']['TOTAL'] > (1 - (#container_array[#container_key]['success_percent']))) ? 'FAILURE' : ((count(#student['unattempted_elements'])==0) ? 'SUCCESS' : 'IN_PROGRESS');", "start_with" => "FIRST_ELEMENT",
"success_percent" => 0.8,
"movement_logic_within_container" => "'NEXT_IN_SEQUENCE';" );

$container_array[] = array("type" => "cluster", "id" => "REA062",
"name" => "Comparison of mixed fractions and improper fractions",
"contents" => array("REA062_8.5","REA062_10.0","REA062_12.0","REA062_13.0","REA062_14.0","REA062_15.0","REA062_16.0","REA062_16.2","REA062_16.4","REA062_16.6","REA062_17.0"),
"remedial_action1" => "RFRA001",
"remedial_action2" => "",
"status_criterion" => "(#student['element_performance']['FAILURE'] / #student['element_performance']['TOTAL'] > (1 - (#container_array[#container_key]['success_percent']))) ? 'FAILURE' : ((count(#student['unattempted_elements'])==0) ? 'SUCCESS' : 'IN_PROGRESS');", "start_with" => "FIRST_ELEMENT",
"success_percent" => 0.8,
"movement_logic_within_container" => "'NEXT_IN_SEQUENCE';" );


//Now the SDLs
$container_array[] = array("type" => "SDL",
"id" => "FRA003_1.0",
"name" => "FRA003_1.0",
"contents" => array(7002,7037,7040),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA003_10.0",
"name" => "FRA003_10.0",
"contents" => array(7096,54163,54164,7053,7094),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA003_11.0",
"name" => "FRA003_11.0",
"contents" => array(7029,7098,7101,54165,54166),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA003_12.0",
"name" => "FRA003_12.0",
"contents" => array(7031,7104,7105,54167,54168),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA003_13.0",
"name" => "FRA003_13.0",
"contents" => array(7059,7106,7107),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA003_14.0",
"name" => "FRA003_14.0",
"contents" => array(7060,7108,7109),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA003_15.0",
"name" => "FRA003_15.0",
"contents" => array(7056,7110,7111),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA003_16.0",
"name" => "FRA003_16.0",
"contents" => array(7113,54169,54170,7061,7112),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA003_2.0",
"name" => "FRA003_2.0",
"contents" => array(7001,7043,7044),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA003_3.0",
"name" => "FRA003_3.0",
"contents" => array(7028,7045,7046),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA003_4.0",
"name" => "FRA003_4.0",
"contents" => array(7027,7048,7049),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA003_5.0",
"name" => "FRA003_5.0",
"contents" => array(7058,54141,54148,75594,7033,7055),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA003_6.0",
"name" => "FRA003_6.0",
"contents" => array(54154,7034,7064,7065,54151),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA003_7.0",
"name" => "FRA003_7.0",
"contents" => array(7041,7085,7086,54156,54158),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA003_8.0",
"name" => "FRA003_8.0",
"contents" => array(7088,7039,7087),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA003_9.0",
"name" => "FRA003_9.0",
"contents" => array(7036,7089,7090,54160,54161),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA004_1.0",
"name" => "FRA004_1.0",
"contents" => array(7015,7062,7092),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA004_10.0",
"name" => "FRA004_10.0",
"contents" => array(7674,7592,7673),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA004_11.0",
"name" => "FRA004_11.0",
"contents" => array(7593,7675,7676,54311,79949),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA004_2.0",
"name" => "FRA004_2.0",
"contents" => array(7124,7063,7093),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA004_3.0",
"name" => "FRA004_3.0",
"contents" => array(7100,7133,7136,54216),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA004_4.0",
"name" => "FRA004_4.0",
"contents" => array(54218,54219,78278,7103,7137,7142),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA004_5.0",
"name" => "FRA004_5.0",
"contents" => array(79934,80722,7102,7146,7147,54224,79933),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA004_6.0",
"name" => "FRA004_6.0",
"contents" => array(7095,7161,7162,54225),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA004_7.0",
"name" => "FRA004_7.0",
"contents" => array(7663,54290,7609,7659),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA004_8.0",
"name" => "FRA004_8.0",
"contents" => array(7590,7664,7667,54301,54303,54305),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA004_9.0",
"name" => "FRA004_9.0",
"contents" => array(7591,7670,7671,7672,54307,54308),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA005_1.0",
"name" => "FRA005_1.0",
"contents" => array(8094,54313,54314,54315,81368,7952,8093),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA005_1.1",
"name" => "FRA005_1.1",
"contents" => array(7946,7948,7958),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA005_10.0",
"name" => "FRA005_10.0",
"contents" => array(7966,8097,8098),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA005_11.0",
"name" => "FRA005_11.0",
"contents" => array(8100,7967,8099),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA005_11.5",
"name" => "FRA005_11.5",
"contents" => array(11672,11746,11801,54367),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA005_12.0",
"name" => "FRA005_12.0",
"contents" => array(7969,8101,8102),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA005_2.0",
"name" => "FRA005_2.0",
"contents" => array(7959,8040,8041,54317,54318,78541,81367),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA005_3.0",
"name" => "FRA005_3.0",
"contents" => array(8044,8046,54320,54322,54334,7961),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA005_4.0",
"name" => "FRA005_4.0",
"contents" => array(54335,54337,7962,8048,8050),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA005_5.0",
"name" => "FRA005_5.0",
"contents" => array(7963,8052,8054,54341,54347,54350),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA005_6.0",
"name" => "FRA005_6.0",
"contents" => array(7964,8056,8057,54353,54358,54359,78691),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA005_7.0",
"name" => "FRA005_7.0",
"contents" => array(8103,8104,7965),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA005_8.0",
"name" => "FRA005_8.0",
"contents" => array(8105,8106,8107,54361,54362,54365),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA005_9.0",
"name" => "FRA005_9.0",
"contents" => array(7968,8095,8096),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA006_1.0",
"name" => "FRA006_1.0",
"contents" => array(7152,7186,7192,54412),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA006_10.0",
"name" => "FRA006_10.0",
"contents" => array(7191,7233,7234,54404),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA006_11.0",
"name" => "FRA006_11.0",
"contents" => array(7235,7236,7188),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA006_12.0",
"name" => "FRA006_12.0",
"contents" => array(7211,7237,7239),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA006_13.0",
"name" => "FRA006_13.0",
"contents" => array(54405,54406,54408,7645,7654,7655),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA006_14.0",
"name" => "FRA006_14.0",
"contents" => array(7312,7647,7652),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA006_2.0",
"name" => "FRA006_2.0",
"contents" => array(7153,7196,7206,73668),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA006_2.5",
"name" => "FRA006_2.5",
"contents" => array(54372,54373,54378),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA006_3.0",
"name" => "FRA006_3.0",
"contents" => array(7154,7208,7210,54413),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA006_4.0",
"name" => "FRA006_4.0",
"contents" => array(7216,7218,7155),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA006_5.0",
"name" => "FRA006_5.0",
"contents" => array(7176,7222,7224,54380,54385,54389),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA006_6.0",
"name" => "FRA006_6.0",
"contents" => array(7177,7225,7226,54393,54395),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA006_6.1",
"name" => "FRA006_6.1",
"contents" => array(8087,8088,8089),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA006_7.0",
"name" => "FRA006_7.0",
"contents" => array(7182,7227,7228),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA006_8.0",
"name" => "FRA006_8.0",
"contents" => array(7180,7229,7230,54401,54403),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA006_9.0",
"name" => "FRA006_9.0",
"contents" => array(7183,7231,7232),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA007_0.5",
"name" => "FRA007_0.5",
"contents" => array(7679,54446,7248,7678),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA007_1.0",
"name" => "FRA007_1.0",
"contents" => array(7240,7680,7681,54447),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA007_10.0",
"name" => "FRA007_10.0",
"contents" => array(80581,7246,7730,7731,54463,54466,54469),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA007_11.0",
"name" => "FRA007_11.0",
"contents" => array(7282,7732,7733),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA007_12.0",
"name" => "FRA007_12.0",
"contents" => array(7283,7734,7735),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA007_13.0",
"name" => "FRA007_13.0",
"contents" => array(7736,7737,7286),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA007_14.0",
"name" => "FRA007_14.0",
"contents" => array(7658,64918,64919),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA007_2.0",
"name" => "FRA007_2.0",
"contents" => array(7683,54451,54452,54453,81369,7247,7682),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA007_3.0",
"name" => "FRA007_3.0",
"contents" => array(7251,7684,7685),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA007_4.0",
"name" => "FRA007_4.0",
"contents" => array(7250,7686,7688),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA007_6.0",
"name" => "FRA007_6.0",
"contents" => array(7249,7694,7695,54455),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA007_6.5",
"name" => "FRA007_6.5",
"contents" => array(7696,7719,7275),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA007_6.7",
"name" => "FRA007_6.7",
"contents" => array(7677,7720,7721),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA007_7.0",
"name" => "FRA007_7.0",
"contents" => array(54458,7242,7724,7725),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA007_8.0",
"name" => "FRA007_8.0",
"contents" => array(7244,7723,7726),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA007_9.0",
"name" => "FRA007_9.0",
"contents" => array(54460,54461,7245,7728,7729,54459),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA008_1.0",
"name" => "FRA008_1.0",
"contents" => array(7975,8007,8008),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA008_10.0",
"name" => "FRA008_10.0",
"contents" => array(8017,8018,7984),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA008_11.0",
"name" => "FRA008_11.0",
"contents" => array(7986,8019,8020),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA008_12.0",
"name" => "FRA008_12.0",
"contents" => array(7982,8021,8024),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA008_13.0",
"name" => "FRA008_13.0",
"contents" => array(7988,8025,8026),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA008_14.0",
"name" => "FRA008_14.0",
"contents" => array(7990,8027,8028),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA008_16.0",
"name" => "FRA008_16.0",
"contents" => array(8030,7993,8029),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA008_17.0",
"name" => "FRA008_17.0",
"contents" => array(7994,8031,8032),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA008_18.0",
"name" => "FRA008_18.0",
"contents" => array(62982,62983,62984),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA008_19.0",
"name" => "FRA008_19.0",
"contents" => array(70852),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA008_19.5",
"name" => "FRA008_19.5",
"contents" => array(70853),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA008_2.0",
"name" => "FRA008_2.0",
"contents" => array(7973,8009,8010),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA008_20.0",
"name" => "FRA008_20.0",
"contents" => array(70854),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA008_20.5",
"name" => "FRA008_20.5",
"contents" => array(70855),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA008_3.0",
"name" => "FRA008_3.0",
"contents" => array(7976,8022,8023),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA008_5.0",
"name" => "FRA008_5.0",
"contents" => array(8012,7978,8011),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA008_6.0",
"name" => "FRA008_6.0",
"contents" => array(7979,8013,8014),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA008_7.0",
"name" => "FRA008_7.0",
"contents" => array(7981,8015,8016),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA009_1.0",
"name" => "FRA009_1.0",
"contents" => array(7315,7317,7744,54472,54473),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA009_10.0",
"name" => "FRA009_10.0",
"contents" => array(54516,54517,78287,7342,7343,7344),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA009_11.0",
"name" => "FRA009_11.0",
"contents" => array(81142,98551,7345,7346,7798,54519,54520),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA009_12.0",
"name" => "FRA009_12.0",
"contents" => array(7347,7799,7800,54521,54523),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA009_13.0",
"name" => "FRA009_13.0",
"contents" => array(7801,7802,54524,54525,54527,7348),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA009_2.0",
"name" => "FRA009_2.0",
"contents" => array(7319,7749,7758,54474,78280),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA009_3.0",
"name" => "FRA009_3.0",
"contents" => array(54476,54477,54478,78281,78282,7320,79777,7759,7762),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA009_4.0",
"name" => "FRA009_4.0",
"contents" => array(7767,98566,54481,98701,54483,98702,54484,98760,79722,79723,7321,81496,7766,98456),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA009_5.0",
"name" => "FRA009_5.0",
"contents" => array(54488,54506,79798,79903,7322,80611,7323,81193,7770,98550,54486),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA009_6.0",
"name" => "FRA009_6.0",
"contents" => array(7325,7773,54489,54491,54492,78284,78285,7324),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA009_7.0",
"name" => "FRA009_7.0",
"contents" => array(7792,7793,54494,54496,54497,7326),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA009_8.0",
"name" => "FRA009_8.0",
"contents" => array(54498,54501,54502,80614,81143,7330,7794,7795),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA009_9.0",
"name" => "FRA009_9.0",
"contents" => array(54503,54510,54515,79790,79889,7341,7796,7797),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA010_1.0",
"name" => "FRA010_1.0",
"contents" => array(54609,54615,54617,7372,7380,7381),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA010_1.5",
"name" => "FRA010_1.5",
"contents" => array(74817),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA010_10.0",
"name" => "FRA010_10.0",
"contents" => array(54651,54652,7392,7594,7595,54650),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA010_11.0",
"name" => "FRA010_11.0",
"contents" => array(76690,76691,76692),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA010_12.0",
"name" => "FRA010_12.0",
"contents" => array(76693,76694,76695),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA010_13.0",
"name" => "FRA010_13.0",
"contents" => array(76696,76697,76698),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA010_2.0",
"name" => "FRA010_2.0",
"contents" => array(54620,7382,7384,7387,54619),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA010_3.0",
"name" => "FRA010_3.0",
"contents" => array(7375,7389,7391,54621,54626),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA010_4.0",
"name" => "FRA010_4.0",
"contents" => array(7396,54630,7376,7395),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA010_5.0",
"name" => "FRA010_5.0",
"contents" => array(7377,7397,7803,54632,54634,54635),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA010_6.0",
"name" => "FRA010_6.0",
"contents" => array(7383,7411,7412),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA010_7.0",
"name" => "FRA010_7.0",
"contents" => array(7385,7413,7414,54638,54640),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA010_8.0",
"name" => "FRA010_8.0",
"contents" => array(7388,7425,7599,54642,54645,54646),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA010_9.0",
"name" => "FRA010_9.0",
"contents" => array(7597,54647,54648,54649,7394,7596),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA011_1.0",
"name" => "FRA011_1.0",
"contents" => array(7440,7838,7840),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA011_10.0",
"name" => "FRA011_10.0",
"contents" => array(7460,7866,7867),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA011_12.0",
"name" => "FRA011_12.0",
"contents" => array(7868,7869,7834),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA011_13.0",
"name" => "FRA011_13.0",
"contents" => array(63764,63765,63766),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA011_14.0",
"name" => "FRA011_14.0",
"contents" => array(70621),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA011_2.0",
"name" => "FRA011_2.0",
"contents" => array(7844,7443,7843),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA011_3.0",
"name" => "FRA011_3.0",
"contents" => array(7445,7845,7846),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA011_4.0",
"name" => "FRA011_4.0",
"contents" => array(7446,7848,7849),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA011_5.0",
"name" => "FRA011_5.0",
"contents" => array(7852,7853,7448),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA011_6.0",
"name" => "FRA011_6.0",
"contents" => array(7450,7854,7855),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA011_7.0",
"name" => "FRA011_7.0",
"contents" => array(7451,7856,7857),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA011_8.0",
"name" => "FRA011_8.0",
"contents" => array(7454,7858,7859),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA011_8.5",
"name" => "FRA011_8.5",
"contents" => array(7832,7860,7861),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA011_8.7",
"name" => "FRA011_8.7",
"contents" => array(7863,7836,7862),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA011_9.0",
"name" => "FRA011_9.0",
"contents" => array(7459,7864,7865),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA012_1.0",
"name" => "FRA012_1.0",
"contents" => array(7164,54535,75617,7116,7163),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA012_2.0",
"name" => "FRA012_2.0",
"contents" => array(7118,7165,7166),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA012_3.0",
"name" => "FRA012_3.0",
"contents" => array(7168,7126,7167),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA012_4.0",
"name" => "FRA012_4.0",
"contents" => array(7127,7172,7173),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA012_5.0",
"name" => "FRA012_5.0",
"contents" => array(7131,7241,7243),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA012_6.0",
"name" => "FRA012_6.0",
"contents" => array(8183,8185,8180),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA012_7.0",
"name" => "FRA012_7.0",
"contents" => array(8181,8182,8184),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA013_1.0",
"name" => "FRA013_1.0",
"contents" => array(54546,54547,54548,79754,80790,7712,81371,7804,7807),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA013_10.0",
"name" => "FRA013_10.0",
"contents" => array(7930,7931,64921),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA013_2.0",
"name" => "FRA013_2.0",
"contents" => array(7811,54549,54553,54560,79753,7713,7810),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA013_3.0",
"name" => "FRA013_3.0",
"contents" => array(54562,54563,7714,7812,7813),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA013_4.0",
"name" => "FRA013_4.0",
"contents" => array(7715,7814,7815,54566,54571,79789),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA013_5.0",
"name" => "FRA013_5.0",
"contents" => array(7716,7816,7817,54574,54579,54583),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA013_6.0",
"name" => "FRA013_6.0",
"contents" => array(7820,54584,54587,54591,80707,81370,7717,7818),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA013_7.0",
"name" => "FRA013_7.0",
"contents" => array(7822,54594,54596,54597,7718,7821),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA013_9.0",
"name" => "FRA013_9.0",
"contents" => array(54599,54600,7722,7823,7825,54598),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA013_9.1",
"name" => "FRA013_9.1",
"contents" => array(76267,76268,76269),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA013_9.2",
"name" => "FRA013_9.2",
"contents" => array(76264,76265,76266),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA014_1.0",
"name" => "FRA014_1.0",
"contents" => array(54671,7925,7942,7945,54661,54662),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA014_10.0",
"name" => "FRA014_10.0",
"contents" => array(7992,7933,7991),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA014_11.0",
"name" => "FRA014_11.0",
"contents" => array(7934,7996,7998),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA014_13.0",
"name" => "FRA014_13.0",
"contents" => array(7935,7997,7999),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA014_14.0",
"name" => "FRA014_14.0",
"contents" => array(8000,8001,54678,54680,54681,81070,7936),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA014_15.0",
"name" => "FRA014_15.0",
"contents" => array(8003,54682,54683,54685,81068,81069,7937,8002),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA014_16.0",
"name" => "FRA014_16.0",
"contents" => array(8005,81359,8006,54686,54688,54689,54691,7938,81063,8004,81066),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA014_2.0",
"name" => "FRA014_2.0",
"contents" => array(7924,7949,7951),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA014_3.0",
"name" => "FRA014_3.0",
"contents" => array(7922,7953,7955),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA014_4.0",
"name" => "FRA014_4.0",
"contents" => array(7957,7960,54672,54673,7923),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA014_5.0",
"name" => "FRA014_5.0",
"contents" => array(7926,7970,7971),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA014_6.0",
"name" => "FRA014_6.0",
"contents" => array(7972,7974,7927),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA014_7.0",
"name" => "FRA014_7.0",
"contents" => array(7929,7977,7980,54674,54675,54676),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA014_8.0",
"name" => "FRA014_8.0",
"contents" => array(7928,7983,7985),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA014_9.0",
"name" => "FRA014_9.0",
"contents" => array(7932,7987,7989),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA018_0.5",
"name" => "FRA018_0.5",
"contents" => array(64573,64717,64729),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA018_0.8",
"name" => "FRA018_0.8",
"contents" => array(64718,64719,64720),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA018_1.0",
"name" => "FRA018_1.0",
"contents" => array(64722,64728,64721),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA018_2.0",
"name" => "FRA018_2.0",
"contents" => array(17650,64565,64634,76112),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA018_3.0",
"name" => "FRA018_3.0",
"contents" => array(17703,76047,17660,17700),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA018_6.5",
"name" => "FRA018_6.5",
"contents" => array(64740,64741,64748),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA018_6.6",
"name" => "FRA018_6.6",
"contents" => array(64742,64746,64747),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA018_6.8",
"name" => "FRA018_6.8",
"contents" => array(64743,64744,64745),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA018_7.0",
"name" => "FRA018_7.0",
"contents" => array(64749,64750,64751),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA032_1.0",
"name" => "FRA032_1.0",
"contents" => array(76797,76745,76796),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA032_2.0",
"name" => "FRA032_2.0",
"contents" => array(76746,76798,76799),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA032_3.0",
"name" => "FRA032_3.0",
"contents" => array(76747,76780,76781),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA032_4.0",
"name" => "FRA032_4.0",
"contents" => array(76800,76801,76748),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA032_5.0",
"name" => "FRA032_5.0",
"contents" => array(76749,76751,76782),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA032_6.0",
"name" => "FRA032_6.0",
"contents" => array(76753,76784,76785),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA035_2.0",
"name" => "FRA035_2.0",
"contents" => array(76497),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA035_3.0",
"name" => "FRA035_3.0",
"contents" => array(76498),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA035_4.0",
"name" => "FRA035_4.0",
"contents" => array(76499),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA035_5.0",
"name" => "FRA035_5.0",
"contents" => array(76492),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA035_6.0",
"name" => "FRA035_6.0",
"contents" => array(76493),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA035_7.0",
"name" => "FRA035_7.0",
"contents" => array(76494),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA035_8.0",
"name" => "FRA035_8.0",
"contents" => array(76495),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "FRA035_9.0",
"name" => "FRA035_9.0",
"contents" => array(76496),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "REA016_1.0",
"name" => "REA016_1.0",
"contents" => array(39367,39578,39580),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "REA016_11.0",
"name" => "REA016_11.0",
"contents" => array(39396,39660,39663),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "REA016_13.0",
"name" => "REA016_13.0",
"contents" => array(39386,39646,39648),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "REA016_13.5",
"name" => "REA016_13.5",
"contents" => array(39651,39387,39649),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "REA016_14.0",
"name" => "REA016_14.0",
"contents" => array(39385,39657,39658),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "REA016_15.0",
"name" => "REA016_15.0",
"contents" => array(39384,39675,39677),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "REA016_2.0",
"name" => "REA016_2.0",
"contents" => array(76228,39369,39585,39589,76226,76227),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "REA016_3.0",
"name" => "REA016_3.0",
"contents" => array(15364,15377,15771,76180,76181,76229,81612),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "REA016_4.0",
"name" => "REA016_4.0",
"contents" => array(39370,39596,39597),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "REA016_5.0",
"name" => "REA016_5.0",
"contents" => array(39371,39598,39599),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "REA016_6.0",
"name" => "REA016_6.0",
"contents" => array(39593,76230,76231,76232,39372,39591),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "REA016_7.0",
"name" => "REA016_7.0",
"contents" => array(76183,76184,15363,15779,15786,76182),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "REA016_8.0",
"name" => "REA016_8.0",
"contents" => array(39374,39622,39623),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "REA016_9.0",
"name" => "REA016_9.0",
"contents" => array(15361,15773,15775),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "REA036_1.0",
"name" => "REA036_1.0",
"contents" => array(15808,15811,15763),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "REA036_2.0",
"name" => "REA036_2.0",
"contents" => array(15778,15813,15814),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "REA036_3.0",
"name" => "REA036_3.0",
"contents" => array(15768,15816,15817),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "REA036_4.0",
"name" => "REA036_4.0",
"contents" => array(15340,15344,15387),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "REA036_5.0",
"name" => "REA036_5.0",
"contents" => array(15339,15348,15349),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "REA036_6.0",
"name" => "REA036_6.0",
"contents" => array(15819,15345,15383),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "REA036_7.0",
"name" => "REA036_7.0",
"contents" => array(15350,15823,15825),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "REA036_8.0",
"name" => "REA036_8.0",
"contents" => array(15346,15820,15822),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "REA036_8.5",
"name" => "REA036_8.5",
"contents" => array(15788),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "REA036_9.0",
"name" => "REA036_9.0",
"contents" => array(39394,39634,39641,79620,79621,79765),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "REA062_10.0",
"name" => "REA062_10.0",
"contents" => array(15343,15351,15821,39405,39665,39668),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "REA062_12.0",
"name" => "REA062_12.0",
"contents" => array(39694,39724,39397),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "REA062_13.0",
"name" => "REA062_13.0",
"contents" => array(39395,39763,39765),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "REA062_14.0",
"name" => "REA062_14.0",
"contents" => array(39404,39779,39823),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "REA062_15.0",
"name" => "REA062_15.0",
"contents" => array(15417,15791,15793),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "REA062_16.0",
"name" => "REA062_16.0",
"contents" => array(15391,15796,15800),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "REA062_16.2",
"name" => "REA062_16.2",
"contents" => array(76272,76270,76271),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "REA062_16.4",
"name" => "REA062_16.4",
"contents" => array(76273,76274,76275),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "REA062_16.6",
"name" => "REA062_16.6",
"contents" => array(76276,76277,76278),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "REA062_17.0",
"name" => "REA062_17.0",
"contents" => array(70833),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"
);

$container_array[] = array("type" => "SDL",
"id" => "REA062_8.5",
"name" => "REA062_8.5",
"contents" => array(80582,15362,15789),
"status_criterion" => "(#student['last_element_status'] == 'SUCCESS') ? 'SUCCESS' : ((count(#student['unattempted_elements'])==0) ? 'FAILURE' : 'IN PROGRESS');",
"start_with" => "RANDOM_FROM_UNATTEMPTED",
"movement_logic_within_container" => "(#student['last_element_status'] == 'SUCCESS') ? 'END' : (count(#student['unattempted_elements'])==0) ? 'END' : 'RANDOM_FROM_UNATTEMPTED';"

$collection_array[] = array("type" => "ASSET_test", // cluster, game, teacher topic, SDL
						"id" => "ASSET_19C",
						"name" => "ASSET English Winter 2006",
						"contents" => array(12775,12778,12779,12783,12784,12782,12781,13250,12871,12875,12876,12869,12868,12873,12874,12877,12872,12852,12855,12856,12854,12858,12861,12853,12851,12792,12793,12800,12788,12802,12795,12790,12823,12824,12862,12863,12864,12865,12866,12804,12816,12770,12765,12769,12773,12772,12768,12809,12803,13157,13158,12844,12846,12847,12848,13251,13188,13189,13190,13191,13192,13193,12813,12810,13249,12808,12805,12806,12807,12812),
						"success_criterion" => "is_last_element_completed()",
						"start_with" => "FIRST_ELEMENT",
						"movement_logic" => "NEXT_IN_SEQUENCE",
						"is_pool_container" => 1
);

$collection_array[] = array("type" => "ASSET_test", // cluster, game, teacher topic, SDL
						"id" => "ASSET_26J",
						"name" => "ASSET Maths Summer 2010",
						"contents" => array(22621,22824,22882,22874,20756,22838,20174,22869,22841,22828,22848,22817,22832,22842,22880,22847,22914,22846,22605,22870,22830,22837,22877,22881,22876,22826,22890,22891,22822,22819,22904,22818,22887,22840,18241,22909,22893,22835,22892,22894),
						"success_criterion" => "is_last_element_completed()",
						"start_with" => "FIRST_ELEMENT",
						"movement_logic" => "NEXT_IN_SEQUENCE",
						"is_pool_container" => 1
);


$collection_array[] = array("type" => "test", // cluster, game, teacher topic, SDL
						"id" => "DA_43449939887782021_2",
						"name" => "",
						"contents" => array(72360,70765,12937,70810,70744,70838,70874,70718,70738,70830,70713,70742,70745,70741,70764,72304,72232,12939,70746),
						"success_criterion" => "is_last_element_completed()",
						"start_with" => "FIRST_ELEMENT",
						"movement_logic" => "UNATTEMPTED_ELEMENT",
						"is_pool_container" => 1
);

$collection_array[] = array("type" => "test", // cluster, game, teacher topic, SDL
						"id" => "DA_26449939887782305_4",
						"name" => "",
						"contents" => array(39990,66142,24024,59805,44006,50923,55878,65723,64109,45523,47727,32096,20234,41401,13512,20488,7597,24129,24123,40414,22966,43685,50859,28775,17356),
						"success_criterion" => "is_last_element_completed()",
						"start_with" => "FIRST_ELEMENT",
						"movement_logic" => "UNATTEMPTED_ELEMENT",
						"is_pool_container" => 1
);

?>