$(document).ready(function () {
    let timedown = $(".ThoiHan");
    if(parseInt(timedown.text()) <= 0) {
        timedown.parent().addClass("bg-danger");
    }
    else if (parseInt(timedown.text()) > 0 && parseInt(timedown.text()) <= 20) {
        timedown.parent().addClass("bg-warning");
    }
    else if (parseInt(timedown.text()) > 20 && parseInt(timedown.text()) <= 100) {
        timedown.parent().addClass("bg-info");
    }
    else {
        // timedown.parent().addClass("bg-light");
    }
});