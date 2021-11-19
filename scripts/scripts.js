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
function NextFirst(){
    let specificTypes = document.getElementsByClassName("selector");
    let webType;
    for (let i = 0; i < specificTypes.length; i++) {
        const type = specificTypes[i];
        if(type.classList.contains("selected")){
            webType = type.innerHTML;
        }
    }
    let webName = document.getElementById("projectName").value;
    if(webName == ""){
        window.alert("Zapomněli jste zadat jméno stránky!");
    } 
    else if(webName.length > 32){
        window.alert("Jméno stránky je příliš dlouhé");
    }
    else if(webType == null){
        window.alert("Zapoměli jste zvolit typ stránky");
    } else{
        let type = "NameTypeFirstInsert";
        $.ajax({
            type: "POST", 
            url: "http://vocko/19ia04_cerman/scripts/SiteAccess.php",
            data : {type : type, webType : webType, webName : webName},
            success: (res)=>{
                if(res!=""){
                    alert(res);
                }
            },
        });
    }
}
function CreateCreatorAccount(){
    
}