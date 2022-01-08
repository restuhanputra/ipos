<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stokkeluar extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model("Stokkeluar_model", "Stokkeluar");
    $this->load->model("Stokmasuk_model", "Stokmasuk");
    $this->load->model("Produk_model", "Produk");
    $this->redirect = "stokkeluar";
    cekUser();
  }

  /**
   * @description Menampilkan halaman data stok keluar
   *
   * @return void
   */
  public function index()
  {
    $dataStokkeluar = $this->Stokkeluar->getAllData();

    $data = [
      'title'          => 'Data Stok Keluar',
      'dataStokkeluar' => $dataStokkeluar->result()
    ];
    $page = 'stokkeluar/index';
    template($page, $data);
  }

  /**
   * @description Menampilkan halaman tambah data & add data stok keluar
   *
   * @param string $post('stokkeluar')
   * @return void
   */
  public function create()
  {
    $this->_validation();
    if ($this->form_validation->run() == FALSE) {
      $dataProduk = $this->Produk->getAllData();
      $noTransaksi = $this->Stokkeluar->getNoTransaksi();
      $data = [
        'title'       => 'Tambah Data Stok Keluar',
        'dataProduk'  => $dataProduk->result(),
        'noTransaksi' => $noTransaksi
      ];
      $page = 'stokkeluar/create';
      template($page, $data);
    } else {
      $no_transaksi  = htmlspecialchars($this->input->post("no_transaksi"));
      $stok_masuk_id = htmlspecialchars($this->input->post("stok_masuk_id"));
      $produk_id     = htmlspecialchars($this->input->post("produk_id"));
      $jumlah_keluar = $this->input->post("jumlah_keluar");
      $keterangan    = htmlspecialchars($this->input->post("keterangan"));
      $pengguna_id   = $this->session->userdata("id");

      $jumlahProduk = $this->Stokkeluar->getDataBy("stok_masuk", ['id' => $stok_masuk_id])->row()->jumlah;
      $hargaProduk = $this->Produk->getDataBy(['produk.id' => $produk_id])->row()->harga;
      $jumlah = (int)($jumlahProduk - $jumlah_keluar);
      $totalHarga = (int)($hargaProduk * $jumlah_keluar);

      $dataInsert = [
        'no_transaksi' => $no_transaksi,
        'stok_masuk_id' => $stok_masuk_id,
        'produk_id'     => $produk_id,
        'harga'         => $hargaProduk,
        'jumlah'        => $jumlah_keluar,
        'total_harga'   => $totalHarga,
        'keterangan'    => $keterangan,
        'pengguna_id'   => $pengguna_id
      ];

      $stokmasukUpdate = [
        'jumlah'     => $jumlah,
        'updated_at' => date("Y-m-d H:i:s")
      ];
      $insert = $this->Stokkeluar->insert($dataInsert, $stokmasukUpdate, $stok_masuk_id);
      print_r($insert);
      if ($insert == TRUE) {
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
    $cek = $this->Stokkeluar->getDataBy(null, ['stok_keluar.id' => $id]);
    if ($cek->num_rows() > 0) {
      $delete = $this->Stokkeluar->delete(['id' => $id]);
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
    $cek = $this->Stokkeluar->getDataBy(null, ['stok_keluar.id' => $id]);
    if ($cek->num_rows() > 0) {
      $row = $cek->row();

      if ($_POST == null) {
        $data = [
          'title'      => 'Ubah Data Stok Masuk',
          'stokkeluar' => $row,
        ];
        $page = 'stokkeluar/update';
        template($page, $data);
      } else {
        $dataUpdate = [
          'keterangan'  => htmlspecialchars($this->input->post("keterangan")),
          'pengguna_id' => $this->session->userdata("id"),
          'updated_at'  => date("Y-m-d H:i:s")
        ];
        $where = [
          'id' => $id
        ];

        $update = $this->Stokkeluar->update($dataUpdate, $where);
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
    $produk = $this->Stokkeluar->getajax(['produk_id' => $produk])->result();
    echo json_encode($produk);
  }

  /**
   * Validasi input
   *
   * @return void
   */
  private function _validation()
  {
    $this->form_validation->set_rules(
      'produk_id',
      'Produk',
      'trim|required',
      [
        'required'  => '%s wajib dipilih',
      ]
    );

    $this->form_validation->set_rules(
      'jumlah_keluar',
      'Jumlah',
      'required',
      [
        'required' => '%s wajib diisi',
      ],
    );
  }
}
