//app.js
App({
    onLaunch: function () {
        this.getUserInfo();
        this.checked();
    },
    globalData: {
        userInfo: null,
        baseUrl: 'http://localhost/phpstorm/AppServ/server/weChatServer/'
    },
    getUserInfo: function (cb) {
        var that = this;
        var _url = this.globalData.baseUrl + 'weChatLogin.php';
        if (this.globalData.userInfo) {
            typeof cb == "function" && cb(this.globalData.userInfo)
        } else {
            wx.login({
                success: function (loginRes) {
                    //console.log(loginRes);
                    if (loginRes.code) {
                        wx.getUserInfo({
                            success: function (userInfoRes) {
                                //console.log(userInfoRes);
                                that.globalData.userInfo = userInfoRes.userInfo;
                                typeof cb == "function" && cb(that.globalData.userInfo)
                                wx.request({
                                    url: _url,
                                    data: {
                                        code: loginRes.code,
                                        avatarUrl: that.globalData.userInfo.avatarUrl
                                    },
                                    method: 'POST',
                                    header: {
                                        'content-type': 'application/x-www-form-urlencoded'
                                    },
                                    success: function (requestRes) {
                                        //console.log(requestRes);
                                        if (requestRes.data.state == 1) {
                                            wx.setStorage({
                                                key: "openid",
                                                data: requestRes.data.value
                                            })
                                        }
                                    }
                                })
                            }
                        })
                    }
                }
            })
        }
    },
    checked: function () {
        var _url = this.globalData.baseUrl + "weChatCheckBind.php";
        wx.getStorage({
            key: 'openid',
            success: function (resStorage) {
                //console.log(resStorage);
                wx.request({
                    url: _url,
                    data: {
                        openid: resStorage.data
                    },
                    method: 'POST',
                    header: {
                        'content-type': 'application/x-www-form-urlencoded'
                    },
                    success: function (requestRes) {
                        //console.log(requestRes);
                        if (requestRes.data.state != 1) {
                            wx.showModal({
                                title: 'Warning',
                                content: 'Please improve the information for the first time.',
                                showCancel: false,
                                success: function (res) {
                                    if (res.confirm) {
                                        wx.switchTab({
                                            url: '/pages/mine/mine'
                                        })
                                    }
                                }
                            })
                        }
                    }
                })
            },
            fail: function () {
                this.getUserInfo();
            }
        })
    }
})