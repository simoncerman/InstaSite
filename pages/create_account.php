<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
<script src="scripts.js"></script>
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
            <button class="next" onclick="NextFirst()">Next</button>
        </div>
    </div>
</body>
</html>