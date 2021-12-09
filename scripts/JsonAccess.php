<?php

class JsonAccess
{
    /**
     *  Function which will move data from JSON into valid HTML 5 file from structure
     */
    function HTML_Encode($json)
    {
        $parsed = json_decode($json);
        echo($parsed["partName"]);
    }
    /**
     * Function which will parse html site into JSON 
     */
    /*function HTML_Decode($data)
    {
        
    }*/
}

$JsonAccess = new JsonAccess();