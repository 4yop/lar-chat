
const token = {
	getToken : function () {
		let token = uni.getStorageSync('_token');

		//过期了
		if (!token || token.expires_time < (Date.parse(new Date())/1000) )
		{
            uni.removeStorageSync('_token');
            console.log(token.expires_time);
            console.log(Date.parse(new Date())/1000);
            console.log("token过期了");

            setTimeout(function () {
                uni.switchTab({
                    url : '/pages/my/login',
                });
            },100);
            return '';
        }
		if (token.token)
        {
		    return token.token;
		}
        uni.removeStorageSync('_token');
        console.log("token 空");
        setTimeout(function () {
            uni.switchTab({
                url : '/pages/my/login',
            });
        },100);
		return '';
	},
};


export default token;
