var  prixVente = document.getElementById('sellingprice'),
     quantity = document.getElementById("quantity");
function addProduct(product)
{
    document.getElementById("ligne_article_title").innerText = product.productCode + " --- " + product.Designation;


    var Newligne = document.getElementById(product.productCode),

        prixVente.value =  product.sellingPrice;
        totalAmount= (quantity.value* prixVente.value);
        alert(totalAmount);

}



$(function()
{



    function addProduct(product){

    }

});


