import url from './url'
import token from './token'

const http_request = function (params) {
    var that = this,
        request_url= url.restUrl + params.url;
    if(!params.type){
        params.type='get';
    }
    //是否不显示弹窗
    if (params.noToast == undefined || params.noToast == false) {
        uni.showToast({
            // title : '加载中',
            icon: 'loading',
            mask: true,
        });
    }

    /*不需要再次组装地址,可能是第三方的地址*/
    if(params.setUpUrl==false){
        request_url = params.url;
    }
    params.token = token.getToken();




    uni.request({
        url: request_url,//请求地址
        data: params.data,//请求数据
        method:params.type,//请求方法 GET POST 等
        header: {
            'content-type': 'application/json',
            'Accept' : 'application/json',
            // 'token': 'token',
            'Authorization' : "Bearer "+params.token,
        },
        success: function (res) {
            uni.hideToast();
            params.sCallback && params.sCallback(res.data);



        },
        fail: function (err) {
            uni.hideToast();

            console.log(err);
            params.eCallback && params.eCallback(res.data);
        },
		complete: (complete) => {
            //状态码为401 则是token过期或没有token
            if (complete.statusCode == 401)
			{
                uni.removeStorageSync('_token');
                uni.showToast({
                    title: '未登陆',
                    icon : 'none',
                    success : function (){
                        setTimeout(function () {
                            uni.redirectTo({
                                url : '/pages/my/login',
                            });
                        },1000);
                    }
                });
			}
        },
    });
}

export { http_request }
