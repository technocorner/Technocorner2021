<?php

namespace App\Models;

use CodeIgniter\Model;

class LombaModel extends Model
{

    public function getLomba($namaLomba = false)
    {
        if ($namaLomba == false) {
            $db = db_connect();
            $queryCust = "SELECT * FROM lomba";
            $query = $db->query($queryCust);
            $result = $query->getResultArray();
            return $result;
        }
        $db = db_connect();
        $queryCust = "SELECT * FROM lomba WHERE nama_lomba = ?";
        $query = $db->query($queryCust, $namaLomba);
        $result = $query->getRowArray();
        return $result;
    }
 public function getLombaById($lombaId)
    {
        $db = db_connect();
        $queryCust = "SELECT * FROM lomba
                        WHERE id = ?";
        $query = $db->query($queryCust, $lombaId);
        $result = $query->getRowArray();
        return $result;
    }
    public function getKategori($lombaId)
    {
        $db = db_connect();
        $queryCust = "SELECT * FROM lomba_kategori WHERE lomba_id = ?";
        $query = $db->query($queryCust, $lombaId);
        $result = $query->getRowArray();
        return $result;
    }

    public function getKontak($lombaId)
    {
        $db = db_connect();
        $queryCust = "SELECT * FROM lomba_kontak WHERE lomba_id = ?";
        $query = $db->query($queryCust, $lombaId);
        $result = $query->getResultArray();
        return $result;
    }

    public function getAgenda($lombaId)
    {
        $db = db_connect();
        $queryCust = "SELECT * FROM lomba_agenda WHERE lomba_id = ?";
        $query = $db->query($queryCust, $lombaId);
        $result = $query->getResultArray();
        return $result;
    }
    
    public function getRekening($lombaId)
    {
        $db = db_connect();
        $queryCust = "SELECT * FROM harga_daftar_rekening WHERE lomba_id = ?";
        $query = $db->query($queryCust, $lombaId);
        $result = $query->getRowArray();
        return $result;
    }
    
     public function getPetunjuk($lombaId)
    {
        $db = db_connect();
        $queryCust = "SELECT * FROM lomba_petunjuk WHERE lomba_id = ?";
        $query = $db->query($queryCust, $lombaId);
        $result = $query->getRowArray();
        return $result;
    }
    
     public function getJumlah($lombaId)
    {
        $db = db_connect();
        $queryCust = "SELECT COUNT(id) as jumlah FROM team WHERE lomba_id = ?";
        $query = $db->query($queryCust, $lombaId);
        $result = $query->getRowArray();
        return $result;
    }
    
    
}
