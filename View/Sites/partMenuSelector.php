<head>
    <?php
    include dirname(getcwd(), 2) . '/View/SiteBlocks/head.php';
    require dirname(getcwd(), 2) . '/Controller/SiteAccess.php';
    ?>
</head>

<body>
    <div class="full-outer">
        <?php include dirname(getcwd(), 2) . '/View/SiteBlocks/adminsSitebar.php'; ?>
        <div class="small-wrap">
            <a href="http://vocko/19ia04_cerman/View/Sites/pageEdit.php" class="go-back-button"><i class="fas fa-arrow-circle-left"></i></a>
            <div class="header">
                <div class="back">
                    <a href="http://vocko/19ia04_cerman/View/Sites/pageEdit.php">
                        <i class="fas fa-angle-left"></i>
                    </a>
                </div>
                <div class="title">
                    <h2>Just parts to choose...</h2>
                    <h1 id="siteNameH2"><?php echo ($_GET["siteName"]); ?></h1>
                </div>
            </div>

            <?php
            //This part will echo all part data to site
            ?>
            <div class="grid-holder">
                <p>enabled</p>
                <?php echo ($siteAccess->LoadActiveParts($_GET["siteName"]));  ?>
            </div>
            <div class="grid-holder">
                <p>disabled</p>
                <?php echo ($siteAccess->LoadDisabledParts($_GET["siteName"]));  ?>
            </div>
            <div class="btn-fw-holder">
                <button onclick="openDialogWindow('newPart')" class="btn-new">
                    Create new
                </button>
            </div>
            <div class="dialog-window" id="newPart">
                <p>Part name</p>
                <input type="text" name="partName" id="partNameInput">
                <button class="next" onclick="newPart()">Přidat</button>
            </div>
        </div>
    </div>
</body>

</html>