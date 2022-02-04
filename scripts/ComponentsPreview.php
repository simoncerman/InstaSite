<?php
class ComponentsPreview extends JsonAccess
{
    function LoadComponentsPreview()
    {
        $json = $this->LoadJSON();
        $parsed = json_decode($json, true);
        $trueData = $parsed["partData"]["objects"][0];
        $path = "partData,objects,0";
        $this->RecursiveComponentsLoad($trueData, $path);
    }
    function RecursiveComponentsLoad($object, $path)
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
                    <i onclick='ModeSwitchAddComponent("<?= $path ?>")' class="fas fa-plus"></i>
                    <i onclick='ModeSwitchRemoveComponent("<?= $path ?>")' class="fas fa-minus"></i>
                    <i onclick='ModeSwitchEditComponent("<?= $path ?>")' class="fas fa-cog"></i>
                </div>
            </div>
            <div class="table-block-inside">
                <?php
                if (empty($object["content"] == false)) {
                    for ($i = 0; $i < count($object["content"]); $i++) {
                        $this->RecursiveComponentsLoad($object["content"][$i], $path . ",content," . $i);
                    }
                }
                ?>
            </div>
        </div>
<?php
    }
}
$ComponentsPreviewHandler = new ComponentsPreview();
