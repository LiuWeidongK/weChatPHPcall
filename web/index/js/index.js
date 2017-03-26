/**
 * Created by Misaya on 2017/3/12.
 */
Messenger.options = {
    extraClasses: 'messenger-fixed messenger-on-bottom messenger-on-right',
    theme: 'air'
};

var lessonNo = [];
var callLessonNo;
var second = 0;
var minute;
var clearTime;
var $startButton;

$(document).ready(function () {
    transDiv();
    refreshTable();
    refresh_2();
    refresh_3();
    startCall();

    $('#modalALBtn').click(function () {
        $.ajax({
            type: 'POST',
            url: '../../server/webServer/addLessonServ.php',
            data: $('#addLessonForm').serialize(),
            success: function (data) {
                if(data=="true") {
                    Messenger().post({message: 'Success', type: 'success', showCloseButton: true});
                    refreshTable();
                    $('#addLessonModal').modal('hide');
                }else Messenger().post({message: 'Fail', type: 'error', showCloseButton: true});
            }
        })
    });

    $("#deleteAll").click(function () {
        var checkedNum = $("input[name='followBox']:checked").length;
        if (checkedNum == 0) {
            Messenger().post({message: '请至少选择一条信息', type: 'error', showCloseButton: true});
        } else {
            var checkedList = [];
            $("input[name='followBox']:checked").each(function () {
                checkedList.push($(this).parents("tr").find("td").eq(1).text().trim());
            });
            var r = confirm("Are you sure to delete the " + checkedNum +" data?");
            if(r==true){
                $.ajax({
                    type: 'POST',
                    url: '../../server/webServer/deleteServ.php',
                    data: {lessonNo: checkedList},
                    success: function (data) {
                        if(data=="true") {
                            Messenger().post({message: 'Success', type: 'success', showCloseButton: true});
                            refreshTable();
                        }else Messenger().post({message: 'Fail', type: 'error', showCloseButton: true});
                    }
                })
            }
        }
    });
});

function detailsInfo() {
    $("[name='details']").click(function () {
        var no = $(this).parents("tr").find("td").eq(1).text().trim();
        $("#spanLNo").text(no);
        $("#spanLName").text($(this).parents("tr").find("td").eq(2).text().trim());
        $("#spanBNum").text($(this).parents("tr").find("td").eq(3).text().trim());
        $("#spanLPlace").text($(this).parents("tr").find("td").eq(4).text().trim());
        $("#erCodeImg").attr("src","http://qr.topscan.com/api.php?text=" + no);
    });
}

function refreshTable() {
    $.post('../../server/webServer/refreshTableServ.php', {
    }, function(data) {
        var jsonObj = eval( "(" + data + ")" );
        var content ="";
        $.each(jsonObj, function (index,obj) {
            content += "<tr>" +
                "<td><input type='checkbox' name='followBox'/></td>" +
                "<td>" + obj.lno + "</td>" +
                "<td>" + obj.lname + "</td>" +
                "<td>" + obj.pnum + "</td>" +
                "<td>" + obj.lplace + "</td>" +
                "<td><a href='#' name='rollCall'>Roll call</a></td>"+
                "<td><a href='#' name='details' data-toggle='modal' data-target='#lessonDetailsModal'>View details</a></td>" +
                "<td><a href='#' name='deleteBtn'>Delete</a></td>" +
                "</tr>";
        });
        $("#lessonTbody").html(content);
        $("#tableClass").trigger("update");
        detailsInfo();
        deleteNo();
        rollCall();
    });
}

function refresh_2() {
    $.ajax({
        type: 'POST',
        url: '../../server/webServer/getLessonListServ.php',
        success: function (data) {
            var jsonObj = eval( "(" + data + ")" );
            var content ="";
            $.each(jsonObj, function (index,obj) {
                content += "<li><a href='#'>" + obj.lessonName + "</a><span class='lessonNo'>" + obj.lessonNo +"</span></li>"
            });
            $("#dropdownC2").html(content);
            chooseLesson();
        }
    });
}

function chooseLesson() {
    $('ul#dropdownC2 li').click(function () {
        $('#btnText').text("Choose Lesson: " + $(this).find('a').text().trim());
        $.ajax({
            type: 'POST',
            url: '../../server/webServer/getStudentListServ.php',
            data: {lessonNo:$(this).find('span').text().trim()},
            success: function (data) {
                var jsonObj = eval( "(" + data + ")" );
                var content ="";
                $.each(jsonObj, function (index,obj) {
                    content += "<tr>" +
                        "<td>" + obj.id + "</td>" +
                        "<td>" + obj.name_ + "</td>" +
                        "<td>" + checkNull(obj.college) + "</td>" +
                        "<td>" + checkNull(obj._class) + "</td>" +
                        "<td>" + checkNull(obj.tel) + "</td>" +
                        "</tr>";
                });
                $("#studentTbody").html(content);
                $("#tableC2").trigger("update");
            }
        })
    });
}

function refresh_3() {
    $.ajax({
        type: 'POST',
        url: '../../server/webServer/historyDataServ.php',
        success: function (data) {
            var jsonObj = eval( "(" + data + ")" );
            var content ="";
            $.each(jsonObj, function (index,obj) {
                content += "<tr>" +
                    "<td style='display: none'>" + obj._lessonNo + "</td>" +
                    "<td>" + obj.date + "</td>" +
                    "<td>" + obj.lessonName + "</td>" +
                    "<td>" + obj.lessonPlace + "</td>" +
                    "<td>" + obj.pNum + "</td>" +
                    "<td>" + obj.aNum + "</td>" +
                    "<td><a name='getInfo' class='getInfo' data-toggle='modal' data-target='#getInfo'>Not Arrive</a></td>" +
                    "</tr>";
            });
            $("#historyTbody").html(content);
            $("#tableC3").trigger("update");
            notArrive();
        }
    });
}

