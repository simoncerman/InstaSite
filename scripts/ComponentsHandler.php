<?php
class ComponentsHandler extends JsonAccess
{
    function RemoveComponent($path)
    {
        $json    = $this->LoadJSON();
        $parsed  = json_decode($json, true);
        $splited = explode(",", $path);
        $new     = $this->RemoveComponentRecursion($splited, $parsed);
        $parsed = json_encode($new);
        $this->UpdateJSON($parsed);
    }
    /**
     * @author Szimns don't ask me how it works -> I'm an engineer
     */
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
    function AddComponent($path, $componentName)
    {
        $json    = $this->LoadJSON();
        $parsed  = json_decode($json, true);
        $splited = explode(",", $path);
        $component = $this->getComponent($componentName);
        print_r($parsed);
        $new     = $this->AddComponentRecursion($splited, $parsed, $component);
        print_r($new);
        $parsed = json_encode($new);
        $this->UpdateJSON($parsed);
    }
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
    function UpdateComponent($path, $data)
    {
        $json    = $this->LoadJSON();
        $parsed  = json_decode($json, true);
        $splited = explode(",", $path);
        $encodedData = json_decode($data);
        for ($i = 0; $i < count($encodedData); $i++) {
            $encodedData[$i] = (array) $encodedData[$i];
        }
        $new     = $this->UpdateComponentRecursion($splited, $parsed, $encodedData);
        $parsed = json_encode($new);
        $this->UpdateJSON($parsed);
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
}
$ComponentsHandler = new ComponentsHandler();
