<?php
class ComponentsList
{
    private $Components;
    function __construct()
    {
        $this->Components = array(
            "basic" => array(
                array(
                    "tag" => "div",
                    "componentName" => "Block",
                    "class" => "",
                    "inline-styles" => "",
                    "content" => array()
                ),
                array(
                    "tag" => "img",
                    "componentName" => "Image",
                    "class" => "",
                    "inline-styles" => "",
                    "img-location" => "local",
                    "src" => "",
                    "alt" => ""
                ),
                array(
                    "tag" => "h1",
                    "componentName" => "Heading",
                    "class" => "",
                    "inline-styles" => "",
                    "text" => "HeadingText"
                ),
                array(
                    "tag" => "p",
                    "componentName" => "Paragraph",
                    "class" => "",
                    "inline-styles" => "",
                    "text" => "paragraf-text"
                ),
                array(
                    "tag" => "a",
                    "componentName" => "Link",
                    "class" => "",
                    "inline-styles" => "",
                    "text" => "Link",
                    "href" => "Empty"
                ),
                array(
                    "componentName" => "SpecialHTML",
                    "special-html" => "",
                ),
            ),
            "full" => array(
                array(
                    "tag" => "div",
                    "componentName" => "About",
                    "class" => "",
                    "inline-styles" => "display:flex;justify-content:center",
                    "content" => array(
                        array(
                            "tag" => "div",
                            "componentName" => "Block",
                            "class" => "width-half",
                            "inline-styles" => "",
                            "content" => array(
                                array(
                                    "tag" => "img",
                                    "componentName" => "Image",
                                    "class" => "float-right margin-small",
                                    "inline-styles" => "",
                                    "img-location" => "local",
                                    "src" => "random_person.jpg",
                                    "alt" => ""
                                ),
                            )
                        ),
                        array(
                            "tag" => "div",
                            "componentName" => "Block",
                            "class" => "width-half margin-small",
                            "inline-styles" => "",
                            "content" => array(
                                array(
                                    "tag" => "p",
                                    "componentName" => "Paragraf",
                                    "class" => "",
                                    "inline-styles" => "",
                                    "text" => "Im your mother! Im your dad! Im everything in your life.<br>  Im like play of chess <br> If you want i can be your sugar daddy for shure. Just you need to want to play chess every night!"
                                ),
                            )
                        ),
                    )
                ),
                array(
                    "tag" => "div",
                    "componentName" => "Header",
                    "class" => "flex space-between",
                    "inline-styles" => "display:flex;justify-content:space-around;",
                    "content" => array(
                        array(
                            "tag" => "div",
                            "componentName" => "Block",
                            "class" => "",
                            "inline-styles" => "",
                            "content" => array(
                                array(
                                    "tag" => "div",
                                    "componentName" => "Block",
                                    "class" => "",
                                    "inline-styles" => "",
                                    "content" => array(
                                        array(
                                            "tag" => "h1",
                                            "componentName" => "Heading",
                                            "class" => "",
                                            "inline-styles" => "",
                                            "text" => "Logo"
                                        ),
                                    )
                                )
                            )
                        ),
                        array(
                            "tag" => "div",
                            "componentName" => "Block",
                            "class" => "margin-child-small disable-child-textdecorations flex",
                            "inline-styles" => "",
                            "content" => array(
                                array(
                                    "tag" => "a",
                                    "componentName" => "Link",
                                    "class" => "",
                                    "inline-styles" => "",
                                    "text" => "Link",
                                    "href" => "Empty"
                                ),
                                array(
                                    "tag" => "a",
                                    "componentName" => "Link",
                                    "class" => "",
                                    "inline-styles" => "",
                                    "text" => "Link",
                                    "href" => "Empty"
                                ),
                                array(
                                    "tag" => "a",
                                    "componentName" => "Link",
                                    "class" => "",
                                    "inline-styles" => "",
                                    "text" => "Link",
                                    "href" => "Empty"
                                )
                            )
                        ),
                        array(
                            "tag" => "a",
                            "componentName" => "Link",
                            "class" => "button",
                            "inline-styles" => "",
                            "text" => "Contact",
                            "href" => "Empty"
                        )
                    )
                ),
                array(
                    "tag" => "div",
                    "componentName" => "Service",
                    "class" => "column-block",
                    "inline-styles" => "",
                    "content" => array(
                        array(
                            "componentName" => "SpecialHTML",
                            "special-html" => "<i class=`fas fa-atom`></i>",
                        ),
                        array(
                            "tag" => "h1",
                            "componentName" => "Heading",
                            "class" => "",
                            "inline-styles" => "",
                            "text" => "HeadingText"
                        ),
                        array(
                            "tag" => "p",
                            "componentName" => "Paragraf",
                            "class" => "",
                            "inline-styles" => "",
                            "text" => "paragraf-text"
                        ),
                    )
                ),
            )
        );
    }
    function GetAvailableComponents($type)
    {
        if ($type == "all") {
            return array_merge($this->Components["basic"], $this->Components["full"]);
        } else {
            return $this->Components[$type];
        }
    }
}