function notArrive() {
    $("[name='getInfo']").click(function () {
        var lesson = $(this).parents("tr").find("td").eq(0).text().trim();
        $.ajax({
            type: 'POST',
            url: '../../server/webServer/notArriveServ.php',
            data: {lessonNo:lesson},
            success: function (data) {
                var jsonObj = eval( "(" + data + ")" );
                var content ="";
                $.each(jsonObj, function (index,obj) {
                    content += "<tr>" +
                        "<td>" + obj.id + "</td>" +
                        "<td>" + obj.name + "</td>" +
                        "</tr>";
                });
                $("#getInfoTbody").html(content);
                $("#getInfoTable").trigger("update");
            }
        });
    });
}

function checkAll(obj){
    $("input[name='followBox']").prop('checked', $(obj).prop('checked'));
}

function deleteNo() {
    $("[name='deleteBtn']").click(function () {
        lessonNo.push($(this).parents("tr").find("td").eq(1).text().trim());
        var r = confirm("Are you sure to delete this data?");
        if (r==true) {
            $.ajax({
                type: 'POST',
                url: '../../server/webServer/deleteServ.php',
                data: {lessonNo:lessonNo},
                success: function (data) {
                    if(data=="true") {
                        Messenger().post({message: 'Success', type: 'success', showCloseButton: true});
                        refreshTable();
                    }else Messenger().post({message: 'Fail', type: 'error', showCloseButton: true});
                }
            })
        }else lessonNo = [];
    });
}

function rollCall() {
    $("[name='rollCall']").click(function () {
        callLessonNo = $(this).parents("tr").find("td").eq(1).text().trim();
        minute = prompt("请设置本次签到持续时间(Min[1-60])");
        if(minute!=null){
            if(minute>=1 && minute<=60){
                $('#minute').text(fix(minute,2));          //分钟数
                $('#codeNumber').text(callLessonNo);       //签到码
                $("#erCodeImg2").attr("src","http://qr.topscan.com/api.php?text=" + callLessonNo);   //二维码
                $('#callClose').show();                    //显示关闭按钮
                if(typeof($startButton)!="undefined"){                  //复原按钮
                    $startButton.button('reset');
                }

                $.ajax({
                    type: 'POST',
                    url: '../../server/webServer/getUserInfoServ.php',
                    data: {lessonNo:callLessonNo},
                    success: function (data) {
                        var jsonObj = eval( "(" + data + ")" );
                        var content ="";
                        $.each(jsonObj, function (index,obj) {
                            content += "<div class='onceDiv'>" +
                                "<img class='userImg' src='" + obj.avatar +"'>" +
                                "<div class='nameDiv'>" + obj.name + "</div>" +
                                "</div>";
                        });
                        $(".modalLeftDiv").html(content);
                    }
                });

                $('#rollCall').modal('show');
            }else Messenger().post({message: 'Input error', type: 'error', showCloseButton: true});
        }
    });
}

function startCall() {          //开始按钮点击事件
    $('#startBtn').click(function () {
        $startButton = $('#startBtn').button('loading');
        $('#callClose').hide();         //隐藏关闭按钮
        $.ajax({
            type: 'POST',
            url: '../../server/webServer/startCallServ.php',
            data: {lessonNo:callLessonNo},
            success: function (data) {
                if(data=="false")
                    Messenger().post({message: 'Fail', type: 'error', showCloseButton: true});
            }
        });
        timesCount();
    })
}

function timesCount() {         //倒计时function
    second--;
    if(second<0){
        minute--;
        second = 59;
    }
    if(minute<0){
        finishCall();
        return;
    }
    $('#second').text(fix(second,2));
    $('#minute').text(fix(minute,2));
    getUserInfo();
    clearTime = setTimeout(timesCount,50);
}

function finishCall() {
    clearTimeout(clearTime);
    second = 0;
    $.ajax({
        type: 'POST',
        url: '../../server/webServer/finishCallServ.php',
        data: {lessonNo:callLessonNo},
        success: function (data) {
            if(!data)
                Messenger().post({message: 'Fail', type: 'error', showCloseButton: true});
        }
    });
    $('#startBtn').text("End");
    $('#callClose').show();         //显示关闭按钮
}

function getUserInfo() {
    $.ajax({
        type: 'POST',
        url: '../../server/webServer/duringCallServ.php',
        data: {lessonNo:callLessonNo},
        success: function (data) {
            var jsonObj = eval( "(" + data + ")" );
            var content ="";
            $.each(jsonObj, function (index,obj) {
                content += "<div class='onceDiv'>" +
                    "<img class='userImg' src='" + obj.avatar +"'>" +
                    "<div class='nameDiv'>" + obj.name + "</div>" +
                    "</div>";
            });
            $(".modalLeftDiv").html(content);
        }
    });
}

function fix(num, length) {
    return ('' + num).length < length ? ((new Array(length + 1)).join('0') + num).slice(-length) : '' + num;
}

function checkNull(str) {
    return str==null?"":str;
}

function transDiv() {
    $("ul#side-menu li:eq(0)").click(function(){
        $("#content1").show();
        $("#content2").hide();
        $("#content3").hide();
        refreshTable();
    });
    $("ul#side-menu li:eq(1)").click(function(){
        $("#content2").show();
        $("#content1").hide();
        $("#content3").hide();
        refresh_2();
    });
    $("ul#side-menu li:eq(2)").click(function(){
        $("#content3").show();
        $("#content1").hide();
        $("#content2").hide();
        refresh_3();
    });
}