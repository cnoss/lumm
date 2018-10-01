function ShowConfirmCardLock(sWidth) {
    $("#dialog-card-lock").dialog({
        resizable: false,
        draggable: false,
        width: sWidth,
        /*minHeight: 500,*/
        dialogClass: "dialog-white",
        modal: true,
        title: ""
    });
    $("#dialog-card-lock").parent().appendTo(jQuery("form:first"));
}
function HideConfirmCardLock() {
    $("#dialog-card-lock").dialog('close');
}

function ShowResultPopupCardLock(title, content) {
    $('#popup-result-card-lock').empty().append(content);
    $('#popup-result-card-lock').dialog({
        autoOpen: true,
        resizable: false,
        draggable: false,
        modal: true,
        title: title,
        width: 350,
        buttons: [{ text: 'OK', click: function () { $(this).dialog('close'); } }]
    });
}