<?php
class JsonAccess
{
    function __construct()
    {
        require_once(__DIR__ . "/DbAccess.php");
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
                "componentName" => "Img+Text",
                "class" => "flex space-between margin-small",
                "content" => array(
                    array(
                        "tag" => "div",
                        "componentName" => "Block",
                        "class" => "full-width",
                        "content" => array(
                            array(
                                "tag" => "img",
                                "componentName" => "Image",
                                "class" => "float-right margin-small",
                                "img-location" => "local",
                                "src" => "random_person.jpg",
                                "alt" => ""
                            ),
                        )
                    ),
                    array(
                        "tag" => "div",
                        "componentName" => "Block",
                        "class" => "full-width margin-small",
                        "content" => array(
                            array(
                                "tag" => "p",
                                "componentName" => "Paragraf",
                                "class" => "",
                                "text" => "Im your mother! Im your dad! Im everything in your life.<br>  Im like play of chess <br> If you want i can be your sugar daddy for shure. Just you need to want to play chess every night!"
                            ),
                        )
                    ),
                )
            ),
            array(
                "tag" => "div",
                "componentName" => "Block",
                "class" => "",
                "content" => array()
            ),
            array(
                "tag" => "img",
                "componentName" => "Image",
                "class" => "",
                "img-location" => "local",
                "src" => "",
                "alt" => ""
            ),
            array(
                "tag" => "h1",
                "componentName" => "Heading-1",
                "class" => "",
                "text" => "HeadingText"
            ),
            array(
                "tag" => "h2",
                "componentName" => "Heading-2",
                "class" => "",
                "text" => "HeadingText"
            ),
            array(
                "tag" => "h3",
                "componentName" => "Heading-3",
                "class" => "",
                "text" => "HeadingText"
            ),
            array(
                "tag" => "p",
                "componentName" => "Paragraf",
                "class" => "",
                "text" => "paragraf-text"
            ),
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
                $this->EditLine($key, $value);
            } ?>
            <div class="editable-update-data">
                <button class="btn-new" onclick='UpdateData(this,"<?= $path ?>")'>Update Data</button>

            </div>
        </div>
    <?php
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
                        "tag": "",
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
