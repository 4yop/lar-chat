
const token = {
	getToken : function () {
		let token = uni.getStorageSync('_token');
		if (token) {
		    return 'Bearer '+token;
		}
		return '';
	},
};


export default token;