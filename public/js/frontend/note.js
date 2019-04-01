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
});