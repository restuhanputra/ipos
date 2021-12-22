<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stokmasuk_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->table          = 'stok_masuk';
    $this->table_produk   = 'produk';
    $this->table_kategori = 'produk_kategori';
    $this->table_satuan   = 'produk_satuan';
  }

  public function getAllData()
  {
    $this->db->select('stok_masuk.*, 
                      produk.produk_nama as produk_nama,
                      produk.kategori_id as kategori_id,
                      produk.satuan_id as satuan_id,
                      produk.harga as harga,
                      produk_kategori.kategori_nama as kategori_nama,
                      produk_satuan.satuan_nama as satuan_nama');
    $this->db->from($this->table);
    $this->db->join($this->table_produk, 'produk.id = stok_masuk.produk_id');
    $this->db->join($this->table_kategori, 'produk_kategori.id = produk.kategori_id');
    $this->db->join($this->table_satuan, 'produk_satuan.id = produk.satuan_id');
    $this->db->order_by('produk.id', 'ASC');
    return $this->db->get();
  }

  public function getajax($data)
  {
    return $this->db->get_where($this->table_produk, $data);
    // $this->db->select('produk.*,
    //                    stok_masuk.jumlah as jumlah');
    // $this->db->from($this->table_produk);
    // $this->db->join($this->table, 'stok_masuk.id = produk.id');
    // return $this->db->get();
  }


  public function insert($data)
  {
    $this->db->insert($this->table, $data);
    return $this->db->affected_rows();
  }

  public function getDataBy($data)
  {
    // return $this->db->get_where($this->table, $data);
    $this->db->select('stok_masuk.*, 
                      produk.produk_nama as produk_nama,
                      produk.kategori_id as kategori_id,
                      produk.satuan_id as satuan_id,
                      produk.harga as harga,
                      produk_kategori.kategori_nama as kategori_nama,
                      produk_satuan.satuan_nama as satuan_nama');
    $this->db->from($this->table);
    $this->db->join($this->table_produk, 'produk.id = stok_masuk.produk_id');
    $this->db->join($this->table_kategori, 'produk_kategori.id = produk.kategori_id');
    $this->db->join($this->table_satuan, 'produk_satuan.id = produk.satuan_id');
    $this->db->where($data);
    return $this->db->get();
  }

  public function delete($data)
  {
    $this->db->delete($this->table, $data);
    return $this->db->affected_rows();
  }

  public function update($data, $where)
  {
    $this->db->update($this->table, $data, $where);
    return $this->db->affected_rows();
  }
}
