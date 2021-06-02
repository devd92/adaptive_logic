<?php
$is_exception = 1;
$element_types = array("Teacher Topic", "Cluster", "Timed Test", "Game", "Remedial", "Challenge Question");
$learning_modes = array("exposure", "skill");
$userDetails = array();
$last_10_attempted = array();


$cluster_params = array("$SDL_params"=>array("pass_on"=>"accuracy", "pass_on_attempt"=>),"on_fail_count"=>array("repeat","remedial_item", "remedial_cluster", "first_element_in_TT"));
//there is a flow stack (where you are WITHIN a flow and how you got there) and an item stack (last 10 units, which can be Qs, games etc.)
//suppose the logic says 'now start element x' the type of x and what it implies should be clear; the stacking logic should be generic enough that it has high interoperability between subjects
//there is an on_fail array which can be at a student level, cluster level, flow level and/or subject level. It can go in order of these levels and the lowest denominator can override the larger set


/* elements of what we did earlier for the adaptive logic */

//list of TTs for a grade, flow, and for each topic
$teacherTopic['CBSE'][5] = array('Fractions'=>array('TT050','TT052','TT054','TT62784','TT62785','TT62786','TT62787','TT62811','TT62976','TT62997','TT63055','TT63056','TT63058','TT63059','TT63061'), 'Decimals'=>array('TT053','TT146','TT62778','TT62779','TT62781','TT62812','TT62813','TT62902','TT63062','TT63064'));

//list of items in a TT
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

//list of qcodes (SDL-wise)	in cluster FRA003											
$clusters['FRA003'] = array(1=>array('qcodes'=>array(7002, 7037, 7040)), 
 						3=>array('qcodes'=>array(7001, 7043, 7044)), 
 						4=>array('qcodes'=>array(7028, 7045, 7046)), 
 						7=>array('qcodes'=>array(7027, 7048, 7049)), 
 						10.5=>array('qcodes'=>array(7033, 7055, 7058, 54141, 54148, 75594)), 
 						11=>array('qcodes'=>array(7034, 7064, 7065, 54151, 54154, 7041)), 
 						13=>array('qcodes'=>array(7041, 7085, 7086, 54156, 54158, 7039)), 
 						15=>array('qcodes'=>array(7039, 7087, 7088)), 
 						17=>array('qcodes'=>array(7036, 7089, 7090, 54160, 54161)), 
 						19=>array('qcodes'=>array(7053, 7094, 7096, 54163, 54164)), 
 						21=>array('qcodes'=>array(7029, 7098, 7101, 54165, 54166)), 
 						23=>array('qcodes'=>array(7031, 7104, 7105, 54167, 54168)), 
 						25=>array('qcodes'=>array(7059, 7106, 7107)), 
 						27=>array('qcodes'=>array(7060, 7108, 7109)), 
 						29=>array('qcodes'=>array(7056, 7110, 7111)), 
 						31=>array('qcodes'=>array(7061, 7112, 7113, 54169, 54170)));

?>