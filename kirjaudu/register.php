<?php
include "../static/server/connect.php";

function start_session_if_not_started() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
}

if (isset($_POST['name_2'], $_POST['email_2'], $_POST['password_2'])) {
    $name = $_POST['name_2'];
    $email = $_POST['email_2'];
    $password = $_POST['password_2'];

    $stmt = $conn->prepare("SELECT email FROM käyttäjät WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        start_session_if_not_started();
        $_SESSION['register_error'] = "Valitsemasi sähköposti on jo käytössä";
        $_SESSION['registration_attempt'] = true;
        $stmt->close();
        header("Location: login");
        exit();
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        $stmt = $conn->prepare("INSERT INTO käyttäjät (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hashed_password);
        
        if ($stmt->execute()) {
            start_session_if_not_started();
            $_SESSION['register_success'] = "Käyttäjä lisätty järjestelmään, ole hyvä ja kirjaudu sisään";
            $_SESSION['registration_attempt'] = true;
            $stmt->close();
            header("Location: login");
            exit();
        } else {
            start_session_if_not_started();
            $_SESSION['register_error'] = "Virhe käyttäjän lisäämisessä";
            $_SESSION['registration_attempt'] = true;
            $stmt->close();
            header("Location: login");
            exit();
        }
    }
}