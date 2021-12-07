<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model("Produk_model", "Produk");
    $this->load->model("Kategori_model", "Kategori");
    $this->load->model("Satuan_model", "Satuan");
    $this->redirect = "produk";
  }

  /**
   * @description Menampilkan halaman data produk
   *
   * @return void
   */
  public function index()
  {
    $dataProduk = $this->Produk->getAllData();

    $data = [
      'title'      => 'Data Produk',
      'dataProduk' => $dataProduk->result()
    ];
    $page = 'produk/index';
    template($page, $data);
  }

  /**
   * @description Menampilkan halaman tambah data & add data produk
   *
   * @param string $post('produk')
   * @return void
   */
  public function create()
  {
    $this->_validation();
    if ($this->form_validation->run() == FALSE) {

      $dataKategori = $this->Kategori->getAllData();
      $dataSatuan   = $this->Satuan->getAllData();

      $data = [
        'title'        => 'Tambah Data Produk',
        'dataKategori' => $dataKategori->result(),
        'dataSatuan'   => $dataSatuan->result(),
      ];
      $page = 'produk/create';
      template($page, $data);
    } else {
      $dataInsert = [
        'produk_nama' => htmlspecialchars($this->input->post("produk_nama")),
        'kategori_id' => htmlspecialchars($this->input->post("kategori")),
        'satuan_id'   => htmlspecialchars($this->input->post("satuan")),
        'harga'       => htmlspecialchars($this->input->post("harga")),
      ];
      $insert = $this->Produk->insert($dataInsert);
      if ($insert > 0) {
        $this->session->set_flashdata("success", "Data berhasil disimpan");
      } else {
        $this->session->set_flashdata("error", "Server sedang sibuk silahkan coba lagi");
      }
      redirect($this->redirect);
    }
  }

  /**
   * @description Delete data produk
   *
   * @param string $id
   * @return void
   */
  public function delete($id)
  {
    $cek = $this->Produk->getDataBy(['produk.id' => $id]);
    if ($cek->num_rows() > 0) {
      $delete = $this->Produk->delete(['id' => $id]);
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
   * @description Update data produk
   *
   * @param string $id
   * @return void
   */
  public function update($id)
  {
    $dataKategori = $this->Kategori->getAllData();
    $dataSatuan   = $this->Satuan->getAllData();
    $cek          = $this->Produk->getDataBy(['produk.id' => $id]);
    if ($cek->num_rows() > 0) {
      $row         = $cek->row();
      $oldProduk = $row->produk_nama;

      $this->_validation($oldProduk);
      if ($this->form_validation->run() == FALSE) {
        $data = [
          'title'        => 'Ubah Data Produk',
          'produk'       => $row,
          'dataKategori' => $dataKategori->result(),
          'dataSatuan'   => $dataSatuan->result(),
        ];
        $page = 'produk/update';
        template($page, $data);
      } else {
        $dataUpdate = [
          'produk_nama' => htmlspecialchars($this->input->post("produk_nama")),
          'kategori_id' => htmlspecialchars($this->input->post("kategori")),
          'satuan_id'   => htmlspecialchars($this->input->post("satuan")),
          'harga'       => htmlspecialchars($this->input->post("harga")),
          'updated_at'  => date("Y-m-d H:i:s")
        ];
        $where = [
          'id' => $id
        ];

        $update = $this->Produk->update($dataUpdate, $where);
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
    $postProduk = $this->input->post("produk_nama");
    if ($postProduk != $post) {
      $is_unique = '|is_unique[produk.produk_nama]';
    } else {
      $is_unique = '';
    }

    $this->form_validation->set_rules(
      'produk_nama',
      'Nama Produk',
      'trim|required' . $is_unique,
      [
        'required'  => '%s wajib diisi',
        'is_unique' => '%s sudah ada',
      ]
    );

    $this->form_validation->set_rules(
      'kategori',
      'Kategori',
      'required',
      [
        'required' => '%s wajib dipilih',
      ],
    );

    $this->form_validation->set_rules(
      'satuan',
      'Satuan',
      'required',
      [
        'required' => '%s wajib dipilih',
      ],
    );

    $this->form_validation->set_rules(
      'harga',
      'Harga',
      'required',
      [
        'required' => '%s wajib diisi',
      ],
    );
  }
}
