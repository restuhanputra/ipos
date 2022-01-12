<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stokmasuk extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model("Stokmasuk_model", "Stokmasuk");
    $this->load->model("Produk_model", "Produk");
    $this->redirect = "stokmasuk";
    cekUser();
  }

  /**
   * @description Menampilkan halaman data stok masuk
   *
   * @return void
   */
  public function index()
  {
    $dataStokmasuk = $this->Stokmasuk->getAllData();

    $data = [
      'title'         => 'Data Stok Masuk',
      'dataStokmasuk' => $dataStokmasuk->result()
    ];
    $page = 'stokmasuk/index';
    template($page, $data);
  }

  /**
   * @description Menampilkan halaman tambah data & add data stok masuk
   *
   * @param string $post('stokmasuk')
   * @return void
   */
  public function create()
  {
    $this->_validation(null, null);
    if ($this->form_validation->run() == FALSE) {

      $dataProduk  = $this->Produk->getAllData();
      $noTransaksi = $this->Stokmasuk->getTransaksi();
      $data = [
        'title'       => 'Tambah Data Stok Masuk',
        'dataProduk'  => $dataProduk->result(),
        'noTransaksi' => $noTransaksi,
      ];
      $page = 'stokmasuk/create';
      template($page, $data);
    } else {
      $dataInsertSupplier = [
        'nama'       => htmlspecialchars($this->input->post("supplier")),
        'perusahaan' => htmlspecialchars($this->input->post("perusahaan")),
        'no_telp'    => htmlspecialchars($this->input->post("no_telp")),
        'alamat'     => htmlspecialchars($this->input->post("alamat")),
      ];

      $dataInsert = [
        'no_transaksi' => $this->input->post("no_transaksi"),
        'produk_id'    => htmlspecialchars($this->input->post("produk_id")),
        'jumlah'       => htmlspecialchars($this->input->post("jumlah")),
        'keterangan'   => htmlspecialchars($this->input->post("keterangan")),
        'pengguna_id'  => $this->session->userdata("id")
      ];


      $insert = $this->Stokmasuk->insert($dataInsertSupplier, $dataInsert);
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
    $cek = $this->Stokmasuk->getDataBy(['stok_masuk.id' => $id]);
    if ($cek->num_rows() > 0) {
      $delete = $this->Stokmasuk->delete(['id' => $id]);
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
    $cek = $this->Stokmasuk->getDataBy(['stok_masuk.id' => $id]);
    if ($cek->num_rows() > 0) {
      $row          = $cek->row();
      $oldStokmasuk = $row->produk_id;
      $update       = "update";

      $this->_validation($oldStokmasuk, $update);
      if ($this->form_validation->run() == FALSE) {
        $data = [
          'title'     => 'Ubah Data Stok Masuk',
          'stokmasuk' => $row,
        ];
        $page = 'stokmasuk/update';
        template($page, $data);
      } else {
        $dataUpdate = [
          'jumlah'      => htmlspecialchars($this->input->post("jumlah")),
          'keterangan'  => htmlspecialchars($this->input->post("keterangan")),
          'supplier'    => htmlspecialchars($this->input->post("supplier")),
          'pengguna_id' => $this->session->userdata("id"),
          'updated_at'  => date("Y-m-d H:i:s")
        ];
        $where = [
          'id' => $id
        ];

        $update = $this->Stokmasuk->update($dataUpdate, $where);
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
   * @description menampilkan detail data produk (untuk select dengan ajax)
   *
   * @param string $id
   * @return void
   */
  public function getProduk()
  {
    $produk = $_GET['produk'];
    $produk = $this->Stokmasuk->getajax(['id' => $produk])->result();
    echo json_encode($produk);
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
    $postStokmasuk = $this->input->post("supplier");
    if ($postStokmasuk != $post) {
      $is_unique = '|is_unique[supplier.nama]';
    } else {
      $is_unique = '';
    }

    if ($aksi == null) {
      $this->form_validation->set_rules(
        'produk_id',
        'Produk',
        'trim|required',
        [
          'required'  => '%s wajib dipilih',
        ]
      );
      $this->form_validation->set_rules(
        'supplier',
        'Nama Supplier',
        'required' . $is_unique,
        [
          'required'  => '%s wajib dipilih',
          'is_unique' => '%s sudah ada',
        ]
      );
    }

    $this->form_validation->set_rules(
      'jumlah',
      'Jumlah',
      'required',
      [
        'required' => '%s wajib diisi',
      ],
    );

    $this->form_validation->set_rules(
      'perusahaan',
      'Perusahaan',
      'required',
      [
        'required' => '%s wajib diisi',
      ],
    );
    $this->form_validation->set_rules(
      'no_telp',
      'No. Telepon',
      'required',
      [
        'required' => '%s wajib diisi',
      ],
    );
  }
}
