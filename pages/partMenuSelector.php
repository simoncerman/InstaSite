<head>
    <?php
    include dirname(getcwd(), 1) . '/pageParts/global/head.php';
    require dirname(getcwd(), 1) . '/scripts/SiteAccess.php';
    ?>
</head>

<body>
    <div class="full-outer">
        <?= include dirname(getcwd(), 1) . '/pageParts/global/adminsSitebar.php'; ?>
        <a href="http://vocko/19ia04_cerman/pages/pageEdit.php" class="go-back-button"><i class="fas fa-arrow-circle-left"></i></a>
        <div class="small-wrap">
            <div class="title-section">
                <p>Just parts to choose...</p>
                <h2 id="siteNameH2"><?php echo ($_GET["siteName"]); ?></h2>
            </div>
            <?php
            //This part will echo all part data to site
            ?>
            <p>enabled</p>
            <div class="grid-holder">
                <?php echo ($siteAccess->LoadActiveParts($_GET["site"]));  ?>
            </div>
            <p>disabled</p>
            <div class="grid-holder">
                <?php echo ($siteAccess->LoadDisabledParts($_GET["site"]));  ?>
            </div>
            <button onclick="openDialogWindow('newPart')" class="btn-new">
                Create new
            </button>
            <div class="dialog-window" id="newPart">
                <p>Part name</p>
                <input type="text" name="partName" id="partNameInput">
                <button class="next" onclick="newPart()">Přidat</button>
            </div>
        </div>
    </div>
</body>

</html>