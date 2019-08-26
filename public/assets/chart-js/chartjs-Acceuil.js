
( function ( $ ) {
    "use strict";





    //pie chart annuelle
    var reste =0,
    utilise = document.getElementById("tauxAnnuel").value;
    reste = 100-utilise;
    reste = reste.toFixed(2);
    utilise = 100 -reste;
    new Chart(document.getElementById("pie-chart-annuelle"), {
        type: 'pie',
        data: {
          labels: [utilise +'%'+" Deja utilise",reste +'%'+ " Non utilise"],
          datasets: [{
            label: "Population (millions)",
            backgroundColor: ["rgba(0, 123, 255,0.5)","rgba(0,0,0,0.07)",],
            data: [utilise,reste]
          }]
        },
        options: {
          title: {
            display: true,
            text: 'Diagramme Dutilisation du budget Annuel'
          }
        }
    });
//Pie Chart mensuel
    var reste =0,
    utilise = document.getElementById("tauxmensuel").value;
    reste = 100-utilise;
    reste = reste.toFixed(2);
    utilise = 100 -reste;

    new Chart(document.getElementById("pie-chart-mensuel"), {
        type: 'pie',
        data: {
          labels: [utilise +'%'+" Deja utilise",reste +'%'+ " Non utilise"],
          datasets: [{
            label: "Population (millions)",
            backgroundColor: ["#8e5ea2","rgba(0,0,0,0.07)",],
            data: [utilise,reste]
          }]
        },
        options: {
          title: {
            display: true,
            text: 'Diagramme Dutilisation du budget mensuel'
          }
        }
    });

    //Diagramme a bande horizontal
    var tab_mois=new Array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");
    var couleurFont=new Array("#3e95cd", "#8e5ea2", "#c45850","#e8c3b9", "rgba(255,99,132,1)", "#483D8B", "#008B8B", "#A9A9A9", "#2F4F4F", "#D2691E", "#BC8F8F");
    var ladate = new Date();
    tab_mois = tab_mois.slice(0,ladate.getMonth()+1);
    var tab_data = document.getElementById('valeurDataAnnuell').value;
        tab_data = JSON.parse(tab_data);

    new Chart(document.getElementById("bar-chart-horizontal"), {
        type: 'horizontalBar',
        data: {
          labels: tab_mois,
          datasets: [
            {
              label: "Consommation en (milliers de Francs)",
              backgroundColor: couleurFont,
              data: tab_data
            }
          ]
        },
        options: {
          legend: { display: false },
          title: {
            display: true,
            text: 'Diagramme de consommation annuel par Mois'
          }
        }
    });


} )( jQuery );
