<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Authentication extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model("Authentication_model", "Auth");
    $this->load->model("Pengguna_model", "Pengguna");
    $this->redirect = "login";
    $this->redirect_forgot = "forgot";
  }

  /**
   * @description Login view & Auth
   *
   * @param string $username
   * @param string $password
   * @return void
   */
  public function index()
  {
    $this->_validation('login');
    if ($this->form_validation->run() == FALSE) {
      $data = [
        'title' => 'Login'
      ];
      $page = 'index';
      $this->_template($page, $data);
    } else {
      $email    = $this->input->post('email');
      $password = $this->input->post('password');

      $data = $this->Auth->cekUser($email, $password);
      if ($data->num_rows() > 0) {
        $data = $data->row();
        $dataUser = [
          'id'     => $data->id,
          'nip'    => $data->nip,
          'nama'   => $data->nama,
          'role'   => $data->role,
          'status' => 'login',
        ];

        $this->session->set_userdata($dataUser);
        redirect('dashboard');
      } else {
        $this->session->set_flashdata("error", "Email/Password salah");
        redirect($this->redirect);
      }
    }
  }

  public function forgot()
  {
    $this->_validation('forgot');
    if ($this->form_validation->run() == FALSE) {
      $data = [
        'title' => 'Lupa Password'
      ];
      $page = 'forgot';
      $this->_template($page, $data);
    } else {
      $this->load->library('mailer');
      $email = $this->input->post('email');

      $data = $this->Pengguna->getDataBy(['email' => $email]);
      if ($data->num_rows() > 0) {
        $email = $data->row()->email;
      }

      // Random password
      $randomPass  = substr(sha1(rand()), 0, 7);
      $encriptPass = sha1($randomPass);

      $password = [
        'password' => $encriptPass
      ];

      $where = [
        'email' => $email
      ];

      $update = $this->Auth->ubahPassword($password, $where);
      if ($update > 0) {
        $to_email = $email;
        $sendmail = [
          'to_email'   => $to_email,
          'randomPass' => $randomPass
        ];

        // Panggil fungsi send yang ada di librari Mailer
        $send = $this->mailer->send($sendmail);

        if ($send == true) {
          $this->session->set_flashdata("success", "Ubah password berhasil, silahkan cek email!");
        } else {
          $this->session->set_flashdata("error", "Gagal ubah password");
        }
        redirect($this->redirect_forgot);
      }
    }
  }

  /**
   * @description Logout
   *
   * @return void
   */
  public function logout()
  {
    $dataUser = [
      'id', 'nip', 'nama', 'status',
    ];
    $this->session->unset_userdata($dataUser);
    redirect($this->redirect);
  }

  /**
   * @description validasi
   *
   * @param string $type
   * @return void
   */
  private function _validation($type)
  {
    if ($type === 'login') {
      $this->form_validation->set_rules(
        'email',
        'Email',
        'trim|required|valid_email',
        [
          'required' => '%s wajib diisi',
          'valid_email' => 'Wajib berisi %s yang valid',
        ],
      );

      $this->form_validation->set_rules(
        'password',
        'Password',
        'trim|required',
        [
          'required' => '%s wajib diisi',
        ],
      );
    }

    if ($type === 'forgot') {
      $this->form_validation->set_rules(
        'email',
        'Email',
        'trim|required|valid_email',
        [
          'required' => '%s wajib diisi',
          'valid_email' => 'Wajib berisi %s yang valid',
        ],
      );
    }
  }

  /**
   * @description template layout
   *
   * @param string $page
   * @param string $data
   * @return void
   */
  private function _template($page = null, $data = null)
  {
    $this->load->view('auth/template/header', $data);
    $this->load->view('auth/' . $page, $data);
    $this->load->view('auth/template/footer', $data);
  }
}
