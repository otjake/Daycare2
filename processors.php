<?php

$errors = [];
$data = [];

if (!empty($_POST['processor']) && ($_POST['processor'] == 'contact') ) {
    if (empty($_POST['name'])) {
        $errors['name'] = 'Name is required.';
    }

    if (empty($_POST['email'])) {
        $errors['email'] = 'Email is required.';
    }

    if (empty($_POST['subject'])) {
        $errors['subject'] = 'Subject is required.';
    }

    if (empty($_POST['message'])) {
        $errors['message'] = 'message is required.';
    }


    require 'mail/PHPMailerAutoload.php';
    date_default_timezone_set('UTC');
    //Admin email configuration
    $admin_mail = new PHPMailer;

    //sumbission data
    $ipaddress = $_SERVER['REMOTE_ADDR'];
    $date = date('d/m/Y');
    $time = date('H:i:s');

    // TODO: set email server host email address
    $emailfrom = $_POST['email'];
//    $emailfrom = "service@personalizedwineng.com";


    //$admin_mail->SMTPDebug = 3;                               // Enable verbose debug output

    $admin_mail->isSMTP();                                      // Set mailer to use SMTP
    $admin_mail->Host = 'smtp.mailtrap.io';  // Specify main and backup SMTP servers
    $admin_mail->SMTPAuth = true;                               // Enable SMTP authentication
    $admin_mail->Username = '558dd39d637677';                 // SMTP username
    $admin_mail->Password = '2d8bc3a75f7f8d';                           // SMTP password
    $admin_mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $admin_mail->Port = 2525;                                    // TCP port to connect to
    try {
        $admin_mail->setFrom($emailfrom);
    } catch (phpmailerException $e) {
    }
    $admin_mail->addAddress('jake@gmail.com');     // Add a recipient
    // $admin_mail->addAddress('ellen@example.com');               // Name is optional
    $admin_mail->addCC('');

    $admin_mail->isHTML(true); // Set email format to HTML

    $admin_mail->Subject = $_POST['subject'];
    $message1 = $_POST["message"];


    $admin_mail->Body = "<html> 
                        
<div>
    <p>
      
              <div style='text-align:center;background:rgb(255, 255, 255);width:100%;line-height:26px; height:60%;margin:auto;border-radius:1rem;margin-top:50px;margin-bottom:57px;'>

      <div style='text-align:center;background: rgb(27, 27, 27); width:100%; height:60px;margin-top:3rem; '>
        <h2 style='padding-top:2%;color:rgb(255, 255, 255)  ;'>DD' CLEMS</h2>
      </div>
          <div style='background:rgb(255, 255, 255) ;width:80%;margin:auto;margin-top:2px;border-radius:2rem;'>
<div style='text-align: left;'>
      Hi Sandra,   
       <br>
       You have a feed back from a client
          <br>
          <p style='text-align: center;'>
         $message1  
          </p>
          </div>
      </div>
    </p>
    <div style='background: url('img/Images/dd_clem.png') center/cover no-repeat;display: flex;width: 100%;height: 20%;'>
      <div style='text-align:center;background: rgb(27, 27, 27);width:100%; height:70px;opacity: 0.5; height: 100%;'>
<h2 style='color: white;opacity: 1;margin: 54px;'>DD' CLEMS</h2>      </div>
    </div>
    </div>
  </div>
 </html>

";
    if (!$admin_mail->Send())        //Send an Email. Return true on success or false on error
    {
        $errors['failedEmail'] = '<label class="text-danger">There is an Error</label>';
    }

    if (!empty($errors)) {
        $data['success'] = false;
        $data['errors'] = '<div class="alert alert-danger">' .$errors . '</div>';
    } else {
        $data['success'] = true;
        $data['message'] = '<div class="alert alert-success">Success!</div>';
    }
    echo json_encode($data);
}

### For subscribtion to newsletter #####
if (!empty($_POST['subscribe']) && ($_POST['subscribe'] == 'subscribe') ) {
    if (empty($_POST['email'])) {
        $errors['email'] = 'Email is required.';
    }

    require 'mail/PHPMailerAutoload.php';
    date_default_timezone_set('UTC');
    //Admin email configuration
    $admin_mail = new PHPMailer;

    //sumbission data
    $ipaddress = $_SERVER['REMOTE_ADDR'];
    $date = date('d/m/Y');
    $time = date('H:i:s');

    // TODO: set email server host email address
    $emailfrom = $_POST['email'];
//    $emailfrom = "service@personalizedwineng.com";


    //$admin_mail->SMTPDebug = 3;                               // Enable verbose debug output

    $admin_mail->isSMTP();                                      // Set mailer to use SMTP
    $admin_mail->Host = 'smtp.mailtrap.io';  // Specify main and backup SMTP servers
    $admin_mail->SMTPAuth = true;                               // Enable SMTP authentication
    $admin_mail->Username = '558dd39d637677';                 // SMTP username
    $admin_mail->Password = '2d8bc3a75f7f8d';                           // SMTP password
    $admin_mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $admin_mail->Port = 2525;                                    // TCP port to connect to
    try {
        $admin_mail->setFrom($emailfrom);
    } catch (phpmailerException $e) {
    }
    $admin_mail->addAddress('jake@gmail.com');     // Add a recipient
    // $admin_mail->addAddress('ellen@example.com');               // Name is optional
    $admin_mail->addCC('');

    $admin_mail->isHTML(true); // Set email format to HTML

    $admin_mail->Subject = "A client subscribed to your new letter";
    $message1 = $_POST["email"];


    $admin_mail->Body = "<html> 
                        
<div>
    <p>
      
              <div style='text-align:center;background:rgb(255, 255, 255);width:100%;line-height:26px; height:60%;margin:auto;border-radius:1rem;margin-top:50px;margin-bottom:57px;'>

      <div style='text-align:center;background: rgb(27, 27, 27); width:100%; height:60px;margin-top:3rem; '>
        <h2 style='padding-top:2%;color:rgb(255, 255, 255)  ;'>DD' CLEMS</h2>
      </div>
          <div style='background:rgb(255, 255, 255) ;width:80%;margin:auto;margin-top:2px;border-radius:2rem;'>
<div style='text-align: left;'>
      Hi Sandra,   
       <br>
       A client has subscribed to your newletter,find the email below.
          <br>
          <p style='text-align: center;'>
        EMAIL : $message1  
          </p>
          </div>
      </div>
    </p>
    <div style='background: url('img/Images/dd_clem.png') center/cover no-repeat;display: flex;width: 100%;height: 20%;'>
      <div style='text-align:center;background: rgb(27, 27, 27);width:100%; height:70px;opacity: 0.5; height: 100%;'>
<h2 style='color: white;opacity: 1;margin: 54px;'>DD' CLEMS</h2>      </div>
    </div>
    </div>
  </div>
 </html>

";
    if (!$admin_mail->Send())        //Send an Email. Return true on success or false on error
    {
        $errors['failedEmail'] = '<label class="text-danger">There is an Error</label>';
    }

    if (!empty($errors)) {
        $data['success'] = false;
        $data['errors'] = '<div class="alert alert-danger">' .$errors . '</div>';
    } else {
        $data['success'] = true;
        $data['message'] = '<div class="alert alert-success">Success!</div>';
    }
    echo json_encode($data);
}


