var app = getApp();
Page({
    data: {
        userInfo: {}
    },
    onShow: function () {
        this.setData({
            userInfo: app.globalData.userInfo
        })
    },
    bindViewTap: function () {
        wx.navigateTo({
            url: '/pages/personInfo/personInfo'
        })
    },
    bindingLesson: function () {
        var that = this;
        var _url = app.globalData.baseUrl + 'weChatBinding.php';
        wx.scanCode({
            success: function (resCode) {
                console.log(resCode);
                wx.getStorage({
                    key: 'openid',
                    success: function (resStorage) {
                        wx.request({
                            url: _url,
                            data: {
                                openid: resStorage.data,
                                lessonNo: resCode.result
                            },
                            method: 'POST',
                            header: {
                                'content-type': 'application/x-www-form-urlencoded'
                            },
                            success: function (resRequest) {
                                if (resRequest.data == 1) {
                                    wx.showModal({
                                        title: 'Prompt',
                                        content: 'Binding success.',
                                        showCancel: false
                                    })
                                } else if (resRequest.data == 0) {
                                    wx.showModal({
                                        title: 'Warning',
                                        content: 'Binding failed.',
                                        showCancel: false
                                    })
                                } else if (resRequest.data == -1) {
                                    wx.showModal({
                                        title: 'Warning',
                                        content: 'Repeat binding.',
                                        showCancel: false
                                    })
                                }
                            },
                            fail: function () {
                                wx.showModal({
                                    title: 'Warning',
                                    content: 'Network error',
                                    showCancel: false
                                })
                            }
                        })
                    },
                    fail: function () {
                        app.getUserInfo();
                    }
                })
            }
        })
    },
    myLesson: function () {
        wx.navigateTo({
            url: '/pages/myLessons/myLessons'
        })
    },
    record: function(){
        wx.navigateTo({
            url: '/pages/record/record'
        })
    }
})