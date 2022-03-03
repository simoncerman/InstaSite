<?php

/**
 * * don't ask me how it works -> I'm an engineer
 */
// Redirect to install site
$root = "http://$_SERVER[HTTP_HOST]";
header("Location: " . $root . "/Controller/page.php");
exit();
