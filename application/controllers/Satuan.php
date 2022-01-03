<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Satuan extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model("Satuan_model", "Satuan");
    $this->redirect = "satuan";
    cekUser();
  }

  /**
   * @description Menampilkan halaman data satuan
   *
   * @return void
   */
  public function index()
  {
    $dataSatuan = $this->Satuan->getAllData();

    $data = [
      'title'      => 'Data Satuan',
      'dataSatuan' => $dataSatuan->result()
    ];
    $page = 'satuan/index';
    template($page, $data);
  }

  /**
   * @description Menampilkan halaman tambah data & add data satuan
   *
   * @param string $post('satuan')
   * @return void
   */
  public function create()
  {
    $this->_validation();
    if ($this->form_validation->run() == FALSE) {
      $data = [
        'title' => 'Tambah Data Satuan',
      ];
      $page = 'satuan/create';
      template($page, $data);
    } else {
      $dataInsert = [
        'satuan_nama' => htmlspecialchars($this->input->post("satuan")),
      ];
      $insert = $this->Satuan->insert($dataInsert);
      if ($insert > 0) {
        $this->session->set_flashdata("success", "Data berhasil disimpan");
      } else {
        $this->session->set_flashdata("error", "Server sedang sibuk silahkan coba lagi");
      }
      redirect($this->redirect);
    }
  }

  /**
   * @description Delete data satuan
   *
   * @param string $id
   * @return void
   */
  public function delete($id)
  {
    $cek = $this->Satuan->getDataBy(['id' => $id]);
    if ($cek->num_rows() > 0) {
      $delete = $this->Satuan->delete(['id' => $id]);
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
   * @description Update data satuan
   *
   * @param string $id
   * @return void
   */
  public function update($id)
  {
    $cek = $this->Satuan->getDataBy(['id' => $id]);
    if ($cek->num_rows() > 0) {
      $row       = $cek->row();
      $oldSatuan = $row->satuan_nama;

      $this->_validation($oldSatuan);
      if ($this->form_validation->run() == FALSE) {
        $data = [
          'title'  => 'Ubah Data Satuan',
          'satuan' => $row,
        ];
        $page = 'satuan/update';
        template($page, $data);
      } else {
        $dataUpdate = [
          'satuan_nama' => htmlspecialchars($this->input->post("satuan")),
          'updated_at'  => date("Y-m-d H:i:s")
        ];
        $where = [
          'id' => $id
        ];

        $update = $this->Satuan->update($dataUpdate, $where);
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
    $postSatuan = $this->input->post("satuan");
    if ($postSatuan != $post) {
      $is_unique = '|is_unique[produk_satuan.satuan_nama]';
    } else {
      $is_unique = '';
    }

    $this->form_validation->set_rules(
      'satuan',
      'Nama Satuan',
      'trim|required' . $is_unique,
      [
        'required'  => '%s wajib diisi',
        'is_unique' => '%s sudah ada',
      ]
    );
  }
}
