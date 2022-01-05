<?php

namespace App\Controllers;

use App\Models\AccessModel;
use App\Models\TeamModel;
use App\Models\UserModel;

class Admin extends BaseController
{

    public function index()
    {
        $teamModel = new TeamModel();
        $accessModel = new AccessModel();
        $userModel = new UserModel();
        if (session('role_id') != 1) {
            return redirect()->back();
        }
        $data = [
            'tes' => 'admin',
            'lomba' => $teamModel->teamLomba(session('id')),
            'pemberitahuan' => $userModel->getPemberitahuan(session('id')),
            'menu' => $accessModel->getAccessMenu(session('role_id'))
        ];


        return view('dashboard/main', $data);
    }


    //--------------------------------------------------------------------

}
