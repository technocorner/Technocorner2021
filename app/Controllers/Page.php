<?php

namespace App\Controllers;

use App\Models\AccessModel;
use App\Models\TeamModel;
use App\Models\UserModel;

class Page extends BaseController
{

    public function index()
    {
        return view('landing/home');
    }

    public function transporter()
    {
        $data = [
            'title' => 'Transporter Competition | Technocorner 2021'
            ];
        return view('landing/competition/transporter', $data);
    }

    public function linefollower()
    {
        $data = [
            'title' => 'Line Follower Competition | Technocorner 2021'
            ];
        return view('landing/competition/line', $data);
    }

    public function iot()
    {
        $data = [
            'title' => 'Iot Dev Competition | Technocorner 2021'
            ];
        return view('landing/competition/iot', $data);
    }

    public function eec()
    {
        $data = [
            'title' => 'Electronic Engineering Competition | Technocorner 2021'
            ];
        return view('landing/competition/eec', $data);
    }

    public function gallery()
    {
        $data = [
            'title' => 'Gallery | Technocorner 2021'
            ];
        return view('landing/gallery', $data);
    }


    public function webinar()
    {
        $data = [
            'title' => 'Webinar Nasional | Technocorner 2021'
            ];
        return view('landing/competition/webinar', $data);
    }

    public function workshop()
    {
        $data = [
            'title' => 'Workshop | Technocorner 2021'
            ];
        return view('landing/competition/workshop', $data);
    }

    //--------------------------------------------------------------------

}
