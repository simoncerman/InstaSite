<head>
    <?php
    include dirname(getcwd(), 2) . '/View/SiteBlocks/head.php';
    ?>
</head>

<body onload="helpHandler()">
    <div class="wrap">
        <div class="title-section">
            <p>installation</p>
            <h1>Create your own web</h1>
        </div>
        <div class="content-wrap">
            <div class="input-section">
                <p>name your project</p>
                <input id="projectName" class="typeinput" type="text">
            </div>
            <div class="input-section">
                <p>select type of project</p>
                <div class="select-one" id="SiteType">
                    <div onclick="selectOne(this)" class="selector">Static page</div>
                    <div onclick="selectOne(this)" class="selector">Empty</div>

                </div>
            </div>
            <div class="next-holder">
                <button class="next" onclick="basicInfoCreate()">Next</button>
            </div>
        </div>
    </div>
    <div class="help-holder" id="help-holder" data-value="basicInfoCreate">
        <div class="help">
            <h4>Tip:</h4><br>
            <div id="help-index">0</div>
            <div class="help-text" id="help-text">There will be something interesting</div>
            <div class="progress" id="help-progress"></div>
        </div>
    </div>

</body>

</html>