<head>
    <?php
    include dirname(getcwd(), 1) . '/pageParts/global/head.php';
    require dirname(getcwd(), 1) . '/scripts/BackAccess.php';
    ?>
</head>

<body>
    <div class="small-wrap">
        <div class="title-section">
            <p>main edit</p>
            <h2>Your pages..</h2>
        </div>
        <p>active</p>
        <div class="grid-holder">
            <?php echo (""); ?>

            <div class="grid-choose">
                <div class="grid-right">
                    <h1>Homepage</h1>
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
                    <h1>About</h1>
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
                    <h2>Contact</h2>
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
                    <h2>Rick roll</h2>
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