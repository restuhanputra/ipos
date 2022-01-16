<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model("Laporan_model", "Laporan");
    $this->redirect = "stokmasuk";
    cekUser();
  }


  public function index()
  {
    $this->_validation();
    if ($this->form_validation->run() == FALSE) {
      $data = [
        'title' => 'Laporan',
      ];
      $page = 'laporan/index';
      template($page, $data);
    } else {
      $jenis_laporan = $this->input->post("jenis_laporan");
      $tanggal_awal  = $this->input->post("tanggal_awal");
      $tanggal_akhir = $this->input->post("tanggal_akhir");

      // panggil library yang kita buat sebelumnya yang bernama pdfgenerator
      $this->load->library('pdfgenerator');

      // get data
      if ($jenis_laporan == 0) {
        $this->data['title_pdf'] = "Laporan Produk"; // title dari pdf
        $file_pdf = "laporan_produk"; // filename dari pdf ketika didownload

        $this->data['dataProduk'] = $this->Laporan->produkByRangeDate($tanggal_awal, $tanggal_akhir);
        $page = "laporan/produk";
      } elseif ($jenis_laporan == 1) {
        $this->data['title_pdf'] = "Laporan Stok Masuk"; // title dari pdf
        $file_pdf = "laporan_stok_masuk"; // filename dari pdf ketika didownload

        $this->data['dataStokmasuk'] = $this->Laporan->stokmasukByRangeDate($tanggal_awal, $tanggal_akhir);
        $page = "laporan/stokmasuk";
      } elseif ($jenis_laporan == 2) {
        $this->data['title_pdf'] = "Laporan Stok Keluar"; // title dari pdf
        $file_pdf = "laporan_stok_keluar"; // filename dari pdf ketika didownload

        $this->data['dataStokkeluar'] = $this->Laporan->stokkeluarByRangeDate($tanggal_awal, $tanggal_akhir);
        $page = "laporan/stokkeluar";
      } else {
        $this->redirect;
      }

      // setting paper
      $paper = 'A4';
      //orientasi paper potrait / landscape
      $orientation = "landscape";

      // $html = $this->load->view('laporan/stokmasuk', $this->data, true);
      $html = $this->load->view($page, $this->data, true);

      // run dompdf
      $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }
  }

  private function _validation()
  {
    $this->form_validation->set_rules(
      'jenis_laporan',
      'Jenis Laporan',
      'required',
      [
        'required' => '%s wajib dipilih',
      ],
    );

    $this->form_validation->set_rules(
      'tanggal_awal',
      'Tanggal Awal',
      'required',
      [
        'required' => '%s wajib diisi',
      ],
    );
    $this->form_validation->set_rules(
      'tanggal_akhir',
      'Tanggal Akhir',
      'required',
      [
        'required' => '%s wajib diisi',
      ],
    );
  }

  public function stokmasuk()
  {
    $tanggal_awal  = $this->input->post("tanggal_awal");
    $tanggal_akhir = $this->input->post("tanggal_akhir");

    // panggil library yang kita buat sebelumnya yang bernama pdfgenerator
    $this->load->library('pdfgenerator');

    // title dari pdf
    $this->data['title_pdf'] = 'Laporan Stok Masuk';
    // get data
    $this->data['dataStokmasuk'] = $this->Laporan->viewByRangeDate('stok_masuk', $tanggal_awal, $tanggal_akhir);

    // filename dari pdf ketika didownload
    $file_pdf = 'laporan_stokmasuk';
    // setting paper
    $paper = 'A4';
    //orientasi paper potrait / landscape
    $orientation = "landscape";

    $html = $this->load->view('laporan/stokmasuk', $this->data, true);

    // run dompdf
    $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
  }

  public function backup()
  {
    // panggil library yang kita buat sebelumnya yang bernama pdfgenerator
    $this->load->library('pdfgenerator');

    // title dari pdf
    $this->data['title_pdf'] = 'Laporan Penjualan Toko Kita';

    // filename dari pdf ketika didownload
    $file_pdf = 'laporan_penjualan_toko_kita';
    // setting paper
    $paper = 'A4';
    //orientasi paper potrait / landscape
    $orientation = "portrait";

    // $page = 'stokmasuk/create';
    // template($page, $data);

    $html = $this->load->view('laporan/index', $this->data, true);

    // run dompdf
    $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
  }
}
