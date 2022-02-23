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
 * Function which returns selected
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
 * Specific function for /View/Sites/basicInfoCreate.php
 * Check data input and insert basic data into page
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
      url: "http://vocko/19ia04_cerman/Controller/PostSiteAccess.php",
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
 * Specific function for /pages/basicAccountCreate.php
 * It will pass data for user registration
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
      url: "http://vocko/19ia04_cerman/Controller/PostSiteAccess.php",
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
/**
 * This function will set of switcher on page, update in DB and reload
 * @param {*} switcher
 */
function pageOnOff(switcher) {
  let gridChoose = switcher.parentElement.parentElement.parentElement;
  let siteName = gridChoose.childNodes[1].childNodes[1].innerHTML;
  let setTo = switcher.checked ? 1 : 0;
  let type = "UpdatingOnOffSite";
  $.ajax({
    type: "POST",
    url: "http://vocko/19ia04_cerman/Controller/PostSiteAccess.php",
    data: {
      type: type,
      siteName: siteName,
      setTo: setTo,
    },
    success: (res) => {
      console.log(res);
      document.location.reload();
    },
  });
}
/**
 * Remove specific page
 * @param {*} object
 */
function pageRemove(object) {
  let gridChoose = object.parentElement.parentElement;
  let siteName = gridChoose.getElementsByClassName("name")[0].innerHTML;
  let type = "RemovePage";
  $.ajax({
    type: "POST",
    url: "http://vocko/19ia04_cerman/Controller/PostSiteAccess.php",
    data: {
      type: type,
      siteName: siteName,
    },
    success: (res) => {
      console.log(res);
      document.location.reload();
    },
  });
}
/**
 * This will just open dialog window on id object
 * @param {string} id
 */
function openDialogWindow(id) {
  //this will invoke specific dialog window
  let dialogWindow = document.getElementById(id);
  dialogWindow.classList.add("dialog-move");
}
/**
 * This will just open dialog window on id object
 * @param {string} id
 */
function closeDialogWindow(id) {
  //this will invoke specific dialog window
  let dialogWindow = document.getElementById(id);
  dialogWindow.classList.remove("dialog-move");
}
/**
 * Specific function for inserting new page
 */
function newSiteInsert() {
  let pageName = document.getElementById("pageNameInput").value;
  //empty not allowed
  if (pageName != "" && pageName != " ") {
    let type = "NewSiteInsertion";
    $.ajax({
      type: "POST",
      url: "http://vocko/19ia04_cerman/Controller/PostSiteAccess.php",
      data: {
        type: type,
        pageName: pageName,
      },
      success: (res) => {
        console.log(res);
        document.location.reload();
      },
    });
  }
}
/**
 * Specific function for inserting new part
 */
function newPart() {
  let partName = document.getElementById("partNameInput").value;
  let siteName = document.getElementById("siteNameH2").innerHTML;

  if (partName != "" && partName != " ") {
    let type = "NewPartInsertion";
    $.ajax({
      type: "POST",
      url: "http://vocko/19ia04_cerman/Controller/PostSiteAccess.php",
      data: {
        type: type,
        partName: partName,
        siteName: siteName,
      },
      success: (res) => {
        console.log(res);
        document.location.reload();
      },
    });
  }
}
/**
 * Specific function for removing parts
 */
function partRemove(object) {
  let partName =
    object.parentElement.parentElement.getElementsByClassName("name")[0]
      .innerHTML;
  let siteName = document.getElementById("siteNameH2").innerHTML;
  let type = "RemovePartFromTable";
  $.ajax({
    type: "POST",
    url: "http://vocko/19ia04_cerman/Controller/PostSiteAccess.php",
    data: {
      type: type,
      partName: partName,
      siteName: siteName,
    },
    success: (res) => {
      console.log(res);
      document.location.reload();
    },
  });
}
/**
 * This will move part up/down (Change PartPosition in PartOnSite)
 * @param {string} direction
 * @param {*} button
 */
function MovePart(direction, button) {
  let partName =
    button.parentElement.parentElement.getElementsByClassName("name")[0]
      .innerHTML;
  let siteName = document.getElementById("siteNameH2").innerHTML;
  let type = "MovePart";
  $.ajax({
    type: "POST",
    url: "http://vocko/19ia04_cerman/Controller/PostSiteAccess.php",
    data: {
      type: type,
      partName: partName,
      siteName: siteName,
      direction: direction,
    },
    success: (res) => {
      console.log(res);
    },
  });
}
/**
 * Specific function for disabling parts
 */
