<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model("Pelanggan_model", "Pelanggan");
    $this->redirect = "pelanggan";
    cekUser();
  }

  /**
   * @description Menampilkan halaman data supplier
   *
   * @return void
   */
  public function index()
  {
    $dataPelanggan = $this->Pelanggan->getAllData();

    $data = [
      'title'         => 'Data Pelanggan',
      'dataPelanggan' => $dataPelanggan->result()
    ];
    $page = 'pelanggan/index';
    template($page, $data);
  }

  /**
   * @description Menampilkan halaman tambah data & add data supplier
   *
   * @param string $post('supplier')
   * @return void
   */
  public function create()
  {
    $this->_validation();
    if ($this->form_validation->run() == FALSE) {
      $data = [
        'title' => 'Tambah Data Pelanggan',
      ];
      $page = 'pelanggan/create';
      template($page, $data);
    } else {
      $dataInsert = [
        'nama'       => htmlspecialchars($this->input->post("pelanggan")),
        'no_telp'    => htmlspecialchars($this->input->post("no_telp")),
        'perusahaan' => htmlspecialchars($this->input->post("perusahaan")),
        'alamat'     => htmlspecialchars($this->input->post("alamat")),
      ];
      $insert = $this->Pelanggan->insert($dataInsert);
      if ($insert > 0) {
        $this->session->set_flashdata("success", "Data berhasil disimpan");
      } else {
        $this->session->set_flashdata("error", "Server sedang sibuk silahkan coba lagi");
      }
      redirect($this->redirect);
    }
  }

  /**
   * @description Delete data supplier
   *
   * @param string $id
   * @return void
   */
  public function delete($id)
  {
    $cek = $this->Pelanggan->getDataBy(['id' => $id]);
    if ($cek->num_rows() > 0) {
      $delete = $this->Pelanggan->delete(['id' => $id]);
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
   * @description Update data supplier
   *
   * @param string $id
   * @return void
   */
  public function update($id)
  {
    $cek = $this->Pelanggan->getDataBy(['id' => $id]);
    if ($cek->num_rows() > 0) {
      $row          = $cek->row();
      $oldPelanggan = $row->nama;

      $this->_validation($oldPelanggan);
      if ($this->form_validation->run() == FALSE) {
        $data = [
          'title'     => 'Ubah Data Pelanggan',
          'pelanggan' => $row,
        ];
        $page = 'pelanggan/update';
        template($page, $data);
      } else {
        $dataUpdate = [
          'nama'       => htmlspecialchars($this->input->post("pelanggan")),
          'no_telp'    => htmlspecialchars($this->input->post("no_telp")),
          'perusahaan' => htmlspecialchars($this->input->post("perusahaan")),
          'alamat'     => htmlspecialchars($this->input->post("alamat")),
          'updated_at' => date("Y-m-d H:i:s")
        ];
        $where = [
          'id' => $id
        ];

        $update = $this->Pelanggan->update($dataUpdate, $where);
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
   * Validasi input
   *
   * @param string|null $post
   * @return void
   */
  private function _validation($post = null)
  {
    $postPelanggan = $this->input->post("pelanggan");
    if ($postPelanggan != $post) {
      $is_unique = '|is_unique[pelanggan.nama]';
    } else {
      $is_unique = '';
    }

    $this->form_validation->set_rules(
      'pelanggan',
      'Nama Pelanggan',
      'trim|required' . $is_unique,
      [
        'required'  => '%s wajib diisi',
        'is_unique' => '%s sudah ada',
      ]
    );

    $this->form_validation->set_rules(
      'no_telp',
      'No. Telepon',
      'required',
      [
        'required'  => '%s wajib diisi',
      ]
    );
  }
}
