/**
 * Function set select tag to clicked div element end remove
 * it from others
 * @author Šimns
 * @param {HTMLDivElement} e
 */
function selectOne(e) {
  let parrent = e.parentElement;
  let childrens = parrent.childNodes;
  if (!e.classList.contains("selected")) {
    for (let i = 0; i < childrens.length; i++) {
      const child = childrens[i];
      if (child.nodeName == "DIV") {
        if (child.classList.contains("selected")) {
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
 * @param {String} selectType   Selector type specify
 * @param {String} selectorID   Id if need to specify
 * @return {String}             Selected Inner text // undefined
 */
function getSelected(selectType, selectorID) {
  let selectorsOfType = document.getElementsByClassName(selectType);
  for (let i = 0; i < selectorsOfType.length; i++) {
    const selector = selectorsOfType[i];
    if (selector.id == selectorID) {
      specifiSelectors = selector.childNodes;
      for (let y = 0; y < specifiSelectors.length; y++) {
        const specifiSelector = specifiSelectors[y];
        if (specifiSelector.nodeName == "DIV") {
          if (specifiSelector.classList.contains("selected")) {
            return specifiSelector.innerHTML;
          }
        }
      }
    }
  }
}
/**
 * Is something like checkout list for site /pages/basicInfoCreate.php
 * @author Šimns
 */
function basicInfoCreate() {
  let webType = getSelected("select-one", "SiteType");
  let webName = document.getElementById("projectName").value;
  if (webName == "") {
    window.alert("Zapomněli jste zadat jméno stránky!");
  } else if (webName.length > 32) {
    window.alert("Jméno stránky je příliš dlouhé");
  } else if (webType == null) {
    window.alert("Zapoměli jste zvolit typ stránky");
  } else {
    let type = "NameTypeFirstInsert";
    $.ajax({
      type: "POST",
      url: "http://vocko/19ia04_cerman/scripts/PostSiteAccess.php",
      data: { type: type, webType: webType, webName: webName },
      success: (res) => {
        console.log(res);
        if (res != "") {
          window.location.href = "http://vocko/19ia04_cerman/";
        }
      },
    });
  }
}
/**
 * Is something like checkout list for site /pages/basicAccountCreate.php
 * @author Šimns
 */
function basicAccountCreate() {
  let AccountType = getSelected("select-one", "AcType");
  let AccountUsername = document.getElementById("AccountUsername").value;
  let AccountPassword = document.getElementById("AccountPassword").value;
  let AccountEmail = document.getElementById("AccountEmail").value;
  if (AccountEmail == null || AccountEmail == undefined || AccountEmail == "") {
    AccountEmail = "empty";
  }
  if (AccountUsername == "") {
    window.alert("Zapomněl jste zadat uživatelské jméno");
  } else if (AccountUsername > 32) {
    window.alert("Zadal jste příliš dlouhé uživatelské jméno");
  } else if (AccountPassword == "") {
    window.alert("Zapomněli jste zadat heslo");
  } else {
    let type = "AccountInsert";
    $.ajax({
      type: "POST",
      url: "http://vocko/19ia04_cerman/scripts/PostSiteAccess.php",
      data: {
        type: type,
        AccountUsername: AccountUsername,
        AccountPassword: AccountPassword,
        AccountEmail: AccountEmail,
        AccountType: AccountType,
      },
      success: (res) => {
        if (res != "") {
          window.location.href = "http://vocko/19ia04_cerman/";
        }
      },
    });
  }
}
function pageOnOff(switcher) {
  let gridChoose = switcher.parentElement.parentElement.parentElement;
  let siteName = gridChoose.childNodes[0].childNodes[0].innerHTML;
  let setTo;

  //move to disabled
  if(gridChoose.parentElement.id == "active"){
    document.getElementById("active").removeChild(gridChoose);
    document.getElementById("disabled").appendChild(gridChoose);
    setTo = 0;
  } 
  //move to active
  else if(gridChoose.parentElement.id == "disabled"){
    document.getElementById("disabled").removeChild(gridChoose);
    document.getElementById("active").appendChild(gridChoose);
    setTo = 1;
  }
  let type = "UpdatingOnOffSite";
  $.ajax({
    type: "POST",
    url: "http://vocko/19ia04_cerman/scripts/PostSiteAccess.php",
    data: {
      type : type,
      siteName : siteName,
      setTo : setTo,
    },
    success: (res) => {
      console.log(res);
    },
  });
}
function pageRemove(object) {
  let gridChoose = object.parentElement.parentElement.parentElement;
  let siteName = gridChoose.childNodes[0].childNodes[0].childNodes[0].innerHTML;
  let type = "DeleteDataFromTable";
  let param = "SiteName";
  let tableName = "sites";
  $.ajax({
    type: "POST",
    url: "http://vocko/19ia04_cerman/scripts/PostSiteAccess.php",
    data: {
      type : type,
      tableName : tableName,
      value : siteName,
      param : param
    },
    success: (res) => {
      console.log(res);
      document.location.reload()

    },
  });
}
function openDialogWindow(id) {
  //this will invoke specific dialog window
  let dialogWindow = document.getElementById(id)
  dialogWindow.classList.add("dialog-move");
}
function newSiteInsert() {
  let pageName = document.getElementById("pageNameInput").value;
  let type = "NewSiteInsertion";
  $.ajax({
    type: "POST",
    url: "http://vocko/19ia04_cerman/scripts/PostSiteAccess.php",
    data: {
      type : type,
      pageName : pageName,
    },
    success: (res) => {
      console.log(res);
      document.location.reload()
    },
  });
}
