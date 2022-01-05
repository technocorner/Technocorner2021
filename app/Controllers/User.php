<?php

namespace App\Controllers;

use App\Models\AccessModel;
use App\Models\TeamModel;
use App\Models\UserModel;
use App\Models\LombaModel;
use CodeIgniter\API\ResponseTrait;

class User extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        if (session('role_id') != 2) {
            return redirect()->back();
        }
        $userModel = new UserModel();
        $accessModel = new AccessModel();
        $teamModel = new TeamModel();
        $data = [
            'css' => array(base_url('assets/css/main-dashboard.css')),
            'tes' => 'User',
            'lomba' => $teamModel->teamLomba(session('id')),
            'pemberitahuan' => $userModel->getPemberitahuan(session('id')),
            'menu' => $accessModel->getAccessMenu(session('role_id'))
        ];

        return view('dashboard/main', $data);
    }

    public function profileTeam()
    {
        $teamModel = new TeamModel();
        $accessModel = new AccessModel();
        $lombaModel = new LombaModel();
        if ($this->request->getMethod() == 'post') {


            $file = $this->request->getFiles();
            $imageFileName = false;
            $validatedFile1 = $this->validate([
                'bukti' => [
                    'rules' => 'max_size[bukti, 10240]|is_image[bukti]',
                    'errors' => [
                        'max_size' => 'Ukuran file terlalu besar',
                        'is_image' => 'Mohon masukkan format file yang valid'
                    ]
                ]
            ]);
            if (!empty($file['bukti']->getClientName())) {
                if (!$validatedFile1) {
                    $validation =  \Config\Services::validation();
                    $this->session->setFlashdata('errors', $validation->getErrors());
                    return redirect()->back()->withInput();
                }

                $imageExtension = $file['bukti']->guessExtension();
                $imageFileName = $this->request->getPost('team_id') . '_' . $this->request->getPost('team_name') . '.' . $imageExtension;

                $get_file = ROOTPATH . '../public_html/uploads/team/image_payment/' . $imageFileName;
                if (file_exists($get_file)) {
                    unlink($get_file);
                }


                $file['bukti']->move(ROOTPATH . '../public_html/uploads/team/image_payment/', $imageFileName);

                $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Bukti pembayaran telah dikirim. Silahkan tunggu konfirmasi.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>');
            }

            // if ($validatedFile2['ktm']) {
            //     $tes = '';
            //     foreach ($file['ktm'] as $f) {
            //         $tes .= $f->getClientName;
            //         $f->move(ROOTPATH . 'public/uploads/team/member_team');
            //     }
            // }

            $data = [
                'team_name' => $this->request->getPost('team_name'),
                'institusi' => $this->request->getPost('institusi'),
                // 'team' => $teamModel->getTeam(session('id'))
                // 'member_team' => $teamModel->getMemberTeam(session('id'))
            ];

            $teamModel->updateTeam($data, $imageFileName);



            return redirect()->to(base_url('/menu/dashboard'));
        }
        $team = $teamModel->getTeam(session('id'));
        $data = [
            'css' => array(base_url('/frontend/akun/dashboard/events/Regist/css/form.css')),
            'team' => $team,
            'member_team' => $teamModel->getMemberTeam(session('id')),
            'menu' => $accessModel->getAccessMenu(session('role_id')),
            'lomba' => $lombaModel->getLombaById($team['lomba_id'])
        ];
        // $data['title'] = 'my page title';

        // $this->load->view('head', $data);
        return view('dashboard/menu/profile_team', $data);
    }

    public function profileTeam2()
    {
        $teamModel = new TeamModel();
        $accessModel = new AccessModel();
        $userModel = new UserModel();
        $data = [
            'css' => array(base_url('/assets/css/profile-team.css')),
            'user' => $userModel->getUser(session('email')),
            'menu' => $accessModel->getAccessMenu(session('role_id'))
        ];


        return view('dashboard/menu/profile_team2', $data);
    }
    //--------------------------------------------------------------------

    public function deleteTeam()
    {
        $teamModel = new TeamModel();
        if ($this->request->getMethod() == 'post') {
            $data = [
                'user_id' => $this->request->getPost('userId'),
                'team_id' => $this->request->getPost('teamId'),
                'image_payment' => $this->request->getPost('imagePayment'),
                'ktm_member' => $this->request->getPost('ktmMember')
            ];
            $get_file = ROOTPATH . '../public_html/uploads/team/image_payment/' . $data['image_payment'];
            if (file_exists($get_file)) {
                unlink($get_file);
            }
            foreach ($data['ktm_member'] as $key => $val) {
                $get_file = ROOTPATH . '../public_html/uploads/team/member_team/' . $val;
                if (file_exists($get_file)) {
                    unlink($get_file);
                }
            }
            $result1 = $teamModel->deleteMemberTeamByTeam($data['team_id']);
            $result = $teamModel->deleteTeam($data['user_id']);
            return $this->respondDeleted(json_encode($result));
        }
    }

    public function editMemberTeam()
    {
        $teamModel = new TeamModel();
        $accessModel = new AccessModel();
        if ($this->request->getMethod() == 'post') {
            // dd($this->request->getPost());

            $file = $this->request->getFiles();

            $data = [
                'name' => $this->request->getPost('member_name'),
                'team_id' => $this->request->getPost('team_id'),
                'id' => $this->request->getPost('member_id'),
                'image' => $this->request->getPost('member_image')
            ];

            $image = $file['member_ktm']->getClientName();
            $imageExtension = $file['member_ktm']->guessExtension();
            $imageFileName = $data['team_id'] . '_' . $data['name'] . '.' . $imageExtension;

            $get_file = ROOTPATH . 'public/uploads/team/member_team/' . $imageFileName;
            if (file_exists($get_file)) {
                unlink($get_file);
            }

            $validatedFile = $this->validate([
                'member_ktm' => 'uploaded[member_ktm]|max_size[member_ktm, 10240]'
            ]);

            if ($validatedFile) {
                $file['member_ktm']->move(ROOTPATH . 'public/uploads/team/member_team', $imageFileName);
            }

            $result = $teamModel->editMemberTeam($data, $imageFileName);
            return $this->respondCreated(json_encode($result));
        }
    }

    public function deleteMemberTeam()
    {
        $teamModel = new TeamModel();
        $accessModel = new AccessModel();
        if ($this->request->getMethod() == 'post') {
            $data = [
                'team_id' => $this->request->getPost('team_id'),
                'member_id' => $this->request->getPost('member_id'),
            ];

            $result = $teamModel->deleteMemberTeam($data);
            return $this->respondDeleted(json_encode($result));
            // return $this->respondCreated(json_encode($result));
        }
    }

    public function addMember()
    {
        $teamModel = new TeamModel();
        $accessModel = new AccessModel();
        if ($this->request->getMethod() == 'post') {
            $file = $this->request->getFiles();

            $team_id = $this->request->getPost('team_id');
            $member_name = $this->request->getPost('member_name');

            $imageExtension = $file['member_ktm']->guessExtension();
            $imageFileName = $team_id . '_' . $member_name . '.' . $imageExtension;

            $data = [
                'team_id' => $team_id,
                'member_name' => $member_name,
                'ktm' => $imageFileName
            ];

            $validatedFile1 = $this->validate([
                'member_ktm' => 'uploaded[member_ktm]|max_size[member_ktm, 10240]',
            ]);

            if ($validatedFile1) {
                $file['member_ktm']->move(ROOTPATH . 'public/uploads/team/member_team', $imageFileName);
            }

            $teamModel->addMemberTeam($data);
            return redirect()->to(base_url('/user/profileTeam'));
        }

        $data = [
            'team' => $teamModel->getTeam(session('id')),
            'menu' => $accessModel->getAccessMenu(session('role_id'))
        ];
        // $data['title'] = 'my page title';

        // $this->load->view('head', $data);
        return view('dashboard/menu/add_member', $data);
    }
}
