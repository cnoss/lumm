function KeypadInit() {
    $('.keypad-key').unbind('click').bind('click', function () { return false; }).keypress(function () { return false; });
    $('.keypad-clear').unbind('click').bind('click', function () { return false; }).keypress(function () { return false; });
    $('.keypad-correct').unbind('click').bind('click', function () { return false; }).keypress(function () { return false; });
}

function KeypadCorrectPassword(targetID, keypadTextId) {
    try {
        if ($('#' + targetID).val().trim().length > 0) {
            var values = $('#' + targetID).val().substring(0, $('#' + targetID).val().length - 1).split(';');
            values = values.slice(0, values.length - 1);
            $('#' + targetID).val("");
            for (var i = 0; i < values.length; i++) {
                $('#' + targetID).val($('#' + targetID).val() + values[i] + ";");
            }
            $('#' + keypadTextId).val($('#' + keypadTextId).val().substring(0, $('#' + keypadTextId).val().length - 1));
        }
    }
    catch (ex) {
        console.log(ex.message);
    }

    return false;
}

function KeypadClearPassword(targetID, keypadTextId) {
    $('#' + targetID).val('');
    $('#' + keypadTextId).val('');
    return false;
}

function pressKeyPos(targetId, keypadTextId, position) {
    if ($('#' + keypadTextId).val().length < $('#' + keypadTextId).attr("maxlength")) {
        $('#' + targetId).val($('#' + targetId).val() + position + ";")
        $('#' + keypadTextId).val($('#' + keypadTextId).val() + "X");
    }
}

function initButtonList(keypadId, keypadLength, rootButtonId, isMobile) {
    console.log(rootButtonId);
    ShowLoadingKeypad();
    getImages(keypadLength, keypadId, rootButtonId, isMobile)
}

function getImages(i, keypadId, rootButtonId, isMobile) {
    $.ajax({
        url: $(location).attr('protocol') + "//" + $(location).attr('host') + "/ws_tools.asmx/GetImage",
        data: '{ "keypadId": "' + keypadId + '", "position": "' + i + '", "isMobile": "'+isMobile+'" }',
        type: "POST",
        cache: false,
        contentType: "application/json; charset=utf-8",
        success: function (data) {
            //console.log(data);
            //console.log(rootButtonId + i.toString());
            //console.log($('#' + rootButtonId + i.toString()));
            $('#' + rootButtonId + (i+1).toString()).removeAttr('src').attr('src', 'data:image/png;base64,' + data.d.toString());
            if (i > 0) {
                i--
                getImages(i, keypadId, rootButtonId, isMobile);
            }
            else {
                HideLoadingKeypad();
            }
        },
        error: function (data) {
            console.log('An error occured while loading keypad image');
            console.log(data);
            if (i > 0) {
                i--
                getImages(i, keypadId, rootButtonId, isMobile);
            }
            else {
                HideLoadingKeypad();
            }
        }
    });
}

function ShowLoadingKeypad() {
    var width = $(window).width();
    var height = $(window).height();
    $('#keypad-loading').css('width', width);
    $('#keypad-loading').css('height', height);

    $('#keypad-loading').show();
    $('#keypad-loading').position({ my: 'center', at: 'center', of: $(window) });
}

function HideLoadingKeypad() {
    $('#keypad-loading').fadeOut();
}

