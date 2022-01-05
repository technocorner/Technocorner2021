<?php

namespace App\Models;

use CodeIgniter\Model;

class AccessModel extends Model
{
    protected $table      = 'lomba';
    protected $primaryKey = 'id';

    public function getAccessMenu($userId)
    {
        $db = db_connect();
        $queryCust = "SELECT menu.menu, menu.title, menu.url, menu.icon
                        FROM menu INNER JOIN user_access ON menu.id = user_access.menu_id
                        WHERE user_access.role_id = ?";
        $query = $db->query($queryCust, $userId);
        $result = $query->getResultArray();
        return $result;
    }
}
