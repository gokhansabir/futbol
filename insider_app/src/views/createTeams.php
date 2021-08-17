<?php

require("../../config/dbconnect.php");
require("../../src/core/Teams.php");
require("../../src/core/Schedule.php");

//db connection
$dbConnect = new DbConnect();
$db = $dbConnect->connect();

//teams
$teamPlayersObj = new Teams();

//delete all players
$teamPlayersObj->deleteAllTeamPlayers($db);

// get all players
$tempPlayers =$teamPlayersObj->getPlayers($db);
shuffle($tempPlayers);

// grouped by position
foreach ($tempPlayers as $value) {
    $randPlayer[] = array_pop($tempPlayers);
    if ($value['position'] == 0) {
        $qbId[] = $value['id'];
    }
    if ($value['position'] == 1) {
        $rbId[] = $value['id'];
    }
    if ($value['position'] == 2) {
        $wrId[] = $value['id'];
    }
    if ($value['position'] == 3) {
        $teId[] = $value['id'];
    }
    if ($value['position'] == 4) {
        $otId[] = $value['id'];
    }
    if ($value['position'] == 5) {
        $gId[] = $value['id'];
    }
    if ($value['position'] == 6) {
        $cId[] = $value['id'];
    }
    if ($value['position'] == 7) {
        $dlId[] = $value['id'];
    }
    if ($value['position'] == 8) {
        $lbId[] = $value['id'];
    }
    if ($value['position'] == 9) {
        $dbId[] = $value['id'];
    }
}

//get all teams
$teamNames = $teamPlayersObj->getAllTeams($db);


// insert new teams into tb_teams table
foreach ($teamNames as $key => $teams) {

    $teamId = $teams["id"];
    // generate team players
    for ($p = 0; $p < 1; $p++) {
        $newPlayerId = array_pop($qbId);
        $teamPlayersObj->insertTeamPlayers($db,$teamId,$newPlayerId);
    }

    for ($p = 0; $p < 2; $p++) {
        $newPlayerId = array_pop($rbId);
        $teamPlayersObj->insertTeamPlayers($db,$teamId,$newPlayerId);
    }


    for ($p = 0; $p < 2; $p++) {
        $newPlayerId = array_pop($wrId);
        $teamPlayersObj->insertTeamPlayers($db,$teamId,$newPlayerId);
    }


    for ($p = 0; $p < 1; $p++) {
        $newPlayerId = array_pop($teId);
        $teamPlayersObj->insertTeamPlayers($db,$teamId,$newPlayerId);
    }


    for ($p = 0; $p < 2; $p++) {
        $newPlayerId = array_pop($otId);
        $teamPlayersObj->insertTeamPlayers($db,$teamId,$newPlayerId);
    }


    for ($p = 0; $p < 2; $p++) {
        $newPlayerId = array_pop($gId);
        $teamPlayersObj->insertTeamPlayers($db,$teamId,$newPlayerId);
    }


    for ($p = 0; $p < 1; $p++) {
        $newPlayerId = array_pop($cId);
        $teamPlayersObj->insertTeamPlayers($db,$teamId,$newPlayerId);
    }


    for ($p = 0; $p < 4; $p++) {
        $newPlayerId = array_pop($dlId);
        $teamPlayersObj->insertTeamPlayers($db,$teamId,$newPlayerId);
    }

    for ($p = 0; $p < 3; $p++) {
        $newPlayerId = array_pop($lbId);
        $teamPlayersObj->insertTeamPlayers($db,$teamId,$newPlayerId);
    }

    for ($p = 0; $p < 4; $p++) {
        $newPlayerId = array_pop($dbId);
        $teamPlayersObj->insertTeamPlayers($db,$teamId,$newPlayerId);
    }
}

// create schedule for all teams
$newSched = new Schedule();
$newSched->createSchedule($db,$teamNames);

// re-direct page to new league page
//header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . '/NFL_simApp/resources/views/leagueDash.php?team=' . $userTeamName . '&league=' . $leagueName . '&seasId=' . $seasonId);
//exit;
