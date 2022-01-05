<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table      = 'team';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'user_id', 'lomba_id', 'team_name', 'image_payment', 'is_paid'
    ];

    public function getTeam($lombaId = false)
    {
        $db = db_connect();

        if ($lombaId == false) {
            $queryTeam = "SELECT nama_lomba, t.id as team_id, team_name, name as leader, image_payment, is_paid, kontak, u.email as email
                            FROM team as t,
                                 lomba as l,
                                 users as u
                           where t.user_id = u.id
                             and t.lomba_id = l.id";
            $query = $db->query($queryTeam);
        } else {
            $queryTeam = "SELECT nama_lomba, t.id as team_id, team_name, name as leader, image_payment, is_paid, kontak, u.email as email
                            FROM team as t,
                                 lomba as l,
                                 users as u
                           where t.user_id = u.id
                             and t.lomba_id = l.id
                             and l.id = ?";
            $query = $db->query($queryTeam, $lombaId);
        }
        return $query->getResultArray();
    }

    public function getTeamMember($teamID)
    {
        $db = db_connect();

        $queryTeamMember = "SELECT *
                              FROM member_team
                             where team_id = ?";
        $query = $db->query($queryTeamMember, $teamID);

        return $query->getResultArray();;
    }

    public function updateTeam($data)
    {
        $db = db_connect();
        $queryUserToken = "UPDATE team 
                              SET is_paid = ?
                            WHERE id = ?";
        $query = $db->query($queryUserToken, [
            $data['is_paid'], $data['team_id']
        ]);

        return $db->error();
    }


    public function getUser($term = false)
    {
        $db = db_connect();
        if ($term == false) {
            $queryPemberitahuan = "SELECT *
                                     FROM users
                                    LIMIT 5";
            $query = $db->query($queryPemberitahuan);
        } else {
            $queryPemberitahuan = "SELECT *
                                     FROM users
                                    WHERE name like '%" . $term . "%'
                                    LIMIT 5";
            $query = $db->query($queryPemberitahuan);
        }
        return $query->getResultArray();
    }

    public function addPemberitahuan($data)
    {
        $db = db_connect();

        $builder = $db->table('pemberitahuan');

        $pemberitahuan = [
            'judul' => $data['judul'],
            'isi' => $data['isi']
        ];

        $builder->insert($pemberitahuan);
        $pemberitahuan_id = $db->insertID();

        if ($data['type'] == '1') {
            foreach ($data['identity'] as $user) {
                $queryPemberitahuan = "INSERT INTO user_pemberitahuan
                                                 (user_id,pemberitahuan_id, type, created_at) 
                                            VALUES (?,?,?,CURRENT_TIMESTAMP)";
                $query = $db->query($queryPemberitahuan, [
                    $user, $pemberitahuan_id, 1
                ]);
            }
        } else if ($data['type'] == '2') {
            $queryGetListUser = "SELECT user_id FROM team WHERE lomba_id = ?";
            $users = $db->query($queryGetListUser, [
                $data['identity']
            ])->getResultArray();

            foreach ($users as $user) {
                $queryPemberitahuan = "INSERT INTO user_pemberitahuan
                                                  (user_id,pemberitahuan_id,type,lomba_id,created_at) 
                                            VALUES (?,?,?,?,CURRENT_TIMESTAMP)";
                $query = $db->query($queryPemberitahuan, [
                    $user, $pemberitahuan_id, 2, $data['identity']
                ]);
            }
        } else if ($data['type'] == '3') {
            $queryGetListUser = "SELECT id FROM users";
            $users = $db->query($queryGetListUser)->getResultArray();

            foreach ($users as $user) {
                $queryPemberitahuan = "INSERT INTO user_pemberitahuan
                                                 (user_id,pemberitahuan_id,type,created_at) 
                                            VALUES (?,?,?,CURRENT_TIMESTAMP)";
                $query = $db->query($queryPemberitahuan, [
                    $user, $pemberitahuan_id, 3
                ]);
            }
        }


        return $db->error();
    }

    public function getListPemberitahuan($type = false)
    {
        $db = db_connect();

        if ($type == false) {
            $queryPemberitahuan = "SELECT up.pemberitahuan_id,
                                          up.type as type_id,
                                          IF(up.type=1,
                                            'Users',
                                            IF(up.type=2,
                                                'Lomba',
                                                'All'
                                            )
                                          )as type,
                                          p.judul,
                                          p.isi,
                                          IF(up.type=3,
                                            'ALL',
                                            IF(up.type=2,
                                                CONCAT('Lomba ',lomba.nama_lomba),
                                                GROUP_CONCAT(u.name)
                                            )
                                          )as identity,
                                          up.created_at
                                     FROM users as u,
                                          pemberitahuan as p,
                                          user_pemberitahuan as up
                                          LEFT JOIN lomba ON up.lomba_id = lomba.id
                                    WHERE up.user_id = u.id
                                      AND up.pemberitahuan_id = p.id
                                 GROUP BY up.pemberitahuan_id";
            $query = $db->query($queryPemberitahuan);
        } else {
        }
        return $query->getResultArray();
    }

    public function deletePemberitahuan($id)
    {
        $db = db_connect();

        $queryPemberitahuan = "DELETE
                                 FROM user_pemberitahuan
                                WHERE pemberitahuan_id = ?";
        $query = $db->query($queryPemberitahuan, [$id]);

        return $db->error();
    }

    public function getQuestionEEC()
    {
        $db = db_connect();
        $queryTeam = "SELECT eq.id, eq.question, ek.kunjaw, eq.answer1, eq.answer2, eq.answer3, eq.answer4, eq.answer5
                        FROM eec_question as eq,
                             eec_kunjaw as ek
                       where eq.id = ek.question_id";
        $query = $db->query($queryTeam);
        return $query->getResultArray();
    }

    public function updateQuestionEEC($data)
    {
        $db = db_connect();
        $queryUserToken = "UPDATE eec_question 
                              SET question = ?,
                                  answer1 = ?,
                                  answer2 = ?,
                                  answer3 = ?,
                                  answer4 = ?,
                                  answer5 = ?
                            WHERE id = ?";
        $query = $db->query($queryUserToken, [
            $data['question'],
            $data['answer1'],
            $data['answer2'],
            $data['answer3'],
            $data['answer4'],
            $data['answer5'],
            $data['id']
        ]);

        $queryUserToken = "UPDATE eec_kunjaw 
                              SET kunjaw = ?
                            WHERE id = ?";
        $query = $db->query($queryUserToken, [
            $data['kunjaw'], 
            $data['id']
        ]);
        
        return $db->error();
    }

    public function getHasilEEC()
    {
        $db = db_connect();
        $queryTeam = "SELECT team_id, answer,(SELECT DATE_SUB(time, INTERVAL 10 HOUR) FROM eec_answer ea_sub WHERE ea_sub.team_id = eec_answer.team_id ORDER BY time DESC LIMIT 1) as time,
                        (select team_name from team where team.id = eec_answer.team_id) as team_name, (SELECT CONCAT('{',GROUP_CONCAT(kunjas),'}') FROM (
                        SELECT CONCAT('\"',id,'\": \"',COALESCE(kunjaw,''),'\"') as kunjas FROM eec_kunjaw
                        ) as oneRowKunjaw) as kunjaw
                        FROM eec_answer group by team_id, answer ";
        $query = $db->query($queryTeam);
        return $query->getResultArray();
    }

    public function getjson()
    {
        $db = db_connect();
        $queryTeam = "SELECT *
                        FROM team
                       WHERE lomba_id = 4 
                         AND is_paid = 1";
        $query = $db->query($queryTeam);
        return $query->getResultArray();
    }
}
