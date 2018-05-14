/**
 * 请假申请
 * @author zgx
 */
"use strict";
define(function(require, exports) {

    var common = require("common");

    common.initForm("#cAdd");
    //初始化 switch 控件
    common.initSwitch();
    require("chosen");
    require("jpreview");
    require("datepicker");

    //初始化 chosen 控件
    $('select[data-type="chosen"]').chosen({
        no_results_text: '木有找到匹配的项！',
        max_selected_options: 3
    });

    // 时间选择控件
    $("#start_time").datetimepicker({
        format: 'yyyy-mm-dd hh:ii',
        minView : 0,
        autoclose : true,
        todayHighlight:true
    }).on('changeDate',function(ev){
        var starttime=$("#start_time").val();
        $("#end_time").datetimepicker('setStartDate',starttime);
        $("#start_time").datetimepicker('hide');
    });

    $("#end_time").datetimepicker({
        format: 'yyyy-mm-dd hh:ii',
        minView : 0,
        autoclose : true,
        todayHighlight:true
    }).on('changeDate',function(ev){
        var endtime=$("#end_time").val();
        $("#start_time").datetimepicker('setEndDate',endtime);
        $("#end_time").datetimepicker('hide');
    });

    //时间重置
    $(".reset1").on('click',function(){
        $("#start_time").val("");
        $("#end_time").datetimepicker('setStartDate',null);
    });
    $(".reset2").on('click',function(){
        $("#end_time").val("");
        $("#start_time").datetimepicker('setStartDate',null);
    });

    //添加假期
    $("#item-add").on("click", function () {
        common.post({
            title : "添加假期",
            tempId : "level-template",
            formId : "cAdd",
            data : {
                url : "/admin/leveltype/insert",
                item : {}
            }
        });
    });

    //编辑假期
    $(".item-edit").on("click", function () {
        var id = $(this).data("id");
        $.get("/admin/level/edit/?id="+id, function (res) {
            if (res.code != "000") {
                common.errorMessage(res.message);
            } else {
                common.post({
                    title : "编辑假期",
                    tempId : "level-template",
                    formId : "cAdd",
                    data : {
                        url : "/admin/level/update",
                        item : res.item
                    }
                });
            }
        }, "json");
    });

});
