<template>
	<view class="content">
		<searchInput />
		<u-index-list :scrollTop="scrollTop" :index-list="indexList" :active-color="'#3CC51F'">
			<view v-for="(item, index) in indexList" :key="index">
				<u-index-anchor :index="item" />
				<view v-for="item in firendsList" :key="item.friend.id"  class="list-cell" @tap="linkToCard(item.friend)" hover-class="message-hover-class">
					<image mode="aspectFill" :src="item.friend.avatar" />
					<view  class="list-cell-name">{{item.friend.email}}</view>
				</view>
			</view>
		</u-index-list>
	</view>
</template>

<script>
	import searchInput from '@/components/searchInput/index.vue'
    import {http_request} from "../../utils/http_request";

    import url from "../../utils/url";
    export default {
	components:{searchInput},
	data() {
		return {
			scrollTop: 0,
			indexList: ['☆',
               // 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'
            ],
            firendsList : [],
		};
	},

    onLoad(options){


    },//end onLoad

    onShow(){

        this.getFriendsList();
    },//end onShow

	methods: {

		onMessage(msg) {

		},

        getFriendsList () {
		    let that = this;
            let parame = {
                url : url.friendList,
                noToast : true,
                sCallback : function (res) {
                    that.firendsList = res.data.list;
                },
            };
            http_request(parame);
        },

        getAddressBookList(){

        },

		linkToCard(user){
			this.$u.route({
				url: 'pages/businessCard/businessCard',
				params:user
			})
		},
	},
	onPageScroll(e) {
		this.scrollTop = e.scrollTop;
	}
};
</script>

<style lang="scss" scoped>
.content {
	height: 100%;
	.list-cell {
		display: flex;
		box-sizing: border-box;
		width: 100%;
		padding: 10px 24rpx;
		overflow: hidden;
		color: #323233;
		font-size: 28rpx;
		line-height: 48rpx;
		background-color: #fff;
		align-items: center;
		image {
			width: 76rpx;
			height: 76rpx;
			border-radius: 12rpx;
			flex: 0 0 76rpx;
		}
		&-name{
			padding-left: 20rpx;
		}
	}
}
</style>
