var app = getApp();
var inputContent = {};
Page({
    data: {
        arr: {}
    },
    onShow: function () {
        var that = this;
        var _url = app.globalData.baseUrl + 'weChatPersonInfo.php';
        wx.getStorage({
            key: 'openid',
            success: function (resStorage) {
                wx.request({
                    url: _url,
                    data: {
                        openid: resStorage.data
                    },
                    method: 'POST',
                    header: {
                        'content-type': 'application/x-www-form-urlencoded'
                    },
                    success: function (resRequest) {
                        //console.log(resRequest);
                        if (resRequest.data.state == 1) {
                            that.setData({
                                arr: resRequest.data,
                            })
                            inputContent = that.data.arr;
                            //console.log(that.data.arr);
                        } else {
                            app.getUserInfo();
                        }
                    }
                })
            }
        })
    },
    bindChange: function (e) {
        inputContent[e.currentTarget.id] = e.detail.value;
        this.setData({
            arr: inputContent
        })
    },
    submitBtn: function (e) {
        var that = this;
        var _url = app.globalData.baseUrl + 'weChatUpdataPInfo.php';
        wx.getStorage({
            key: 'openid',
            success: function (resStorage) {
                wx.request({
                    url: _url,
                    data: {
                        openid: resStorage.data,
                        arr: JSON.stringify(that.data.arr)
                    },
                    method: 'POST',
                    header: {
                        'content-type': 'application/x-www-form-urlencoded'
                    },
                    success: function (resRequest) {
                        //console.log(resRequest.data)
                        if (resRequest.data) {
                            wx.showModal({
                                title: 'Prompt',
                                content: 'Submit success',
                                showCancel: false,
                                success: function (resModal) {
                                    if (resModal.confirm) {
                                        wx.navigateBack({})
                                    }
                                }
                            })
                        } else {
                            wx.showModal({
                                title: 'Warning',
                                content: 'Submit failed',
                                showCancel: false
                            })
                        }
                    }, fail: function () {
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
});