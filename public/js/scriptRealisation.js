
$(document).ready(function() {
    $('#btn_submit_form_realisation').on('click', function (e) {

        var code = $('#intitulecat').val();
        if(code =="")
        {
            $("#msgform1").html('<p class="alert alert-danger" style="text-align:center;"><span class="glyphicon glyphicon-warning-sign" ></span> Veuillez renseigner le champs obligatoire </p>');
            $("#msgform1").show();
        }else
        {

            $("imgload").show();
            $("#msgform1").hide();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
             e.preventDefault();
          $.ajax({
              type:"POST",
              dataTytpe :"json",
              url:"/realisation/new",
              data:{
                  '_token':$('input[name=_token]').val(),
                  intituleCat:code
                },

              success:function(data)
              {

                  $('#intituleCat').val("");
                  $("#msgform1").html('<p class="alert alert-success" style="text-align:center"> <span class="glyphicon glyphicon-check" ></span>Enregistrement reussi !!! </p>');
                  $("#msgform1").show();
                  $("#imgload").hide();
                  console.log(data);
              },
              error: function (data) {
                console.log(data);
                $("#msgform1").show(data);
                $("#msgform1").show();
              }
          });
        }

    });
});
