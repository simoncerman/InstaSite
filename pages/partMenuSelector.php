<head>
    <?php
    include dirname(getcwd(), 1) . '/pageParts/global/head.php';
    ?>
</head>

<body>
    <a href="http://vocko/19ia04_cerman/pages/pageEdit.php" class="go-back-button"><i class="fas fa-arrow-circle-left"></i></a>
    <div class="small-wrap">
        <div class="title-section">
            <p>Just parts to choose...</p>
            <h2>{Site name}</h2>
        </div>
        <div class="grid-holder">
            <div class="grid-choose">
                <div class="grid-right">
                    <h2>Header</h2>
                    <i class="fas fa-cog"></i>
                </div>
                <div class="grid-left">
                    <label class="switch">
                        <input type="checkbox" checked>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
            <div class="grid-choose">
                <div class="grid-right">
                    <h2>Footer</h2>
                    <i class="fas fa-cog"></i>
                </div>
                <div class="grid-left">
                    <label class="switch">
                        <input type="checkbox" checked>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
        </div>
        <p>non-active</p>
        <div class="grid-holder">
            <div class="grid-choose">
                <div class="grid-right">
                    <h2>Form</h2>
                    <i class="fas fa-cog"></i>
                </div>
                <div class="grid-left">
                    <label class="switch">
                        <input type="checkbox">
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
            <div class="grid-choose">
                <div class="grid-right">
                    <h2>Rick roll element</h2>
                    <i class="fas fa-cog"></i>
                </div>
                <div class="grid-left">
                    <label class="switch">
                        <input type="checkbox">
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
        </div>
        <button class="btn-new ">
            Create new
        </button>
    </div>
</body>

</html>