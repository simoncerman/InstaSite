<?php
class JsonAccess
{
    function __construct()
    {
        require_once __DIR__ . '/DbAccess.php';;
        $this->DbAccess = new DbAccess();
    }
    /**
     * Simple function with dictionary of tag to component name values
     * TODO: Automate proces from GetAvailableComponents()
     * @param string $tag is just tak name
     * @return string Name of component
     */
    function GetComponentNameByTag($tag)
    {
        $tagToComponentName = array(
            "div"   => "Block",
            "a"     => "Link",
            "img"   => "Image",
            "header" => "Header",
        );
        return $tagToComponentName[$tag];
    }
    /**
     * Return table of all avaliable components
     * TODO: In future you will have basic components and special
     * @return array array of components
     */
    function GetAvailableComponents()
    {
        $elemnts = array(
            array(
                "tag" => "div",
                "componentName" => "About",
                "class" => "flex justify-center margin-small width-seven-five margin-left-auto margin-right-auto",
                "inline-styles" => "",
                "content" => array(
                    array(
                        "tag" => "div",
                        "componentName" => "Block",
                        "class" => "width-half",
                        "inline-styles" => "",
                        "content" => array(
                            array(
                                "tag" => "img",
                                "componentName" => "Image",
                                "class" => "float-right margin-small",
                                "inline-styles" => "",
                                "img-location" => "local",
                                "src" => "random_person.jpg",
                                "alt" => ""
                            ),
                        )
                    ),
                    array(
                        "tag" => "div",
                        "componentName" => "Block",
                        "class" => "width-half margin-small",
                        "inline-styles" => "",
                        "content" => array(
                            array(
                                "tag" => "p",
                                "componentName" => "Paragraf",
                                "class" => "",
                                "inline-styles" => "",
                                "text" => "Im your mother! Im your dad! Im everything in your life.<br>  Im like play of chess <br> If you want i can be your sugar daddy for shure. Just you need to want to play chess every night!"
                            ),
                        )
                    ),
                )
            ),
            array(
                "tag" => "div",
                "componentName" => "Header",
                "class" => "flex space-between",
                "inline-styles" => "",
                "content" => array(
                    array(
                        "tag" => "div",
                        "componentName" => "Block",
                        "class" => "",
                        "inline-styles" => "",
                        "content" => array(
                            array(
                                "tag" => "div",
                                "componentName" => "Block",
                                "class" => "",
                                "inline-styles" => "",
                                "content" => array(
                                    array(
                                        "tag" => "h1",
                                        "componentName" => "Heading",
                                        "class" => "",
                                        "inline-styles" => "",
                                        "text" => "Logo"
                                    ),
                                )
                            )
                        )
                    ),
                    array(
                        "tag" => "div",
                        "componentName" => "Block",
                        "class" => "margin-child-small disable-child-textdecorations flex",
                        "inline-styles" => "",
                        "content" => array(
                            array(
                                "tag" => "a",
                                "componentName" => "Link",
                                "class" => "",
                                "inline-styles" => "",
                                "text" => "Link",
                                "href" => "Empty"
                            ),
                            array(
                                "tag" => "a",
                                "componentName" => "Link",
                                "class" => "",
                                "inline-styles" => "",
                                "text" => "Link",
                                "href" => "Empty"
                            ),
                            array(
                                "tag" => "a",
                                "componentName" => "Link",
                                "class" => "",
                                "inline-styles" => "",
                                "text" => "Link",
                                "href" => "Empty"
                            )
                        )
                    ),
                    array(
                        "tag" => "a",
                        "componentName" => "Link",
                        "class" => "button",
                        "inline-styles" => "",
                        "text" => "Contact",
                        "href" => "Empty"
                    )
                )
            ),
            array(
                "tag" => "div",
                "componentName" => "Service",
                "class" => "column-block",
                "inline-styles" => "",
                "content" => array(
                    array(
                        "componentName" => "SpecialHTML",
                        "special-html" => "<i class=`fas fa-atom`></i>",
                    ),
                    array(
                        "tag" => "h1",
                        "componentName" => "Heading",
                        "class" => "",
                        "inline-styles" => "",
                        "text" => "HeadingText"
                    ),
                    array(
                        "tag" => "p",
                        "componentName" => "Paragraf",
                        "class" => "",
                        "inline-styles" => "",
                        "text" => "paragraf-text"
                    ),

                )
            ),
            array(
                "tag" => "div",
                "componentName" => "Block",
                "class" => "",
                "inline-styles" => "",
                "content" => array()
            ),
            array(
                "tag" => "img",
                "componentName" => "Image",
                "class" => "",
                "inline-styles" => "",
                "img-location" => "local",
                "src" => "",
                "alt" => ""
            ),
            array(
                "tag" => "h1",
                "componentName" => "Heading",
                "class" => "",
                "inline-styles" => "",
                "text" => "HeadingText"
            ),
            array(
                "tag" => "p",
                "componentName" => "Paragraph",
                "class" => "",
                "inline-styles" => "",
                "text" => "paragraf-text"
            ),
            array(
                "tag" => "a",
                "componentName" => "Link",
                "class" => "",
                "inline-styles" => "",
                "text" => "Link",
                "href" => "Empty"
            )
        );
        return $elemnts;
    }
    /**
     * Will return full component or component blueprint
     * @param string $componentName Name of specific component/object which you want to return
     */
    function getComponent($componentName)
    {
        $components =  $this->GetAvailableComponents();
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
    function AddComponentUI($path)
    {

        $availableComponents = $this->GetAvailableComponents();
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
                <h2><?= $this->GetComponentNameByTag($parsed["tag"]) ?></h2>
            </div>
            <?php
            foreach ($parsed as $key => $value) {
                if ($key != "inline-styles" && $key != "content")
                    $this->EditLine($key, $value);
            } ?>
            <!--This is place for inline styles editing-->
            <div class="editable-inline-styles">
                <h2>Inline style</h2>
                <?= $this->GetInlineStyleOptionsForPart($parsed["inline-styles"]) ?>
            </div>
            <div class="editable-update-data">
                <button class="btn-new" onclick='UpdateData(this,"<?= $path ?>")'>Update Data</button>
            </div>
        </div>
        <?php
    }
    /**
     * @param string $usedStyles is string in what are all just used inline styles
     */
    function GetInlineStyleOptionsForPart($usedStyles)
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
                <select name="<?= $styleTypes[$i] ?>">
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
            "display" => ["flex", "block", "line"],
            "float" => ["left", "right"]
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
