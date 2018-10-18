$(function () {
    $('#add-form select[id=selectLabel]').select2();
})

function create() {
    var labelPost = [];
    var labelData = $("#add-form select[id=selectLabel]").select2('data');
    for (index in labelData) {
        labelPost.push(labelData[index]['id']);
    }
    var data = $('#add-form').serialize();

    data += '&label='+labelPost.toString();

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

function info_delete(id) {
    $.ajax({
        url:"/admin/navi/"+id,//请求的url地址
        type:"DELETE",//请求的方式
        dataType:"json",//返回的格式为json
        async:true,//请求是否异步，默认true异步，这是ajax的特性
        beforeSend:function(){},//请求前的处理
        success:function(req){
            $('#modal-primary').modal('show');
        },//请求成功的处理
        complete:function(){},//请求完成的处理
        error:function(){}//请求出错的处理
    });
}