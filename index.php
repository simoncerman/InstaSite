<?php
// Redirect to install site
$root = "http://$_SERVER[HTTP_HOST]";
header("Location: " . $root . "/19ia04_cerman/pages/page.php");
exit();
