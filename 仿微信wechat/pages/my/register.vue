<template>
	<view class="content">
		<!-- #ifdef MP-WEIXIN -->
		<u-navbar :is-back="false" title=" " :background="{ background: '#ffffff'  }" :border-bottom="false"></u-navbar>
		<!-- #endif -->
		<!-- #ifndef MP-WEIXIN -->
		<view class="status_bar"></view>
		<!-- #endif -->


		<view class="warp">
			<form  class="login-form">
				<view class="uni-form-item uni-column email-input">
					<input class="uni-input input" @blur="clearTips" @input="showTips" :disabled="isSendEmail ? 'disabled' : false " v-model="email" type="email" name="input" placeholder="请输入邮箱" />
					<view class="email-tips" v-if="inputEmailTips.length > 0" :style="['top:-'+inputEmailTips.length*100+'%']">
						<view class="email-tips-row" @click="changeEmail(item)" v-for="item in inputEmailTips">{{item}}</view>
					</view>
				</view>
				<view v-if="isSendEmail==true">
					<view class="uni-form-item uni-column">
						<input class="uni-input input" name="input" v-model="code" placeholder="邮箱验证码" />
					</view>
					<view class="uni-form-item uni-column">
						<input class="uni-input input" name="input" v-model="password" type="password" placeholder="密码" />
					</view>
					<view class="uni-form-item uni-column">
						<input class="uni-input input" name="input" v-model="repassword" type="password" placeholder="确认密码" />
					</view>

					<view class="uni-form-item uni-column other">
						 <navigator url="/pages/my/login" hover-class="navigator-hover">
							<view type="default">立即登录</view>
						</navigator>

					</view>

					<view class="uni-btn-v">
						<button class='submit-button' @click="register" form-type="submit">提交</button>
					</view>
				</view>
				<view class="uni-btn-v" v-if="isSendEmail==false">
					<button class='submit-button' @click="sendEmail" form-type="submit">发送验证码</button>
				</view>
			</form>
		</view>




	</view>
</template>

<script>
import validator from 'validator';
import { http_request } from "../../utils/http_request";

export default {
	data() {
		return {
			email : '',
			password : '',
			repassword : '',
			code : '',
			isSendEmail : false,
			inputEmailTips : [],
			groupList: [
				{ title: '收藏', color: '#409eff', icon: 'star' },
				{ title: '相册', color: '#409eff', icon: 'photo' },
				{ title: '卡包', color: '#409eff', icon: 'coupon' },
				{ title: '表情', color: '#ff9900', icon: 'heart' }
			],
		};
	},
	methods: {
		clearTips(){
			let that = this;
			setTimeout( ()=>{
				that.inputEmailTips = [];
			},100);

		},//end clearTips
		changeEmail(email){
			this.email = email;
			this.inputEmailTips = [];
		},//end changeEmail
		showTips(e){
			let ext = [

                "sina.com",
                "163.com",
                "126.com",
                "yahoo.com.cn",
                "gmail.com",
                "sohu.com",
				"qq.com",
			];
			let val = e.target.value;
			let start = val;
			if (val.indexOf('@') != -1) {
				start = val.split('@')[0];
			}
			let tips = [];
			ext.forEach((value)=>{
				let email = start+'@'+value;
				tips.push(email);
			});
			this.inputEmailTips = tips;
			// console.log(val);
		},//end showTips

		sendEmail () {
            let that = this;
			if ( validator.isEmail(that.email) == false)
			{
				uni.showToast({
				    title: '邮件格式不正确',
					icon : 'none',
				});
				return;
			}
            let params = {
                url : 'register/code',
                data : {
                    email : that.email,
                },
                type : 'POST',
                sCallback : function (res) {
                    if (res.code != 1) {
                        uni.showToast({
                            title: res.msg ? res.msg : '发送失败',
                            icon : 'none',
                        });
                        return;
                    }
                    uni.showToast({
                        title: '发送邮件成功',
                    });
                    that.isSendEmail = true;
                },
            }
            http_request(params);
        },//end sendEmail

        register () {
		    let that = this;
            //验证数据start
            if ( validator.isEmail(this.email) == false)
            {
                uni.showToast({
                    title: '邮件格式不正确',
                    icon : 'none',
                });
                return;
            }
            if ( that.password == '' || that.repassword == '' )
            {
                uni.showToast({
                    title: '密码和确认密码不能为空',
                    icon : 'none',
                });
                return;
            }
            if ( that.password != that.repassword )
            {
                uni.showToast({
                    title: '密码和确认密码不一致',
                    icon : 'none',
                });
                return;
            }
            if ( that.code == '' )
            {
                uni.showToast({
                    title: '邮箱验证码不能为空',
                    icon : 'none',
                });
                return;
            }
            //验证数据end


            let params = {
                url : 'user/register',
                data : {
                    email : that.email,
                    password : that.password,
                    repassword : that.repassword,
                    code : that.code,
                },
                type : 'POST',
                sCallback : function (res) {
                    if (res.code != 1) {
                        uni.showToast({
                            title: res.msg ? res.msg : 'error',
                            icon : 'none',
                        });
                        return;
                    }
                    uni.showToast({
                        title: '注册成功',
                        success : function () {
                            setTimeout(function () {
                                uni.navigateTo({
                                    url : '/pages/my/login',
                                });
                            },2000);
                        },
                    });
                },
            };//end parames
            http_request(params);
        },//end function register


	},//end methods
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
	.email-input{
		position : relative;
	}
	.email-tips{
		position: absolute;
		top:-700%;
		z-index: 999;
		background-color: #FFF;
		width: 100%;
	}
	.email-tips-row{
		border:1px solid #EEEEEE;
		height: 70rpx;
		line-height: 70rpx;
		padding: 0 20rpx;
	}
</style>
