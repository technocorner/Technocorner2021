<?php

namespace App\Models;

use CodeIgniter\Model;

class TeamModel extends Model
{
    protected $table      = 'team';
    protected $primaryKey = 'id';

    public function getTeam($userId)
    {
        return $this->where('user_id', $userId)->first();
    }
    
     public function deleteTeam($userId)
    {
        $db = db_connect();
        $queryCustMember = "DELETE FROM team WHERE user_id = ?";
        $query = $db->query($queryCustMember, $userId);
    }

    public function deleteMemberTeamByTeam($teamId)
    {
        $db = db_connect();
        $queryCust = "DELETE FROM member_team WHERE team_id = ?";
        $query = $db->query($queryCust, $teamId);
    }

    public function getMemberTeam($userId)
    {
        $db = db_connect();
        $queryCust = "SELECT *, member_team.id as member_id FROM member_team 
                        JOIN team ON member_team.team_id = team.id
                        WHERE team.user_id = ?";
        $query = $db->query($queryCust, $userId);
        $result = $query->getResultArray();
        return $result;
    }
    // public function getTeamByLomba($lombaId)
    // {
    //     $db = db_connect();
    //     $queryInsert = "SELECT "
    // }
    public function createTeam($data)
    {

        $db = db_connect();
        $queryInsertTeam = "INSERT INTO team VALUES ('', ?, ?, ?, ?, ?, ?, ?)";
        $query = $db->query($queryInsertTeam, [$data['user_id'], $data['lomba_id'], $data['team_name'], $data['institusi'], $data['kontak'], $data['image_payment'], $data['is_paid']]);
    }

    public function createMemberTeam($data)
    {
        $db = db_connect();
        $queryInsert = "INSERT INTO member_team VALUES ('', ?, ?, ?, ?)";
        $query = $db->query($queryInsert, [$data['team_id'], $data['name'], $data['image'], $data['ktm']]);
    }

    public function createMultipleMember($data)
    {
        $db = db_connect();
        $builder = $db->table('member_team');
        $builder->insertBatch($data);
    }

    public function createRobotTeam($data)
    {
        $db = db_connect();
        $queryInsert = "INSERT INTO team_robot VALUES ('', ?, ?, ?)";
        $query = $db->query($queryInsert, [$data['team_id'], $data['nama_robot'], $data['foto_robot']]);
    }

    public function canCreate($userId)
    {
        $db = db_connect();
        $queryInsert = "SELECT user_id FROM team WHERE user_id = ?";
        $query = $db->query($queryInsert, $userId);
        $result = $query->getResultArray();
        if ($result) {
            return false;
        }
        return true;
    }

    public function teamLomba($userId)
    {
        $db = db_connect();
        $queryCust = "SELECT lomba.title, lomba.image FROM lomba
                        JOIN team 
                        ON lomba.id = team.lomba_id
                        WHERE team.user_id = ?";
        $query = $db->query($queryCust, $userId);
        $result = $query->getRowArray();
        return $result;
    }

    public function updateTeam($data, $image = false)
    {
        $db = db_connect();
        if ($image == false) {
            $queryCust = "UPDATE team
                            SET team_name = ?,
                                institusi = ?
                            WHERE user_id = ?";
            $query = $db->query($queryCust, [$data['team_name'], $data['institusi'], session('id')]);
        } else {
            $queryCust = "UPDATE team
                            SET image_payment = ?,
                                team_name = ?,
                                institusi = ?
                            WHERE user_id = ?";
            $query = $db->query($queryCust, [$image, $data['team_name'], $data['institusi'], session('id')]);
        }
    }

    public function editMemberTeam($data, $image = false)
    {
        $db = db_connect();
        if ($image == false) {
            $queryCust = "UPDATE member_team 
                         SET name=?
                       WHERE team_id = ?
                         AND id = ?";
            $query = $db->query($queryCust, [$data['name'], $data['team_id'], $data['id']]);
        } else {
            $queryCust = "UPDATE member_team 
                         SET name=?, 
                             ktm=?,
                             image=?
                       WHERE team_id = ?
                         AND id = ?";
            $query = $db->query($queryCust, [$data['name'], $image, $data['image'], $data['team_id'], $data['id']]);
        }
        $result = $query->getResultArray();
        return $result;
    }

    public function deleteMemberTeam($data)
    {
        $db = db_connect();
        $queryCust = "DELETE FROM member_team
                            WHERE team_id = ?
                              AND id = ?";
        $query = $db->query($queryCust, [$data['team_id'], $data['member_id']]);
        $result = $query->getResultArray();
        return $db->error();
    }

    public function addMemberTeam($data)
    {
        $db = db_connect();
        $queryCust = "INSERT INTO member_team (team_id, name, ktm)
                           VALUES (?, ?, ?)";
        $query = $db->query($queryCust, [$data['team_id'], $data['member_name'], $data['ktm']]);
        $result = $query->getResultArray();
        return $db->error();
    }
}
