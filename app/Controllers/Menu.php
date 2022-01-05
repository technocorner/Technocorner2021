<?php

namespace App\Controllers;

use App\Models\AccessModel;
use App\Models\UserModel;
use App\Models\AdminModel;
use App\Models\LombaModel;
use App\Models\TeamModel;
use CodeIgniter\API\ResponseTrait;

class Menu extends BaseController
{
    use ResponseTrait;

    public function test()
    {
        return view('email/pembayaran');
    }
    public function dashboard()
    {

        $accessModel = new AccessModel();
        $userModel = new UserModel();
        $teamModel = new TeamModel();
        $data = [
            'css' => array(base_url('assets/css/main-dashboard.css')),
            'tes' => 'admin',
            'pemberitahuan' => $userModel->getPemberitahuan(session('id')),
            'menu' => $accessModel->getAccessMenu(session('role_id')),
            'lomba' => $teamModel->teamLomba(session('id'))
        ];


        return view('dashboard/main', $data);
    }

    public function manageUser()
    {
        if (session('role_id') != 1) {
            return redirect()->back();
        }

        $userModel = new UserModel();
        $user_list = $userModel->getUser();
        $accessModel = new AccessModel();

        $data = [
            'tes' => 'admin',
            'menu' => $accessModel->getAccessMenu(session('role_id'))
        ];

        return view('dashboard/menu/manage_user', $data);
    }

    public function getAllUser()
    {
        if (session('role_id') != 1) {
            return redirect()->back();
        }

        $userModel = new UserModel();
        $user_list = $userModel->getUser();

        return $this->respond(json_encode($user_list));
    }

    public function update()
    {
        if (session('role_id') != 1) {
            return redirect()->back();
        }

        $data = [
            'id' => $this->request->getPost('id'),
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'asal_kampus' => $this->request->getPost('asal_kampus'),
            'role_id' => $this->request->getPost('role_id'),
            'is_active' => $this->request->getPost('is_active'),
        ];

        $userModel = new UserModel();
        $result = $userModel->updateUser($data);

        return $this->respondCreated(json_encode($result));
    }

    public function delete()
    {
        if (session('role_id') != 1) {
            return redirect()->back();
        }

        $data = [
            'id' => $this->request->getPost('id'),
            'name' => $this->request->getPost('name'),
        ];

        $userModel = new UserModel();
        $result = $userModel->deleteUser($data);

        return $this->respondDeleted(json_encode($result));
    }


    public function manageTeam()
    {
        $accessModel = new AccessModel();
        $adminModel = new AdminModel();
        if (session('role_id') != 1) {
            return redirect()->back();
        }

        $id = '';
        $lomba = $this->request->getGet('lomba');
        switch ($lomba) {
            case 'linefollower':
                $id = 1;
                break;
            case 'transporter':
                $id = 2;
                break;
            case 'eec':
                $id = 4;
                break;
            case 'iot':
                $id = 3;
                break;
            default:
                break;
        }


        $data = [
            'tes' => 'admin',
            'lomba' => $lomba,
            'lomba_id' => $id,
            'menu' => $accessModel->getAccessMenu(session('role_id'))
        ];

        return view('dashboard/menu/manage_team', $data);
    }

    public function getAllTeam()
    {
        if (session('role_id') != 1) {
            return redirect()->back();
        }

        $lomba_id = $this->request->getPost('lomba_id');

        $adminModel = new AdminModel();
        $team_list = $adminModel->getTeam($lomba_id);

        return $this->respond(json_encode($team_list));
    }

    public function getTeamMember()
    {
        if (session('role_id') != 1) {
            return redirect()->back();
        }
        $team_id = $this->request->getPost('team_id');

        $adminModel = new AdminModel();
        $team_member = $adminModel->getTeamMember($team_id);

        return $this->respond(json_encode($team_member));
    }

    public function updateTeam()
    {
        if (session('role_id') != 1) {
            return redirect()->back();
        }

        $data = [
            'team_id' => $this->request->getPost('team_id'),
            'is_paid' => $this->request->getPost('is_paid'),
        ];

        $adminModel = new AdminModel();
        $result = $adminModel->updateTeam($data);

        return $this->respondCreated(json_encode($data));
    }

