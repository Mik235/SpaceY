<?php
if(isset($_POST['email'])) {


    $email_to = "SpaceY@SpaceY.com";
    $email_subject = "Kontaktanfrage";

    function died($error) {

        echo "Es tut uns sehr leid, aber bei dem von Ihnen übermittelten Formular wurden Fehler gefunden. ";
        echo "Die Fehler werden unten angezeigt.<br /><br />";
        echo $error."<br /><br />";
        echo "Bitte überprüfe deine Eingaben und behebe die Fehler!<br /><br />";
        die();
    }



    if(!isset($_POST['first_name']) ||
        !isset($_POST['last_name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['telephone']) ||
        !isset($_POST['comments'])) {
        died('Wir entschuldigen uns für diese umstände, es gibt jedoch ein Problem mit dem Formular. ');
    }



    $first_name = $_POST['first_name']; // required
    $last_name = $_POST['last_name']; // required
    $email_from = $_POST['email']; // required
    $telephone = $_POST['telephone']; // not required
    $comments = $_POST['comments']; // required

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'Die eingegeben E-Mail ist ungültig.<br />';
  }

    $string_exp = "/^[A-Za-z .'-]+$/";

  if(!preg_match($string_exp,$first_name)) {
    $error_message .= 'Der eingegegebene Vorname ist ungültig.<br />';
  }

  if(!preg_match($string_exp,$last_name)) {
    $error_message .= 'Der eingegeben Nachname ist ungültig.<br />';
  }

  if(strlen($comments) < 2) {
    $error_message .= 'Die eingegeben Nachricht ist ungültig<br />';
  }

  if(strlen($error_message) > 0) {
    died($error_message);
  }

    $email_message = "Ihre Nachricht an uns.\n\n";


    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }



    $email_message .= "Vorname: ".clean_string($first_name)."\n";
    $email_message .= "Nachname: ".clean_string($last_name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Telephone: ".clean_string($telephone)."\n";
    $email_message .= "Nachricht: ".clean_string($comments)."\n";

// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);
?>



Danke für deine Kontaktanfrage wir werden uns bald bei dir melden.

<?php

}
?>
