<?php

/**
 * This class will handle components -> Do stuff with them
 */
class ComponentsHandler extends JsonAccess
{
    function RemoveComponent($path, $partName)
    {
        $json    = $this->LoadJSON($partName);
        echo ($json);
        $parsed  = json_decode($json, true);
        $splited = explode(",", $path);
        $new     = $this->RemoveComponentRecursion($splited, $parsed);
        $parsed = json_encode($new);
        $this->UpdateJSON($parsed, $partName);
    }
    function RemoveComponentRecursion($path, $array)
    {
        if (count($path) == 1) {
            unset($array[$path[0]]);
            $array = array_values($array);
            return $array;
        }
        if (count($path) > 1) {
            $nexthop = $path[0];
            array_shift($path);
            $array[$nexthop] = $this->RemoveComponentRecursion($path, $array[$nexthop]);
            return $array;
        }
    }
    /**
     * @param string $path path to specific location where you want to add component
     * @param string $componentName is tag what you want to add
     */
    function AddComponent($path, $componentName, $partName)
    {
        $json    = $this->LoadJSON($partName);
        $parsed  = json_decode($json, true);
        $splited = explode(",", $path);
        $component = $this->getComponent($componentName);
        $new     = $this->AddComponentRecursion($splited, $parsed, $component);
        $parsed = json_encode($new);
        $this->UpdateJSON($parsed, $partName);
    }
    /**
     * @param array $path path to specific place in json
     * @param array $array is specific data in json to be eddited and going throu
     * @param array $component is array which will be added to content content by path
     */
    function AddComponentRecursion($path, $array, $component)
    {
        if (count($path) == 1) {
            array_push($array[$path[0]]["content"], $component);
            $array = array_values($array);
            return $array;
        }
        if (count($path) > 1) {
            $nexthop = $path[0];
            array_shift($path);
            $array[$nexthop] = $this->AddComponentRecursion($path, $array[$nexthop], $component);
            return $array;
        }
    }
    function UpdateComponent($path, $data, $partName)
    {
        $json    = $this->LoadJSON($partName);
        $parsed  = json_decode($json, true);
        $splited = explode(",", $path);
        $encodedData = json_decode($data);
        for ($i = 0; $i < count($encodedData); $i++) {
            $encodedData[$i] = (array) $encodedData[$i];
        }
        $new     = $this->UpdateComponentRecursion($splited, $parsed, $encodedData);
        $parsed = json_encode($new);
        $this->UpdateJSON($parsed, $partName);
    }
    function UpdateComponentRecursion($path, $array, $encodedData)
    {
        if (count($path) == 1) {
            $retArray = $array;
            for ($i = 0; $i < count($encodedData); $i++) {
                if ($encodedData[$i]["value"] != "Array") {
                    $retArray[$path[0]][$encodedData[$i]["parameter"]] = $encodedData[$i]["value"];
                }
            }
            return $retArray;
        }
        if (count($path) > 1) {
            $nexthop = $path[0];
            array_shift($path);
            $array[$nexthop] = $this->UpdateComponentRecursion($path, $array[$nexthop], $encodedData);
            return $array;
        }
    }
    function DuplicateComponent($path, $partName)
    {
        $json    = $this->LoadJSON($partName);
        $parsed  = json_decode($json, true);
        $splited = explode(",", $path);
        $new     = $this->DuplicateComponentRecursion($splited, $parsed);
        $parsed = json_encode($new);
        $this->UpdateJSON($parsed, $partName);
    }
    function DuplicateComponentRecursion($path, $array)
    {
        if (count($path) == 1) {
            $retArray = $array;
            array_push($retArray, $array[$path[0]]);
            return $retArray;
        }
        if (count($path) > 1) {
            $nexthop = $path[0];
            array_shift($path);
            $array[$nexthop] = $this->DuplicateComponentRecursion($path, $array[$nexthop]);
            return $array;
        }
    }
}
$ComponentsHandler = new ComponentsHandler();
