<template>
	<view class="content">
		<!-- #ifdef MP-WEIXIN -->
		<u-navbar :is-back="false" title="微信" :background="{ background: '#f8f8f8'  }" title-color="#404133" :border-bottom="false" z-index="1001">
			<view class="slot-wrap" slot="right">
				<u-icon name="plus-circle" size="36" @click="showSelect"></u-icon>
			</view>
		</u-navbar>
		<!-- #endif -->

		<selectInput :list="selectList" :list-key="'name'" :show.sync="selectShow" @on-select="checkSelect" @close="closeSelect" />
		<searchInput />
		<u-swipe-action :show="item.show" :index="index" v-for="(item, index) in list" btn-width="160" :key="item.id" @click="click" @open="open" :options="options">
			<view class="item"  hover-class="message-hover-class" @tap="linkTo(item)">
                <span v-if="item.no_read>0" class="no-read">
                    {{ item.no_read > 99 ? 99 : item.no_read }}
                </span>
				<image mode="aspectFill" :src="item.other_user.avatar" />

				<!-- 此层wrap在此为必写的，否则可能会出现标题定位错误 -->
				<view class="right u-border-bottom title-wrap">
					<view class="right_top">
						<view class="right_top_name u-line-1">{{ item.other_user.name }}</view>
						<view class="right_top_time ">{{ item.updated_at }}</view>
					</view>
					<view class="right_btm ">
						<view class="u-line-1">{{ item.last_content }}</view>
						<view class=""></view>
					</view>
				</view>
			</view>
		</u-swipe-action>
	</view>
</template>

<script>
import searchInput from '@/components/searchInput/index.vue';
import selectInput from '@/components/selectInput/selectInput.vue';

import url from "../../utils/url";
import {http_request} from "../../utils/http_request";

import {ws_conn,notifyFriend} from "../../utils/websocket";

export default {
	components: { searchInput, selectInput },
	data() {
		return {
		    page : 1,
			list: [],
			selectShow: false,
			options: [
				{
					text: '删除',
					style: {
						backgroundColor: '#dd524d',
						fontSize: '24rpx'
					}
				}
			],
			selectList: [
			    { id: '1', name: '添加朋友', icon: 'man-add-fill',page : '/pages/search/newFriend', },
                // { id: '2', name: '扫一扫', icon: 'scan' },
                // { id: '3', name: '收付款', icon: 'fingerprint' }
            ]
		};
	},
	methods: {
		//打开或者关闭弹窗
		showSelect(){
			this.selectShow = !this.selectShow;
		},
		//action 点击事件
		click(index, index1) {
			if (index1 == 0) {
			    let that = this;

			    console.log(that.list[index]);
                that.delById(that.list[index].id);
                that.list.splice(index, 1);

            }
		},
		//action 打开事件
		open(index) {
			this.list[index].show = true;
			this.list.map((val, idx) => {
				if (index != idx) this.list[idx].show = false;
			});
		},
		//点击导航栏自定义按钮
		onNavigationBarButtonTap({ index }) {
			if (index == 0) {
				this.showSelect()
			}
		},
		//跳转
		linkTo(item) {
			this.$u.route({
				url: 'pages/chat/chat',
				params: { id: item.other_user.id}
			});
		},
		//关闭弹窗
		closeSelect(){
			//小程序兼容
			this.selectShow = false;
		},
		//扫码
		checkSelect(index) {
			if (index == 1) {
				uni.vibrateLong();
				//扫码
				uni.scanCode({
					success: function(res) {
						// console.log('条码内容：' + res.result);
						this.$u.toast('条码类型:', res.scanType);
					}
				});
			}
		},
        getChatList () {
            let that = this;
            let page = that.page;
            let parame = {
                url : `${url.chatList}`,
                data : {
                    page : page,
                },
                noToast : true,
                sCallback : function (res) {
                    if (res.code == 1 && res.data && res.data.length > 0) {
                        that.page = page+1;
                        if (page == 1) {
                            that.list = res.data;
                            uni.setStorageSync('chatList:page:1',res.data);
                        }
                    }
                },
            };
            http_request(parame);
        },

        delById (id) {
            let that = this;
            let page = that.page;
            let parame = {
                url : `${url.chatHide}`,
                data : {
                    id : id
                },
                type : 'POST',
            };
            http_request(parame);
        },

        wsNotifyMessage() {
		    let that = this;
		    that.page = 1;
		    that.getChatList();
        },
	},
    onLoad() {
        let that = this;
        ws_conn();
        that.list = uni.getStorageSync('chatList:page:1');

        if (!that.list || that.list.length < 1)
        {
            that.page = 1;
        }

        uni.onSocketMessage(function (res) {
            let message = JSON.parse(res.data);
            console.log(message);
            if (!message || !message.event)
            {
                return;
            }
            if (message.event == 'user.message')
            {
                that.wsNotifyMessage();
            }
        });

    },
    onShow() {
        let that = this;
        that.getChatList();
    }

};
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
