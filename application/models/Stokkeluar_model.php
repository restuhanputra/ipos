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
    $this->table_pengguna  = 'pengguna';
  }

  /**
   * @description Ambil semua data
   *
   * @return void
   */
  public function getAllData()
  {
    $this->db->select('stok_keluar.*, 
                      produk.produk_nama as produk_nama,
                      produk.satuan_id as satuan_id,
                      produk_satuan.satuan_nama as satuan_nama,
                      pengguna.id as pengguna_id,
                      pengguna.nama as pengguna_nama');
    $this->db->from($this->table);
    $this->db->join($this->table_produk, 'produk.id = stok_keluar.produk_id');
    $this->db->join($this->table_satuan, 'produk_satuan.id = produk.satuan_id');
    $this->db->join($this->table_pengguna, 'pengguna.id = stok_keluar.pengguna_id');
    $this->db->order_by('stok_keluar.id', 'ASC');
    return $this->db->get();
  }

  /**
   * @description Ambil data nomor transaksi
   *
   * @return void
   */
  function getNoTransaksi()
  {
    $q = $this->db->query("SELECT MAX(RIGHT(no_transaksi,4)) AS kode_max FROM stok_keluar WHERE DATE(create_at)=CURDATE()");
    $kd = "";
    if ($q->num_rows() > 0) {
      foreach ($q->result() as $k) {
        $tmp = ((int)$k->kode_max) + 1;
        $kd = sprintf("%04s", $tmp);
      }
    } else {
      $kd = "0001";
    }
    $stokmasuk = "STK-";
    date_default_timezone_set('Asia/Jakarta');
    return $stokmasuk . date('dmy') . $kd;
  }

  /**
   * @description Ambil data stok masuk via ajax
   *
   * @param string $data
   * @return void
   */
  public function getajax($data)
  {
    $this->db->select('
                      stok_masuk.id as id,
                      stok_masuk.produk_id as produk_id,
                      stok_masuk.jumlah as jumlah,
                      produk.harga as harga,
                      ');
    $this->db->from($this->table_stokmasuk);
    $this->db->join($this->table_produk, 'produk.id = stok_masuk.produk_id');
    $this->db->where($data);
    return $this->db->get();
  }

  /**
   * @description Menambahkan dan update data via transaction
   *
   * @param string $data
   * @param string $dataUpdate
   * @param int $id
   * @return void
   */
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

  /**
   * @description Ambil data bedasarkan $table & $data
   *
   * @param string $table
   * @param string $data
   * @return void
   */
  public function getDataBy($table, $data)
  {
    if ($table != null) {
      return $this->db->get_where($table, $data);
    } else {
      $this->db->select('
                        stok_keluar.*, 
                        produk.produk_nama as produk_nama,
                        produk.satuan_id as satuan_id,
                        produk_satuan.satuan_nama as satuan_nama
                        ');
      $this->db->from($this->table);
      $this->db->join($this->table_produk, 'produk.id = stok_keluar.produk_id');
      $this->db->join($this->table_satuan, 'produk_satuan.id = produk.satuan_id');
      $this->db->where($data);
      return $this->db->get();
    }
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
