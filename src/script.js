
$(document).ready(function() {
    setBackground();
    $('#demo').hide();
    //$.cookie("color1", "content");
    //alert($.cookie("color1"));
    //setColors($.cookie("color1"));
    $('#picker').farbtastic(function callback(color) {
        //$.cookie("color1", color, { path: '/colorSchemaForum'});
        setColors(color);
    });
});

function setColors(color) {
    $('.greyOrangeGreyFlowBackground').css("background", "linear-gradient(to right, #808080 0%,"+color+" 51%,#808080 100%)");
    $('.topBottFlowBackground').css("background", "linear-gradient(to bottom,  "+color+" 1%,#808080 100%)");
    $('.leftRightFlowBackground').css("background", "linear-gradient(to right,  "+color+" 50%,#808080 100%)");
}

function setBackground() {
    $(".userWrap label").addClass("greyOrangeGreyFlowBackground");
    $(".wrapTitleDate").addClass("leftRightFlowBackground");
    $(".postUser").addClass("topBottFlowBackground");
    $(".error").addClass("greyOrangeGreyFlowBackground");
}