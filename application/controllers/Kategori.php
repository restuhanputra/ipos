<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model("Kategori_model", "Kategori");
    $this->redirect = "kategori";
    cekUser();
  }

  /**
   * @description Menampilkan halaman data kategori
   *
   * @return void
   */
  public function index()
  {
    $dataKategori = $this->Kategori->getAllData();

    $data = [
      'title'        => 'Data Kategori',
      'dataKategori' => $dataKategori->result()
    ];
    $page = 'kategori/index';
    template($page, $data);
  }

  /**
   * @description Menampilkan halaman tambah data & add data kategori
   *
   * @param string $post('kategori')
   * @return void
   */
  public function create()
  {
    $this->_validation();
    if ($this->form_validation->run() == FALSE) {
      $data = [
        'title' => 'Tambah Data Kategori',
      ];
      $page = 'kategori/create';
      template($page, $data);
    } else {
      $dataInsert = [
        'kategori_nama' => htmlspecialchars($this->input->post("kategori")),
      ];
      $insert = $this->Kategori->insert($dataInsert);
      if ($insert > 0) {
        $this->session->set_flashdata("success", "Data berhasil disimpan");
      } else {
        $this->session->set_flashdata("error", "Server sedang sibuk silahkan coba lagi");
      }
      redirect($this->redirect);
    }
  }

  /**
   * @description Delete data kategori
   *
   * @param string $id
   * @return void
   */
  public function delete($id)
  {
    $cek = $this->Kategori->getDataBy(['id' => $id]);
    if ($cek->num_rows() > 0) {
      $delete = $this->Kategori->delete(['id' => $id]);
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
   * @description Update data kategori
   *
   * @param string $id
   * @return void
   */
  public function update($id)
  {
    $cek = $this->Kategori->getDataBy(['id' => $id]);
    if ($cek->num_rows() > 0) {
      $row         = $cek->row();
      $oldKategori = $row->kategori_nama;

      $this->_validation($oldKategori);
      if ($this->form_validation->run() == FALSE) {
        $data = [
          'title'    => 'Ubah Data Kategori',
          'kategori' => $row,
        ];
        $page = 'kategori/update';
        template($page, $data);
      } else {
        $dataUpdate = [
          'kategori_nama' => htmlspecialchars($this->input->post("kategori")),
          'updated_at'    => date("Y-m-d H:i:s")
        ];
        $where = [
          'id' => $id
        ];

        $update = $this->Kategori->update($dataUpdate, $where);
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
    $postKategori = $this->input->post("kategori");
    if ($postKategori != $post) {
      $is_unique = '|is_unique[produk_kategori.kategori_nama]';
    } else {
      $is_unique = '';
    }

    $this->form_validation->set_rules(
      'kategori',
      'Nama Kategori',
      'trim|required' . $is_unique,
      [
        'required'  => '%s wajib diisi',
        'is_unique' => '%s sudah ada',
      ]
    );
  }
}
