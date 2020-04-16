//Récupération du menu
var menuAdmin = document.getElementById("menu-admin");
var liens = menuAdmin.getElementsByTagName("a");
var divs = menuAdmin.getElementsByTagName("div");



for( let lien of liens){

        //Au chargement de ma page
       if(lien.classList.contains("activated")){
           var divParent = lien.parentNode.parentNode;
           var divItem = divParent.querySelector('div');
           divItem.style.backgroundColor = "green";
               switch (lien.innerText) {//la value du lien
                   case "Liste Questions" :
                       clearDiv("container-accueil-corps");
                       listQuestion("container-accueil-corps");
                       break;
                   case "Créer utilisateur" :
                       clearDiv("container-accueil-corps");
                       createUser("container-accueil-corps");
                       break;
                   default : clearDiv("container-accueil-corps");
                       break;
               }
           //Passage le de l'icône inactive à active
           var type = divParent.getAttribute("categorie");
           if(type === "list"){
               var imgItem = divParent.querySelector("img");
               imgItem.src="public/source/images/icônes/ic-liste-active.png";
           }
           if(type === "create"){
               var imgItem = divParent.querySelector("img");
               imgItem.src="public/source/images/icônes/ic-ajout-active.png";
           }
       }
       lien.addEventListener("click",function(e){
           for(let lien of liens){
               //Initialisation de la couleur de l'item
               lien.parentNode.classList.remove("active");
               if(lien.classList.contains("activated")){
                   lien.classList.remove("activated");
               }
               var divItem = lien.parentNode.parentNode.querySelector('div');
               divItem.style.backgroundColor = "white";

               //Initialisation des icônes
               var type = lien.parentNode.parentNode.getAttribute("categorie");
               if(type === "list"){
                   var imgItem = lien.parentNode.parentNode.querySelector("img");
                   imgItem.src="public/source/images/icônes/ic-liste.png";
               }
               if(type === "create"){
                   var imgItem = lien.parentNode.parentNode.querySelector("img");
                   imgItem.src="public/source/images/icônes/ic-ajout.png";
               }
           }
           lien.parentNode.parentNode.querySelector("div").style.backgroundColor = "green";
           //Passage de l'item inactive en active
           e.target.parentNode.classList.add("active");
           //AFFICHAGE DES ZONES EN FONCTION DU MENU
           if( e.target.parentNode.classList.contains("active")){//si l'élément contient la class active
               switch (e.target.innerText) {//la value du lien
                   case "Liste Questions" :
                       clearDiv("container-accueil-corps");
                       listQuestion("container-accueil-corps");
                       break;
                   case "Créer utilisateur" :
                       clearDiv("container-accueil-corps");
                       createUser("container-accueil-corps");
                       break;
                   default : clearDiv("container-accueil-corps");
                       break;
               }
           }
           //Passage le de l'icône inactive à active
           var type = lien.parentNode.parentNode.getAttribute("categorie");
           if(type === "list"){
               var imgItem =lien.parentNode.parentNode.querySelector("img");
               imgItem.src="public/source/images/icônes/ic-liste-active.png";
           }
           if(type === "create"){
               var imgItem = lien.parentNode.parentNode.querySelector("img");
               imgItem.src="public/source/images/icônes/ic-ajout-active.png";
           }
        });

}
