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

    $("#tigger").on('click', function () {
       tiggerMenu();
    });
});

//侧边栏动作
function tiggerMenu() {
    var menuDisplay = $("#menu").css("display");
    if (menuDisplay == 'block'){ //显示状态
        $("#menu").css("display", "none");
    } else {
        console.log(menuDisplay);
       $("#menu").css("display", "block");
    }
}