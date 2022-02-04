<head>
    <?php
    include dirname(getcwd(), 1) . '/pageParts/global/head.php';
    require dirname(getcwd(), 1) . '/scripts/SiteAccess.php';
    require dirname(getcwd(), 1) . '/scripts/JsonAccess.php';
    require dirname(getcwd(), 1) . '/scripts/PartPreview.php';


    ?>
</head>


<body id="body">
    <div class="full-outer">
        <?php include dirname(getcwd(), 1) . '/pageParts/global/adminsSitebar.php'; ?>
        <div class="small-wrap">
            <a href="http://vocko/19ia04_cerman/pages/pageEdit.php" class="go-back-button"><i class="fas fa-arrow-circle-left"></i></a>
            <div class="header">
                <div class="back">
                    <a href="http://vocko/19ia04_cerman/pages/pageEdit.php">
                        <i class="fas fa-angle-left"></i>
                    </a>
                </div>
                <div class="title">
                    <h2>part what you are editing is </h2>
                    <h1><?= $_GET["partName"] ?></h1>
                </div>
            </div>
            <div class="preview">
                <div class="preview-title">
                    <p>preview:</p>
                </div>
                <div class="part-preview">
                    <?= $PreviewHandler->TestingDefault() ?>
                </div>
            </div>
            <div class="editor">
                <div class="editor-title">
                    <p>editor:</p>
                </div>
                <div class="editor-ui">
                    <div class="components">
                        <?= $JsonAccess->LoadEditor() ?>
                    </div>
                    <div class="editable-window">
                        <?php
                        if ($_GET["mode"] == null || $_GET["path"] == null) {
                            echo ("tap on element to edit/add");
                        } else {
                            if ($_GET["mode"] == "edit") {
                                echo ($JsonAccess->EditElementUI($_GET["path"]));
                            }
                            if ($_GET["mode"] == "add") {
                                echo ($JsonAccess->AddElementUI($_GET["path"]));
                            }
                        }
                        ?>
                    </div>
                </div>

            </div>
        </div>

    </div>

</body>