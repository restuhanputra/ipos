<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Konfigurasi_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->table = 'konfigurasi';
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