    public function daftarRobotik()
    {
        return redirect()->back();
        // $teamModel = new TeamModel();
        // $accessModel = new AccessModel();
        // $data = [
        //     'css' => array(base_url('/frontend/akun/dashboard/events/Regist/css/form.css')),
        //     'menu' => $accessModel->getAccessMenu(session('role_id')),
        //     'validation' => \Config\Services::validation()
        // ];
        // // Cek apakah user telah membuat team
        // if ($this->_isHaveTeam(session('id'))) {
        //     return redirect()->back();
        // }

        // if ($this->request->getMethod() == 'post') {
        //      $rules = [
        //         'team_name' => [
        //             'rules' => 'required',
        //             'errors' => [
        //                 'required' => 'Nama tim tidak boleh kosong'
        //             ]
        //         ],
        //         'institusi' => [
        //             'rules' => 'required',
        //             'errors' => [
        //                 'required' => 'Asal instansi tidak boleh kosong'
        //             ]
        //         ],
        //         'name.*' => [
        //             'rules' => 'required',
        //             'errors' => [
        //                 'required' => 'Nama anggota tim tidak boleh ada yang kosong'
        //             ]
        //         ],
        //         'ktm.*' => [
        //             'rules' => 'uploaded[ktm]|max_size[ktm,10240]|is_image[ktm]',
        //             'errors' => [
        //                 'uploaded' => 'Foto KTM tidak boleh ada yang kosong',
        //                 'max_size' => 'Ukuran file terlalu besar (max 10MB)',
        //                 'is_image' => 'Mohon masukkan format file yang valid (png, jpg, jpeg)'
        //             ]
        //         ],
        //         'lomba' => [
        //             'rules' => 'required',
        //             'errors' => [
        //                 'required' => 'Cabang lomba tidak boleh kosong'
        //             ]
        //         ],
        //         'kontak' => [
        //             'rules' => 'required',
        //             'errors' => [
        //                 'required' => 'Kontak tidak boleh kosong'
        //             ]
        //         ],
        //         // 'twibbon.*' => [
        //         //     'rules' => 'required',
        //         //     'errors' => [
        //         //         'required' => 'Link twibbon tidak boleh ada yang kosong'
        //         //     ]
        //         // ]
        //     ];
        //     // validasi input
        //     if (!$this->validate($rules)) {
        //         $validation =  \Config\Services::validation();
        //         $this->session->setFlashdata('errors', $validation->getErrors());
        //         return redirect()->back()->withInput();
        //     }
        //     $dataTeam = [
        //         'user_id' => session('id'),
        //         'lomba_id' =>  $this->request->getPost('lomba'),
        //         'team_name' => htmlspecialchars(trim($this->request->getPost('team_name'))),
        //         'institusi' => htmlspecialchars($this->request->getPost('institusi')),
        //         'kontak' => htmlspecialchars($this->request->getPost('kontak')),
        //         'image_payment' => '',
        //         'is_paid' => 0
        //     ];
        //     // insert data team
        //     $teamModel->createTeam($dataTeam);
        //     $team = $teamModel->getTeam(session('id'));

        //     $file = $this->request->getFiles();
        //     foreach ($file['ktm'] as $key => $f) {
        //         $image = $f->getClientName();
        //         $imageExtension = $f->guessExtension();
        //         $imageFileName = $team['id'] . '_' . $_POST['name'][$key] . '.' . $imageExtension;
        //         $f->move(ROOTPATH . '../public_html/uploads/team/member_team', $imageFileName);

        //         $member[] = array(
        //             'team_id' => $team['id'],
        //             'name' => htmlspecialchars(trim($_POST['name'][$key])),
        //             'image' => '',
        //             'ktm' => $imageFileName
        //         );
        //     }

        //     // insert data member team
        //     $teamModel->createMultipleMember($member);

        //     // kirim email

        //     $message = view('email/pembayaran');
        //     $this->_sendEmail(session('email'), 'Terima kasih telah mendaftar', $message);

        //     $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        //     Pendaftaran berhasil. Segera lakukan pembayaran.
        //     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        //       <span aria-hidden="true">&times;</span>
        //     </button>
        //   </div>');

        //     return redirect()->to(base_url('menu/dashboard'));
        // }

        // return view('dashboard/menu/daftar_robotik', $data);
    }

