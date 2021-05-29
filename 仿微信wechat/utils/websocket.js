import token from './token'
import url from './url'
const ws_conn = function () {
let user_id = uni.getStorageSync('userInfo')['id'];

let wsUrl = url.wsUrl+`?token=${token.getToken()}`;








uni.connectSocket({
    url: wsUrl,
    header: {
        'content-type': 'application/json'
    },
    method: 'GET',
	success : function () {

	},
	fail : function () {

	},
	complete : function () {

	}
});

uni.onSocketOpen(function (res) {
  console.log('WebSocket连接已打开！');
});

uni.onSocketError(function (res) {
  console.log('WebSocket连接打开失败，请检查！');
});

// uni.onSocketMessage(function (res) {
//   console.log('收到服务器内容：' + res.data);
// });

uni.onSocketClose(function (res) {
  console.log('WebSocket 已关闭！');
});

}

const notifyFriend = function (data) {
    let json = JSON.stringify(data);
    uni.sendSocketMessage({
        data : json,
    });
}

export {ws_conn,notifyFriend}
