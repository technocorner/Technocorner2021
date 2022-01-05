<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name', 'email', 'password', 'asal_kampus', 'image', 'role_id', 'is_active', 'created_at', 'updated_at'
    ];

    public function getUser($userEmail = false)
    {
        if ($userEmail == false) {
            return $this->findAll();
        }

        return $this->where('email', $userEmail)->first();
    }

    public function getUserByEmail($userEmail = false)
    {
        return $this->where('email', $userEmail)->first();
    }

    public function setUserToken($data)
    {
        $db = db_connect();
        $queryUserToken = "INSERT INTO user_token VALUES ('', ?, ?, NULL)";
        $query = $db->query($queryUserToken, [$data['email'], $data['token']]);
    }

    public function getUserToken($token)
    {
        $db = db_connect();
        $queryUserToken = "SELECT * FROM user_token WHERE token = ? ORDER BY id DESC LIMIT 1";
        $query = $db->query($queryUserToken, $token);
        $result = $query->getRowArray();
        return $result;
    }

    public function updateUser($data)
    {
        $db = db_connect();
        $queryUserToken = "UPDATE users 
                              SET name = ?,
                                  email = ?,
                                  asal_kampus = ?,
                                  role_id = ?,
                                  is_active = ?
                            WHERE id = ?";
        $query = $db->query($queryUserToken, [
            $data['name'], $data['email'], $data['asal_kampus'], $data['role_id'], $data['is_active'], $data['id']
        ]);

        return $db->error();
    }

    public function deleteUser($data)
    {
        $db = db_connect();
        $queryUserToken = "DELETE FROM users 
                            WHERE id = ?";
        $query = $db->query($queryUserToken, [$data['id']]);

        return $db->error();
    }

    public function setUserResetToken($data)
    {
        $db = db_connect();
        $queryUserToken = "UPDATE user_token
                              SET resetToken=?
                            WHERE email=?";
        $query = $db->query($queryUserToken, [$data['token'], $data['email']]);
    }

    public function getUserResetToken($data)
    {
        $db = db_connect();
        $queryUserToken = "SELECT * FROM user_token WHERE email = ? AND resetToken = ?";
        $query = $db->query($queryUserToken, [$data['email'], $data['token']]);
        $result = $query->getResultArray();
        return $result;
    }

    public function getPemberitahuan($userId)
    {
        $db = db_connect();
        $queryCust = "SELECT * FROM pemberitahuan
                        JOIN user_pemberitahuan
                        ON pemberitahuan.id = user_pemberitahuan.pemberitahuan_id
                        WHERE user_pemberitahuan.user_id = ? ORDER BY pemberitahuan.id DESC";
        $query = $db->query($queryCust, $userId);
        $result = $query->getResultArray();
        return $result;
    }

    public function updateProfile($data)
    {
        $db = db_connect();
        $queryCust = "UPDATE users 
                        SET name = ?,
                            asal_kampus = ?,
                            image = ?
                        WHERE id = ?";
        $query = $db->query($queryCust, [$data['name'], $data['asal_kampus'], $data['image'], session('id')]);

        return $db->error();
    }
}
