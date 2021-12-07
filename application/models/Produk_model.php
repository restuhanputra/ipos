<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->table          = 'produk';
    $this->table_kategori = 'produk_kategori';
    $this->table_satuan   = 'produk_satuan';
  }

  public function getAllData()
  {
    // return $this->db->get($this->table);
    $this->db->select('produk.*, produk_kategori.kategori_nama as kategori_nama, produk_satuan.satuan_nama as satuan_nama');
    $this->db->from($this->table);
    $this->db->join($this->table_kategori, 'produk_kategori.id = produk.kategori_id');
    $this->db->join($this->table_satuan, 'produk_satuan.id = produk.satuan_id');
    $this->db->order_by('produk.id', 'ASC');
    // $this->db->join('comments', 'comments.id = blogs.id');
    return $this->db->get();
  }

  public function insert($data)
  {
    $this->db->insert($this->table, $data);
    return $this->db->affected_rows();
  }

  public function getDataBy($data)
  {
    $this->db->select('produk.*, produk_kategori.kategori_nama as kategori_nama, produk_satuan.satuan_nama as satuan_nama');
    $this->db->from($this->table);
    $this->db->join($this->table_kategori, 'produk_kategori.id = produk.kategori_id');
    $this->db->join($this->table_satuan, 'produk_satuan.id = produk.satuan_id');
    $this->db->where($data);
    return $this->db->get();
    // return $this->db->get_where($this->table, $data);
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
