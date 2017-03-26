var app = getApp();
Page({
    data: {
        arr: []
    },
    onShow: function () {
        var that = this;
        var _url = app.globalData.baseUrl + 'weChatLessonInfo.php';
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
    },
    delItem: function (e) {
        console.log(e);
        var that = this;
        var oldArr = this.data.arr;
        var newArr = [];
        var lessonNo = e.currentTarget.dataset.id;
        var _url = app.globalData.baseUrl + 'weChatDeleteBind.php';
        wx.showModal({
            title: 'Warning',
            content: 'Are you sure to delete this data?',
            success: function (resModal) {
                if (resModal.confirm) {
                    wx.getStorage({
                        key: 'openid',
                        success: function (resStorage) {
                            wx.request({
                                url: _url,
                                data: {
                                    openid: resStorage.data,
                                    lessonno: lessonNo
                                },
                                method: 'POST',
                                header: {
                                    'content-type': 'application/x-www-form-urlencoded'
                                },
                                success: function (resRequest) {
                                    for (var i in oldArr) {
                                        var item = oldArr[i];
                                        if (item.lessonNo != lessonNo) {
                                            newArr.push(item);
                                        }
                                    }
                                    that.setData({
                                        arr: newArr
                                    })
                                }
                            })
                        },
                        fail: function () {
                            app.getUserInfo();
                        }
                    })
                }
            }
        })
    }
});
