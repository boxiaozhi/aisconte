$(function () {
    $('#add-form select[name=label]').select2();
})

function info_create() {
    var data = $('#add-form').serialize();

    $.ajax({
        url:"/admin/navi",//请求的url地址
        type:"POST",//请求的方式
        dataType:"json",//返回的格式为json
        async:true,//请求是否异步，默认true异步，这是ajax的特性
        data:data,//参数值
        beforeSend:function(){},//请求前的处理
        success:function(req){
            $('#modal-primary').modal('show');
        },//请求成功的处理
        complete:function(){},//请求完成的处理
        error:function(){}//请求出错的处理
    });
}