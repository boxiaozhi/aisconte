function label_create() {
    var data = $('#add-form').serialize();

    $.ajax({
        url:"/admin/naviLabel",//请求的url地址
        type:"POST",//请求的方式
        dataType:"json",//返回的格式为json
        async:true,//请求是否异步，默认true异步，这是ajax的特性
        data:data,//参数值
        beforeSend:function(){},//请求前的处理
        success:function(req){
            swal({
                title: '自动关闭弹窗！',
                text: '2秒后自动关闭。',
                timer: 20000
            }).then(
                function () {},
                // handling the promise rejection
                function (dismiss) {
                    if (dismiss === 'timer') {
                        console.log('I was closed by the timer')
                    }
                }
            )
        },//请求成功的处理
        complete:function(){},//请求完成的处理
    });
}

function label_edit() {
    var data = $('#edit-form').serialize();
    var id = $('#edit-form input[name=id]').val();

    $.ajax({
        url:"/admin/naviLabel/"+id,//请求的url地址
        type:"PATCH",//请求的方式
        dataType:"json",//返回的格式为json
        async:true,//请求是否异步，默认true异步，这是ajax的特性
        data:data,//参数值
        beforeSend:function(){},//请求前的处理
        success:function(req){
            $('#modal-primary').modal('show');
        },//请求成功的处理
        complete:function(){},//请求完成的处理
    });
}

function label_delete(id) {
    c_delete("/admin/naviLabel/", id);
}