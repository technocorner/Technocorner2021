<?php

namespace App\Models;

use CodeIgniter\Model;

class ApiModel extends Model
{
    protected $table      = 'team';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'user_id', 'lomba_id', 'team_name', 'image_payment', 'is_paid'
    ];

    public function getTeamInfo($username)
    {
        $db = db_connect();

        $queryTeam = "select team.team_name, 
                	   team.institusi,
                       users.email,
                       member_team.name
                from team, 
                  	 users, 
                     member_team 
                where team.user_id = users.id 
                  and team.lomba_id = 4 
                  and team.id = member_team.team_id 
                  and users.email LIKE ?";
        $query = $db->query($queryTeam, $username.'%');
        
        return $query->getResultArray();
    }

    public function getQuestion()
    {
        $db = db_connect();

        $queryTeam = "select * from eec_question";
        // $queryTeam = "select * from eec_question_test";
        $query = $db->query($queryTeam);
        
        return $query->getResultArray();
    }

    public function saveAnswer($data)
    {
        $db = db_connect();

        $queryTeam = "insert into eec_answer(team_id,answer,time) values (?,?,NOW())";
        $query = $db->query($queryTeam, [$data->team_id, $data->answer]);
        
        return $db->error();
    }


}
