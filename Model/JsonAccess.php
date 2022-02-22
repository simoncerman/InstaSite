<?php
class JsonAccess
{
    function __construct()
    {
        require_once __DIR__ . '/DbAccess.php';;
        $this->DbAccess = new DbAccess();
        require_once __DIR__ . '/ComponentsList.php';;
    }
    /**
     * Will return full component or component blueprint
     * @param string $componentName Name of specific component/object which you want to return
     */
    function getComponent($componentName)
    {
        $componentList = new ComponentsList();
        $components =  $componentList->GetAvailableComponents("all");
        for ($i = 0; $i < count($components); $i++) {
            if ($components[$i]["componentName"] == $componentName) {
                return $components[$i];
            }
        }
    }
    /**
     * Function will load adding window for adding new components when add mode is enabled
     * @param string specific path to place in JSON (for going back)
     */
    function AddComponentUI($path, $componentType)
    {
        if (empty($componentType)) {
            $componentType = "basic";
        }
        $componentList = new ComponentsList();
        $availableComponents = $componentList->GetAvailableComponents($componentType);
?>
        <div class="available-components">
            <?php for ($i = 0; $i < count($availableComponents); $i++) {
            ?>
                <div class="component">
                    <div class="inner-left">
                        <h3><?= $availableComponents[$i]["componentName"] ?></h3>
                        <p><?= $availableComponents[$i]["tag"] ?></p>
                    </div>
                    <button onclick='AddComponent(this,"<?= $path ?>")' class="btn-new">Add component</button>
                </div>
            <?php
            } ?>
        </div>
    <?php
    }
    /**
     * Function will load edit window for editing selected component on path
     * @param string @path specific path to place in JSON (for going back)
     * @param string @partName name of part working with
     */
    function EditComponentUI($path, $partName)
    {
        $parsed = $this->LoadJSONdataByPath($path, $partName);
    ?>
        <div class="editable-holder">
            <div class="editable-title">
                <h2><?= $parsed["componentName"] ?></h2>
            </div>
            <?php
            foreach ($parsed as $key => $value) {
                if ($key != "inline-styles" && $key != "content")
                    $this->EditLine($key, $value);
            } ?>
            <!--This is place for inline styles editing-->
            <h2>Inline style</h2>
            <div class="editable-inline-styles">
                <?= $this->GetInlineStyleOptionsForPart($parsed["inline-styles"], $path) ?>
            </div>
            <div class="editable-update-data">
                <button class="btn-new" onclick='UpdateData("<?= $path ?>")'>Update Data</button>
            </div>
        </div>
        <?php
    }
    /**
     * @param string $usedStyles is string in what are all just used inline styles
     */
    function GetInlineStyleOptionsForPart($usedStyles, $path)
    {
        //Convert used styles to array of truhly used styles

        $usedStylesArray = [];
        $usedStyles = str_replace(" ", "", $usedStyles);
        $splited = (explode(";", $usedStyles));
        for ($i = 0; $i < count($splited); $i++) {
            $selectorAndParam = explode(":", $splited[$i]);
            $usedStylesArray[$selectorAndParam[0]] = $selectorAndParam[1];
        }
        array_values($usedStylesArray);

        $possibleStyles = $this->GetPossibleInlineStyles();
        $styleTypes = array_keys($possibleStyles);
        for ($i = 0; $i < count($possibleStyles); $i++) {
        ?>
            <div class="select-style">
                <?= $styleTypes[$i] ?>
                <select onchange='UpdateData("<?= $path ?>")' name="<?= $styleTypes[$i] ?>">
                    <?php
                    for ($y = 0; $y < count($possibleStyles[$styleTypes[$i]]); $y++) {
                        if ($y == 0) {
                    ?>
                            <option value="empty"></option>
                        <?php
                        }
                        $selected = $possibleStyles[$styleTypes[$i]][$y] == $usedStylesArray[$styleTypes[$i]];
                        ?>
                        <option value="<?= $possibleStyles[$styleTypes[$i]][$y] ?>" <?= ($selected) ? "selected" : "" ?>><?= $possibleStyles[$styleTypes[$i]][$y] ?></option>
                    <?php
                    }
                    ?>
                </select>

            </div>
        <?php
        }
    }
    function GetPossibleInlineStyles()
    {
        return array(
            "display" => ["flex", "block", "line", "none"],
            "float" => ["left", "right"],
            "background-color" => ["white", "black", "yellow", "blue", "gray"],
            "color" => ["white", "black", "yellow", "blue", "gray"],
            "margin" => ["10px", "20px", "30px"],
            "justify-content" => ["center", "flex-start", "flex-end", "space-around", "space-between", "space-evenly"],
            "align-items" => ["center", "flex-start", "flex-end", "stretch", "baseline"]
        );
    }
    function EditLine($tag, $data)
    {
        ?>
        <div class="editable">
            <p><?= $tag ?></p>
            <input type="text" name="" id="" value="<?= $data ?>">
        </div>
<?php
    }
    /**
     * Write json to DB by partName
     */
    function UpdateJSON($data, $partName)
    {
        $this->DbAccess->updateData("parttable", "PartData", "'" . $data . "'", "PartName='" . $partName . "'");
    }
    /**
     * Load json from DB by partName
     */
    function LoadJSON($partName)
    {
        $json = $this->DbAccess->getValueOfParam("parttable", "PartName", $partName, "PartData");
        return $json;
    }
    /**
     * 
     */
    function LoadJSONdataByPath($path, $partName)
    {
        $json = $this->LoadJSON($partName);
        $parsed = json_decode($json, true);
        $splited = explode(",", $path);
        for ($i = 0; $i < count($splited); $i++) {
            $parsed = $parsed[$splited[$i]];
        }
        return $parsed;
    }
    /**
     * Load default empty structure of data as default part structure with outer component
     * @param string $partName name of part which will be added as component name to head of component
     */
    function getDefaultPartData($partName)
    {
        $json = '{
            "partData": {
                "objects": [
                    {
                        "tag": "div",
                        "class": "",
                        "componentName": "' . $partName . '",
                        "content": [
                        ]
                    }
                ]
            }
        }';
        return $json;
    }
}
$JsonAccess = new JsonAccess();
