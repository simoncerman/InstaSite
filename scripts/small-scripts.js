/**
 * Globall functions and app using 
 */
function selectOne(e){
    let parrent = e.parentElement;
    let childrens = parrent.childNodes;
    if(!e.classList.contains("selected")){
        for (let i = 0; i < childrens.length; i++) {
            const child = childrens[i];
            if(child.nodeName=="DIV"){
                if(child.classList.contains("selected")){
                    child.classList.remove("selected");
                }
            }
        }
        e.classList.add("selected");
    }
}
/**
 * Part / Site using scripts
 */
//page-install
function installNext(){
    let field_value = document.getElementById("InputNameSiteInstall").value;
    if(field_value==""){
        window.alert("Zapomněli jste zadat jméno stránky!");
    }
    /*TODO: Other checks -> 
        1. Length
        2. Character uppercase variants  
    */  
    let specificTypes = document.getElementsByClassName("specific-type");
    let selectedType;
    for (let i = 0; i < specificTypes.length; i++) {
        const type = specificTypes[i];
        if(type.classList.contains("selected")){
            selectedType = type.innerHTML;
        }
    }
    if(selectedType==null){
    //TODO: if user dont choose one of types
    }

}