<template>
	<view class="content">
		<view class="qrcode_section">
			<view class="clearfix">
				<view class="header1">
					<image  :src="userInfo.avatar" mode="aspectFill" alt="" style="width: 80rpx;height:80rpx;"></image>
				</view>
				<view class="info">
					<view>
						<text>{{userInfo.name}}</text>
						<text class="gender gender-male"></text>
					</view>
					<text>地球 中国</text>
				</view>
			</view>
			<view id="qrcode-pic" >
				<image  :src="qr_code" mode="aspectFit" alt="" style="width: 100%;"></image>
			</view>
			<view class="desc">扫一扫上面的二维码图案，加我</view>
		</view>
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
			qr_code : '',
		};
	},
    onLoad(options){
		this.getQrCode();
        this.userInfo = uni.getStorageSync('userInfo');
        this.getUserInfo();
    },
    onShow() {
       
    },//end onShow
	methods: {
		
		getQrCode () {
			let that = this;
			let params = {
			    url : 'user/qr_code',
			    sCallback : function (res) {
			        if (res.code == 1) 
					{
						that.qr_code = res.data.qr_code
					}//end if res.code
			    },//end sCallback
			};//end params
			http_request(params);
		},

		getUserInfo () {
            let that = this;
            let params = {
                url : 'user',
                noToast : true,
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
.qrcode_section{
	width: 90%;
	padding: 5%;
	border-radius: 5px;
	margin: 0 auto;
	margin-top: 20%;
	background: #fff;
	.header1 {
		float: left;
	}
	.info{
		float: left;
		margin-left: 20rpx;
		.gender {
		    display: inline-block;
		    width: 40rpx;
		    height: 40rpx;
		    vertical-align: middle;
		    margin-left: 8rpx;
		    margin-top: -10rpx;
		}
		.gender-male {
		    background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAMAAADW3miqAAAAsVBMVEUAAABHtvBGtvBmzP////9It/JGtvBHuPFHt/CA//9Kv/RHt+9Gt/BHtu9It/BHuPFIt+9JufBHuPBOxP9HuPBIt/FMuvFGtvBIt+9Ht/BIt/JGtvBOvPRHt/BKvfdNufBHt/BGt/BIt/JHt+9JtvJGtu////+34vip3fe64/lwxvJHtu/v+P3g8vxMuO9+zPNNuO+EzvTf8vyM0fWR0/VbvvBWvPDl9PyV1fVLuO9It+9EB+HiAAAAJXRSTlMA58gFAV/PbM0CGPF49WNIIEKdDYR8Je+kvzzLF8kfIar+TuZNWbDWOQAAANdJREFUeAHdzWVywzAYBNA1hZk5KazCUIb7H6zGz+qM5P/tu8DD/+CV3XrdLXsoUCsxVqrBqlphqlKFTYuiBQvfoXjwYbamZg2ze2oeYRZQE8CsTU0bZh1qOrBwKVzYdCm6sOox1YNd32HM6aPAgLEBigwZG6LAKOtGsPGD8ecXQ9+v48CH0WxO7j5e3t6fnnfkfAYhVhuGDip2YGizwm9eo8nI8aRCpyMjzYYHzWLJ1FaFtkwtF8hNmbmq0JWZKXIUl7NS5wsFcncUt/3+RnGH3IQWE/xtP2nFNGboYU8HAAAAAElFTkSuQmCC);
		    background-repeat: no-repeat;
		    background-size: contain;
		    background-position: 50%;
		}
		
	}
	#qrcode-pic {
	    // background-color: #F1F1F1;
	   
	    margin-top: 40rpx;
	}
	.desc {
	    font-size: 24rpx;
	    text-align: center;
	    color: #999;
	    margin-top: 40rpx;
	}
}
.clearfix {
    zoom: 1;
}

</style>
