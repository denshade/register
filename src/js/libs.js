function setreadonly() {
    var e = document.getElementById("type");
    var strUser = e.options[e.selectedIndex].value;
    var area = document.getElementById("options");
    area.disabled = strUser.indexOf("enum") === -1;
}
function removeSpaces(name) {
    var nameElement = document.getElementById(name);
    nameElement.value = nameElement.value.replace(" ", "_");
}
