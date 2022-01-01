<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stokkeluar_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->table           = 'stok_keluar';
    $this->table_stokmasuk = 'stok_masuk';
    $this->table_produk    = 'produk';
    $this->table_kategori  = 'produk_kategori';
    $this->table_satuan    = 'produk_satuan';
  }

  public function getAllData()
  {
    $this->db->select('stok_keluar.*, 
                      produk.produk_nama as produk_nama,
                      produk.satuan_id as satuan_id,
                      produk_satuan.satuan_nama as satuan_nama');
    $this->db->from($this->table);
    $this->db->join($this->table_produk, 'produk.id = stok_keluar.produk_id');
    $this->db->join($this->table_satuan, 'produk_satuan.id = produk.satuan_id');
    return $this->db->get();
  }

  public function getajax($data)
  {
    $this->db->select(
      'stok_masuk.id as id,
      stok_masuk.produk_id as produk_id,
      stok_masuk.jumlah as jumlah,
      produk.harga as harga,'
    );
    $this->db->from($this->table_stokmasuk);
    $this->db->join($this->table_produk, 'produk.id = stok_masuk.produk_id');
    $this->db->where($data);
    return $this->db->get();
  }

  public function insert($data, $dataUpdate, $id)
  {
    $this->db->trans_start(); # Starting Transaction
    $this->db->trans_strict(FALSE); # See Note 01. If you wish can remove as well 

    $this->db->insert($this->table, $data); # Inserting data

    # Updating data
    $this->table_stokmasuk = 'stok_masuk';
    $this->db->where('stok_masuk.id', $id);
    $this->db->update($this->table_stokmasuk, $dataUpdate);

    $this->db->trans_complete(); # Completing transaction

    /*Optional*/

    if ($this->db->trans_status() === FALSE) {
      # Something went wrong.
      $this->db->trans_rollback();
      return FALSE;
    } else {
      # Everything is Perfect. 
      # Committing data to the database.
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function getDataBy($table, $data)
  {
    if ($table != null) {
      return $this->db->get_where($table, $data);
    } else {
      // return $this->db->get_where($this->table, $data);
      $this->db->select('stok_keluar.*, 
                      produk.produk_nama as produk_nama,
                      produk.satuan_id as satuan_id,
                      produk_satuan.satuan_nama as satuan_nama');
      $this->db->from($this->table);
      $this->db->join($this->table_produk, 'produk.id = stok_keluar.produk_id');
      $this->db->join($this->table_satuan, 'produk_satuan.id = produk.satuan_id');
      $this->db->where($data);
      return $this->db->get();
    }
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
