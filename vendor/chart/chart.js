//the revenue chart
let chartRevenue = new Morris.Bar({
    element: 'morris-bar-chart',
    // data: [],
    xkey: 'Time',
    ykeys: ['LaiXuat'],
    labels: ['Lãi Xuất'],
    barColors: ['#5873FE'],
    hideHover: 'auto',
    gridLineColor: '#eef0f2',
    resize: true
});

$.getJSON('http://localhost/doan_csdl/partials/chart.php', function (data) {
    chartRevenue.setData(data);
});

$('#selTimeLine').change(function () {
    let url = $('#formChart1').data('url');
    let timeLine = $(this).val();
    $.ajax({
        url: url,
        method: "POST",
        dataType: "JSON",
        data: {timeLine:timeLine},
        success: function (data) {
            chartRevenue.setData(data);
        }
    });
});

$('.btn-chart_filter').click(function () {
    let url = $(this).parent().data('url');
    let timeFrom = $(this).prevAll("input[name='timeFrom']").val();
    let timeTo = $(this).prevAll("input[name='timeTo']").val();
    $.ajax({
        url: url,
        method: "POST",
        dataType: "JSON",
        data: {timeFrom:timeFrom, timeTo:timeTo},
        success: function (data) {
            chartRevenue.setData(data);
        },
        error: function (data) {
            alert("k thanh cong");
        }
    });
});

//the product chart
let chartProduct = new Morris.Donut({
    element: 'morris-product-chart',
    data: [{"value":"","label":""}]
    // data: [
    //   { label: "Bánh gạo kê", value: 20 },
    //   { label: "Kẹo", value: 10 },
    //   { label: "Mì", value: 5 }
    // ]
});

$.getJSON('http://localhost/doan_csdl/partials/chart_product.php', function (data) {
    chartProduct.setData(data);
});

$('#thangtruoc').click(function() {
    let url = $(this).parent().data('url');
    $.ajax({
        url: url,
        method: "POST",
        dataType: "JSON",
        data: {thangtruoc: 'thangtruoc'},
        success: function (data) {
            chartProduct.setData(data);
        },
        error: function (data) {
            alert('Error');
        }
    });
});

$('#thangnay').click(function() {
    let url = $(this).parent().data('url');
    $.ajax({
        url: url,
        method: "POST",
        dataType: "JSON",
        data: {thangnay: 'thangnay'},
        success: function (data) {
            chartProduct.setData(data);
        }
    });
});