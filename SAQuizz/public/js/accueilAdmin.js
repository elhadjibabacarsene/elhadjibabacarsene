function clearDiv($idDiv){
    let div = document.getElementById($idDiv);
    div.innerHTML = '';
}

/**
 *
 * @param $idDiv le div pour l'affichage
 */
function listQuestion($idDiv){
    //Récupération de la div corps-question
    let divCorps = document.getElementById($idDiv);
//Création des divs
    let divNbreQuestion = document.createElement("div");
    let divListQuestion = document.createElement("div");
    let divSuivant = document.createElement("div");


//ZONE NOMBRE DE QUESTIONS
//Création des formulaires
    //form nbreQuestions
    let form = document.createElement("form");
    form.action = "";
    form.method = "POST";
    //form nextPage
    let formnext = document.createElement("form");
    formnext.action = "";
    formnext.method = "POST";

//Création des éléments du formulaire nbreQuestions et de leurs propriétés
    let labelNbreQuestion = document.createElement("label");
    labelNbreQuestion.innerText = "Nbre de questions/jeux";
    let inputNbreQuestion = document.createElement("input");
    inputNbreQuestion.type = "text";
    let inputSubmit = document.createElement("input");
    inputSubmit.type = "submit";
    inputSubmit.value = "OK";
//Création des éléments du formulaire nextPage et leurs prorpiétés
    let inputNext = document.createElement("input");
    inputNext.type = "submit";
    inputNext.value = "Suivant";

//Insertion dans éléments dans le formulaire nbreQuestions
    form.appendChild(labelNbreQuestion);
    form.appendChild(inputNbreQuestion);
    form.appendChild(inputSubmit);
//Insertion des éléments dans le formulaire nextPage
    formnext.appendChild(inputNext);

//Insertion du formulaire nbreQuestion dans le divNbreQuestion
    divNbreQuestion.appendChild(form);
//Insertion du formulaire nextPage dans le divSuivant
    divSuivant.appendChild(formnext);

//ajout des class aux différents zones
    divNbreQuestion.classList.add("accueil-nbre-question");
    divListQuestion.classList.add("accueil-list-question");
    divSuivant.classList.add("accueil-question-next");

//Insertion dans le document
    divCorps.appendChild(divNbreQuestion);
    divCorps.appendChild(divListQuestion);
    divCorps.appendChild(divSuivant);
}


function createUser($idDiv){
    //Récupération de la div
    let divCorps = document.getElementById($idDiv);
    divCorps.style.position  = "relative";
    //Création des éléments de la zone
    let title = document.createElement("h1");
    let p = document.createElement("p");
    let hr = document.createElement("hr");
    hr.classList.add("hr-create-user");
    let formCreateUser =  document.createElement("form");
    formCreateUser.method = "POST";
    formCreateUser.classList.add("form-create-user");
    let avatarPhoto =  document.createElement("img");
    avatarPhoto.classList.add("avatar-create-user-img");
    avatarPhoto.src = "public/source/images/avatar/ebs.jpg";

    //Affection de propriétés
    title.classList.add("title-create-user");
    title.innerText = "s'incrire";
    p.classList.add("comment-create-user");

    //Création des éléments du formulaire et de leurs proriétés
    let prenomUser = document.createElement("input");
    prenomUser.type = "text";
    prenomUser.name = "prenom-user";
    let nomUser = document.createElement("input");
    nomUser.type = "text";
    nomUser.name = "nom-user";
    let loginUser = document.createElement("input");
    loginUser.type = "text";
    loginUser.name = "login-user";
    let  passwordUser = document.createElement("input");
    passwordUser.type = "text";
    passwordUser.name = "password-user";
    let confirmPasswordUser = document.createElement("input");
    confirmPasswordUser.type = "text";
    confirmPasswordUser.name = "login-user";
    let lblprenom = document.createElement("label");
    let lblnom = document.createElement("label");
    let lbllogin = document.createElement("label");
    let lblpassword = document.createElement("label");
    let lblconfirmpassword = document.createElement("label");
    let  lblchoicefile = document.createElement("label");
    lblchoicefile.innerText = "Avatar";
    lblchoicefile.classList.add('avatar-create-user');
    let lblavatarAdmin = document.createElement("label");
    lblavatarAdmin.innerText = "Avatar admin";
    lblavatarAdmin.classList.add("lbl-avatar-admin");
    //Boutons submit
    let submitFile = document.createElement("input");
    submitFile.type = "submit";
    submitFile.name = "choice-file";
    submitFile.value = "Choisir un fichier";
    submitFile.id = "choice-file";
    let submitCreateUser = document.createElement("input");
    submitCreateUser.type = "submit";
    submitCreateUser.name = "create-user";
    submitCreateUser.value = "Créer un compte";
    submitCreateUser.id = "create-user";

    //labels
    lblprenom.innerText = "Prénom";
    lblprenom.classList.add('label-create-user');
    lblnom.innerText = "Nom";
    lblnom.classList.add('label-create-user');
    lbllogin.innerText = "Login";
    lbllogin.classList.add('label-create-user');
    lblpassword.innerText = "Password";
    lblpassword.classList.add('label-create-user');
    lblconfirmpassword.innerText = "Confirmer password";
    lblconfirmpassword.classList.add('label-create-user');




    //Insertion des éléments dur formulaire dans le formulaire
    formCreateUser.appendChild(lblprenom);
    formCreateUser.appendChild(prenomUser);
    formCreateUser.appendChild(lblnom);
    formCreateUser.appendChild(nomUser);
    formCreateUser.appendChild(lbllogin);
    formCreateUser.appendChild(loginUser);
    formCreateUser.appendChild(lblpassword);
    formCreateUser.appendChild(passwordUser);
    formCreateUser.appendChild(lblconfirmpassword);
    formCreateUser.appendChild(confirmPasswordUser);
    formCreateUser.appendChild(lblchoicefile);
    formCreateUser.appendChild(submitFile);
    formCreateUser.appendChild(submitCreateUser);

    //Contenu des textes
    p.innerText = "Pour proposer des quizz";

    divCorps.appendChild(title);
    divCorps.appendChild(p);
    divCorps.appendChild(hr);
    divCorps.appendChild(formCreateUser);
    divCorps.appendChild(avatarPhoto);
    divCorps.appendChild(lblavatarAdmin)
}