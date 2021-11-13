<?php
$root = "http://$_SERVER[HTTP_HOST]";
$installed = false;
if ($installed == false) {
    header("Location: " . $root . "/19ia04_cerman/pages/page-install.php");
}
