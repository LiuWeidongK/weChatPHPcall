var app = getApp();
Page({
  data: {
    userInfo: {},
    focus: false
  },
  scanCode: function () {
    var that = this;
    var _url = app.globalData.baseUrl + "weChatDuringCall.php";
    wx.scanCode({
      success: function (resCode) {
        //console.log(resCode)
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
                console.log(resRequest);
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
  inputCode: function () {
    this.setData({
      focus: true
    })
  },
  confirmInput: function (e) {
    console.log("Check finish Btn");
    var value = e.detail.value;
    var that = this;
    var _url = app.globalData.baseUrl + "weChatDuringCall.php";
    wx.getStorage({
      key: 'openid',
      success: function (resStorage) {
        wx.request({
          url: _url,
          data: {
            openid: resStorage.data,
            lessonNo: value
          },
          method: 'POST',
          header: {
            'content-type': 'application/x-www-form-urlencoded'
          },
          success: function (resRequest) {
            console.log(resRequest);
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
  },
  onShow: function () {
    app.checked();
  }
})