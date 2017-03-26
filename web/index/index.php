<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mata v1.0</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../lib/css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="css/metisMenu.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <link href="css/morris.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Alert Message -->
    <link href="../others/css/messenger.css" rel="stylesheet">
    <link href="../others/css/messenger-theme-future.css" rel="stylesheet">
    <link href="../others/css/messenger-theme-air.css" rel="stylesheet">
    <!-- Own Css -->
    <link href="css/index.css" rel="stylesheet">
</head>

<body>

<div id="wrapper">
    <nav id="top" class="navbar navbar-default navbar-static-top" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Mata v1.0</a>
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <!-- Message Ico -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-alerts">
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-comment fa-fw"></i> New Comment
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                <span class="pull-right text-muted small">12 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-envelope fa-fw"></i> Message Sent
                                <span class="pull-right text-muted small">8 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a class="text-center" href="#">
                            <strong>See All Alerts</strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Personal Ico -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#"><i class="fa fa-user fa-fw"></i>
                            <?php
                                session_start();
                                $username = "";
                                if(isset($_SESSION['name'])) {
                                    $username = $_SESSION['name'];
                                    echo $username;
                                } else {
                                    header("Location:../others/alertJump.html");
                                }
                            ?></a>
                    </li>
                    <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="../login/login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>

    <!-- Left List -->
    <div class="container-fluid">
        <div class="row">
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a ><i class="fa fa-dashboard fa-fw"></i> Class Manage</a>
                        </li>
                        <li id="dropdownMenu1">
                            <a><i class="fa fa-bar-chart-o fa-fw"></i> Student Manage<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level" id="dropdownC2"><!-- js动态生成 --></ul>
                        </li>
                        <li>
                            <a ><i class="fa fa-edit fa-fw"></i> History Data</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" id="content1">
                <h1 class="sub-header">Class Manage</h1>
                <div class="table-responsive">
                    <div id="btn-group" class="btn-group" role="group" aria-label="...">
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#addLessonModal">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> AddLesson
                        </button>
                        <button type="button" id="deleteAll" class="btn btn-default">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete
                        </button>
                    </div>
                    <table class="table table-hover" id="tableClass">
                        <thead>
                            <tr>
                                <th><input type="checkbox" onclick="checkAll(this)"/></th>
                                <th>LessonNo</th>
                                <th>LessonName</th>
                                <th>BindingNum</th>
                                <th>Place</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="lessonTbody"></tbody>
                    </table>
                </div>
            </div>

            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" id="content2">
                <h1 class="sub-header">Student Manage</h1>
                <h3 id="btnText">Choose Lesson: NULL</h3>
                <div id="table2" class="table-responsive">
                    <table class="table table-hover" id="tableC2">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>College</th>
                            <th>Class</th>
                            <th>Tel.</th>
                        </tr>
                        </thead>
                        <tbody id="studentTbody"></tbody>
                    </table>
                </div>
                </div>
            </div>

            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" id="content3">
                <h1 class="sub-header">History Data</h1>
                <div class="table-responsive">
                    <div id="table3" class="table-responsive">
                        <table class="table table-hover" id="tableC3">
                            <thead>
                            <tr>
                                <th>DateTime</th>
                                <th>LessonName</th>
                                <th>LessonPlace</th>
                                <th>PersonNum</th>
                                <th>ArriveNum</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody id="historyTbody"></tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
</div>

<!-- 添加课程Modal -->
<div class="modal fade bs-example-modal-sm" id="addLessonModal" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">AddLesson</h4>
            </div>
            <div class="modal-body">
                <form id="addLessonForm" class="form-horizontal" role="form">
                    <div class="form-group">
                        <label for="modalALTeach" class="col-sm-3 control-label">TeachPerson</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="modalALTeach" name="modalALTeach" value="<?php echo $_SESSION['name'];?>" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="modalALLName" class="col-sm-3 control-label">LessonName</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="modalALLName" name="modalALLName">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="modalALLPlace" class="col-sm-3 control-label">LessonPlace</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="modalALLPlace" name="modalALLPlace">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="modalALTPerson" class="col-sm-3 control-label">TotalPerson</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control" id="modalALTPerson" name="modalALTPerson">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <input id="modalALBtn" type="button" class="btn btn-primary" value="Submit"/>
            </div>
        </div>
    </div>
</div>

<!-- 课程详细信息Modal -->
<div class="modal fade bs-example-modal-sm" id="lessonDetailsModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Lesson Details</h4>
            </div>
            <div class="modal-body">
                <form class="form-inline">
                    <div id="infoListLeft" class="form-group">
                        <p><b>Lesson No. : </b><span id="spanLNo"></span></p>
                        <p><b>Lesson Name : </b><span id="spanLName"></span></p>
                        <p><b>Binding Num : </b><span id="spanBNum"></span></p>
                        <p><b>Lesson Place : </b><span id="spanLPlace"></span></p>
                    </div>
                    <div id="infoListRight" class="form-group">
                        <img id="erCodeImg" class="erCodeImg" src=""/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- 签到Modal -->
<div class="modal fade bs-example-modal-lg" id="rollCall" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" id="callClose">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Roll Call</h4>
            </div>
            <div id="modalContent" class="modal-body">
                <div class="modalLeftDiv">
                    <!-- js动态生成 -->
                </div>
                <div class="modalRightDiv">
                    <img src="" id="erCodeImg2" class="erCodeImg2">
                    <div><h1 id="codeNumber" class="codeNumber"></h1></div>
                    <div class="timesDiv">
                        <span id="hour">00</span>:<span id="minute">00</span>:<span id="second">00</span>
                    </div>
                    <button type="button" id="startBtn" data-loading-text="Running..." class="btn btn-primary">
                        Start
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 查看详情Modal -->
<div class="modal fade bs-example-modal-sm" id="getInfo" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" id="callClose">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Not Arrive</h4>
            </div>
            <div id="modalContent" class="modal-body">
                <table class="table table-hover" id="getInfoTable">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                    </tr>
                    </thead>
                    <tbody id="getInfoTbody"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="../../lib/js/jquery-3.0.0.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="../../lib/js/bootstrap.js"></script>
<!-- Metis Menu Plugin JavaScript -->
<script src="js/metisMenu.min.js"></script>
<!-- Custom Theme JavaScript -->
<script src="js/sb-admin-2.js"></script>
<!-- Alert Message -->
<script src="../others/js/messenger.min.js"></script>
<script src="../others/js/messenger-theme-future.js"></script>
<!-- Own JsCode -->
<script src="js/index.js"></script>
</body>

</html>
