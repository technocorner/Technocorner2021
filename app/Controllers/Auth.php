<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'email' => 'required',
                'password' => 'required|min_length[8]'
            ];

            if (!$this->validate($rules)) {
                $validation = \Config\Services::validation();
                return redirect()->to(base_url('auth'))->withInput()->with('validation', $validation);
            }

            $input = [
                'email' => htmlspecialchars(trim($this->request->getPost('email'))),
                'password' => htmlspecialchars(trim($this->request->getPost('password')))
            ];

            $user = $userModel->getUser($input['email']);
            if ($user) {
                if ($user['is_active'] == 0) {

                    $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Your account has not been activated. Please activate your account.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>');
                    return redirect()->to('/auth');
                }
                if (password_verify($input['password'], $user['password'])) {
                    $this->setUserSession($user);
                    return redirect()->to('/menu/dashboard');
                    // if ($user['role_id'] == 1) {
                    //     return redirect()->to('/admin');
                    // } else {
                    //     return redirect()->to('/user');
                    // }
                }
                $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Wrong password
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>');
                redirect()->back()->withInput();
            } else {
                $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Email is not registered
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>');
                redirect()->back()->withInput();
            }
        }

        $data = [
            'validation' => \Config\Services::validation()
        ];
        return view('auth/login', $data);
    }

    public function register()
    {
        $userModel = new UserModel();

        if ($this->request->getMethod() == 'post') {

            $rules = [
                'name' => 'required',
                'email' => 'required|is_unique[users.email]|valid_email',
                'password' => 'required|min_length[8]'
            ];

            if (!$this->validate($rules)) {
                $validation =  \Config\Services::validation();
                return redirect()->to(base_url('auth/register'))->withInput()->with('validation', $validation);
            }

            $input = [
                'name' => htmlspecialchars(trim($this->request->getPost('name'))),
                'email' => htmlspecialchars(trim($this->request->getPost('email'))),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'asal_kampus' => '',
                'image' => 'default.jpg',
                'role_id' => 2,
                'is_active' => 0,
                'created_at' => time(),
                'updated_at' => time()
            ];
            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => htmlspecialchars(trim($this->request->getPost('email'))),
                'token' => $token
            ];
            $messageVerif =  view('email/verification', $user_token);
            $this->_sendEmail($input['email'], 'Account Verification', $messageVerif);
            $userModel->save($input);
            $userModel->setUserToken($user_token);
            $this->session->setFlashdata('message', '<div class="alert alert-success alert-auth alert-dismissible fade show" role="alert">
            Registration success. Please check your email to activate.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
            return redirect()->to(base_url('/auth'));
        }

        $data = [
            'validation' => \Config\Services::validation()
        ];

        return view('auth/register', $data);
    }

    private function setUserSession($user)
    {
        $userLogIn = [
            'id' => $user['id'],
            'email' => $user['email'],
            'role_id' => $user['role_id'],
            'name' => $user['name'],
            'image' => $user['image']
        ];
        $this->session->set($userLogIn);
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(base_url('/auth'));
    }

    private function _sendEmail($to, $subject, $message)
    {
        $email = \Config\Services::email();

        $email->setFrom('softwebtc21@gmail.com', 'technocorner2021');
        $email->setTo($to);
        $email->setSubject($subject);
        $email->setMessage($message);

        if (!$email->send()) {
            return false;
        } else {
            return true;
        }
    }

    public function verify()
    {
        $userModel = new UserModel();
        $data = [
            'email' => $this->request->getGet('email'),
            'token' => str_replace(" ","+",$this->request->getGet('token'))
        ];
        $user = $userModel->getUserByEmail($data['email']);
        if ($user) {
            $user_token = $userModel->getUserToken($data['token']);
            if ($user_token) {
                $userModel->where('id', $user['id'])->set(['is_active' => 1])->update();
                $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Your account has been created. Please login!.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
      </div>');
                return redirect()->to(base_url('/auth'));
            }
            $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Activated failed. Wrong token.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
      </div>');
            return redirect()->to(base_url('/auth'));
        }
        $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Activation failed. Wrong email.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>');
        return redirect()->to(base_url('/auth'));
    }

    public function reset()
    {
        $userModel = new UserModel();
        if ($this->request->getMethod() == 'post') {

            $rules = [
                'email' => 'required|valid_email|check_email'
            ];

            if (!$this->validate($rules)) {
                $validation =  \Config\Services::validation();
                return redirect()->to(base_url('auth/reset'))->withInput()->with('validation', $validation);
            }
            $token = substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(40 / strlen($x)))), 1, 40);
            $user_token = [
                'email' => htmlspecialchars(trim($this->request->getPost('email'))),
                'token' => $token
            ];
            $messageReset = view('email/reset', $user_token);
            $this->_sendEmail($user_token['email'], 'Reset Password', $messageReset);
            $userModel->setUserResetToken($user_token);
            $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            email has been sent. Please check your email.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
            return redirect()->to(base_url('/auth'));
        }

        $data = [
            'validation' => \Config\Services::validation()
        ];

        return view('auth/reset', $data);
    }

    public function resetPassword()
    {
        $userModel = new UserModel();

        if ($this->request->getMethod() == 'post') {
            $data = [
                'email' => htmlspecialchars(trim($this->request->getPost('email'))),
                'token' => htmlspecialchars(trim($this->request->getPost('token'))),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
            ];

            $rules = [
                'password' => 'required|min_length[8]',
                'confirmPassword' => 'required|min_length[8]|matches[password]'
            ];

            if (!$this->validate($rules)) {
                $validation =  \Config\Services::validation();
                return redirect()->to(base_url() . '/auth/resetPassword?email=' . $data['email'] . '&token=' . $data['token'])->withInput()->with('validation', $validation);
            }
            $user = $userModel->getUserByEmail($data['email']);
            $user_token = $userModel->getUserResetToken($data);
            if ($user && $user_token) {
                $clearResetToken = [
                    'email' => $data['email'],
                    'token' => '',
                ];

                $userModel->where('id', $user['id'])->set(['password' => $data['password']])->update();
                $userModel->setUserResetToken($clearResetToken);

                $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            Your account password has been reset. Please login!.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                </div>');
                return redirect()->to('/auth');
            }
        } else {
            $data = [
                'email' => $this->request->getGet('email'),
                'token' => $this->request->getGet('token')
            ];

            $user = $userModel->getUserByEmail($data['email']);
            $user_token = $userModel->getUserResetToken($data);
            if (!$user || !$user_token) {
                $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Link is invalid.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                return redirect()->to('/auth');
            }
        }

        $data = [
            'email' => $this->request->getGet('email'),
            'token' => $this->request->getGet('token'),
            'validation' => \Config\Services::validation()
        ];
        return view('auth/resetPassword', $data);
    }
    //--------------------------------------------------------------------

}
