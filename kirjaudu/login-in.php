<?php
include "../static/server/connect.php";

function start_session_if_not_started() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
}

if (isset($_POST['email_1'], $_POST['password_1'])) {
    $username = $_POST['email_1'];
    $password = $_POST['password_1'];

    $stmt = $conn->prepare("SELECT * FROM käyttäjät WHERE email = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            start_session_if_not_started();
            if ($row['is_admin'] == 1) {
                $_SESSION['muhola_admin'] = true;
            } else {
                $_SESSION['kayttaja'] = $username;
            }
            if ($row['is_admin'] == 1) {
                header("Location: admin");
            } else {
                header("Location: dashboard");
            }
            $stmt->close();
            exit();
        } else {
            start_session_if_not_started();
            $_SESSION['login_error'] = "Väärä käyttäjänimi tai salasana";
            $stmt->close();
            header("Location: login");
            exit();
        }
    } else {
        start_session_if_not_started();
        $_SESSION['login_error'] = "Väärä käyttäjänimi tai salasana";
        $stmt->close();
        header("Location: login");
        exit();
    }
}