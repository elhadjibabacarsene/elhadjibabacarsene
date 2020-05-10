//On récupère la div-top-score
let div_top_score = document.getElementById("div-top-score");
//On récupère la div-best-score
let div_best_score = document.getElementById("div-best-score");

//On récupère l'id (général) div score
let div_score  = document.getElementById("div-score");

//On récupère le first child (div-id du menu)
let all_childreen_div = div_score.getElementsByTagName("div");

if(document.getElementById("top-score"))
{
    //On applique un fond blanc au background de la div du top-score
    div_top_score.style.backgroundColor = "white";
    //On applique un dfond transparent au background de la div best-score
    div_best_score.style.backgroundColor = "Transparent";
}
if(document.getElementById("best-score"))
{
    //On applique un fond blanc au background de la div du top-score
    div_best_score.style.backgroundColor = "white";
    //On applique un dfond transparent au background de la div best-score
    div_top_score.style.backgroundColor = "Transparent";
}


