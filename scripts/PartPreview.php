<?php

/**
 * Partpreview is subclass of JsonAccess
 * Only handle Decoding preview of parts and rendering them
 */
class PartPreview extends JsonAccess
{
    /***
     * Handle default testing before connecting to DB
     */
    function TestingDefault()
    {
        $json = file_get_contents(dirname(getcwd(), 1) . "\pageParts\components\header_default.json", true);
        $this->HTML_Encode($json);
    }
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
}
$PreviewHandler = new PartPreview();
