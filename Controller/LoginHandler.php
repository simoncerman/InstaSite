<?php
class LoginHandler
{
    function LoginCheck()
    {
        echo (session_status());
        if (session_status() == 1) {
            //need to be loged in => move to login page
            $root = "http://$_SERVER[HTTP_HOST]";
            header("Location: " . $root . "/login.php");
        } else if (session_status() == 2) {
            //need to be checked if loged user is good login
            echo ($_SESSION["username"]);
            echo ($_SESSION["password"]);
            $verify = $this->VerifyLogin($_SESSION["username"], $_SESSION["password"]);
            if ($verify == false) {
                echo ("verify failed");
                $root = "http://$_SERVER[HTTP_HOST]";
                header("Location: " . $root . "/login.php");
            }
        }
    }
    /**
     * Function to check if input login details are correct
     * @param string $username
     * @param string $password
     */
    function VerifyLogin($username, $password)
    {
        require_once dirname(getcwd(), 1) . '/Model/DbAccess.php';
        $DbAccess = new DbAccess();
        $hashedPassword = $DbAccess->GetHashedPassword($username);
        $valid = password_verify($password, $hashedPassword);
        if ($valid) {
            if (password_needs_rehash($password, PASSWORD_DEFAULT)) {
                $newHash = password_hash($password, PASSWORD_DEFAULT);
                $DbAccess->updateData("accountinfo", "AccountPassword", "'" . $newHash . "'", "AccountName='{$username}'");
            }
            if (session_status() == 1) {
                session_start();
            }
            $_SESSION["username"] = $username;
            $_SESSION["password"] = $password;
            return true;
        } else {
            echo ("Your password/username is notcorrect!");
            return false;
        }
    }
}
$loginHandler = new LoginHandler();
