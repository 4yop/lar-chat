<template>
	<view class="content">
		<!-- #ifdef MP-WEIXIN -->
		<u-navbar :is-back="false" title=" " :background="{ background: '#ffffff'  }" :border-bottom="false"></u-navbar>
		<!-- #endif -->
		<!-- #ifndef MP-WEIXIN -->
		<view class="status_bar"></view>
		<!-- #endif -->
			
			
		<view class="warp">
			<form @submit="formSubmit" @reset="formReset" class="login-form">
				<view class="uni-form-item uni-column">
					<input class="uni-input input" name="input" placeholder="请输入用户名" />
				</view>
				<view class="uni-form-item uni-column">
					<input class="uni-input input" name="input" placeholder="密码" />
				</view>
				
				<view class="uni-form-item uni-column other">
					 <navigator url="/pages/my/register" hover-class="navigator-hover">
						<view type="default">注册</view>
					</navigator>
					 <navigator url="navigate/navigate?title=navigate" hover-class="navigator-hover">
						<view type="default">忘记密码</view>
					</navigator>
				</view>
				<view class="uni-btn-v">
					<button class='submit-button' form-type="submit">登录</button>
				</view>
			</form>
		</view>
		    	
		
		
		
	</view>
</template>

<script>
export default {
	data() {
		return {
			groupList: [
				{ title: '收藏', color: '#409eff', icon: 'star' },
				{ title: '相册', color: '#409eff', icon: 'photo' },
				{ title: '卡包', color: '#409eff', icon: 'coupon' },
				{ title: '表情', color: '#ff9900', icon: 'heart' }
			],
		};
	},
	methods: {}
};
</script>

<style lang="scss" scoped>
	.warp{
		position: absolute;
		display: flex;
		justify-content: center;
		align-items: center;
		width: 100%;
		height: 100%;
	}
	.login-form{
		width: 100%;
		padding: 0 10px;
	}
	.uni-btn-v{
		padding: 10px 0;
	}
	.submit-button{
		background: rgb(60, 197, 31);
		color:#FFF;
	}
	.input{
		margin-bottom: 10px;
		height: 70rpx;
		line-height: 70rpx;
		padding: 0 10px;
		display: block;
		border: 1px solid #000;
		border-radius: 5px;
	}
	.other{
		display: flex;
		justify-content: space-between;
		padding: 0 10px;
	}
</style>
