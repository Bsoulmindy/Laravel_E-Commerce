function getCookie(cname) 
{
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
}

function delete_cookie( name, path, domain ) {
    if( getCookie( name ) ) {
      document.cookie = name + "=" +
        ((path) ? ";path="+path:"")+
        ((domain)?";domain="+domain:"") +
        ";expires=Thu, 01 Jan 1970 00:00:01 GMT";
    }
}
function Incrementer(nomArticle) 
{
    let NodeStock = document.getElementById(nomArticle + "Stock");
    //Traitement du cookie
    if (getCookie(nomArticle) == "") // Introuvable = 0
    {
        if(NodeStock.textContent != "0")
        {
            document.cookie = nomArticle + "=1" + ";path=/";
        }
    }
    else
    {
        if (getCookie(nomArticle) != NodeStock.textContent)
        {
            document.cookie = nomArticle + "=" + String(parseInt(getCookie(nomArticle)) + 1) + ";path=/";
        }
    }
    //Affichage de résultat
    let NodeValeur = document.getElementById(nomArticle);
    if (getCookie(nomArticle) == "") // Introuvable = 0
    {
        var valeur = document.createTextNode("0");
    }
    else
    {
        var valeur = document.createTextNode(getCookie(nomArticle));
    }
    NodeValeur.removeChild(NodeValeur.firstChild);
    NodeValeur.appendChild(valeur);
}
function Decrementer(nomArticle)
{
    if (getCookie(nomArticle) == "" || getCookie(nomArticle) == "0") // Introuvable = 0
    {
        document.cookie = nomArticle + "=0"  + ";path=/";
    }
    else
    {
        document.cookie = nomArticle + "=" + String(parseInt(getCookie(nomArticle)) - 1) + ";path=/";
    }
    let NodeValeur = document.getElementById(nomArticle);
    if (getCookie(nomArticle) == "") // Introuvable = 0
    {
        var valeur = document.createTextNode("0");
    }
    else
    {
        var valeur = document.createTextNode(getCookie(nomArticle));
        if(getCookie(nomArticle) == "0")
        {
            delete_cookie(nomArticle, '/');
        }
    }
    NodeValeur.removeChild(NodeValeur.firstChild);
    NodeValeur.appendChild(valeur);
}

//Fill the page with the nb of products selected
const NodesProducts = document.querySelectorAll("span.nb-products-in-cart");
for(let i=0; i < NodesProducts.length; i++)
{
    let nb = getCookie(NodesProducts[i].id);
    if (nb == "") nb = "0";
    let newNode = document.createTextNode(nb);
    NodesProducts[i].appendChild(newNode);
}