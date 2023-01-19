class Product{

}



class ligneProduct{

}





var  prixVente = document.getElementById('sellingprice'),
     quantity = document.getElementById("quantity"), 
     discount = document.getElementById("discount"), 
     avance = document.getElementById("avance"), 
     totalAmountLigne =  document.getElementById("totalPrice"), 
     countArticle =0,
     produit = {};
     addedAricle = document.getElementById('articleTAdded');






function selectProduct(product)
{
    
    document.getElementById("ligne_article_title").innerText = product.productCode + "    --------   " + product.Designation;
    var Newligne = document.getElementById(product.productCode);
        prixVente.value =  product.sellingPrice;
        totalAmount= (quantity.value* prixVente.value);
        produit = product;
}






var btn = document.getElementById("addbtn");
btn.addEventListener("click", function(){
    addProduct(produit);
});

function addProduct(prod){

    var ligne = "<tr> <td>" +
                 (++countArticle) + 
                 "</td><td> "+
                prod.Designation +
                "</td> <td>" + quantity.value + "</td><td>" + prixVente.value  +"</td><td>" + (prixVente.value * quantity.value)  +" </td></tr>";
    addedAricle.innerHTML += ligne; 
}










$(function()
{



    function addProduct(product){

    }

});


