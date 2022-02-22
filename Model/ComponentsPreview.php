<?php
class ComponentsPreview extends JsonAccess
{
    function LoadComponentsPreview($partName)
    {
        $json = $this->LoadJSON($partName);
        $parsed = json_decode($json, true);
        $trueData = $parsed["partData"]["objects"][0];
        $path = "partData,objects,0";
        $this->RecursiveComponentsLoad($trueData, $path);
    }
    function RecursiveComponentsLoad($object, $path)
    {
        if ($object["componentName"] == "" || $object["componentName"] == null) {
            $object["componentName"] = $object["componentName"];
        }
?>
        <div class="table-block">
            <div class="table-block-info">
                <p><?= ">" . $object["tag"] . "<" ?></p>
                <p><?= $object["componentName"] ?></p>
                <div class="table-block-info-controls">
                    <i onclick='ModeSwitchMoveComponent("<?= $path ?>","up")' class="fas fa-angle-up"></i>
                    <i onclick='ModeSwitchMoveComponent("<?= $path ?>","down")' class="fas fa-angle-down"></i>
                    <i onclick='ModeSwitchDuplicateComponent("<?= $path ?>")' class="fas fa-clone"></i>
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
