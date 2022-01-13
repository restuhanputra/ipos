<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->table = 'pengguna';
  }

  public function getAllData()
  {
    return $this->db->get($this->table);
  }

  function getNip()
  {
    $q = $this->db->query("SELECT MAX(RIGHT(nip,3)) AS kode_max FROM pengguna WHERE DATE(create_at)");
    $kd = "";
    if ($q->num_rows() > 0) {
      foreach ($q->result() as $k) {
        $tmp = ((int)$k->kode_max) + 1;
        $kd = sprintf("%03s", $tmp);
      }
    } else {
      $kd = "001";
    }
    date_default_timezone_set('Asia/Jakarta');
    $tahun = date("y");
    $bulan = date("m");
    return $tahun . $bulan . $kd;
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
