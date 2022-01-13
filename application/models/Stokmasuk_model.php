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
    $this->table_pengguna = 'pengguna';
    $this->table_supplier = 'supplier';
  }

  public function getAllData()
  {
    $this->db->select('stok_masuk.*, 
                      produk.produk_nama as produk_nama,
                      produk.kategori_id as kategori_id,
                      produk.satuan_id as satuan_id,
                      produk.harga as harga,
                      produk_kategori.kategori_nama as kategori_nama,
                      produk_satuan.satuan_nama as satuan_nama,
                      pengguna.id as pengguna_id,
                      pengguna.nama as pengguna_nama,
                      supplier.id as supplier_id,
                      supplier.nama as supplier_nama,
                      ');
    $this->db->from($this->table);
    $this->db->join($this->table_produk, 'produk.id = stok_masuk.produk_id');
    $this->db->join($this->table_kategori, 'produk_kategori.id = produk.kategori_id');
    $this->db->join($this->table_satuan, 'produk_satuan.id = produk.satuan_id');
    $this->db->join($this->table_pengguna, 'pengguna.id = stok_masuk.pengguna_id');
    $this->db->join($this->table_supplier, 'supplier.id = stok_masuk.supplier_id');
    $this->db->order_by('stok_masuk.id', 'ASC');
    return $this->db->get();
  }


  function getTransaksi()
  {
    $q = $this->db->query("SELECT MAX(RIGHT(no_transaksi,4)) AS kode_max FROM stok_masuk WHERE DATE(create_at)=CURDATE()");
    $kd = "";
    if ($q->num_rows() > 0) {
      foreach ($q->result() as $k) {
        $tmp = ((int)$k->kode_max) + 1;
        $kd = sprintf("%04s", $tmp);
      }
    } else {
      $kd = "0001";
    }
    $stokmasuk = "STM-";
    date_default_timezone_set('Asia/Jakarta');
    return $stokmasuk . date('dmy') . $kd;
  }


  public function getajax($data)
  {
    return $this->db->get_where($this->table_produk, $data);
  }


  public function insert($dataSupplier, $data)
  {
    $this->db->trans_start(); # Starting Transaction
    $this->db->trans_strict(FALSE); # See Note 01. If you wish can remove as well 

    $this->db->insert($this->table_supplier, $dataSupplier); # Inserting data

    $data['supplier_id'] = $this->db->insert_id();
    # Updating data
    $this->db->insert($this->table, $data);

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

  public function getDataBy($data)
  {
    // return $this->db->get_where($this->table, $data);
    $this->db->select('stok_masuk.*, 
                      produk.produk_nama as produk_nama,
                      produk.kategori_id as kategori_id,
                      produk.satuan_id as satuan_id,
                      produk.harga as harga,
                      produk_kategori.kategori_nama as kategori_nama,
                      produk_satuan.satuan_nama as satuan_nama,
                      supplier.id as supplier_id,
                      supplier.nama as supplier_nama,
                      ');
    $this->db->from($this->table);
    $this->db->join($this->table_produk, 'produk.id = stok_masuk.produk_id');
    $this->db->join($this->table_kategori, 'produk_kategori.id = produk.kategori_id');
    $this->db->join($this->table_satuan, 'produk_satuan.id = produk.satuan_id');
    $this->db->join($this->table_supplier, 'supplier.id = stok_masuk.supplier_id');
    $this->db->where($data);
    return $this->db->get();
  }

  public function delete($data, $data_supplier)
  {
    $this->db->trans_start(); # Starting Transaction
    $this->db->trans_strict(FALSE);

    // delete supplier 
    $this->db->delete($this->table_supplier, $data_supplier);
    // delete stokmasuk
    $this->db->delete($this->table, $data);
    $this->db->trans_complete();

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

  public function update($data, $where)
  {
    $this->db->update($this->table, $data, $where);
    return $this->db->affected_rows();
  }
}
