var token = localStorage.getItem("token");

$.ajaxSetup({
    dataType: "json",
    cache: false,
    headers: {
        "token": token
    },
    xhrFields: {
        withCredentials: true
    },
    complete: function(xhr) {
        //token过期，则跳转到登录页面
        if(xhr.responseJSON.code == 401){
            parent.location.href = baseURL + 'login.html';
        }
    }
});