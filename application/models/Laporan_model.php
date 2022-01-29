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

  /**
   * @description Ambil semua data produk dari tanggal
   *
   * @param string $startDate
   * @param string $endDate
   * @return void
   */
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

  /**
   * @description Ambil semua data stok masuk dari tanggal
   *
   * @param string $startDate
   * @param string $endDate
   * @return void
   */
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
    return $this->db->get()->result();
  }

  /**
   * @description Ambil semua data stok keluar dari tanggal
   *
   * @param string $startDate
   * @param string $endDate
   * @return void
   */
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
}
