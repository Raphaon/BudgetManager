

$(document).ready(function(){
    $('#dataTables').DataTable();
    // show modal  form to add
    $(document).on('click','.create-modal',function(){
        $("#create").modal('show');
        $(".form-horizontal").show();
        $(".modal-title").text('Ajouter une agence');
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

function editAg(codeAg , nomAg, regionAg, typeAg)
{
    document.getElementById("edition-codeAg").value =""+ codeAg;
    document.getElementById("edition-nomAg").value = nomAg;
   var  region =  document.getElementById("edition-regionAg"),
        typeag1 = document.getElementById("edition-typeAg");
   region.options[region.selectedIndex].innerHTML =regionAg ;
   typeag1.options[typeag1.selectedIndex].innerHTML =typeAg ;
}
//showing data detail
function showAg(codeAg , nomAg, regionAg, typeAg)
{
    document.getElementById("show-codeAg").innerHTML =""+ codeAg;
    document.getElementById("show-nomAg").innerHTML = nomAg;
    document.getElementById("show-regionAg").innerHTML = regionAg;
    document.getElementById("show-typeAg").innerHTML = typeAg;
    document.getElementById("#delete-form-msg").style.display ="none";
    document.getElementById("#delete-confirm-msg").style.display ="inline-block";
}

function showAg(codeAg , nomAg, regionAg, typeAg)
{
    document.getElementById("show-codeAg").innerHTML =""+ codeAg;
    document.getElementById("show-nomAg").innerHTML = nomAg;
    document.getElementById("show-regionAg").innerHTML = regionAg;
    document.getElementById("show-typeAg").innerHTML = typeAg;

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


        var code = $('#codeAg').val(),
            nom = $('#nomAg').val(),
            region = $("#regionAg option:selected").text(),
            typea = $("#typeAg option:selected").text();

        if(code =="" || nom ==""|| region=="" || typea=="")
        {
            $("#msgform1").html('<p class="alert alert-danger" style="text-align:center;"><span class="glyphicon glyphicon-warning-sign" ></span> Veuillez renseigner tous les champs</p>');
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
              url:"/addBranch",
              data:{
                  '_token':$('input[name=_token]').val(),
                  codeAg:code,
                  nomAg : nom,
                  regionAg:region,
                  typeAg:typea
                  },
              success:function(data)
              {
                  $('#nomAg').val("");
                  $('#codeAg').val("");
                  $("#msgform1").html('<p class="alert alert-success" style="text-align:center"> <span class="glyphicon glyphicon-check" ></span>Enregistrement reussi !!! </p>');
                  $("#msgform1").show();
                  $("#imgload").hide();
              },
              error: function (data) {

                $("#msgform1").show();
              }
          });
        }

    });
// edit data


$(document).ready(function() {
    $('#edit-ag').on('click', function (e) {
        var code = $('#edition-codeAg').val(),
        nom = $('#edition-nomAg').val(),
        region = $("#edition-regionAg option:selected").text(),
        typea = $("#edition-typeAg option:selected").text();
        if(code =="" || nom ==""|| region=="" || typea=="")
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
                url:"/updateBranch",
                data:{
                    '_token':$('input[name=_token]').val(),
                    codeAg:code,
                    nomAg : nom,
                    regionAg:region,
                    typeAg:typea
                    },
                success:function(data)
                {
                    $('#nomAg').val("");
                    $('#codeAg').val("");
                    $("#form-edit-msg").html('<p class="alert alert-success" style="text-align:center"> <span class="glyphicon glyphicon-check" ></span>Modification reussi avec success </p>');
                    $("#form-edit-msg").show();
                    $("#edit-imgload").hide();
                    console.log(data);
                },
                error: function (data) {

                  $("#msgform1").show();
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






