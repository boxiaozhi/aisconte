function register() {
    var username = $('#register-form #username').val();
    var password = $('#register-form #password').val();
    var password_confirmation = $('#register-form #password-confirmation').val();

    $.ajax({
        url:"/admin/register",//请求的url地址
        type:"POST",//请求的方式
        dataType:"json",//返回的格式为json
        async:true,//请求是否异步，默认true异步，这是ajax的特性
        data:{
            username: username,
            password: password,
            password_confirmation: password_confirmation,
        },//参数值
        beforeSend:function(){},//请求前的处理
        success:function(req){},//请求成功的处理
        complete:function(){},//请求完成的处理
        error:function(){}//请求出错的处理
    });
}

function login() {
    var username = $('#login-form #username').val();
    var password = $('#login-form #password').val();

    $.ajax({
        url:"/admin/login",//请求的url地址
        type:"POST",//请求的方式
        dataType:"json",//返回的格式为json
        async:true,//请求是否异步，默认true异步，这是ajax的特性
        data:{
            username: username,
            password: password,
        },//参数值
        beforeSend:function(){},//请求前的处理
        success:function(req){},//请求成功的处理
        complete:function(response){
            console.log(response, response.status);
            if (response.status == 200){
                window.location = '/admin/dashboard';
            } else {
                alert(response)
            }
        },//请求完成的处理
        error:function(){}//请求出错的处理
    });
}