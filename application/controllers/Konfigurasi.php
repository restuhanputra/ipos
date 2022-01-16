<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Konfigurasi extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model("Konfigurasi_model", "Konfigurasi");
    $this->redirect = "konfigurasi";
    cekUser();
    adminOnly();
  }

  /**
   * @description Menampilkan halaman data konfigurasi
   *
   * @return void
   */
  public function index()
  {
    $this->_validation();
    if ($this->form_validation->run() == FALSE) {
      $konfigurasi = $this->Konfigurasi->getDataBy(['id' => 1]);

      $data = [
        'title'       => 'Data Konfigurasi',
        'konfigurasi' => $konfigurasi->row()
      ];
      $page = 'konfigurasi/index';
      template($page, $data);
    } else {
      $dataUpdate = [
        'nama_web'   => $this->input->post("nama_web"),
        'no_telp'    => $this->input->post("no_telp"),
        'email'      => $this->input->post("email"),
        'alamat'     => $this->input->post("alamat"),
        'updated_at' => date("Y-m-d H:i:s")
      ];
      $where = [
        'id' => 1
      ];

      $update = $this->Konfigurasi->update($dataUpdate, $where);
      if ($update > 0) {
        $this->session->set_flashdata("success", "Data berhasil diupdate");
      } else {
        $this->session->set_flashdata("error", "Server sedang sibuk silahkan coba lagi");
      }
      redirect($this->redirect);
    }
  }

  /**
   * Validasi input
   *
   * @return void
   */
  private function _validation()
  {

    $this->form_validation->set_rules(
      'nama_web',
      'Nama Website',
      'trim|required',
      [
        'required'  => '%s wajib diisi',
      ]
    );

    $this->form_validation->set_rules(
      'no_telp',
      'No. Telepon',
      'trim|required',
      [
        'required'  => '%s wajib diisi',
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
      'alamat',
      'Alamat',
      'required',
      [
        'required'  => '%s wajib diisi',
      ]
    );
  }
}
