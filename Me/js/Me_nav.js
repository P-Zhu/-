/**
 * 
 * @authors Zhu Peng (rieeqms@outlook.com)
 * @date    2017-05-25 17:22:52
 * @version $Id$
 */

// Me_index.php导航处理
$("#Reset_pw,#update_info,#ANN_Record,#CLA_Record").on("click",function(){
    $.ajax({
        type: "POST",
        url: "nav_ajax.php?action="+this.id,
        dataType: "json",
        data: {},
        success: function(json) {
            if (json.success == 1) {
                $("#content").empty();
                $("#content").html(json.html);
                return true;
            } else {
                alert(json.msg);
                return false;
            }
        }
    });

});
$("#back").on("click",function(){
    location.reload();
});

$("#logout").on("click",function(){
  $.ajax({
        type: "POST",
        url: "../login/Check.php?action=logout",
        dataType: "json",
        data: {},
        success: function(json) {
            if (json.success == 1) {
                parent.window.open(json.url, '_top');
            } else {
                $(".error").html(json.msg);
                return false;
            }
        }
    });
});
