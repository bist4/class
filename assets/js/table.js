function toggleTable(tableId, buttonId, excludeTableId) {
    var userTable = document.getElementById(tableId);
    var toggleButton = document.getElementById(buttonId);
    var excludeTable = document.getElementById(excludeTableId);

    if (userTable.style.display === "none" || userTable.style.display === "") {
        userTable.style.display = "block";
        toggleButton.textContent = "Close";
        if (excludeTable) {
            excludeTable.style.display = "none";
        }
    } else {
        userTable.style.display = "none";
        toggleButton.textContent = "View";
        if (excludeTable) {
            excludeTable.style.display = "none";
        }
    }
}
