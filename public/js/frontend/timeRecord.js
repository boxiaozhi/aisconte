
function countTime(id, time) {
    var date = new Date();
    var now = date.getTime();
    var endDate = new Date(time + " 00:00:00");//设置截止时间
    var end = endDate.getTime();
    var leftTime = end - now; //时间差
    var d, h, m, s, ms;
    if(leftTime >= 0) {
        d = Math.floor(leftTime / 1000 / 60 / 60 / 24);
        h = Math.floor(leftTime / 1000 / 60 / 60 % 24);
        m = Math.floor(leftTime / 1000 / 60 % 60);
        s = Math.floor(leftTime / 1000 % 60);
        ms = Math.floor(leftTime % 1000);
        if(ms < 100) {
            ms = "0" + ms;
        }
        if(s < 10) {
            s = "0" + s;
        }
        if(m < 10) {
            m = "0" + m;
        }
        if(h < 10) {
            h = "0" + h;
        }
    } else {
        console.log('已截止')
    }
    //将倒计时赋值到div中'
    var str = d + "天" + h + "时" + m + "分" + s + "秒";
    $('#'+id).html(str);
}