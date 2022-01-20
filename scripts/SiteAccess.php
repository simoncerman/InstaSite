<?php

/**
 * For accessing specific data and specific functions from sites
 */
class SiteAccess
{
    public function __construct()
    {
        require(__DIR__ . '\DbAccess.php');
        $this->Site_Dbaccess = $DbAccess;
    }
    /**
     * Get data about sites from DB and return them in readeble form for HTML
     * @return string html5 for accesing/editing sites
     */
    function AdminSites()
    {
        $HTMLString = "";
        $data =  $this->Site_Dbaccess->getDataFromTable("sites");
        $enabled = [];
        $notEnabled = [];
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]["SiteEnabled"] == 1) {
                array_push($enabled, $data[$i]);
            } else if ($data[$i]["SiteEnabled"] == 0) {
                array_push($notEnabled, $data[$i]);
            }
        }
        //main grid for active
        $HTMLString .= '<p>active</p>';
        $HTMLString .= '<div class="grid-holder" id="active">';
        for ($y = 0; $y < count($enabled); $y++) {
            $HTMLString .= '<div class="grid-choose">';

            $lcHost = $_SERVER['HTTP_HOST'];
            $fullLink = 'http://' . $lcHost . '/19ia04_cerman/pages/partMenuSelector.php?site=';
            $fullLink .= $enabled[$y]["SiteName"];
            $HTMLString .= '<div class="grid-left">';
            $HTMLString .= "<h1>{$enabled[$y]["SiteName"]}</h1>";
            $HTMLString .= '<a href="' . $fullLink . '"><i class="fas fa-cog"></i></a>';
            $HTMLString .= '</div>';

            $HTMLString .= '<div class="grid-right">';
            $HTMLString .= '<button class="btn-new red" onclick="pageRemove(this)">Remove</button>';
            $HTMLString .= '<label class="switch">';
            $HTMLString .= '<input onclick="pageOnOff(this)" type="checkbox" checked>';
            $HTMLString .= '<span class="slider round"></span>';
            $HTMLString .= '</label>';
            $HTMLString .= '</div>';

            $HTMLString .= "</div>";
        }
        $HTMLString .= "</div>";
        $HTMLString .= '<p>disabled</p>';

        $HTMLString .= '<div class="grid-holder" id="disabled">';
        for ($y = 0; $y < count($notEnabled); $y++) {
            $HTMLString .= '<div class="grid-choose">';

            $lcHost = $_SERVER['HTTP_HOST'];
            $fullLink = 'http://' . $lcHost . '/19ia04_cerman/pages/partMenuSelector.php?site=';
            $fullLink .= $notEnabled[$y]["SiteName"];
            $HTMLString .= '<div class="grid-left">';
            $HTMLString .= "<h1>{$notEnabled[$y]["SiteName"]}</h1>";
            $HTMLString .= '<a href="' . $fullLink . '"><i class="fas fa-cog"></i></a>';
            $HTMLString .= '</div>';

            $HTMLString .= '<div class="grid-right">';
            $HTMLString .= '<button class="btn-new red" onclick="pageRemove(this)">Remove</button>';
            $HTMLString .= '<label class="switch">';
            $HTMLString .= '<input onclick="pageOnOff(this)" type="checkbox">';
            $HTMLString .= '<span class="slider round"></span>';
            $HTMLString .= '</label>';
            $HTMLString .= '</div>';

            $HTMLString .= "</div>";
        }
        $HTMLString .= "</div>";
        return $HTMLString;
    }
    /**
     * This function will load data from parts which
     * @param string $siteName Name of site with parts
     * @return array 
     */
    function ExportPartsData($siteName)
    {
        $data = $this->Site_Dbaccess->GetPartData($siteName);
        return $data;
    }
    /**
     * This will load active parts to table
     */
    function LoadActiveParts($siteName)
    {
        $data = $this->ExportPartsData($siteName);
        $parts = [];
        for ($i = 0; $i < count($data); $i++) {
            $partName = $data[$i]["PartName"];
            if($data[$i]["PartEnabled"] == 1){
                array_push($parts, $this->partsBlueprint($partName, true));
            }
        }
        echo ($this->blockCompiler($parts));
    }
    /**
     * This will load disabled parts to table
     */
    function LoadDisabledParts($siteName)
    {
        $data = $this->ExportPartsData($siteName);
        $parts = [];
        for ($i = 0; $i < count($data); $i++) {
            $partName = $data[$i]["PartName"];
            if($data[$i]["PartEnabled"] == 0){
                array_push($parts, $this->partsBlueprint($partName, false));
            }
        }
        echo ($this->blockCompiler($parts));
    }
    function partsBlueprint($partName, $checkbox)
    {

?>
        <div class="grid-choose">
            <div class="grid-left">
                <h2><?php echo $partName; ?></h2>
                <i class="fas fa-cog"></i>
            </div>
            <div class="grid-right">
                <label class="switch">
                    <input type="checkbox" <?= ($checkbox) ? "checked" : "" ?>>
                    <span class="slider round"></span>
                </label>
            </div>
        </div>
<?php
    }
    /**
     * This is special function which will return full string from arrays of string
     * @param array[string] $blocks Array of strings which you want to connect
     * @return string HTML5 string to return
     */
    function blockCompiler($blocks)
    {
        $string = "";
        for ($i=0; $i < count($blocks); $i++) { 
            $string.= $blocks[$i];
        }
        return $string;
    }

}
$siteAccess = new SiteAccess();
