<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->table = 'pelanggan';
  }

  /**
   * @description Ambil semua data
   *
   * @return void
   */
  public function getAllData()
  {
    return $this->db->get($this->table);
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
    return $this->db->get_where($this->table, $data);
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
