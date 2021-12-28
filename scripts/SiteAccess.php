<?php

/**
 * For accessing specific data and specific functions from sites
 */
class SiteAccess
{
    /**
     * Get data about sites from DB and return them in readeble form for HTML
     * @return string html5 for accesing/editing sites
     */
    function AdminSites()
    {
        require(__DIR__ . '\DbAccess.php');
        $HTMLString = "";
        $data = $DbAccess->getDataFromTable("sites");
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
}
$siteAccess = new SiteAccess();
