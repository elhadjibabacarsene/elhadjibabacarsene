//On récupère l'input du nombre de question
var nbre_question = document.getElementById("nbre-question");
//On récupère le bouton submit
var submit_nbre_question = document.getElementById("submit-nbre-question");

submit_nbre_question.addEventListener("click",function(e){
    //Si lez champ est vide
    if(nbre_question.value === "")
    {
        //On bloque l'action submit
        e.preventDefault();
        //On affiche le message d'erreur
        alert("Veuillez préciser le nombre de questions par jeux !");
    }
    //Si le champ contient une valeur non numérique
    if(isNaN(nbre_question.value))
    {
        //On bloque l'action submit
        e.preventDefault();
        //On affiche le message d'erreur
        alert("Le nombre de question par jeux doit être en numérique !");
    }
    //Si le nombre n'est pas un entier
    if(!is_int(nbre_question.value))
    {
        //On bloque l'action submit
        e.preventDefault();
        //On affiche le message d'erreur
        alert("Le nombre de question par jeux doit être en entier !");
    }
});