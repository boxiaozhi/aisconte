$(function () {
    var mql = window.matchMedia("(max-width: 960px)");
    if (mql.matches) {
    } else {
    }

    mql.addListener(handleOrientationChange);
    function handleOrientationChange(mql){
        if (mql.matches) {

        } else {

        }
    }

    $("#icon-menu").on('click', function () {
       tiggerMenu();
    });
});

//侧边栏动作
function tiggerMenu() {
    var memuDisplay = $("#menu").css("display");
    if (memuDisplay == 'block'){ //显示状态
        $("#menu").css("display", "none");
        $("#icon-bar").css("margin-left", "0px");
        $("#content").css("margin-left", "60px");
    } else {
        $("#menu").css("display", "block");
        $("#icon-bar").css("margin-left", "340px");
        $("#content").css("margin-left", "400px");
    }
}