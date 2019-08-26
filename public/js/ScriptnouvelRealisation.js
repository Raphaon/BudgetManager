$(document).ready(function()
{
    $('#rubrique_rea').on('click change keyup', function (e)
    {
        codePost  = this.value;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        e.preventDefault();
        $.ajax({
            type:"POST",
            dataTytpe :"json",
            url:"/realisation/store",
            data:{
                '_token':$('input[name=_token]').val(),
                'codePost':codePost
                },

            success:function(data)
            {

                console.log(data);
                numCompte = data[0][0]['numCompte'];
                libelle  =data[0][0]['intitulePost'];
                sens = data[0]['sensPost'];
                previAnnuel = data[2];
                realAnnuel =data[1];
                var tauxAnnuel = data[3];
                previmen = data[4];
                reaMens = data[5];
                tauxMens = data[6];
                EcartAnnuel = data[7];
                EcartMens = data[8];
                tA  = data[9];
                tM  = data[10];
                Em = data[11];

                if(tA>100)
                {
                    tA = 100;
                    $("#progressAnnuel").addClass("progress-bar-danger")
                }
                if(tM>100)
                {
                    tM = 100;
                    $("#progressMens").addClass("progress-bar-danger");
                }
                $("#realisationMensuelHidden").val(data[12]);
                $("#progressAnnuel").width(tA+"%");
                $("#progressAnnuel").html(tauxAnnuel+"%");
                $("#progressMens").width(tM+"%");
                $("#progressMens").html(tauxMens+"%");
                $("#codePostBud").html(numCompte+' -- '+libelle);
                $("#PreviAnnuel").html(previAnnuel);
                $("#ReaAnnuel").html(realAnnuel);
                $("#EcartAnnuel").html(EcartAnnuel);
                $("#tauxAnnuel").html(tauxAnnuel+"%");
                $("#previMens").html(previmen);
                $("#reaMens").html(reaMens);
                $("#EcartMens").html(EcartMens);
                $("#montantReliquat").val(Em);
                $("#EcartMensuelHidden").val(Em);
                $("#tauxMens").html(tauxMens +"%");


                console.log(data);
            },
            error: function (data) {
                //console.log(data);
                $("#codePostBud").html(data);
            }
        });
    });


    $('#PrintPrevalidation').on('click', function (e)
    {

      //$("#formrea").attr('action',"realisation/PreValidation");
      //$("#formrea").submit();
        codePost  = $('#rubrique_rea').val();
        montantSortie = $("#montant_rea").val();
        autoriseBy = $("#employe_effectuer_rea").val();
        doneBy = $("#employe_autorise_rea").val();
        observation = $("#observation_rea").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        e.preventDefault();
        $.ajax({
            type:"POST",
            dataTytpe :"json",
            url:"/realisation/preValidation",
            data:{
                '_token':$('input[name=_token]').val(),
                'codePost':codePost,
                'montantSortie':montantSortie,
                'autoriseBy': autoriseBy,
                'doneBy': doneBy,
                'observation':observation
                },

            success:function(data)
            {
               window.open("preValidation");
                console.log(data);

            },
            error: function (data) {
                console.log(data);
                $("#codePostBud").html(data);
            }
        });

    });





    $('#montant_rea').on('click change keyup',function (e)
    {
        montantSortie = $('#montant_rea').val();
        EcartMensuF = $("#EcartMensuelHidden").val();
        $realisationMensu = $("#realisationMensuelHidden").val();
        $realisationMensu  = parseFloat($realisationMensu) + parseFloat(montantSortie) ;

        if(montantSortie=="")
        {
            realisaMensueapresSortie =
            $("#montantReliquat").val(EcartMensuF);
            $("#montantnvleRealisation").val($realisationMensu);

        }
        reliq = parseFloat(EcartMensuF - montantSortie);
        if(isNaN(reliq))
        {
            reliq =EcartMensuF;

        }
        $("#montantReliquat").val(reliq);
        if(reliq <0)
        {
            $('#danger-alert-rea').show();
            $('#warning-alert-rea').hide();
            $("#montantnvleRealisation").val($realisationMensu);
        }
        if(reliq>0)
        {
            $('#danger-alert-rea').hide();
        }
        if((reliq < EcartMensuF/2) && (reliq >0))
        {
            $("#montantnvleRealisation").val("0");
            $('#danger-alert-rea').hide();
            $('#warning-alert-rea').show();
            $("#montantnvleRealisation").val($realisationMensu);
        }else
        {
            $("#montantnvleRealisation").val("0");
            $('#warning-alert-rea').hide();
            $("#montantnvleRealisation").val($realisationMensu);
        }

    } );


});
