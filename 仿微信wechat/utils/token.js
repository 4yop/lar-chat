
const token = {
	getToken : function () {
		let token = uni.getStorageSync('_token');
		if (token) {
		    return token;
		}
		return '';
	},
};


export default token;