function partOnOff(switcher) {
  let partName =
    switcher.parentElement.parentElement.parentElement.getElementsByClassName(
      "name"
    )[0].innerHTML;
  let setTo = switcher.checked ? 1 : 0;
  let type = "UpdatingOnOffPart";
  $.ajax({
    type: "POST",
    url: "http://vocko/19ia04_cerman/Controller/PostSiteAccess.php",
    data: {
      type: type,
      partName: partName,
      setTo: setTo,
    },
    success: (res) => {
      console.log(res);
      document.location.reload();
    },
  });
}
function SavePartData() {
  let partNameNew = document.getElementById("partNameChangable").value;
  let type = "UpdatingPartNameData";
  $.ajax({
    type: "POST",
    url: "http://vocko/19ia04_cerman/Controller/PostSiteAccess.php",
    data: {
      type: type,
      partNameNew: partNameNew,
    },
    success: (res) => {
      console.log(res);
    },
  });
}
function ModeSwitchMoveComponent(path, direction) {
  let type = "ComponentHandling";
  let subtype = "MoveDirection";
  let partName = document.getElementById("partName").innerHTML;

  $.ajax({
    type: "POST",
    url: "http://vocko/19ia04_cerman/Controller/PostSiteAccess.php",
    data: {
      type: type,
      subtype: subtype,
      path: path,
      partName: partName,
      direction: direction,
    },
    success: (res) => {
      console.log(res);
      document.location.reload();
    },
  });
}
function ComponentTypeSelector(path) {
  let selector = document.getElementById("componentSelector");
  console.log(selector.value);
  window.location.href =
    window.location.href.split("&")[0] +
    "&siteName=" +
    GetSpecificParam("siteName") +
    "&mode=add" +
    "&path=" +
    path +
    "&componentType=" +
    selector.value;
}
function AddComponent(button, path) {
  let type = "ComponentHandling";
  let subtype = "Add";
  let componentName =
    button.parentElement.getElementsByTagName("h3")[0].innerHTML;
  let partName = document.getElementById("partName").innerHTML;

  $.ajax({
    type: "POST",
    url: "http://vocko/19ia04_cerman/Controller/PostSiteAccess.php",
    data: {
      type: type,
      subtype: subtype,
      path: path,
      componentName: componentName,
      partName: partName,
    },
    success: (res) => {
      console.log(res);
      document.location.reload();
    },
  });
}
function UpdateData(path) {
  /**
   * Working for all normal data (tag,componentName.. etc.)
   */
  let allData = document.getElementsByClassName("editable");
  let jsonData = [];
  for (let index = 0; index < allData.length; index++) {
    parameter = allData[index].getElementsByTagName("p")[0].innerHTML;
    value = allData[index].getElementsByTagName("input")[0].value;
    row = { parameter: parameter, value: value };
    jsonData.push(row);
  }
  /**
   * Working for inline style data
   */
  inline_styles = "";
  let allInlineHolders = document.getElementsByClassName("select-style");
  for (let i = 0; i < allInlineHolders.length; i++) {
    const element = allInlineHolders[i];
    let name = element.getElementsByTagName("select")[0].name;
    let value = element.getElementsByTagName("select")[0].value;
    if (value != "empty") {
      inline_styles += name + ":" + value + ";";
    }
  }
  inlineStylesRow = { parameter: "inline-styles", value: inline_styles };
  jsonData.push(inlineStylesRow);

  let data = JSON.stringify(jsonData);

  let type = "ComponentHandling";
  let subtype = "Edit";
  let partName = document.getElementById("partName").innerHTML;
  $.ajax({
    type: "POST",
    url: "http://vocko/19ia04_cerman/Controller/PostSiteAccess.php",
    data: {
      type: type,
      subtype: subtype,
      path: path,
      data: data,
      partName: partName,
    },
    success: (res) => {
      console.log(res);
      document.location.reload();
    },
  });
}
function ModeSwitchAddComponent(path) {
  let full_href = window.location.href;
  if (GetSpecificParam("mode") == undefined) {
    window.location.href = `${full_href}&mode=add`;
  }
  window.location.href =
    window.location.href.split("&")[0] +
    "&siteName=" +
    GetSpecificParam("siteName") +
    "&mode=add" +
    "&path=" +
    path;
}
function ModeSwitchEditComponent(path) {
  let full_href = window.location.href;
  if (GetSpecificParam("mode") == undefined) {
    window.location.href = `${full_href}&mode=edit`;
  }
  window.location.href =
    window.location.href.split("&")[0] +
    "&siteName=" +
    GetSpecificParam("siteName") +
    "&mode=edit" +
    "&path=" +
    path;
}
function ModeSwitchRemoveComponent(path) {
  let type = "ComponentHandling";
  let subtype = "Remove";
  let partName = document.getElementById("partName").innerHTML;
  $.ajax({
    type: "POST",
    url: "http://vocko/19ia04_cerman/Controller/PostSiteAccess.php",
    data: {
      type: type,
      subtype: subtype,
      path: path,
      partName: partName,
    },
    success: (res) => {
      console.log(res);
      window.location.href = window.location.href.split("&")[0];
    },
  });
}
function ModeSwitchDuplicateComponent(path) {
  let type = "ComponentHandling";
  let subtype = "Duplicate";
  let partName = document.getElementById("partName").innerHTML;
  $.ajax({
    type: "POST",
    url: "http://vocko/19ia04_cerman/Controller/PostSiteAccess.php",
    data: {
      type: type,
      subtype: subtype,
      path: path,
      partName: partName,
    },
    success: (res) => {
      console.log(res);
      window.location.href = window.location.href.split("&")[0];
    },
  });
}

/**
 * @returns all params in url
 */
function GetURLParamsAsJSON() {
  let full_href = window.location.href.split("?")[1].split("&");
  let objects = [];
  for (let index = 0; index < full_href.length; index++) {
    let param = full_href[index];
    param = param.split("=");
    const object = { param_name: param[0], param_value: param[1] };
    objects.push(object);
  }
  return objects;
}
/**
 * @param {string} paramName
 * @returns value of param in url
 */
function GetSpecificParam(paramName) {
  let data = GetURLParamsAsJSON();
  for (let index = 0; index < data.length; index++) {
    const element = data[index];
    if (element.param_name == paramName) {
      return element.param_value;
    }
  }
}
