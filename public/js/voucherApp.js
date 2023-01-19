var hostServeur  = "http://localhost:8000";

function loadServices()
{
    $.ajax({
        url: hostServeur +"/getServices",
        success: function(services)
        {
            services.forEach(service => {
                $('#allServices').append("<a class='btn btn-app'> <i class='service fa fa-user-md'></i> "+ service.serviceCode +' -- '+ service.serviceAbreviation+" "+ service.serviceName + "</a>");

            });
        }
    });
    
}





$(function(){
  loadServices();

    $('#serviceFilter').on("keypress", function(){
        alert();
        $("#serviceFilter").filter( ":nth-child(2n)" ).text();
    });

});


