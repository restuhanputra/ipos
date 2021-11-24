<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->table = 'produk_kategori';
  }

  public function getAllData()
  {
    return $this->db->get($this->table);
  }

  public function insert($data)
  {
    $this->db->insert($this->table, $data);
    return $this->db->affected_rows();
  }

  public function getDataBy($data)
  {
    return $this->db->get_where($this->table, $data);
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
