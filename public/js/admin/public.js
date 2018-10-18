$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(function(){
    //.ajaxError事件定位到document对象，文档内所有元素发生ajax请求异常，都将冒泡到document对象的ajaxError事件执行处理
    $(document).ajaxError(

        //所有ajax请求异常的统一处理函数，处理
        function(event,xhr,options,exc ){
            if(xhr.status == 'undefined'){
                return;
            }
            switch(xhr.status){
                case 403:
                    // 未授权异常
                    alert("系统拒绝：您没有访问权限。");
                    break;

                case 404:
                    alert("您访问的资源不存在。");
                    break;
                case 422:
                    swal({
                        title: '数据已存在',
                        text: '数据已存在，请检查',
                        timer: 2000
                    }).then(
                        function () {},
                        // handling the promise rejection
                        function (dismiss) {
                            if (dismiss === 'timer') {
                                console.log('I was closed by the timer')
                            }
                        }
                    );
                    break;
            }
        }
    );
});

function c_create() {
    
}

function c_delete(url, id) {
    swal({
        title: '确定删除吗？',
        text: '你将无法恢复它！',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '确定删除！',
    }).then(function(){

        $.ajax({
            url:url+id,//请求的url地址
            type:"DELETE",//请求的方式
            dataType:"json",//返回的格式为json
            async:true,//请求是否异步，默认true异步，这是ajax的特性
            beforeSend:function(){},//请求前的处理
            success:function(req){
                swal({
                    title: '删除成功',
                    timer: 2000
                }).then(
                    function () {
                        location.reload();
                    },
                    // handling the promise rejection
                    function (dismiss) {
                        if (dismiss === 'timer') {
                            console.log('I was closed by the timer')
                        }
                    }
                )
            },//请求成功的处理
            complete:function(){},//请求完成的处理
            error:function(){}//请求出错的处理
        });
    })
}