<?php

/**
 * @description load view header, topbar, sidebar, & footer
 *
 * @param string $page
 * @param string $data
 * @return void
 */
function template($page = null, $data = null)
{
  $ci = get_instance();
  $ci->load->view('template/header', $data);
  $ci->load->view('template/topbar', $data);
  $ci->load->view('template/sidebar', $data);
  $ci->load->view($page, $data);
  $ci->load->view('template/footer', $data);
}

/**
 * @description Hapus session 'sucess' & 'error'
 *
 * @return void
 */
function usetFlash()
{
  if (isset($_SESSION['success'])) {
    unset($_SESSION['success']);
  }
  if (isset($_SESSION['error'])) {
    unset($_SESSION['error']);
  }
}
