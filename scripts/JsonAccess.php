<?php

class JsonAccess
{
    /**
     *  Function which will move data from JSON into valid HTML 5 file from structure
     */
    function HTML_Encode($json)
    {
        //parse data into Arrays and Dictionaries
        $parsed = json_decode($json, true);
        $partData = $parsed["partData"];
        $HTML = $this->HTML_Convert($partData["objects"][0]);
        echo ($HTML);
    }
    /**
     * Recursive function which will convert data into html
     */
    function HTML_Convert($data)
    {
        //*TAG PARAMETERS
        $str = "";
        $str .= "<{$data['tag']}";
        if (empty($data["class"] == false)) {
            if (is_string($data["class"])) {
                $str .= " class=" . '"' . "{$data["class"]}" . '"';
            }
            if (is_array($data["class"])) {
                $str .= " class=\"";
                for ($i = 0; $i < count($data["class"]); $i++) {
                    $str .= " " . $data["class"][$i];
                }
                $str .= " \"";
            }
        }
        if (empty($data["src"] == false)) {
            if (empty($data["img-location"]) == false) {
                if ($data["img-location"] == "local") {
                    $fullLink = "http://vocko/19ia04_cerman/uploads/";
                    $str .= "src=\"" . $fullLink . $data["src"] . "\"";
                } else {
                    $str .= " src=" . '"' . "{$data["src"]}" . '"';
                }
            } else {
                $str .= " src=" . '"' . "{$data["src"]}" . '"';
            }
        }
        if (empty($data["alt"] == false)) {
            $str .= " alt=" . '"' . "{$data["alt"]}" . '"';
        }
        if (empty($data["href"] == false)) {
            $str .= " href=" . '"' . "{$data["href"]}" . '"';
        }

        //*INSIDE OF TAG
        $str .= ">";
        if (empty($data["content"])) {
            if (empty($data["text"] == false)) {
                $str .= $data["text"];
            }
            $str .= "</{$data['tag']}>";
        } else {
            //*INSIDE OF TAG
            for ($i = 0; $i < count($data["content"]); $i++) {
                $str .= $this->HTML_Convert($data["content"][$i]);
            }
            $str .= "</{$data['tag']}>";
        }
        return $str;
    }
    function LoadEditor()
    {
        $json = $this->LoadJSON();
        $parsed = json_decode($json, true);
        $trueData = $parsed["partData"]["objects"][0];
        $path = "partData,objects,0";
        $this->RecursivePartLoad($trueData, $path);
    }
    function RecursivePartLoad($object, $path)
    {
        if ($object["componentName"] == "" || $object["componentName"] == null) {
            $object["componentName"] = $this->GetComponentNameByTag($object["tag"]);
        }
?>
        <div class="table-block">
            <div class="table-block-info">
                <p><?= ">" . $object["tag"] . "<" ?></p>
                <p><?= $object["componentName"] ?></p>
                <div class="table-block-info-controls">
                    <i onclick='AddElement("<?= $path ?>")' class="fas fa-plus"></i>
                    <i onclick='RemoveElement("<?= $path ?>")' class="fas fa-minus"></i>
                    <i onclick='EditElement("<?= $path ?>")' class="fas fa-cog"></i>
                </div>
            </div>
            <div class="table-block-inside">
                <?php
                if (empty($object["content"] == false)) {
                    for ($i = 0; $i < count($object["content"]); $i++) {
                        $this->RecursivePartLoad($object["content"][$i], $path . ",content," . $i);
                    }
                }
                ?>
            </div>
        </div>
    <?php
    }
    /**
     * Simple function with dictionary of tag to component name values
     * 
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
     * From Array structur will return html string of element
     * @param array $data JSON parsed to Array
     * @return string true html string
     */
    function EditorRecurs($data)
    {
        //*TAG PARAMETERS
        $str = "";
        $str .= "<{$data['tag']}";
        if (empty($data["class"] == false)) {
            if (is_string($data["class"])) {
                $str .= " class=" . '"' . "{$data["class"]}" . '"';
            }
            if (is_array($data["class"])) {
                $str .= " class=\"";
                for ($i = 0; $i < count($data["class"]); $i++) {
                    $str .= " " . $data["class"][$i];
                }
                $str .= " \"";
            }
        }
        if (empty($data["src"] == false)) {
            if (empty($data["img-location"]) == false) {
                if ($data["img-location"] == "local") {
                    $fullLink = "http://vocko/19ia04_cerman/uploads/";
                    $str .= "src=\"" . $fullLink . $data["src"] . "\"";
                } else {
                    $str .= " src=" . '"' . "{$data["src"]}" . '"';
                }
            } else {
                $str .= " src=" . '"' . "{$data["src"]}" . '"';
            }
        }
        if (empty($data["alt"] == false)) {
            $str .= " alt=" . '"' . "{$data["alt"]}" . '"';
        }
        if (empty($data["href"] == false)) {
            $str .= " href=" . '"' . "{$data["href"]}" . '"';
        }

        //*INSIDE OF TAG
        $str .= ">";
        if (empty($data["content"])) {
            if (empty($data["text"] == false)) {
                $str .= $data["text"];
            }
            $str .= "</{$data['tag']}>";
        } else {
            //*INSIDE OF TAG
            for ($i = 0; $i < count($data["content"]); $i++) {
                $str .= $this->EditorRecurs($data["content"][$i]);
            }
            $str .= "</{$data['tag']}>";
        }
        return $str;
    }
    /***
     * Testing only
     */
    function TestingDefault()
    {

        $json = file_get_contents(dirname(getcwd(), 1) . "\pageParts\components\header_default.json", true);
        $this->HTML_Encode($json);
    }
    function EditElementUI($path)
    {
        $parsed = $this->LoadJSONdataByPath($path);
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
                <button class="btn-new">Update Data</button>

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
    function AddElementUI($path)
    {
    }
    function RemoveElement($path)
    {

        echo ($path);
        $json    = $this->LoadJSON();
        $parsed  = json_decode($json, true);
        $splited = explode(",", $path);
        $new     = $this->RemoveElementRecursion($splited, $parsed);
        $parsed = json_encode($new);
        $this->UpdateJSON($parsed);
    }
    /**
     * @author Szimns don't ask me how it works -> I'm an engineer
     */
    function RemoveElementRecursion($path, $data)
    {
        if (count($path) == 1) {
            unset($data[$path[0]]);
            return $data;
        }
        if (count($path) > 1) {
            $nexthop = $path[0];
            array_shift($path);
            $data[$nexthop] = $this->RemoveElementRecursion($path, $data[$nexthop]);
            return $data;
        }
    }
    function UpdateJSON($data)
    {
        file_put_contents(dirname(getcwd(), 1) . "\pageParts\components\header_default.json", $data);
    }
    function LoadJSON()
    {
        $json = file_get_contents(dirname(getcwd(), 1) . "\pageParts\components\header_default.json", true);
        return $json;
    }
    function LoadJSONdataByPath($path)
    {
        $json = $this->LoadJSON();
        $parsed = json_decode($json, true);
        $splited = explode(",", $path);
        for ($i = 0; $i < count($splited); $i++) {
            $parsed = $parsed[$splited[$i]];
        }
        return $parsed;
    }
}

$JsonAccess = new JsonAccess();
