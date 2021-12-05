<head>
<?php
include dirname(getcwd(), 1) . '/pageParts/head.php';
?>
</head>
<body>
    <div class="small-wrap">
        <div class="title-section">
            <p>installation</p>
            <h2>Create your own web</h2>
        </div>
        <div class="input-section">
            <p>name your project</p>
            <input id="projectName" class="typeinput" type="text">
        </div>
        <div class="input-section">
            <p>select type of project</p>
            <div class="select-one">
                <div onclick="selectOne(this)" class="selector">Local shop</div>
                <div onclick="selectOne(this)" class="selector">Chat room</div>
                <div onclick="selectOne(this)" class="selector">Basic presentation</div>
                <div onclick="selectOne(this)" class="selector">Video presentation page</div>
            </div>
        </div>
        <div class="next-holder">
            <button class="next" onclick="basicInfoCreate()">Next</button>
        </div>
    </div>

</body>
</html>