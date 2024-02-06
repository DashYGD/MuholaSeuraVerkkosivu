<?php
include "../static/server/connect.php";

function start_session_if_not_started() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
}

function generateToken($length = 32) {
    return bin2hex(random_bytes($length));
}

function setUserToken($user_id, $token, $conn) {
    $_SESSION['id'] = $user_id;
    $_SESSION['token'] = $token;
    setcookie('auth_token', $token, time() + (86400 * 30), "/");

    $stmt = $conn->prepare("UPDATE käyttäjät SET token = ? WHERE id = ?");
    $stmt->bind_param("si", $token, $user_id);
    $stmt->execute();
    $stmt->close();
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
            if (isset($_POST['muista_minut'])) {
                setUserToken($row['id'], generateToken(), $conn);
            }
            if ($row['is_admin'] == 1) {
                $_SESSION['muhola_admin'] = true;
                header("Location: admin");
            } else {
                $_SESSION['muhola_user'] = $username;
                header("Location: dashboard");
            }
            $stmt->close();
            exit();
        } else {
            start_session_if_not_started();
            $_SESSION['login_error'] = "Väärä sähköposti tai salasana";
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