import config from './config'


const http_request = function (params, noRefetch) {
    var that = this,
        url= config.restUrl + params.url;
    if(!params.type){
        params.type='get';
    }
    /*不需要再次组装地址*/
    if(params.setUpUrl==false){
        url = params.url;
    }
    uni.request({
        url: url,//请求地址
        data: params.data,//请求数据
        method:params.type,//请求方法 GET POST 等
        header: {
            'content-type': 'application/json',
            'Accept' : 'application/json',
            'token': 'token',
        },
        success: function (res) {

            // 判断以2（2xx)开头的状态码为正确
            // 异常不要返回到回调中，就在request中处理，记录日志并showToast一个统一的错误即可

            params.sCallback && params.sCallback(res.data);

            params.eCallback && params.eCallback(res.data);

        },
        fail: function (err) {
            //wx.hideNavigationBarLoading();
            console.log(err);
            // params.eCallback && params.eCallback(err);
        }
    });
}

export {http_request}
