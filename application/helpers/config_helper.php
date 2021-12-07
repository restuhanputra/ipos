<?php

/**
 * @description load view header, topbar, sidebar, & footer
 *
 * @param string $page
 * @param string $data
 * @return void
 */
if (!function_exists('template')) {
  function template($page = null, $data = null)
  {
    $ci = get_instance();
    $ci->load->view('template/header', $data);
    $ci->load->view('template/topbar', $data);
    $ci->load->view('template/sidebar', $data);
    $ci->load->view($page, $data);
    $ci->load->view('template/footer', $data);
  }
}

/**
 * @description Hapus session 'sucess' & 'error'
 *
 * @return void
 */
if (!function_exists('usetFlash')) {
  function usetFlash()
  {
    if (isset($_SESSION['success'])) {
      unset($_SESSION['success']);
    }
    if (isset($_SESSION['error'])) {
      unset($_SESSION['error']);
    }
  }
}

if (!function_exists('rupiah')) {
  function rupiah($angka)
  {
    $hasil_rupiah = number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
  }
}
