<head>
    <?php
    include dirname(getcwd(), 1) . '/pageParts/global/head.php';
    require dirname(getcwd(), 1) . '/scripts/SiteAccess.php';
    require dirname(getcwd(), 1) . '/scripts/JsonAccess.php';
    ?>
</head>

<body id="body">
    <div class="full-outer">
        <?= include dirname(getcwd(), 1) . '/pageParts/global/adminsSitebar.php'; ?>
        <div class="small-wrap">
            <a href="http://vocko/19ia04_cerman/pages/pageEdit.php" class="go-back-button"><i class="fas fa-arrow-circle-left"></i></a>
            <h2><?= $_GET["partName"] ?></h2>
            <div class="preview">
                <div class="preview-title">
                    <p>preview:</p>
                </div>
                <div class="part-preview">
                    <?= $JsonAccess->TestingDefault() ?>
                </div>
            </div>
            <div class="editor">
                <div class="editor-title">
                    <p>editor:</p>
                </div>
                <div class="components">
                    <?= $JsonAccess->LoadEditor() ?>
                </div>
            </div>
        </div>

    </div>

</body>