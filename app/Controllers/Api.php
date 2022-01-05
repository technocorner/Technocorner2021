<?php

namespace App\Controllers;

use App\Models\ApiModel;
use CodeIgniter\API\ResponseTrait;

class Api extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        echo 'Selamat datang di layanan api technocorner';
    }
    
    public function getQuestion()
    {
        $apiModel = new ApiModel();
        if ($this->request->getMethod() == 'post') {
            return $this->respond($apiModel->getQuestion(), 200);
        }
    }
    
    public function saveAnswer()
    {

        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Disposition, Content-Type, Content-Length, Accept-Encoding");
        header("Content-type:application/json");
        
        if ($this->request->getMethod() == 'post') {
            $data = json_decode(file_get_contents("php://input"));
            $apiModel = new ApiModel();
            
            return $this->respond($apiModel->saveAnswer($data), 200);
        }
    }


    //--------------------------------------------------------------------

}