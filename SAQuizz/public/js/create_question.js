//On récupère le formulaire
let form = document.getElementById("form-create-question");
//On récupère l'input type de réponse
let inputs = form.getElementsByTagName("input");
//On récupère notre select
let select_type_reponse = document.getElementById("select-type-reponse");
//On récupère la div des réponses
let div_reponses = document.getElementById("reponses");
//on récupère le button ajout réponse
let id_ajout_rep = document.getElementById("ic-ajout-rep");
//On récupère l'image de suppression
let ic_deletes = div_reponses.getElementsByTagName("img");
//on initialise l'id des réponse à 0
let id_nbre;

select_type_reponse.addEventListener("change",function(e){



    switch (e.target.value)
    {
        case "texte":
            div_reponses.innerHTML= "";
            id_ajout_rep.style.visibility = "hidden";
            //on crée l'input
            let input = document.createElement("input");
            input.type = "text";
            input.name = "reponse1";
            input.id = input.name;
            //On crée le label
            let label = document.createElement("label");
            label.innerText = "Réponse1";
            //On crée la nouvelle div
            let new_div = document.createElement("div");
            new_div.id = input.id;
            new_div.classList.add("reponse-div");
            //On attache nos élements
            new_div.appendChild(label);
            new_div.appendChild(input);
            //On place la div dans div reponse
            div_reponses.appendChild(new_div);
            break;

        case "choixSimple":
            div_reponses.innerHTML= "";
            //On fait apparaitre le button add reponse
            id_nbre = 0;
            id_ajout_rep.style.visibility = "visible";
            //On gére la génération automatique des champs
            id_ajout_rep.removeEventListener("click",multiple);
            id_ajout_rep.addEventListener("click",simple);

            break;

        case "choixMultiple" :
            div_reponses.innerHTML= "";
            //On vide la div des réponses
            id_nbre = 0;
            //On fait apparaitre le button add reponse
            id_ajout_rep.style.visibility = "visible";
            //On gére la génération automatique des champs
            id_ajout_rep.removeEventListener("click",simple);
            id_ajout_rep.addEventListener("click",multiple);
            break;


    }
});



function multiple()
{
    //Id du row (reponse[1...])
    let id_row = "reponse" + (id_nbre++);
    //On crée la nouvelle div
    let new_div = document.createElement("div");
    new_div.id = id_row ;
    new_div.classList.add("reponse-div");
    //On crée un nouveau label
    let new_label = document.createElement("label");
    new_label.innerText = "Réponse " + id_nbre ;
    //on crée l'input
    let input = document.createElement("input");
    input.type = "text";
    input.name = id_row;
    input.id = id_row;
    //On crée le checkbox de la réponse
    let checkbox = document.createElement("input");
    checkbox.type = "checkbox";
    checkbox.name = "checkreponse[]";
    checkbox.value = id_row;
    //On crée l'icone delete de la réponse
    let img = document.createElement("img");
    img.src = "public/source/images/icones/ic-supprimer.png";
    img.id = "ic-delete";
    img.setAttribute("reponse",id_row);

    //On place les éléments dans la div
    new_div.appendChild(new_label);
    new_div.appendChild(input);
    new_div.appendChild(checkbox);
    new_div.appendChild(img);

    div_reponses.appendChild(new_div);

    deleteInput(id_row);
}

function simple()
{
    //Id du row (reponse[1...])
    let id_row = "reponse" + (id_nbre++);
    //On crée la nouvelle div
    let new_div = document.createElement("div");
    new_div.id = id_row ;
    new_div.classList.add("reponse-div");
    //On crée un nouveau label
    let new_label = document.createElement("label");
    new_label.innerText = "Réponse " + id_nbre ;
    //on crée l'input
    let input = document.createElement("input");
    input.type = "text";
    input.name = id_row;
    input.id = id_row;
    //On crée le radio de la réponse
    let radio = document.createElement("input");
    radio.type = "radio";
    radio.name = "radio-reponse";
    radio.value = id_row;
    //On crée l'icone delete de la réponse
    let img = document.createElement("img");
    img.src = "public/source/images/icones/ic-supprimer.png";
    img.id = "ic-delete";
    img.setAttribute("reponse", id_row);

    //On place les éléments dans la div
    new_div.appendChild(new_label);
    new_div.appendChild(input);
    new_div.appendChild(radio);
    new_div.appendChild(img);

    div_reponses.appendChild(new_div);

    deleteInput(id_row);

}


function deleteInput(id_row)
{
    let divs_rep = div_reponses.getElementsByTagName("div");
    for(let div of divs_rep){
        let img = div.getElementsByTagName("img");
        img[0].addEventListener("click",function(e){
                div.remove();
        });
    }
}
