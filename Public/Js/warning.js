/**
 * 
 * @authors Zhu Peng (rieeqms@outlook.com)
 * @date    2017-05-27 08:33:30
 * @version $Id$
 */
function checkNewWarning() {
    if ($("#NewWarning").text() != '0') {
        $("#NewWarning").toggleClass("btn_hidden");
    }
}



function AddNewWarning() {
    var n = $("#NewWarning").text();
    $("#NewWarning").text(parseInt(n) + 1);
    checkNewWarning();
}
