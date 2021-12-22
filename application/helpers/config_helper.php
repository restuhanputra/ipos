<?php
defined('BASEPATH') or exit('No direct script access allowed');

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

/**
 * @description format rupiah
 *
 * @return void
 */
if (!function_exists('rupiah')) {
  function rupiah($angka)
  {
    $hasil_rupiah = number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
  }
}


/**
 * @description Rubah format tanggal ke format indonesia dengan nama bulan dan hari indonesia
 * @param  string $timestamp   [bisa dalam bentuk timestamp atau unix_date]
 * @param  string $date_format [d F Y ==> 12 Januari 2017]
 * @param  string $suffix      [contoh tuliskan WIB default false]
 * @return [string]              [tanggal indonesia]
 *
 */
function indonesian_date($timestamp = '', $date_format = 'd F Y', $suffix = '')
{
  if ($timestamp == NULL)
    return '-';

  if ($timestamp == '1970-01-01' || $timestamp == '0000-00-00' || $timestamp == '-25200')
    return '-';


  if (trim($timestamp) == '') {
    $timestamp = time();
  } elseif (!ctype_digit($timestamp)) {
    $timestamp = strtotime($timestamp);
  }
  # remove S (st,nd,rd,th) there are no such things in indonesia :p
  $date_format = preg_replace("/S/", "", $date_format);
  $pattern = array(
    '/Mon[^day]/', '/Tue[^sday]/', '/Wed[^nesday]/', '/Thu[^rsday]/',
    '/Fri[^day]/', '/Sat[^urday]/', '/Sun[^day]/', '/Monday/', '/Tuesday/',
    '/Wednesday/', '/Thursday/', '/Friday/', '/Saturday/', '/Sunday/',
    '/Jan[^uary]/', '/Feb[^ruary]/', '/Mar[^ch]/', '/Apr[^il]/', '/May/',
    '/Jun[^e]/', '/Jul[^y]/', '/Aug[^ust]/', '/Sep[^tember]/', '/Oct[^ober]/',
    '/Nov[^ember]/', '/Dec[^ember]/', '/January/', '/February/', '/March/',
    '/April/', '/June/', '/July/', '/August/', '/September/', '/October/',
    '/November/', '/December/',
  );
  $replace = array(
    'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min',
    'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu',
    'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des',
    'Januari', 'Februari', 'Maret', 'April', 'Juni', 'Juli', 'Agustus', 'September',
    'Oktober', 'November', 'Desember',
  );
  $date = date($date_format, $timestamp);
  $date = preg_replace($pattern, $replace, $date);
  $date = "{$date} {$suffix}";
  return $date;
}
