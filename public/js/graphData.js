/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {

    var dataurl = "/api/interactions/list/";
    var data = [];

    $.ajax({
        url: dataurl,
        type: "GET",
        dataType: "json",
        success: onDataReceived
    });

    function onDataReceived(output) {

        for (var i = 0; i < output.length - 1; i++) {
            data[i] = {
                label: output[i].name,
                data: output[i].num_interaction
            }
        }

        $.plot('#placeholder', data, {
            series: {
                pie: {
                    show: true,
                    radius: 3 / 4,
                    label: {
                        show: true,
                        radius: 3 / 4,
                        formatter: labelFormatter,
                        background: {
                            opacity: 0.5,
                            color: '#000'
                        }
                    }
                }
            },
            legend: {
                show: false
            }
        });
    }

    function labelFormatter(label, series) {
        return "<div style='font-size:8pt; text-align:center; padding:2px; color:white;'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
    }

});

