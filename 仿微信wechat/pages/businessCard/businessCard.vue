<template>
	<view>
		<view class="userinfo">
			<image :src="userInfo.avatar" @tap="previewImg(userInfo.avatar)" class="img"></image>
			<view class="userinfo-desc">
				<view class="userinfo-desc-name">{{userInfo.name}}</view>
				<view class="userinfo-desc-gray">邮箱：{{userInfo.email}}</view>
<!--				<view class="userinfo-desc-gray">微信号：{{userInfo.wechatNumber}}</view>-->
<!--				<view class="userinfo-desc-gray">地区：{{userInfo.address}}</view>-->
			</view>
		</view>
		<view  class="perch"></view>
		<u-cell-group >
			<u-cell-item title="个性签名" :label="userInfo.description" hover-class="none" :title-style="{ marginLeft: '10rpx' }"></u-cell-item>
<!--            <u-cell-item title="朋友圈" label="模拟数据暂不支持查看好友朋友圈" hover-class="none" :title-style="{ marginLeft: '10rpx' }"></u-cell-item>-->
<!--			<u-cell-item title="更多信息" :title-style="{ marginLeft: '10rpx' }" @click="linkToMoreInfoMation"></u-cell-item>-->
		</u-cell-group>
		<view class="" v-if="userInfo.is_friend==1" >
			<view  class="perch"></view>
			<u-cell-group >
				<u-cell-item title="发消息" :arrow="false" :center="true" :title-style="{ marginLeft: '10rpx' }" @click="linkToChat">
					<u-icon slot="icon" name="chat" color="#36648B" size="32"></u-icon>
				</u-cell-item>
			</u-cell-group>
        </view>
        <view class="" v-if="userInfo.is_friend==0" >
            <view  class="perch"></view>
            <u-cell-group >
                <u-cell-item title="添加好友" :arrow="false" :center="true" :title-style="{ marginLeft: '10rpx',textAlign:'center', }" @click="addFriendById(userInfo.id)">
                    <u-icon slot="icon" name="plus" color="#36648B" size="32"></u-icon>
                </u-cell-item>
            </u-cell-group>
        </view>
	</view>
</template>

<script>
	import url from "../../utils/url";
    import {http_request} from "../../utils/http_request";

    export default {
		data() {
			return {
				userInfo:{
                    name : '',
                    email : '',
                    description : '',
                    avatar : '',
                },
				isItMe:false
			}
		},
		methods: {
			linkToChat(){
			    let that = this;
                that.$u.route({
					url:"pages/chat/chat",
					params: that.userInfo,
				})
			},
			previewImg(urls){
				uni.previewImage({urls:[urls]})
			},
			linkToMoreInfoMation(){
				this.$u.route({
					url:"pages/moreInforMation/moreInforMation",
					params:{ signature:this.userInfo.signature }
				})
			},
			getFriendById (friend_id) {
                let that = this;
                let parame = {
                    url : `${url.friend}/${friend_id}`,
                    sCallback : function (res) {
                        if (res.code == 1 && res.data) {
                            that.userInfo = res.data;
                        }
                    },
                };
                http_request(parame);
            },

            addFriendById (friend_id) {
                let that = this;
                let parame = {
                    url : url.friendAdd,
                    data : {
                        friend_id : friend_id,
                    },
                    type : "POST",
                    sCallback : function (res) {
                        uni.showToast({
                            title: res.msg?res.msg:'添加失败',
                            duration: 2000,
                            icon : res.code == 1 ? 'success' : 'none',
                            success : function () {
                                if (res.code == 1 ) {
                                    that.linkToChat();
                                }//endif
                            },//end success
                        });//end uni.showToast
                    },//end sCallback
                };//end parame
                http_request(parame);
            },//end addFriendById()

		},//end methods{}
		onLoad( user ) {
		    console.log(user);
            let that = this;
			if(user){
                that.userInfo = user;
            }
            that.getFriendById(user.id);
        }



	}
</script>

<style scoped lang="scss">
	.perch{
		height: 10rpx;
	}
.userinfo{
	display: flex;
	justify-content: flex-start;
	align-items: flex-start;
	padding: 20rpx 30rpx 40rpx 40rpx;
	background-color: #FFFFFF;
	.img{
		display: block;
		width: 110rpx;
		height: 110rpx;
		border-radius: 10rpx;
	}
	&-desc{
		padding-left: 30rpx;
		&-name{
			font-weight: bold;
			font-size: 36rpx;
			transform: translateY(-10rpx);
		}
		&-gray{
			color: $u-tips-color;
			font-size: 29rpx;
		}
	}
}
</style>
