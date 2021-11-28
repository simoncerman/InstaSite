<!DOCTYPE html>
<html lang="en">
<head>
<?php
include dirname(getcwd(), 1) . '/pageParts/head.php';
?>
</head>
<body>
    <div class="small-wrap">
        <div class="title-section">
            <p>user</p>
            <h2>Create your account</h2>
        </div>
        <div class="input-section">
            <p>username</p>
            <input class="typeinput" type="text">
            <p>password</p>
            <input class="typeinput" type="text">
            <p>email</p>
            <input class="typeinput" type="text">
        </div>
        <div class="input-section">
            <p>select type of account</p>
            <div class="select-one">
                <div onclick="selectOne(this)" class="selector">Creator</div>
                <div onclick="selectOne(this)" class="selector">Administrator</div>
                <div onclick="selectOne(this)" class="selector">User</div>
                <div onclick="selectOne(this)" class="selector">Publisher</div>
            </div>
        </div>
        <div class="next-holder">
            <button class="next" onclick="basicAccountCreate()">Next</button>
        </div>
    </div>
</body>
</html>