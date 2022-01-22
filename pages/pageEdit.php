<head>
    <?php
    include dirname(getcwd(), 1) . '/pageParts/global/head.php';
    require dirname(getcwd(), 1) . '/scripts/SiteAccess.php';
    ?>
</head>

<body>
    <div class="full-outer">
        <?= include dirname(getcwd(), 1) . '/pageParts/global/adminsSitebar.php'; ?>
        <div class="small-wrap">
            <div class="title-section">
                <p>main edit</p>
                <h2>Your pages..</h2>
            </div>
            <?php
            echo ($siteAccess->AdminSites());
            ?>
            <button class="btn-new" onclick="openDialogWindow('addPage')">Create new</button>
        </div>
        <div class="dialog-window" id="addPage">
            <p>Site name</p>
            <input type="text" name="pageName" id="pageNameInput">
            <button class="next" onclick="newSiteInsert()">Přidat</button>
        </div>
    </div>
</body>