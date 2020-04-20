//On récupère le lien top score
var lien_top_score = document.getElementById("menu-top-score");
//on récupère le lien best score
var lien_best_score = document.getElementById("menu-best-score");
//On récupère la div score
var div_score = document.getElementById("div-score");
//On récupère notre comment
var comment = document.getElementById("comment");


lien_top_score.addEventListener("click",function (e) {
    lien_top_score.style.color = "#8d8170";
    lien_top_score.style.backgroundColor = "white";
    lien_top_score.style.padding = "12px";
    lien_top_score.style.top = "15px";
    lien_top_score.style.left = "0px";
    lien_top_score.style.borderTopLeftRadius = "8px";
    lien_top_score.style.borderTopRightRadius  = "8px";
    comment.innerText = "Vous n'avez pas encore jouer !"
});

lien_best_score.addEventListener("click",function (e) {
    lien_best_score.style.color = "#8d8170";
    lien_best_score.style.backgroundColor = "white";
    lien_best_score.style.padding = "15px";
    lien_best_score.style.top = "15px";
    lien_best_score.style.borderTopLeftRadius = "8px";
    lien_best_score.style.borderTopRightRadius  = "8px";
    comment.innerText = "Aucun score pour le moment";
});