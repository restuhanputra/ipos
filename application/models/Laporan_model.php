<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->table_stokmasuk  = 'stok_masuk';
    $this->table_stokkeluar = 'stok_keluar';
    $this->table_produk     = 'produk';
    $this->table_kategori   = 'produk_kategori';
    $this->table_satuan     = 'produk_satuan';
    $this->table_pengguna   = 'pengguna';
    $this->table_supplier   = 'supplier';
  }

  public function produkByRangeDate($startDate, $endDate)
  {
    $this->db->select('produk.*,
                      produk_kategori.kategori_nama as kategori_nama,
                      produk_satuan.satuan_nama as satuan_nama');
    $this->db->from($this->table_produk);
    $this->db->join($this->table_kategori, 'produk_kategori.id = produk.kategori_id');
    $this->db->join($this->table_satuan, 'produk_satuan.id = produk.satuan_id');
    $this->db->where('DATE(' .  $this->table_produk . '.create_at) >=', date('Y-m-d', strtotime($startDate)));
    $this->db->where('DATE(' .  $this->table_produk . '.create_at) <=', date('Y-m-d', strtotime($endDate)));
    $this->db->order_by('' . $this->table_produk . '.id', 'ASC');
    return $this->db->get()->result();
  }

  public function stokmasukByRangeDate($startDate, $endDate)
  {
    $this->db->select('stok_masuk.*, 
                      produk.produk_nama as produk_nama,
                      produk.kategori_id as kategori_id,
                      produk.satuan_id as satuan_id,
                      produk.harga as harga,
                      produk_satuan.satuan_nama as satuan_nama,
                      supplier.id as supplier_id,
                      supplier.nama as supplier_nama,
                      ');
    $this->db->from($this->table_stokmasuk);
    $this->db->join($this->table_produk, 'produk.id = stok_masuk.produk_id');
    $this->db->join($this->table_satuan, 'produk_satuan.id = produk.satuan_id');
    $this->db->join($this->table_supplier, 'supplier.id = stok_masuk.supplier_id');

    $this->db->where('DATE(' .  $this->table_stokmasuk . '.create_at) >=', date('Y-m-d', strtotime($startDate)));
    $this->db->where('DATE(' .  $this->table_stokmasuk . '.create_at) <=', date('Y-m-d', strtotime($endDate)));
    $this->db->order_by('' . $this->table_stokmasuk . '.id', 'ASC');
    // $this->db->where('' .  $this->table_stokmasuk . '.create_at BETWEEN "' . date('Y-m-d', strtotime($startDate)) . '" and "' . date('Y-m-d', strtotime($endDate)) . '"');
    return $this->db->get()->result();
  }

  public function stokkeluarByRangeDate($startDate, $endDate)
  {
    $this->db->select('stok_keluar.*, 
                      produk.produk_nama as produk_nama,
                      produk.satuan_id as satuan_id,
                      produk_satuan.satuan_nama as satuan_nama,
                      pengguna.id as pengguna_id,
                      pengguna.nama as pengguna_nama');
    $this->db->from($this->table_stokkeluar);
    $this->db->join($this->table_produk, 'produk.id = stok_keluar.produk_id');
    $this->db->join($this->table_satuan, 'produk_satuan.id = produk.satuan_id');
    $this->db->join($this->table_pengguna, 'pengguna.id = stok_keluar.pengguna_id');
    $this->db->where('DATE(' .  $this->table_stokkeluar . '.create_at) >=', date('Y-m-d', strtotime($startDate)));
    $this->db->where('DATE(' .  $this->table_stokkeluar . '.create_at) <=', date('Y-m-d', strtotime($endDate)));
    $this->db->order_by('' . $this->table_stokkeluar . '.id', 'ASC');
    return $this->db->get()->result();
  }

  // public function viewByDate($tabel, $date)
  // {
  //   $this->db->where('DATE(create_at)', $date); // Tambahkan where tanggal nya

  //   return $this->db->get($tabel)->result(); // Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter
  // }

  // public function viewByMonth($tabel, $month, $year)
  // {
  //   $this->db->where('MONTH(create_at)', $month); // Tambahkan where bulan
  //   $this->db->where('YEAR(create_at)', $year); // Tambahkan where tahun

  //   return $this->db->get($tabel)->result(); // Tampilkan data transaksi sesuai bulan dan tahun yang diinput oleh user pada filter
  // }

  // public function viewByYear($tabel, $year)
  // {
  //   $this->db->where('YEAR(create_at)', $year); // Tambahkan where tahun

  //   return $this->db->get($tabel)->result(); // Tampilkan data transaksi sesuai tahun yang diinput oleh user pada filter
  // }

  // public function viewAll($tabel)
  // {
  //   return $this->db->get($tabel)->result(); // Tampilkan semua data transaksi
  // }

  // public function optionTahun($tabel)
  // {
  //   $this->db->select('YEAR(create_at) AS tahun'); // Ambil Tahun dari field create_at
  //   $this->db->from($tabel); // select ke tabel transaksi
  //   $this->db->order_by('YEAR(create_at)'); // Urutkan berdasarkan tahun secara Ascending (ASC)
  //   $this->db->group_by('YEAR(create_at)'); // Group berdasarkan tahun pada field create_at

  //   return $this->db->get()->result(); // Ambil data pada tabel transaksi sesuai kondisi diatas
  // }
}
