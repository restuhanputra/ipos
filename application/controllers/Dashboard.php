<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model("Pengguna_model", "Pengguna");
    $this->load->model("Produk_model", "Produk");
    $this->load->model("Stokmasuk_model", "Stokmasuk");
    $this->load->model("Stokkeluar_model", "Stokkeluar");
    // $this->redirect = "login";
    cekUser();
  }

  /**
   * @description dashboard
   *
   * @return void
   */
  public function index()
  {
    $dataCountPengguna    = $this->Pengguna->getAllData()->num_rows();
    $dataCountProdukMasuk =
      $this->Produk->getAllData()->num_rows();
    $dataCountStokmasuk =
      $this->Stokmasuk->getAllData()->num_rows();
    $dataCountStokkeluar =
      $this->Stokkeluar->getAllData()->num_rows();

    $data = [
      'title'                => 'Dashboard',
      'dataCountPengguna'    => $dataCountPengguna,
      'dataCountProdukMasuk' => $dataCountProdukMasuk,
      'dataCountStokmasuk'   => $dataCountStokmasuk,
      'dataCountStokkeluar'  => $dataCountStokkeluar
    ];
    $page = 'dashboard/index';
    template($page, $data);
  }
}
