<?php
require_once(__DIR__ . "/JsonAccess.php");
/**
 * Partpreview is subclass of JsonAccess
 * Only handle Decoding preview of parts and rendering them
 */
class PartPreview extends JsonAccess
{
    function __constructor()
    {
        require_once dirname(getcwd(), 1) . '/Model/DbAccess.php';;
        $this->DbAccess = new DbAccess();
    }
    /***
     * Handle default testing before connecting to DB
     */
    function LoadPreview($partName)
    {
        $json = $this->LoadJSON($partName);
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
        $this->HTML_Convert($partData["objects"][0]);
    }
    /**
     * Function created to handling scr (links to photos)
     */
    function ScrHandler($data)
    {
        $str = "";
        if (!empty($data["src"])) {
            if (!empty($data["img-location"])) {
                if ($data["img-location"] == "local") {
                    $fullLink = 'http://vocko/19ia04_cerman/uploads/';
                    $str .= " src=\"" . $fullLink . $data["src"] . "\"";
                } else {
                    $str .= " src=" . '"' . "{$data["src"]}" . '"';
                }
            } else {
                $str .= " src=" . '"' . "{$data["src"]}" . '"';
            }
        }
        return $str;
    }
    /**
     * Recursive function which will convert data into html
     * Will need to reconvert it to new template like version
     */
    function HTML_Convert($data)
    {
        if (!empty($data["special-html"])) {
            echo $this->clean($data["special-html"]);
            return;
        }
?>
        <<?= (!empty($data["tag"])) ? $data["tag"] : "" ?> <?= (!empty($data["class"])) ? "class=" . '"' . "{$data['class']}" . '"' : "" ?> <?= (!empty($data["src"])) ? $this->ScrHandler($data) : "" ?> <?= (!empty($data["alt"])) ? "alt={$data['alt']}" : "" ?> <?= (!empty($data["href"])) ? "alt={$data['href']}" : "" ?> <?= (!empty($data["inline-styles"])) ? " style=" . "'" . $data['inline-styles'] . ";'" : "" ?>>

            <?= (!empty($data["text"])) ? $data["text"] : "" ?>

            <?php
            for ($i = 0; $i < count($data["content"]); $i++) {
                $this->HTML_Convert($data["content"][$i]);
            }
            ?>

        </<?= (!empty($data["tag"])) ? $data["tag"] : "" ?>>
<?php
    }
    function clean($string)
    {
        $string = str_replace('`', "'", $string);
        return $string;
    }
    /**
     * Function which will render all data by site name
     * @param string $siteName
     */
    function RenderSite($siteName)
    {
        echo ($siteName);
        $partsOnSite = $this->DbAccess->GetPartData($siteName);
        for ($i = 0; $i < count($partsOnSite); $i++) {
            $this->LoadPreview($partsOnSite[$i]["PartName"]);
        }
    }
    /**
     * Returns homepage name
     */
    function getHomepageName()
    {
        $data = $this->DbAccess->getDataFromTable("sites");
        return $data[0]["SiteName"];
    }
}
$PreviewHandler = new PartPreview();
