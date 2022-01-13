<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supplier extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model("Supplier_model", "Supplier");
    $this->redirect = "supplier";
    cekUser();
  }

  /**
   * @description Menampilkan halaman data supplier
   *
   * @return void
   */
  public function index()
  {
    $dataSupplier = $this->Supplier->getAllData();

    $data = [
      'title'        => 'Data Supplier',
      'dataSupplier' => $dataSupplier->result()
    ];
    $page = 'supplier/index';
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
        'title' => 'Tambah Data Supplier',
      ];
      $page = 'supplier/create';
      template($page, $data);
    } else {
      $dataInsert = [
        'nama'       => htmlspecialchars($this->input->post("supplier")),
        'perusahaan' => htmlspecialchars($this->input->post("perusahaan")),
        'no_telp'    => htmlspecialchars($this->input->post("no_telp")),
        'alamat'     => htmlspecialchars($this->input->post("alamat")),
      ];
      $insert = $this->Supplier->insert($dataInsert);
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
    $cek = $this->Supplier->getDataBy(['id' => $id]);
    if ($cek->num_rows() > 0) {
      $delete = $this->Supplier->delete(['id' => $id]);
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
    $cek = $this->Supplier->getDataBy(['id' => $id]);
    if ($cek->num_rows() > 0) {
      $row         = $cek->row();
      $oldSupplier = $row->nama;

      $this->_validation($oldSupplier);
      if ($this->form_validation->run() == FALSE) {
        $data = [
          'title'    => 'Ubah Data Supplier',
          'supplier' => $row,
        ];
        $page = 'supplier/update';
        template($page, $data);
      } else {
        $dataUpdate = [
          'nama'       => htmlspecialchars($this->input->post("supplier")),
          'perusahaan' => htmlspecialchars($this->input->post("perusahaan")),
          'no_telp'    => htmlspecialchars($this->input->post("no_telp")),
          'alamat'     => htmlspecialchars($this->input->post("alamat")),
          'updated_at' => date("Y-m-d H:i:s")
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
    $postSupplier = $this->input->post("supplier");
    if ($postSupplier != $post) {
      $is_unique = '|is_unique[supplier.nama]';
    } else {
      $is_unique = '';
    }

    $this->form_validation->set_rules(
      'supplier',
      'Nama Supplier',
      'trim|required' . $is_unique,
      [
        'required'  => '%s wajib diisi',
        'is_unique' => '%s sudah ada',
      ]
    );

    $this->form_validation->set_rules(
      'perusahaan',
      'Perusahaan',
      'required',
      [
        'required'  => '%s wajib diisi',
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
