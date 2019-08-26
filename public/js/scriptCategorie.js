

$(document).ready(function(){
    $('#dataTables').DataTable();
    // show modal  form to add
    $(document).on('click','.create-modal',function(){
        $("#create").modal('show');
        $(".form-horizontal").show();
        $(".modal-title").text('Ajouter une categorie');
    });


    //show information in modal



    $(document).on('click','.show-modal',function(){
        $("#show").modal('show');
        $(".modal-title").text('Detail agence');
    });



    // show edit form
    $(document).on('click','.edit-modal',function(){
        $("#edit").modal('show');
        $(".modal-title").text("Edition d'une agence");

    });
    // show delete message confirmation
    $(document).on('click','.delete-modal',function(){
        $("#deletecontent").modal('show');
        $(".modal-title").text("Confirmation de la suppression ");
        $.ajax()
    });



});
//showing data for edition

function editCat(codeCat , intituleCat)
{
    document.getElementById("edition-codeCat").value = codeCat;
    document.getElementById("edition-intituleCat").value = intituleCat;
}
//showing data detail
function showCat(codecat , intituleCat)
{
    document.getElementById("show-codeCat").innerHTML = codecat;
    document.getElementById("show-nomCat").innerHTML = intituleCat;
}



function deleteAg(codeAg , nomAg, regionAg, typeAg)
{
    document.getElementById("delete-codeAg").value =""+ codeAg;
    document.getElementById("delete-nomAg").value = nomAg;
    document.getElementById("delete-regionAg").value = regionAg;
    document.getElementById("delete-typeAg").value = typeAg;
    document.getElementById("delete-confirm-msg").style.display='inline-block';
    document.getElementById("delete-confirm-msg").style.textalign='center';
    document.getElementById("delete-form-msg").style.display='none';
    document.getElementById("deleteAg").style.display='inline-block';
}


$(document).ready(function() {
    $('#add-ag').on('click', function (e) {

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
              url:"/addCategorie",
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
// edit data


$(document).ready(function() {
    $('#edit-cat').on('click', function (e) {
        var code = $('#edition-codeCat').val(),
            intitule = $('#edition-intituleCat').val();
        if(code =="" || intitule=="")
        {

            $("#form-edit-msg").html('<p class="alert alert-danger" style="text-align:center;"><span class="glyphicon glyphicon-warning-sign" ></span> Veuillez correctement renseigner tous les champs !!!</p>');
            $("#form-edit-msg").show();
            $("#edit-imgload").hide();
        }else
        {
            $("#edit-imgload").show();
            $("#form-edit-msg").hide();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            e.preventDefault();
            $.ajax({
                type:"POST",
                dataTytpe :"json",
                url:"/updateCategorie",
                data:{
                    '_token':$('input[name=_token]').val(),
                    codeCat:code,
                    intituleCat : intitule
                    },
                success:function(data)
                {
                    $('#edition-codeCat').val("");
                    $('#edition-intituleCat').val("");
                    $("#form-edit-msg").html('<p class="alert alert-success" style="text-align:center"> <span class="glyphicon glyphicon-check" ></span>Modification reussi avec success </p>');
                    $("#form-edit-msg").show();
                    $("#edit-imgload").hide();
                    console.log(data);
                },
                error: function (data) {

                  $("#msgform1").show();
                  console.log(data)
                }
            });


        }
    });
});


//delete data

$(document).ready(function() {
    $('#deleteAg').on('click', function (e) {
        var code = $('#delete-codeAg').val(),
        nom = $('#delete-nomAg').val(),
        region = $('#delete-regionAg').val(),
        typea =$('#delete-typeAg').val();

        if(code =="" || nom ==""|| region=="" || typea=="")
        {
           alert("Veuillez selectionner un champs valide !!!");

        }else
        {
            $("#delete-imgload").show();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            e.preventDefault();
            $.ajax({
                type:"POST",
                dataTytpe :"json",
                url:"/deleteBranch",
                data:{
                    '_token':$('input[name=_token]').val(),
                    codeAg:code,
                    nomAg : nom,
                    regionAg:region,
                    typeAg:typea
                    },
                success:function(data)
                {
                    $('#delete-nomAg').val("");
                    $('#delete-codeAg').val("");
                    $("#delete-form-msg").html('<p class="alert alert-success" style="text-align:center"> <span class="glyphicon glyphicon-check" ></span>Suppression reussi !</p>');
                    $("#delete-form-msg").show();
                    $("#delete-imgload").hide();
                    $("#delete-confirm-msg").hide();
                    $("#btn-delete-close-modal").html("<span class='glyphicon glyphicon-remove'></span> Close");
                    $("#deleteAg").hide();
                    console.log(data);
                },
                error: function (data) {

                  $("#delete-form-msg").show();
                }
            });


        }
    });
});










});






