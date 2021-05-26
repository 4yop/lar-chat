<template>
	<view class="content">
		<!-- #ifdef MP-WEIXIN -->
		<u-navbar :is-back="false" title=" " :background="{ background: '#ffffff'  }" :border-bottom="false"></u-navbar>
		<!-- #endif -->
		<!-- #ifndef MP-WEIXIN -->
		<view class="status_bar"></view>
		<!-- #endif -->
		<view class="header">
			<view class="header_left">
				<image mode="aspectFill" :src="userInfo.avatar" />
				<view class="header_left_content">
					<view class="header_left_content_name">{{userInfo.name}}</view>
					<view class="header_left_content_number">邮箱: {{userInfo.email}}</view>
				</view>
			</view>
			<view class="header_right">
				<u-icon name="arrow-right"></u-icon>
			</view>
		</view>
		<view  style="height: 10rpx;"></view>
<!--		<u-cell-group>-->
<!--			<u-cell-item title="支付" :title-style="{ marginLeft: '10rpx' }"><u-icon slot="icon" name="fingerprint" color="#4cd964" size="32"></u-icon></u-cell-item>-->
<!--		</u-cell-group>-->
<!--		<view  style="height: 10rpx;"></view>-->
<!--		<u-cell-group>-->
<!--			<u-cell-item v-for="(item, index) in groupList" :key="index" :title="item.title" :title-style="{ marginLeft: '10rpx' }">-->
<!--				<u-icon slot="icon" :name="item.icon" :color="item.color" size="32"></u-icon>-->
<!--			</u-cell-item>-->
<!--		</u-cell-group>-->
<!--		<view  style="height: 10rpx;"></view>-->
<!--		<u-cell-group>-->
<!--			<u-cell-item title="设置" :title-style="{ marginLeft: '10rpx' }"><u-icon slot="icon" name="setting" color="#409eff" size="32"></u-icon></u-cell-item>-->
<!--		</u-cell-group>-->
		<u-cell-group>
			<u-cell-item @click="logout()" title="退出登录" :title-style="{ marginLeft: '10rpx' }"><u-icon slot="icon" name="setting" color="#409eff" size="32"></u-icon></u-cell-item>
		</u-cell-group>
	</view>
</template>

<script>
import {http_request} from "../../utils/http_request";
import {getUserAvatar} from "../../utils/common";
import {ws_conn} from "../../utils/websocket.js";
export default {
	data() {
		return {
		    userInfo : {
		        avatar : '',
                name : '',
                email : '',
            },
			groupList: [
				{ title: '收藏', color: '#409eff', icon: 'star' },
				{ title: '相册', color: '#409eff', icon: 'photo' },
				{ title: '卡包', color: '#409eff', icon: 'coupon' },
				{ title: '表情', color: '#ff9900', icon: 'heart' }
			],
		};
	},
    onLoad(options){
        console.log(options);

        if (!uni.getStorageSync('_token'))
        {

        }

        this.userInfo = uni.getStorageSync('userInfo');
        this.getUserInfo();
    },
    onShow() {
		let ws = ws_conn();
    },//end onShow
	methods: {

		//退出登录
		logout() {
			let that = this;
			let params = {
				url : 'logout',
				type : 'POST',
				sCallback : function (res) {
					uni.removeStorageSync('_token');
					uni.redirectTo({
					    url : '/pages/my/login',
					});
				}
			};//end params
			http_request(params);
		},//end function logout


        getUserInfo () {
            let that = this;
            let params = {
                url : 'user',
                sCallback : function (res) {
                    if (res.code != 1) {
                        uni.removeStorageSync('_token');
                        uni.showToast({
                            title: res.msg ? res.msg : 'error',
                            icon : 'none',
                            success : function (){
                                setTimeout(function () {
                                    uni.redirectTo({
                                        url : '/pages/my/login',
                                    });
                                },1000);
                            }
                        });
                        return;
                    }//end if res.code
                    that.userInfo = res.data;
                    that.userInfo.avatar = getUserAvatar(res.data.id);
                    uni.setStorageSync('userInfo',res.data);
                },//end sCallback
            };//end params
            http_request(params);
        },//end getUserInfo
    },//end methods
};
</script>

<style lang="scss" scoped>
	.header{
		display: flex;
		justify-content: space-between;
		align-items: center;
		padding: 60rpx 38rpx;
		background-color: #ffffff;
		&_left{
			display: flex;
			align-items: center;
			&_content{
				padding-left: 20rpx;
				&_name{
					font-weight: bold;
				}
				&_number{
					color:#969799 ;
					font-size: 26rpx;
				}
			}
		}
		&_right{
			font-size: 28rpx;
			color: #969799;
		}
		image {
			width: 100rpx;
			height: 100rpx;
			border-radius: 6rpx;
		}
	}
.status_bar {
	height: var(--status-bar-height);
	width: 100%;
}
</style>
