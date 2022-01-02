<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model("Pengguna_model", "Pengguna");
    $this->redirect = "pengguna";
  }

  /**
   * @description Menampilkan halaman data pengguna
   *
   * @return void
   */
  public function index()
  {
    $dataPengguna = $this->Pengguna->getAllData();

    $data = [
      'title'        => 'Data Pengguna',
      'dataPengguna' => $dataPengguna->result()
    ];
    $page = 'pengguna/index';
    template($page, $data);
  }

  /**
   * @description Menampilkan halaman tambah data & add data pengguna
   *
   * @param string $post('pengguna')
   * @return void
   */
  public function create()
  {
    $this->_validation();
    if ($this->form_validation->run() == FALSE) {
      $data = [
        'title' => 'Tambah Data Pengguna',
      ];
      $page = 'pengguna/create';
      template($page, $data);
    } else {
      $file_selected = isset($_FILES['foto']) && isset($_FILES['foto']['name']) && $_FILES['foto']['name'] != '';
      $nama_foto     = $_FILES['foto']['name'];

      if ($file_selected) {
        $nip = $this->input->post("nip");
        $this->_uploadFoto($nip, $nama_foto);

        if (!$this->upload->do_upload('foto')) {
          $data = $this->upload->display_errors();
          $this->session->set_flashdata("error", $data['error']);
        } else {
          $foto =  $this->upload->data();

          $dataInsert = [
            'nip'      => htmlspecialchars($this->input->post("nip")),
            'email'    => htmlspecialchars($this->input->post("email")),
            'password' => sha1(htmlspecialchars($this->input->post("password"))),
            'nama'     => htmlspecialchars($this->input->post("nama")),
            'photo'    => $foto['file_name'],
            'role'     => htmlspecialchars($this->input->post("role")),
          ];
        }
      } else {
        $dataInsert = [
          'nip'      => htmlspecialchars($this->input->post("nip")),
          'email'    => htmlspecialchars($this->input->post("email")),
          'password' => sha1(htmlspecialchars($this->input->post("password"))),
          'nama'     => htmlspecialchars($this->input->post("nama")),
          'role'     => htmlspecialchars($this->input->post("role")),
        ];
      }

      $insert = $this->Pengguna->insert($dataInsert);
      if ($insert > 0) {
        $this->session->set_flashdata("success", "Data berhasil diupdate");
      } else {
        $this->session->set_flashdata("error", "Server sedang sibuk silahkan coba lagi");
      }
      redirect($this->redirect);
    }
  }

  /**
   * @description Delete data pengguna
   *
   * @param string $id
   * @return void
   */
  public function delete($id)
  {
    $cek = $this->Pengguna->getDataBy(['id' => $id]);
    if ($cek->num_rows() > 0) {
      $delete = $this->Pengguna->delete(['id' => $id]);
      if ($delete > 0) {
        $this->session->set_flashdata("success", "Data berhasil dihapus");
      } else {
        $this->session->set_flashdata("error", "Server sedang sibuk silahkan coba lagi");
      }
    } else {
      $this->session->set_flashdata("error", "Data tidak ada");
    }
    redirect($this->redirect);
  }

  /**
   * @description Update data pengguna
   *
   * @param string $id
   * @return void
   */
  public function update($id)
  {
    $cek = $this->Pengguna->getDataBy(['id' => $id]);
    if ($cek->num_rows() > 0) {
      $row         = $cek->row();
      $oldNip = $row->nip;

      $this->_validation($oldNip, "update");
      if ($this->form_validation->run() == FALSE) {
        $data = [
          'title'    => 'Ubah Data Pengguna',
          'pengguna' => $row,
        ];
        $page = 'pengguna/update';
        template($page, $data);
      } else {

        $file_selected = isset($_FILES['foto']) && isset($_FILES['foto']['name']) && $_FILES['foto']['name'] != '';
        $nama_foto     = $_FILES['foto']['name'];

        if ($file_selected) {
          $nip = $this->input->post("nip");
          $this->_uploadFoto($nip, $nama_foto);

          if (!$this->upload->do_upload('foto')) {
            $data = $this->upload->display_errors();
            $this->session->set_flashdata("error", $data['error']);
          } else {

            if ($row->photo != null) {
              $target_file = './uploads/users/' . $row->photo;
              unlink($target_file);
            }
            $foto = $this->upload->data();
            $dataUpdate = [
              'email'      => htmlspecialchars($this->input->post("email")),
              'password'   => sha1(htmlspecialchars($this->input->post("password"))),
              'nama'       => htmlspecialchars($this->input->post("nama")),
              'photo'      => $foto['file_name'],
              'role'       => htmlspecialchars($this->input->post("role")),
              'updated_at' => date("Y-m-d H:i:s")
            ];
          }
        } elseif ($this->input->post("password") != null) {
          $dataUpdate = [
            'email'      => htmlspecialchars($this->input->post("email")),
            'password'   => sha1(htmlspecialchars($this->input->post("password"))),
            'nama'       => htmlspecialchars($this->input->post("nama")),
            'role'       => htmlspecialchars($this->input->post("role")),
            'updated_at' => date("Y-m-d H:i:s")
          ];
        } else {
          $dataUpdate = [
            'email'      => htmlspecialchars($this->input->post("email")),
            'nama'       => htmlspecialchars($this->input->post("nama")),
            'role'       => htmlspecialchars($this->input->post("role")),
            'updated_at' => date("Y-m-d H:i:s")
          ];
        }

        $where = [
          'id' => $id
        ];

        $update = $this->Pengguna->update($dataUpdate, $where);
        if ($update > 0) {
          $this->session->set_flashdata("success", "Data berhasil diupdate");
        } else {
          $this->session->set_flashdata("error", "Server sedang sibuk silahkan coba lagi");
        }
        redirect($this->redirect);
      }
    } else {
      $this->session->set_flashdata("error", "Data tidak ada");
      redirect($this->redirect);
    }
  }

  /**
   * @description Setting upload foto
   *
   * @param string|null $nip
   * @param string|null $nama
   * @return void
   */
  private function _uploadFoto($nip = null, $nama = null)
  {
    /**
     * upload_path adalah folder tujuan untuk upload file;
     * allowed_types adalah tipe file yang diizinkan untuk diupload;
     * max_size adalah batas ukuran file yang dibolehkan;
     * max_width adalah batas lebar untuk file gambar;
     * max_height adalah batas tinggi untuk file gambar;
     * FCPATH adalah konstanta yang berisi alamat path untuk folder project. (Jika kita menyimpan project di dalam C:\xampp\htdocs\ipos, maka FCPATH akan berisi alamat tersebut.)
     */
    $config['upload_path']   = FCPATH . '/uploads/users/';
    $config['upload_path']   = './uploads/users/';
    $config['allowed_types'] = 'jpg|jpeg|png';
    $config['file_name']     = $nip . '_' . $nama;
    $config['overwrite']     = true;
    $config['max_size']      = 2048; //2MB
    // $config['max_width']     = 1080;
    // $config['max_height']    = 1080;

    $this->load->library('upload', $config);
  }

  /**
   * Validasi input
   *
   * @param string|null $post
   * @param string|null $aksi
   * @return void
   */
  private function _validation($post = null, $aksi = null)
  {
    $postNIP = $this->input->post("nip");
    if ($postNIP != $post) {
      $is_unique = '|is_unique[pengguna.nip]';
    } else {
      $is_unique = '';
    }

    if ($aksi == "update") {
      $required = '';
    } else {
      $required = '|required';
    }

    $this->form_validation->set_rules(
      'nip',
      'NIP',
      'trim|required' . $is_unique,
      [
        'required'  => '%s wajib diisi',
        'is_unique' => '%s sudah ada',
      ]
    );

    $this->form_validation->set_rules(
      'nama',
      'Nama',
      'trim|required',
      [
        'required'  => '%s wajib diisi',
      ]
    );



    $this->form_validation->set_rules(
      'password',
      'Password',
      'trim' . $required,
      [
        'required'  => '%s wajib diisi',
      ]
    );

    $this->form_validation->set_rules(
      'password_konfirm',
      'Password Konfirmasi',
      'trim|matches[password]' . $required,
      [
        'required'  => '%s wajib diisi',
        'matches' => '%s tidak sama dengan Password'
      ]
    );

    $this->form_validation->set_rules(
      'email',
      'Email',
      'trim|required|valid_email|valid_emails',
      [
        'required'  => '%s wajib diisi',
        'valid_email'  => '%s tidak valid',
        'valid_emails'  => '%s tidak boleh ada koma (,)',
      ]
    );

    $this->form_validation->set_rules(
      'role',
      'Role',
      'required',
      [
        'required' => '%s wajib dipilih',
      ],
    );
  }
}