    public function daftar($namaLomba)
    {
        
        $lombaModel = new LombaModel();
        $teamModel = new TeamModel();
        $accessModel = new AccessModel();
        $data = [
            'menu' => $accessModel->getAccessMenu(session('role_id')),
            'css' => array(base_url('/frontend/akun/dashboard/events/Regist/css/form.css')),
            'lomba' => $lombaModel->getLomba($namaLomba),
            'validation' => \Config\Services::validation()
        ];

        // cek apakah user telah membuat team
        if ($this->_isHaveTeam(session('id')) || empty(($data['lomba']))) {
            return redirect()->back();
        }
        if ($this->request->getMethod() == 'post') {

            $rules = [
                'team_name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama tim tidak boleh kosong'
                    ]
                ],
                'institusi' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Asal instansi tidak boleh kosong'
                    ]
                ],
                'name.*' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama anggota tim tidak boleh ada yang kosong'
                    ]
                ],
                'ktm.*' => [
                    'rules' => 'uploaded[ktm]|max_size[ktm,10240]|is_image[ktm]',
                    'errors' => [
                        'uploaded' => 'Foto KTM tidak boleh ada yang kosong',
                        'max_size' => 'Ukuran file terlalu besar (max 10MB)',
                        'is_image' => 'Mohon masukkan format file yang valid (png, jpg, jpeg)'
                    ]
                ],
                'kontak' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kontak tidak boleh kosong'
                    ]
                ],
                // 'twibbon.*' => [
                //     'rules' => 'required',
                //     'errors' => [
                //         'required' => 'Link twibbon tidak boleh ada yang kosong'
                //     ]
                // ]
            ];
            // validasi input
            if (!$this->validate($rules)) {

                $validation =  \Config\Services::validation();

                $this->session->setFlashdata('errors', $validation->getErrors());
                return redirect()->back()->withInput();
            }
            $dataTeam = [
                'user_id' => session('id'),
                'lomba_id' =>  $data['lomba']['id'],
                'team_name' => htmlspecialchars(trim($this->request->getPost('team_name'))),
                'institusi' => htmlspecialchars($this->request->getPost('institusi')),
                'kontak' => htmlspecialchars($this->request->getPost('kontak')),
                'image_payment' => '',
                'is_paid' => 0
            ];
            $teamModel->createTeam($dataTeam);
            $team = $teamModel->getTeam(session('id'));

            $file = $this->request->getFiles();
            foreach ($file['ktm'] as $key => $f) {
                $image = $f->getClientName();
                $imageExtension = $f->guessExtension();
                $imageFileName = $team['id'] . '_' . $_POST['name'][$key] . '.' . $imageExtension;
                $f->move(ROOTPATH . '../public_html/uploads/team/member_team', $imageFileName);

                $member[] = array(
                    'team_id' => $team['id'],
                    'name' => htmlspecialchars(trim($_POST['name'][$key])),
                    'image' => htmlspecialchars(trim($_POST['twibbon'][$key])),
                    'ktm' => $imageFileName
                );
            }


            // input member team
            $teamModel->createMultipleMember($member);
            // kirim email
            $message = view('email/pembayaran');
            $this->_sendEmail(session('email'), 'Terima kasih telah mendaftar', $message);

            $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Pendaftaran berhasil. Segera lakukan pembayaran.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>');

            return redirect()->to(base_url('/menu/dashboard'));
        }
        return view('dashboard/menu/daftar_eec', $data);
    }
    
     public function daftareec($namaLomba)
    {
        $lombaModel = new LombaModel();
        $teamModel = new TeamModel();
        $accessModel = new AccessModel();
        $data = [
            'menu' => $accessModel->getAccessMenu(session('role_id')),
            'css' => array(base_url('/frontend/akun/dashboard/events/Regist/css/form.css')),
            'lomba' => $lombaModel->getLomba($namaLomba),
            'validation' => \Config\Services::validation()
        ];

        // cek apakah user telah membuat team
        if ($this->_isHaveTeam(session('id')) || empty(($data['lomba']))) {
            return redirect()->back();
        }
        if ($this->request->getMethod() == 'post') {

            $rules = [
                'team_name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama tim tidak boleh kosong'
                    ]
                ],
                'institusi' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Asal instansi tidak boleh kosong'
                    ]
                ],
                'name.*' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama anggota tim tidak boleh ada yang kosong'
                    ]
                ],
                'ktm.*' => [
                    'rules' => 'uploaded[ktm]|max_size[ktm,10240]|is_image[ktm]',
                    'errors' => [
                        'uploaded' => 'Foto KTM tidak boleh ada yang kosong',
                        'max_size' => 'Ukuran file terlalu besar (max 10MB)',
                        'is_image' => 'Mohon masukkan format file yang valid (png, jpg, jpeg)'
                    ]
                ],
                'kontak' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kontak tidak boleh kosong'
                    ]
                ],
                // 'twibbon.*' => [
                //     'rules' => 'required',
                //     'errors' => [
                //         'required' => 'Link twibbon tidak boleh ada yang kosong'
                //     ]
                // ]
            ];
            // validasi input
            if (!$this->validate($rules)) {

                $validation =  \Config\Services::validation();

                $this->session->setFlashdata('errors', $validation->getErrors());
                return redirect()->back()->withInput();
            }
            $dataTeam = [
                'user_id' => session('id'),
                'lomba_id' =>  $data['lomba']['id'],
                'team_name' => htmlspecialchars(trim($this->request->getPost('team_name'))),
                'institusi' => htmlspecialchars($this->request->getPost('institusi')),
                'kontak' => htmlspecialchars($this->request->getPost('kontak')),
                'image_payment' => '',
                'is_paid' => 0
            ];
            $teamModel->createTeam($dataTeam);
            $team = $teamModel->getTeam(session('id'));

            $file = $this->request->getFiles();
            foreach ($file['ktm'] as $key => $f) {
                $image = $f->getClientName();
                $imageExtension = $f->guessExtension();
                $imageFileName = $team['id'] . '_' . $_POST['name'][$key] . '.' . $imageExtension;
                $f->move(ROOTPATH . '../public_html/uploads/team/member_team', $imageFileName);

                $member[] = array(
                    'team_id' => $team['id'],
                    'name' => htmlspecialchars(trim($_POST['name'][$key])),
                    'image' => htmlspecialchars(trim($_POST['twibbon'][$key])),
                    'ktm' => $imageFileName
                );
            }


            // input member team
            $teamModel->createMultipleMember($member);
            // kirim email
            $message = view('email/pembayaran');
            $this->_sendEmail(session('email'), 'Terima kasih telah mendaftar', $message);

            $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Pendaftaran berhasil. Segera lakukan pembayaran.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>');

            return redirect()->to(base_url('/menu/dashboard'));
        }
        return view('dashboard/menu/daftar_eec', $data);
    }
    
    public function daftarIot()
    {
        return redirect()->back();
        // $lombaModel = new LombaModel();
        // $teamModel = new TeamModel();
        // $adminModel = new AdminModel();
        // $accessModel = new AccessModel();
        // $data = [
        //     'menu' => $accessModel->getAccessMenu(session('role_id')),
        //     'css' => array(base_url('/frontend/akun/dashboard/events/Regist/css/form.css')),
        //     'lomba' => $lombaModel->getLomba('iot'),
        //     'validation' => \Config\Services::validation()
        // ];

        // // cek apakah user telah membuat team
        // if ($this->_isHaveTeam(session('id'))) {
        //     return redirect()->back();
        // }
        // if ($this->request->getMethod() == 'post') {
        //     $rules = [
        //         'team_name' => [
        //             'rules' => 'required',
        //             'errors' => [
        //                 'required' => 'Nama tim tidak boleh kosong'
        //             ]
        //         ],
        //         'institusi' => [
        //             'rules' => 'required',
        //             'errors' => [
        //                 'required' => 'Asal instansi tidak boleh kosong'
        //             ]
        //         ],
        //         'name.*' => [
        //             'rules' => 'required',
        //             'errors' => [
        //                 'required' => 'Nama anggota tidak boleh ada yang kosong'
        //             ]
        //         ],
        //         'ktm.*' => [
        //             'rules' => 'uploaded[ktm]|max_size[ktm,10240]|is_image[ktm]',
        //             'errors' => [
        //                 'uploaded' => 'Foto KTM tidak boleh ada yang kosong',
        //                 'max_size' => 'Ukuran file terlalu besar (max 10MB)',
        //                 'is_image' => 'Mohon masukkan gambar (png, jpg, jpeg)'
        //             ]
        //         ],
        //         'twibbon.*' => [
        //             'rules' => 'required',
        //             'errors' => [
        //                 'required' => 'Link twibbon tidak boleh ada yang kosong'
        //             ]
        //         ],
        //         'kontak' => [
        //             'rules' => 'required',
        //             'errors' => [
        //                 'required' => 'Kontak tidak boleh kosong'
        //             ]
        //         ]
        //     ];
        //     // validasi input
        //     if (!$this->validate($rules)) {

        //         $validation =  \Config\Services::validation();
        //         $this->session->setFlashdata('errors', $validation->getErrors());
        //         return redirect()->back()->withInput();
        //     }



        //      $dataTeam = [
        //         'user_id' => session('id'),
        //         'lomba_id' =>  $data['lomba']['id'],
        //         'team_name' => htmlspecialchars(trim($this->request->getPost('team_name'))),
        //         'institusi' => htmlspecialchars($this->request->getPost('institusi')),
        //         'kontak' => htmlspecialchars($this->request->getPost('kontak')),
        //         'image_payment' => '',
        //         'is_paid' => 0
        //     ];
        //     $teamModel->createTeam($dataTeam);
        //     $team = $teamModel->getTeam(session('id'));
        //     $file = $this->request->getFiles();
        //     foreach ($file['ktm'] as $key => $f) {
        //         $image = $f->getClientName();
        //         $imageExtension = $f->guessExtension();
        //         $imageFileName = $team['id'] . '_' . $_POST['name'][$key] . '.' . $imageExtension;
        //         $f->move(ROOTPATH . '../public_html/uploads/team/member_team', $imageFileName);

        //         $member[] = array(
        //             'team_id' => $team['id'],
        //             'name' => htmlspecialchars(trim($_POST['name'][$key])),
        //             'image' => htmlspecialchars(trim($_POST['twibbon'][$key])),
        //             'ktm' => $imageFileName
        //         );
        //     }
        //     // input member team
        //     $teamModel->createMultipleMember($member);

        //     // Make announcement
        //     $data_pemberitahuan = [
        //         'judul' => 'Segera Kirim Proposal',
        //         'isi' => 'Harap bagi peserta IOT competition untuk mengirim proposal ke iottechnocorner21@gmail.com',
        //         'type' => 1,
        //         'identity' => array(session('id'))
        //     ];
        //     $adminModel->addPemberitahuan($data_pemberitahuan);
        //     // kirim email
        //     $message = view('email/pembayaran');
        //     $message2 = view('email/proposal');
        //     // $this->_sendEmail(session('email'), 'Terima kasih telah mendaftar', $message);
        //     $this->_sendEmail(session('email'), 'Terima kasih telah mendaftar', $message2);

        //     $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        //         Pendaftaran berhasil. Segera kirim proposal.
        //         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        //           <span aria-hidden="true">&times;</span>
        //         </button>
        //       </div>');

        //     return redirect()->to(base_url('/menu/dashboard'));
        // }
        // return view('dashboard/menu/daftar_iot', $data);
    }
    private function _isHaveTeam($userId)
    {
        $teamModel = new TeamModel();
        return $teamModel->getTeam($userId);
    }

    private function _sendEmail($to, $subject, $message)
    {
        $email = \Config\Services::email();

        $email->setFrom('softwebtc21@technocornerugm.com', 'technocorner2021');
        $email->setTo($to);
        $email->setSubject($subject);
        $email->setMessage($message);

        if (!$email->send()) {
            return false;
        } else {
            return true;
        }
    }


    public function managePemberitahuan()
    {
        $accessModel = new AccessModel();
        if (session('role_id') != 1) {
            return redirect()->back();
        }
        $data = [
            'menu' => $accessModel->getAccessMenu(session('role_id'))
        ];

        return view('dashboard/menu/manage_pemberitahuan', $data);
    }
    
    public function manageEEC()
    {
        $accessModel = new AccessModel();
        if (session('role_id') != 3) {
            return redirect()->back();
        }
        $data = [
            'menu' => $accessModel->getAccessMenu(session('role_id'))
        ];

        return view('dashboard/menu/manage_eec', $data);
    }

    
    public function manageEECAnswer()
    {
        $accessModel = new AccessModel();
        if (session('role_id') != 3) {
            return redirect()->back();
        }
        $data = [
            'menu' => $accessModel->getAccessMenu(session('role_id'))
        ];

        // $adminModel = new AdminModel();
        // $hasil = $adminModel->getHasilEEC();
        // echo '<pre>';
        // print_r($hasil);
        // die;
        return view('dashboard/menu/manage_eec_answer', $data);
    }

    public function getUserAutocomplete()
    {
        if (session('role_id') != 1) {
            return redirect()->back();
        }

        $term = $this->request->getPost('term');

        $adminModel = new adminModel();
        $user_list = $adminModel->getUser($term);

        echo json_encode($user_list);
    }

    public function addPemberitahuan()
    {
        if (session('role_id') != 1) {
            return redirect()->back();
        }


        $data = [
            'type' => $this->request->getPost('type'),
            'judul' => $this->request->getPost('judul'),
            'isi' => $this->request->getPost('isi'),
            'identity' => $this->request->getPost('identity')
        ];


        $adminModel = new adminModel();
        $result = $adminModel->addPemberitahuan($data);

        return $this->respondCreated(json_encode($result));
    }

    public function getListPemberitahuan()
    {
        if (session('role_id') != 1) {
            return redirect()->back();
        }

        $adminModel = new adminModel();
        $result = $adminModel->getListPemberitahuan();

        return $this->respondCreated(json_encode($result));
    }

    public function deletePemberitahuan()
    {
        if (session('role_id') != 1) {
            return redirect()->back();
        }

        $id = $this->request->getPost('id');

        $adminModel = new adminModel();
        $result = $adminModel->deletePemberitahuan($id);

        return $this->respondCreated(json_encode($result));
    }

    public function competition($lomba)
    {
        $accessModel = new AccessModel();
        $lombaModel = new LombaModel();
        $lomba = $lombaModel->getLomba($lomba);

        $data = [
            'lomba' => $lomba,
            'menu' => $accessModel->getAccessMenu(session('role_id')),
            'have_team' => $this->_isHaveTeam(session('id')),
            'agenda' => $lombaModel->getAgenda($lomba['id']),
            'kontak' => $lombaModel->getKontak($lomba['id']),
            'kategori' => $lombaModel->getKategori($lomba['id']),
            'rekening' => $lombaModel->getRekening($lomba['id']),
            'petunjuk' => $lombaModel->getPetunjuk($lomba['id']),
            'total' => $lombaModel->getJumlah($lomba['id'])
        ];
        return view('dashboard/menu/lomba', $data);
    }

    public function event($event)
    {
        $accessModel = new AccessModel();
        $data = [
            'menu' => $accessModel->getAccessMenu(session('role_id'))
        ];
        if ($event == 'workshop') {
            return view('dashboard/menu/workshop', $data);
        } else if ($event == 'webinar') {
            return view('dashboard/menu/webinar', $data);
        }
    }
    public function profilteam()
    {
        $teamModel = new TeamModel();
        $data = [
            'team' => $teamModel->getTeam(session('id')),
            'member_team' => $teamModel->getMemberTeam(session('id'))
        ];

        return view('dashboard/menu/profile_team', $data);
    }

    public function profile()
    {
        $accessModel = new AccessModel();
        $userModel = new UserModel();

        if ($this->request->getMethod() == 'post') {
            $user = $userModel->getUser(session('email'));
            $rules = [
                'image' => [
                    'rules' => 'max_size[image,1024]|is_image[image]',
                    'errors' => [
                        'max_size' => 'Ukuran file terlalu besar',
                        'is_image' => 'File yang di upload harus berupa gambar (png, jpg, jpeg)'
                    ]
                ]
            ];

            $file = $this->request->getFile('image');
            if (!empty($file->getClientName())) {
                if (!$this->validate($rules)) {
                    $validation =  \Config\Services::validation();
                    $this->session->setFlashdata('errors', $validation->getErrors());
                    return redirect()->back();
                    
                }
                $get_file = ROOTPATH . '../public_html/uploads/user/' . session('image');
                if (file_exists($get_file)) {
                    unlink($get_file);
                }
                $image = $file->getClientName();
                $imageExtension = $file->guessExtension();
                $imageFileName = session('id') . '_' . session('name') . '.' . $imageExtension;
                $file->move(ROOTPATH . '../public_html/uploads/user', $imageFileName);
            }

            $data = [
                'name' => htmlspecialchars(trim($this->request->getPost('name'))),
                'asal_kampus' => htmlspecialchars(trim($this->request->getPost('asal_kampus'))),
                'image' => ($file->getClientName()) ? $imageFileName : $user['image']
            ];

            $userModel->updateProfile($data);
            $this->session->set($data);
        }

        $data = [
            'user' => $userModel->getUser(session('email')),
            'menu' => $accessModel->getAccessMenu(session('role_id')),
            'validation' => \Config\Services::validation()
        ];

        return view('dashboard/menu/profile', $data);
    }

    public function updateProfile()
    {
        $userModel = new UserModel();
        $user = $userModel->getUser(session('email'));
        $validatedFile = $this->validate([
            'image' => 'uploaded[image]|max_size[image,50]'
        ]);

        $file = $this->request->getFile('image');

        if ($validatedFile) {
            $file->move(ROOTPATH . '../public_html/uploads/user');
        }
        $data = [
            'name' => htmlspecialchars(trim($this->request->getPost('name'))),
            'asal_kampus' => htmlspecialchars(trim($this->request->getPost('asal_kampus'))),
            'image' => ($file->getClientName()) ? $file->getClientName() : $user['image']
        ];

        $userModel = new UserModel();
        $userModel->updateProfile($data);
        $this->session->set($data);
        $validation = \Config\Services::validation();

        return redirect()->back()->with('validation', $validation);
    }
    
    public function getAllQuestion()
    {
        if (session('role_id') != 3) {
            return redirect()->back();
        }

        $adminModel = new AdminModel();
        $team_list = $adminModel->getQuestionEEC();

        return $this->respond(json_encode($team_list));
    }

    public function updateQuestion()
    {
        if (session('role_id') != 3) {
            return redirect()->back();
        }

        $data = [
            'id' => $this->request->getPost('id'),
            'question' => $this->request->getPost('question'),
            'kunjaw' => $this->request->getPost('kunjaw'),
            'answer1' => $this->request->getPost('answer1'),
            'answer2' => $this->request->getPost('answer2'),
            'answer3' => $this->request->getPost('answer3'),
            'answer4' => $this->request->getPost('answer4'),
            'answer5' => $this->request->getPost('answer5'),
        ];

        $adminModel = new AdminModel();
        $result = $adminModel->updateQuestionEEC($data);

        return $this->respondCreated(json_encode($data));
    }
    
    public function getHasilEEC()
    {
        if (session('role_id') != 3) {
            return redirect()->back();
        }

        $adminModel = new AdminModel();
        $hasil = $adminModel->getHasilEEC();

        return $this->respond(json_encode($hasil));
    }
    
    // public function getjson()
    // {
    //     if (session('role_id') != 3) {
    //         return redirect()->back();
    //     }

    //     $adminModel = new AdminModel();
    //     $hasil = $adminModel->getjson();

    //         echo '{
    //             "data" : {';

    //     foreach($hasil as $val){
    //         echo '
    //             "'.$val['team_name'].'" : [ null, {
    //               "answer" : "",
    //               "event" : "flag",
    //               "flag" : 0,
    //               "number" : 1
    //             }, {
    //               "answer" : "",
    //               "event" : "flag",
    //               "flag" : 0,
    //               "number" : 2
    //             }, {
    //               "answer" : "",
    //               "event" : "flag",
    //               "flag" : 0,
    //               "number" : 3
    //             }, {
    //               "answer" : "",
    //               "event" : "flag",
    //               "flag" : 0,
    //               "number" : 4
    //             }, {
    //               "answer" : "",
    //               "event" : "flag",
    //               "flag" : 0,
    //               "number" : 5
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 6
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 7
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 8
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 9
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 10
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 11
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 12
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 13
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 14
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 15
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 16
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 17
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 18
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 19
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 20
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 21
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 22
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 23
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 24
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 25
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 26
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 27
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 28
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 29
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 30
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 31
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 32
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 33
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 34
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 35
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 36
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 37
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 38
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 39
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 40
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 41
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 42
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 43
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 44
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 45
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 46
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 47
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 48
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 49
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 50
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 51
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 52
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 53
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 54
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 55
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 56
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 57
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 58
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 59
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 60
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 61
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 62
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 63
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 64
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 65
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 66
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 67
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 68
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 69
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 70
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 71
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 72
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 73
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 74
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 75
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 76
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 77
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 78
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 79
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 80
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 81
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 82
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 83
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 84
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 85
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 86
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 87
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 88
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 89
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 90
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 91
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 92
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 93
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 94
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 95
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 96
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 97
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 98
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 99
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 100
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 101
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 102
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 103
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 104
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 105
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 106
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 107
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 108
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 109
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 110
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 111
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 112
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 113
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 114
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 115
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 116
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 117
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 118
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 119
    //             }, {
    //               "answer" : "",
    //               "event" : "answerDel",
    //               "flag" : 0,
    //               "number" : 120
    //             } ], <br />
    //         ';
    //     }
        
    //     echo '} }';
        
    //     // return $this->respond(json_encode($hasil));
    // }
}
