<template>
    <view class="content">
        <!-- #ifdef MP-WEIXIN -->
        <u-navbar :is-back="false" title="微信" :background="{ background: '#f8f8f8'  }" title-color="#404133" :border-bottom="false" z-index="1001">
            <view class="slot-wrap" slot="right">
                <u-icon name="plus-circle" size="36" @click="showSelect"></u-icon>
            </view>
        </u-navbar>
        <!-- #endif -->

        <selectInput  />
        <searchInput />
    </view>
</template>

<script>
	import url from "../../utils/url";
    import {http_request} from "../../utils/http_request";

    import searchInput from '@/components/searchInput/index.vue';
    import selectInput from '@/components/selectInput/selectInput.vue';

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
            }


		},
		onLoad( user ) {

        }



	}
</script>

<style lang="scss" scoped>
.content {
    .item {
        width: 750rpx;
        display: flex;
        align-items: center;
        // padding: 20rpx;
        image {
            width: 76rpx;
            height: 76rpx;
            margin: 20rpx;
            border-radius: 12rpx;
            flex: 0 0 76rpx;
            position:relative;
        }
        .no-read{
            position:absolute;
            border-radius:50%;
            min-width:40rpx;
            line-height: 40rpx;
            height:40rpx;
            top:10rpx;
            left:70rpx;
            background-color:red;
            color:white;
            display: block;
            text-align: center;
            z-index: 99;
        }
        .right {
            overflow: hidden;
            flex: 1 0;
            padding: 20rpx 20rpx 20rpx 0;
            &_top {
                display: flex;
                justify-content: space-between;
                &_name {
                    font-size: 28rpx;
                    color: $u-main-color;
                    flex: 0 0 450rpx;
                    overflow: hidden;
                }
                &_time {
                    font-size: 22rpx;
                    color: $u-light-color;
                }
            }
            &_btm {
                display: flex;
                justify-content: space-between;
                align-items: center;
                font-size: 22rpx;
                color: $u-tips-color;
                padding-top: 10rpx;
            }
        }
    }
    .bg_view {
        background-color: #fafafa;
    }
    .slot-wrap {
        display: flex;
        align-items: center;
        padding: 0 30rpx;
    }
}
</style>
