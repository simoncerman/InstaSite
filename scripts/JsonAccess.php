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
            $str .= " class=" . '"' . "{$data["class"]}" . '"';
        }
        if (empty($data["scr"] == false)) {
            $str .= " scr=" . '"' . "{$data["scr"]}" . '"';
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
    function TestingDefault()
    {

        $json = file_get_contents(dirname(getcwd(), 1) . "\pageParts\header_default.json", true);

        $this->HTML_Encode($json);
    }
}

$JsonAccess = new JsonAccess();
