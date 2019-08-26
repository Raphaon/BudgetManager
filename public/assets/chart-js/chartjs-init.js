( function ( $ ) {
    "use strict";



    //pie chart
    var ctx = document.getElementById( "pieChart" );
    ctx.height = 400;
    var myChart = new Chart( ctx, {
        type: 'pie',
        data: {
            datasets: [ {
                data: [ 75, 25 ],
                backgroundColor: [

                                    "rgba(0, 123, 255,0.5)",
                                    "rgba(0,0,0,0.07)"
                                ],
                hoverBackgroundColor: [

                                    "rgba(0, 123, 255,0.5)",
                                    "rgba(0,0,0,0.07)"
                                ]

                            } ],
            labels: [
                        " % Deja utilise",
                        " % Non utilise",
                    ]
        },
        options: {
            responsive: true
        }
    } );







} )( jQuery );
