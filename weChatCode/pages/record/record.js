var app = getApp();
Page({
    data: {
        arr: []
    },
    onShow: function () {
        var that = this;
        var _url = app.globalData.baseUrl + 'weChatRecord.php';
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
                        that.setData({
                            arr: resRequest.data
                        });
                        console.log(that.data.arr);
                    }
                })
            },
            fail: function () {
                app.getUserInfo();
            }
        })
    }
})