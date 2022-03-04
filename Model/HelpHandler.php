<?php
class HelpHandler
{
    /**
     * Will send help as simple text
     * @param string|null $siteName Name of site or nothing
     * @param int $index index of specific help if not load random 
     */
    function __construct()
    {
        $this->helplist = $this->HelpData();
    }
    function LoadHelp($siteName, $index)
    {
        if (!empty($siteName)) {
            $localArray = [];
            for ($i = 0; $i < count($this->helplist); $i++) {
                if ($this->helplist[$i]["SiteName"] == $siteName) {
                    array_push($localArray, $this->helplist[$i]);
                }
            }
        }
        if (!empty($siteName) && !empty($index)) {
            echo $localArray[$index]["HelpText"];
        }
        if (!empty($siteName) && empty($index)) {
            echo $localArray[rand(0, count($localArray) - 1)]["HelpText"];
        }
        if (empty($siteName) && empty($index)) {
            echo $this->helplist[rand(0, count($this->helplist) - 1)]["HelpText"];
        }
    }
    function HelpData()
    {
        $helplist = [
            [
                "SiteName" => "BasicInfoCreate",
                "HelpText" => "Remember to have ready database before installation",
            ],
            [
                "SiteName" => "BasicInfoCreate",
                "HelpText" => "Static page is page where are some data created",
            ],

        ];
        return $helplist;
    }
}
$helpHandler = new HelpHandler();
