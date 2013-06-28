
$(document).ready(function() {
    setBackground();
    $('#demo').hide();
    setColors($.cookie("color1"));
    $('#picker').farbtastic(function callback(color) {
        $.cookie("color1", color);
        $('#color').val(color);
        setColors(color);
    });
});

function setColors(color) {
    if (colorToNumber(color) < 250) {
        $('.greyOrangeGreyFlowBackground').css("color", "white");
        $('.topBottFlowBackground').css("color", "white");
        $('.leftRightFlowBackground').css("color", "white");
        $('.a:link').css("color", "white");
        $('#color').css("color", "white");
    } else {
        $('.greyOrangeGreyFlowBackground').css("color", "black");
        $('.topBottFlowBackground').css("color", "black");
        $('.leftRightFlowBackground').css("color", "black");
        $('a:link').css("color", "black");
        $('#color').css("color", "black");
    }
    $('#color').css("background", color);
    $('.greyOrangeGreyFlowBackground').css("background", "linear-gradient(to right, #808080 0%,"+color+" 51%,#808080 100%)");
    $('.topBottFlowBackground').css("background", "linear-gradient(to bottom,  "+color+" 1%,#808080 100%)");
    $('.leftRightFlowBackground').css("background", "linear-gradient(to right,  "+color+" 50%,#808080 100%)");
}

function setBackground() {
    $(".userWrap label").addClass("greyOrangeGreyFlowBackground");
    $(".wrapTitleDate").addClass("leftRightFlowBackground");
    $(".postUser").addClass("topBottFlowBackground");
    $(".error").addClass("greyOrangeGreyFlowBackground");
    $(".wrapThreadTitle").addClass("leftRightFlowBackground");
    $("article").addClass("leftRightFlowBackground");
}

/**
 * Generiert aus einer Farbe als Hexzahl die Summe der dezimalen RGB Werte.
 * @param color Die Farbe.
 * @returns {number} dezimale RGB Summe.
 */
function colorToNumber(color) {
    r = color.substr(1, 2);
    g = color.substr(3, 2);
    b = color.substr(5, 6);
    return parseInt(r, 16) + parseInt(g, 16) + parseInt(b, 16);
}