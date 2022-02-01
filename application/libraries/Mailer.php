<?php defined('BASEPATH') or exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
  protected $_ci;
  protected $email_pengirim = '';      // Isikan dengan email pengirim
  protected $nama_pengirim  = '';       // Isikan dengan nama pengirim
  protected $password       = '';  // Isikan dengan password email pengirim

  public function __construct()
  {
    $this->_ci = &get_instance(); // Set variabel _ci dengan Fungsi2-fungsi dari Codeigniter

    require_once('PHPMailer/src/Exception.php');
    require_once('PHPMailer/src/PHPMailer.php');
    require_once('PHPMailer/src/SMTP.php');
  }

  public function send($data)
  {
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = $this->email_pengirim;                     //SMTP username
    $mail->Password   = $this->password;                               //SMTP password
    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->SMTPSecure = 'ssl';            //Enable implicit ssl encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom($this->email_pengirim, $this->nama_pengirim);
    $mail->addAddress($data['to_email'], '');     //Add a recipient

    $pesan = "
      <html>
        <head>
          <title>Reset Password IPOS</title>
        </head>
        <body>
          <p>Akun Anda:</p>
          <p>Email : " . $data['to_email'] . "</p>
          <p>Password : " . $data['randomPass'] . "</p>
          <p>Mohon untuk login, dan ubah password baru. Terima kasih.</p>
          <h4><a href='" . base_url() . "'>Login</a></h4>
        </body>
      </html>
      ";

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = "Ubah Password IPOS";
    $mail->Body    = $pesan;
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $send = $mail->send();
    if ($send) { // Jika Email berhasil dikirim
      // $response = array('status' => 'Sukses', 'message' => 'Email berhasil dikirim');
      $response = true;
    } else { // Jika Email Gagal dikirim
      // $response = array('status' => 'Gagal', 'message' => 'Email gagal dikirim');
      $response = false;
    }

    return $response;
  }
}
