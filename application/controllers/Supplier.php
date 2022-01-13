<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supplier extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model("Supplier_model", "Supplier");
    $this->redirect = "stokmasuk";
    cekUser();
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

        $update = $this->Supplier->update($dataUpdate, $where);
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
    $this->form_validation->set_rules(
      'supplier',
      'Nama Supplier',
      'required',
      [
        'required'  => '%s wajib diisi',
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
