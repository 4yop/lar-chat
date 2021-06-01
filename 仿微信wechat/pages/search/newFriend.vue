<template>
	<view class="">
		<!-- #ifdef MP-WEIXIN -->
		<u-navbar title=" " :background="{ background: '#f8f8f8' }">
			<view class="slot-wrap">
				<u-search
					:focus="true"
					@custom="clickCancel"
					placeholder="输入用户邮箱"
					shape="square"
					:action-style="{ color: '#007aff' }"
					action-text="取消"
					:bg-color="'#ffffff'"
					v-model="search_word"
					@search="search"
				></u-search>
			</view>
		</u-navbar>
		<!-- #endif -->
		<!-- #ifndef MP-WEIXIN -->
		<view class="status_bar"></view>
		<view class="content_search">
			<u-search
				:focus="true"
				@custom="clickCancel"
				placeholder="输入用户邮箱"
				shape="square"

				:action-style="{ color: '#007aff' }"
				action-text="取消"
				:bg-color="'#ffffff'"
				v-model="search_word"
                @search="search"
			></u-search>
			<view style="text-align: center;line-height: 50rpx;height:50rpx;padding-top: 10rpx;">
				我的:{{userInfo.email}}<u-icon name="grid" @click="toQrCode()"  color="#2979ff" size="50"></u-icon>
			</view>
		</view>
		<!-- #endif -->
	</view>
</template>

<script>

import { http_request } from "../../utils/http_request";
import url from "../../utils/url";

export default {
	data() {
		return {
			search_word: '',
			userInfo : {},
		};
	},
	mounted() {
		this.userInfo =  uni.getStorageSync('userInfo');
	},
	methods: {
		clickCancel() {
			this.$u.route({
				type: 'navigateBack'
			});
		},
		toQrCode () {
			this.$u.route({
			    url: 'pages/my/qr_code',
			});
		},
		search(){
		    console.log(this.search_word);
		    let that = this;
		    let parame = {
		        url : url.friendSearch,
                data : {
		            email : that.search_word,
                },
                sCallback : function (res) {
		            if (res.code && res.data && res.data.id)
		            {
                        setTimeout(()=>{
                            that.$u.route({
                                url: 'pages/businessCard/businessCard',
                                params:res.data
                            })
                        },500);
                    }else
                    {
                        uni.showToast({
                            title : res.msg ? res.msg : '查无此人',
                            icon: 'none',
                            mask: true,
                        });
                    }
                },
                eCallback : function (res) {
                    uni.showToast({
                        title : res.msg ? res.msg : '查无此人',
                        icon: 'none',
                        mask: true,
                    });
                },
            };
		    http_request(parame);
        },
	},
	onShow() {}
};
</script>

<style lang="scss" scoped>
.status_bar {
	height: var(--status-bar-height);
	width: 100%;
}
.content_search {
	padding: 16rpx;
	background-color: #f8f8f8;
}
</style>
