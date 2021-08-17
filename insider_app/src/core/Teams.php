<?php

class Teams{

    /**
     * @param $db
     */
    public function deleteAllTeamPlayers($db){
        $sql = "DELETE FROM tb_team_players";
        $db->exec($sql);
    }

    /**
     * @param $db
     * @return mixed
     */
    public function getPlayers($db){
        $sql = "SELECT id, position FROM tb_players";
        $results = $db->query($sql);
        $allPlayers = $results->fetchAll(PDO::FETCH_ASSOC);
        return $allPlayers;
    }

    /**
     * @param $db
     * @return mixed
     */
    public function getAllTeams($db){
        $sqlTeams = "SELECT * FROM tb_teams";
        $resultTeams = $db->query($sqlTeams);
        $teamNames = $resultTeams->fetchAll(PDO::FETCH_ASSOC);
        return $teamNames;
    }

    /**
     * @param $db
     * @param $teamId
     * @param $newPlayerId
     */
    public function insertTeamPlayers($db,$teamId,$newPlayerId){
        $sql = "INSERT INTO tb_team_players (team_id, player_id) VALUES ('$teamId', '$newPlayerId')";
        $db->exec($sql);
    }
}