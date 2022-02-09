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
        $data =  $this->Site_Dbaccess->getDataFromTable("sites");
        $enabled = [];
        $disabled = [];
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]["SiteEnabled"] == 1) {
                array_push($enabled, $data[$i]);
            } else {
                array_push($disabled, $data[$i]);
            }
        }
        $siteLink = "http://vocko/19ia04_cerman/pages/partMenuSelector.php?siteName=";
?>

        <div class="grid-holder">
            <p>active</p>
            <?php
            for ($i = 0; $i < count($enabled); $i++) {
                $this->SitesBlueprint(
                    $enabled[$i]["SiteName"],
                    $siteLink . $enabled[$i]["SiteName"],
                    true
                );
            }
            ?>
        </div>

        <div class="grid-holder">
            <p>disabled</p>
            <?php
            for ($i = 0; $i < count($disabled); $i++) {
                $this->SitesBlueprint(
                    $disabled[$i]["SiteName"],
                    $siteLink . $disabled[$i]["SiteName"],
                    false
                );
            }
            ?>
        </div>
    <?php
    }
    /**
     * This will return site part by inserting
     * @param string $siteName name of site
     * @param string $siteLink link to site edit
     * @param bool $checkbox TRUE if checked || false if not
     */
    function SitesBlueprint($siteName, $siteLink, $checkbox)
    {
    ?>
        <div class="grid-choose">
            <div class="grid-left">
                <h2 class="name"><?= $siteName ?></h2>
                <a href="<?= $siteLink ?>">
                    <i class="fas fa-cog" aria-hidden="true"></i>
                </a>
            </div>
            <div class="grid-right">
                <button class="btn-new red" onclick="pageRemove(this)">Remove</button>
                <label class="switch"><input onclick="pageOnOff(this)" type="checkbox" <?= ($checkbox) ? "checked" : "" ?>>
                    <span class="slider round"></span>
                </label>
            </div>
        </div>
    <?php
    }

    /**
     * This function will load data from parts which
     * @param string $siteName Name of site with parts
     * @return array of part data
     */
    function ExportPartsData($siteName)
    {
        $data = $this->Site_Dbaccess->GetPartData($siteName);
        return $data;
    }
    /**
     * This will load active parts to table
     * @param string $siteName Name of site with parts
     */
    function LoadActiveParts($siteName)
    {
        $data = $this->ExportPartsData($siteName);
        $parts = [];
        for ($i = 0; $i < count($data); $i++) {
            $partName = $data[$i]["PartName"];
            if ($data[$i]["PartEnabled"] == 1) {
                $lcHost = $_SERVER['HTTP_HOST'];
                $fullLink = "http://" . $lcHost . "/19ia04_cerman/pages/partEdit.php?partName=" . $partName. "&siteName=".$_GET["siteName"];
                array_push($parts, $this->partsBlueprint($partName, true, $fullLink));
            }
        }
        echo ($this->blockCompiler($parts));
    }
    /**
     * This will load disabled parts to table
     * @param string $siteName Name of site with parts
     */
    function LoadDisabledParts($siteName)
    {
        $data = $this->ExportPartsData($siteName);
        $parts = [];
        for ($i = 0; $i < count($data); $i++) {
            $partName = $data[$i]["PartName"];
            if ($data[$i]["PartEnabled"] == 0) {
                $lcHost = $_SERVER['HTTP_HOST'];
                $fullLink = "http://" . $lcHost . "/19ia04_cerman/pages/partEdit.php?partName=" . $partName. "&siteName=".$_GET["siteName"];
                array_push($parts, $this->partsBlueprint($partName, false, $fullLink));
            }
        }
        echo ($this->blockCompiler($parts));
    }
    /**
     * Blueprint for showing parts on site
     * @param string $partName is name of part to load
     * @param bool $checkbox TRUE if is checked | FALSE if not checked
     */
    function partsBlueprint($partName, $checkbox, $partLink)
    {
    ?>
        <div class="grid-choose">
            <div class="grid-left">
                <h2 class="name"><?php echo $partName; ?></h2>
                <a href="<?= $partLink ?>"><i class="fas fa-cog"></i></a>
            </div>
            <div class="grid-right">
                <button class="btn-new red" onclick="partRemove(this)">Remove</button>
                <label class="switch">
                    <input onclick="partOnOff(this)" type="checkbox" <?= ($checkbox) ? "checked" : "" ?>>
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
        for ($i = 0; $i < count($blocks); $i++) {
            $string .= $blocks[$i];
        }
        return $string;
    }
}
$siteAccess = new SiteAccess();
