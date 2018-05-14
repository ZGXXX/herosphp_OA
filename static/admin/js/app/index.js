/**
 * 公共js文件
 * @author yangjian
 */
"use strict";
define(function(require, exports) {

    var common = require("common");
	require("chosen");
	require("jpreview");
	require("datepicker");

    common.initForm("#cAdd", {
	    //validate: function(validity) {
		 //   // if (validity.field.id == 'pic') {
		 //   //     alert("fuck");
			// //    // var date = validity.field.value;
			// //    // var date1 = $('#startdate').val();
			// //    // if (date1 > date) {
			//	//  //    validity.valid = false;
			// //    // }
		 //   // }
	    //
	    //},
    });

    //选项卡js
	$('#doc-my-tabs').tabs();

    //假期申请审查
    $(".item-edit").on("click", function () {
        var id = $(this).data("id");
        $.get("/admin/level/edit/?id="+id, function (res) {
            if (res.code != "000") {
                common.errorMessage(res.message);
            } else {
                common.post({
                    title : "审核假期申请",
                    tempId : "index-template",
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
