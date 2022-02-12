<head>
    <?php
    include dirname(getcwd(), 1) . '/pageParts/global/head.php';
    require dirname(getcwd(), 1) . '/scripts/SiteAccess.php';
    ?>
</head>

<body>
    <div class="full-outer">
        <?php include dirname(getcwd(), 1) . '/View/adminsSitebar.php'; ?>
        <div class="small-wrap">
            <div class="header">
                <div class="title">
                    <h2>main edit</h2>
                    <h1>Your pages..</h1>
                </div>
            </div>
            <?php
            echo ($siteAccess->AdminSites());
            ?>
            <div class="btn-fw-holder">
                <button class="btn-new" onclick="openDialogWindow('addPage')">Create new</button>
            </div>
            <div class="dialog-window" id="addPage">
                <p>Site name</p>
                <input type="text" name="pageName" id="pageNameInput">
                <button class="next" onclick="newSiteInsert()">Přidat</button>
            </div>
        </div>
    </div>
</body>