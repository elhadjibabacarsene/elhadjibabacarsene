//On récupère le container général
let container = document.getElementById("container");
//On récupère le container de la page concernée
let div_page = container.getElementsByTagName("div")[0];
//On récupère l'ID de la page en se basant sur l'id du container de la page concernée
let id_page = div_page.id;
//On récupère notre menu
let menu = document.getElementById("menu-admin");

function activeMenu(idDivItem,nomIcone){
    //Récupération de la div qui concerne l'option du menu
    var div_item = document.getElementById(idDivItem);
    //On récupère l'étiquette et on l'affecte une couleur verte
    var etiquette = div_item.getElementsByTagName("div");
    etiquette[0].style.backgroundColor = "green";
    //On récupère le li concerné et on l'affecte la classe active
    var li =  div_item.getElementsByTagName("li");
    li[0].classList.add("active");
    //On récupère l'icône
    var icone = div_item.getElementsByTagName("img");
    icone[0].src = "public/source/images/icônes/" + nomIcone;
}




    switch (id_page)
    {
        case "container-accueil" :
            activeMenu("ic-1","ic-liste-active.png");
         break;

        case "container-create-user" :
            activeMenu("ic-2","ic-ajout-active.png");
        break;

        case "liste-joueurs":
            activeMenu("ic-3","ic-liste-active.png");
        break;

        case "create-question":
            activeMenu("ic-4", "ic-ajout-active.png");
        break;
    }


