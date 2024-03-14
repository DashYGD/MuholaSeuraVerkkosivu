<?php

include "../static/server/connect.php";
$sql = "SELECT * FROM varaus";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    /*
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $date = $_POST["date"];
    $selectedOption = $_POST["vuokra"];

    $to = "your@example.com";
    $subject = "Muholaseuran tilojen varaus";
    $message = "Email: $email\nPhone: $phone\nDate: $date\nSelected Option: $selectedOption";

    mail($to, $subject, $message);
    */

    

    header("Location: /etusivu");
    exit();
}
else {
    //echo "Virhe varaus pyynnön lähettämisessä.";
    //echo "<a href='/etusivu'>etusivu</a>";
    header("Location: /etusivu");
}
?>
