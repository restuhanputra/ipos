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

  /**
   * @description Ambil semua data
   *
   * @return void
   */
  public function getAllData()
  {
    $this->db->select('produk.*,
                      produk_kategori.kategori_nama as kategori_nama,
                      produk_satuan.satuan_nama as satuan_nama');
    $this->db->from($this->table);
    $this->db->join($this->table_kategori, 'produk_kategori.id = produk.kategori_id');
    $this->db->join($this->table_satuan, 'produk_satuan.id = produk.satuan_id');
    $this->db->order_by('produk.id', 'ASC');
    return $this->db->get();
  }

  /**
   * @description Menambahkan data
   *
   * @param string $data
   * @return void
   */
  public function insert($data)
  {
    $this->db->insert($this->table, $data);
    return $this->db->affected_rows();
  }

  /**
   * @description Ambil data bedasarkan $data
   *
   * @param string $data
   * @return void
   */
  public function getDataBy($data)
  {
    $this->db->select('
                    produk.*,
                    produk_kategori.kategori_nama as kategori_nama, 
                    produk_satuan.satuan_nama as satuan_nama
                    ');
    $this->db->from($this->table);
    $this->db->join($this->table_kategori, 'produk_kategori.id = produk.kategori_id');
    $this->db->join($this->table_satuan, 'produk_satuan.id = produk.satuan_id');
    $this->db->where($data);
    return $this->db->get();
  }

  /**
   * @description Delete data
   *
   * @param string $data
   * @return void
   */
  public function delete($data)
  {
    $this->db->delete($this->table, $data);
    return $this->db->affected_rows();
  }

  /**
   * @description Update data
   *
   * @param string $data
   * @param string $where
   * @return void
   */
  public function update($data, $where)
  {
    $this->db->update($this->table, $data, $where);
    return $this->db->affected_rows();
  }
}
