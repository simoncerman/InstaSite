<head>
    <?php
    include dirname(getcwd(), 2) . '/View/SiteBlocks/head.php';
    require dirname(getcwd(), 2) . '/Controller/SiteAccess.php';
    require dirname(getcwd(), 2) . '/Model/JsonAccess.php';
    require dirname(getcwd(), 2) . '/Model/PartPreview.php';
    require dirname(getcwd(), 2) . '/Model/ComponentsPreview.php';
    ?>
</head>


<body id="body">
    <div class="full-outer">
        <?php include dirname(getcwd(), 2) . '/View/SiteBlocks/adminsSitebar.php'; ?>
        <div class="small-wrap">
            <a href="http://vocko/19ia04_cerman/View/Sites/pageEdit.php" class="go-back-button"><i class="fas fa-arrow-circle-left"></i></a>
            <div class="header">
                <div class="back">
                    <a href="http://vocko/19ia04_cerman/View/Sites/partMenuSelector.php?siteName=<?= $_GET["siteName"] ?>">
                        <i class="fas fa-angle-left"></i>
                    </a>
                </div>
                <div class="title">
                    <h2>part what you are editing is </h2>
                    <h1 id="partName"><?= $_GET["partName"] ?></h1>
                </div>
            </div>
            <div class="preview">
                <div class="preview-title">
                    <p>preview:</p>
                </div>
                <div class="part-preview">
                    <?= $PreviewHandler->LoadPreview($_GET["partName"]) ?>
                </div>
            </div>
            <div class="editor">
                <div class="editor-title">
                    <p>editor:</p>
                </div>
                <div class="editor-ui">
                    <div class="components">
                        <?= $ComponentsPreviewHandler->LoadComponentsPreview($_GET["partName"]) ?>
                    </div>
                    <div class="editable-window">
                        <?php
                        if ($_GET["mode"] == null || $_GET["path"] == null) {
                            echo ("tap on element to edit/add");
                        } else {
                            if ($_GET["mode"] == "edit") {
                                echo ($JsonAccess->EditComponentUI($_GET["path"], $_GET["partName"]));
                            }
                            if ($_GET["mode"] == "add") {
                        ?>
                                <select onchange='ComponentTypeSelector("<?= $_GET["path"] ?>")' name="componentType" id="componentSelector">
                                    <option value="basic <?= ($_GET["componentType"] == "basic") ? "selected" : "" ?>">Basic Components</option>
                                    <option value="full" <?= ($_GET["componentType"] == "full") ? "selected" : "" ?>>Full Components</option>
                                </select>
                        <?php
                                echo ($JsonAccess->AddComponentUI($_GET["path"], $_GET["componentType"]));
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php include dirname(getcwd(), 2) . '/View/SiteBlocks/classList.php'; ?>
            <!-- Show code => there is problem with formating -->
            <p>code:</p>
            <code>
                <xmp><?= $PreviewHandler->LoadPreview($_GET["partName"]) ?></xmp>
            </code>
        </div>
    </div>
</body>