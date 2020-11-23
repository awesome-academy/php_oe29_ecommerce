$(document).ready(function () {
    let url = $(".url").data('url');
    $.ajax({
        url : url,
        type : "GET",
        success : function (reponse) {
            let data = JSON.parse(reponse);
            Highcharts.chart('container', {

                chart: {
                    styledMode: true
                },

                title: {
                    text: '___Order___'
                },

                xAxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                },

                series: [{
                    type: 'pie',
                    allowPointSelect: true,
                    keys: ['name', 'y', 'selected', 'sliced'],
                    data: [
                        ['Pending', data.pending, false],
                        ['Approved', data.approved, false],
                        ['Rejected', data.rejected, false],
                        ['Cancel', data.cancel, false],
                    ],
                    showInLegend: true
                }]
            });
        }
    });
});
