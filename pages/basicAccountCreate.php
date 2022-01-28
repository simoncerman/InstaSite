<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include dirname(getcwd(), 1) . '/pageParts/global/head.php';
    ?>
</head>

<body>
    <div class="wrap">
        <div class="title-section">
            <p>user</p>
            <h2>Create your account</h2>
        </div>
        <div class="content-wrap">
            <div class="input-section">
                <p>username*</p>
                <input id="AccountUsername" class="typeinput" type="text">
                <p>password*</p>
                <input id="AccountPassword" class="typeinput" type="text">
                <p>email</p>
                <input id="AccountEmail" class="typeinput" type="text">
                <p>select type of account</p>
                <div class="select-one" id="AcType">
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

    </div>
</body>

</html>