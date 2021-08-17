<?php
class Schedule
{

    public $week;
    public $games;
    public $homeTeam;
    public $awayTeam;
    public $schedule;
    public $weeks;

    /**
     * @param $db
     * @param $teams
     */
    public function createSchedule($db, $teams)
    {

        $leagueTeamsArr = $teams;
        $leagueTeamsId = array();
        $t = 0;
        foreach ($leagueTeamsArr as $key => $value) {
            $leagueTeamsId[$t] = $value['id'];
            $t++;
        }

        $this->week = array();
        $this->games = array();

        $temp = $leagueTeamsId;
        shuffle($temp);
        $numTeams = count($leagueTeamsId);

        // loop every week
        for ($w = 0; $w < 7; $w++) {
            $this->week[] = array($this->games);
            // games each week number of teams divided by 2
            for ($x = 0; $x < $numTeams / 2; $x++) {
                $val1 = array_pop($temp);
                $val2 = array_pop($temp);
                if (is_null($val1) OR is_null($val2)) {
                    $temp = $leagueTeamsId;
                    shuffle($temp);
                    $val1 = array_pop($temp);
                    $val2 = array_pop($temp);
                }

                $this->games[$x]['homeTeam'] = $val1;
                $this->games[$x]['awayTeam'] = $val2;
            }
        }
        $this->insertSchedule($db);
    }

    /**
     * @param $db
     */
    public function deleteSchedules($db){
        $sql = "DELETE FROM tb_schedules";
        $db->exec($sql);
    }

    /**
     * @param $db
     */
    public function insertSchedule($db)
    {
        //delete
        $this->deleteSchedules($db);

        foreach ($this->week as $wk => $wkgame) {
            $this->weeks = $wk;
            foreach ($wkgame as $key => $value) {
                foreach ($value as $game => $team) {
                    $this->homeTeam = $team['homeTeam'];
                    $this->awayTeam = $team['awayTeam'];
                    $score = $this->scoreAll($db,$this->homeTeam,$this->awayTeam);

                    if($score){
                        $homeScore = rand(3,5);
                        $awayScore = rand(0,2);
                    }else{
                        $awayScore = rand(3,5);
                        $homeScore = rand(0,2);
                    }
                    $sql = "INSERT INTO tb_schedules (home_team, away_team, week, home_score, away_score) VALUES ('$this->homeTeam', '$this->awayTeam', '$this->weeks',$homeScore,$awayScore)";
                    $db->exec($sql);
                }
            }
        }
    }

    /**
     * @param $db
     * @param $homeTeamId
     * @param $awayTeamId
     * @return bool
     */
    public function scoreAll($db,$homeTeamId,$awayTeamId){

        $sql = "SELECT sum(p.star) as totalstar FROM tb_players as p INNER JOIN tb_team_players as tp ON p.id = tp.player_id WHERE tp.team_id = $homeTeamId";
        $results = $db->query($sql);
        $homeScore = $results->fetch();
        $yuzde = ($homeScore[0]*15)/100;
        $homeScoreArti = $homeScore[0]+$yuzde;

        $sql = "SELECT sum(p.star) as totalstar FROM tb_players as p INNER JOIN tb_team_players as tp ON p.id = tp.player_id WHERE tp.team_id = $awayTeamId";
        $results = $db->query($sql);
        $awayScore = $results->fetch();

        if($awayScore[0]>$homeScoreArti){
            //away kazanır
            return true;
        }else{
            //home kazanır
            return false;
        }
    }
}