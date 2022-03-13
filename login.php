<?php
include(getcwd() . '/View/SiteBlocks/head.php');
echo ($_SESSION["username"]);
?>

<div class="content-wrap" style="align-items: center;">
    <div class="input-section">
        <p>username*</p>
        <input id="AccountUsername" class="typeinput" type="text">
        <p>password*</p>
        <input id="AccountPassword" class="typeinput" type="password">
    </div>
    <div class="next-holder">
        <button class="next" onclick="Login()">Next</button>
    </div>
</div>