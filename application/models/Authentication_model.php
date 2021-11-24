<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Authentication_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->table = 'pengguna';
  }

  /**
   * @description cek data user
   *
   * @param string $username
   * @param string $password
   * @return void
   */
  public function cekUser($email, $password)
  {
    return $this->db->get_where(
      $this->table,
      array(
        'email'    => $email,
        'password' => sha1($password)
      )
    );
  }
}
