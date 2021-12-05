/**
 * Function set select tag to clicked div element end remove 
 * it from others
 * @author Šimns
 * @param {HTMLDivElement} e
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
 * Function which returns selector
 * @author Šimns
 * @param {String} selectorID   Id if need to specify
 * @return {String}             Selected Inner
 * TODO: Rework and add selectorID => This will allow more selectors in site
 */
function getSelected(selectorID){
    let specificTypes = document.getElementsByClassName("selector");
    let selected;
    for (let i = 0; i < specificTypes.length; i++) {
        const type = specificTypes[i];
        if(type.classList.contains("selected")){
            selected = type.innerHTML;
        }
    }
    return selected
}
/**
 * Is something like checkout list for site /pages/basicInfoCreate.php
 * @author Šimns
 */
function basicInfoCreate(){
    let webType = getSelected(null)
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
                console.log(res);
                if(res!=""){
                    window.location.href = "http://vocko/19ia04_cerman/"
                }
            },
            
        });
    }
}
/**
 * Is something like checkout list for site /pages/basicAccountCreate.php
 * @author Šimns
 */
function basicAccountCreate(){
    let AccountType = getSelected(null)
    let AccountUsername = document.getElementById("AccountUsername").value;
    let AccountPassword = document.getElementById("AccountPassword").value;
    let AccountEmail = document.getElementById("AccountEmail").value;
    if(AccountEmail == null || AccountEmail == undefined || AccountEmail == ""){
        AccountEmail = "empty"
    }
    if(AccountUsername == ""){
        window.alert("Zapomněl jste zadat uživatelské jméno");
    } 
    else if(AccountUsername > 32){
        window.alert("Zadal jste příliš dlouhé uživatelské jméno");
    }
    else if(AccountPassword == ""){
        window.alert("Zapomněli jste zadat heslo");
    } else{
        let type = "AccountInsert"
        $.ajax({
            type: "POST", 
            url: "http://vocko/19ia04_cerman/scripts/SiteAccess.php",
            data : {type : type,
                AccountUsername : AccountUsername,
                AccountPassword : AccountPassword,
                AccountEmail : AccountEmail,
                AccountType : AccountType,
            },
            success: (res)=>{
                if(res!=""){                    
                    window.location.href = "http://vocko/19ia04_cerman/";
                }
            },
        });
    }
}
 