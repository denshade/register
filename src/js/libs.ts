function setreadonly()
{
    let e = document.getElementById("type") as HTMLSelectElement;
    let strUser = e.options[e.selectedIndex].value;
    let area = document.getElementById("options") as HTMLInputElement;
    area.disabled = strUser.indexOf("enum") === -1;
}

function removeSpaces(name)
{
    let nameElement = document.getElementById(name) as HTMLInputElement;
    nameElement.value = replaceAll(nameElement.value," ", "_");
}

function replaceAll(value, search, replacement) {

    return value.replace(new RegExp(search, 'g'), replacement);
};