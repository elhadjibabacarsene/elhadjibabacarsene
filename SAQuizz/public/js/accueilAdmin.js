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
    //Récupération du container-accueil
    let containerAccueil = document.getElementById("container-accueil");
    containerAccueil.style.height = "640px";
    containerAccueil.style.marginBottom = "12px";
    //Récupération du ovelray
    let overlay = document.getElementById("color-overlay");
    overlay.style.height = "110%";
    //Récupération de la div
    let divCorps = document.getElementById($idDiv);
    divCorps.style.position  = "relative";
    divCorps.style.height = "531px";

    //Création des éléments de la zone
    //LE TITRE
    let title = document.createElement("h1");
    title.classList.add("title-create-user");
    title.innerText = "s'incrire";
    //LE SOUS-TITRE
    let p = document.createElement("p");
    p.classList.add("comment-create-user");
    p.innerText = "Pour proposer des quizz";
    //LE HR
    let hr = document.createElement("hr");
    hr.classList.add("hr-create-user");

    //CREATION DU FORMULAIRE
    let formCreateUser =  document.createElement("form");
    formCreateUser.method = "POST";
    formCreateUser.id = "form-create-user";
    //CREATION DE lA ZONE D'AFFICHAGE AVATAR
    let avatarPhoto =  document.createElement("img");
    avatarPhoto.classList.add("avatar-create-user-img");
    avatarPhoto.src = "public/source/images/avatar/ebs.jpg";

    //CREATION DE L'ATTRIBUT ERROR
    var error = document.createAttribute("error");
    error.value = "";




    //CREATION DES ELEMENTS DU FORMULAIRES ET DE LEURS PROPRIETES

    //PRENOM USER
    let lblprenom = document.createElement("label");
    lblprenom.innerText = "Prénom";
    lblprenom.classList.add('label-create-user');
    let prenomUser = document.createElement("input");
    prenomUser.type = "text";
    prenomUser.name = "prenom-user";
    prenomUser.setAttributeNode(error);
    prenomUser.setAttribute("error","error-1");
    let prenomError = document.createElement("p");
    prenomError.id = "error-1";

    //NOM USER
    let lblnom = document.createElement("label");
    lblnom.innerText = "Nom";
    lblnom.classList.add('label-create-user');
    let nomUser = document.createElement("input");
    nomUser.type = "text";
    nomUser.name = "nom-user";
    prenomUser.setAttributeNode(error);
    prenomUser.setAttribute("error","error-2");
    let nomError = document.createElement("p");
    nomError.id = "error-2";

    //LOGIN USER
    let lbllogin = document.createElement("label");
    lbllogin.innerText = "Login";
    lbllogin.classList.add('label-create-user');
    let loginUser = document.createElement("input");
    loginUser.type = "text";
    loginUser.name = "login-user";
    prenomUser.setAttributeNode(error);
    prenomUser.setAttribute("error","error-3");
    let loginError = document.createElement("p");
    loginError.id = "error-3";

    //PASSWORD USER
    let lblpassword = document.createElement("label");
    lblpassword.innerText = "Password";
    lblpassword.classList.add('label-create-user');
    let  passwordUser = document.createElement("input");
    passwordUser.type = "password";
    passwordUser.name = "password-user";
    prenomUser.setAttributeNode(error);
    prenomUser.setAttribute("error","error-3");
    let passwordError = document.createElement("p");
    passwordError.id = "error-4";

    //CONFIRM PASSWORD USER
    let lblconfirmpassword = document.createElement("label");
    lblconfirmpassword.innerText = "Confirmer password";
    lblconfirmpassword.classList.add('label-create-user');
    let confirmPasswordUser = document.createElement("input");
    confirmPasswordUser.type = "password";
    confirmPasswordUser.name = "login-user";
    let confirmPasswordError = document.createElement("p");
    confirmPasswordError.id = "error-5";

    //CHOIX DE L'AVATAR
    let  lblchoicefile = document.createElement("label");
    lblchoicefile.innerText = "Avatar";
    lblchoicefile.classList.add('avatar-create-user');

    //AFFICHAGE DE L'AVATAR
    let lblavatarAdmin = document.createElement("label");
    lblavatarAdmin.innerText = "Avatar admin";
    lblavatarAdmin.classList.add("lbl-avatar-admin");

    //CREATIONS DES BUTTONS DU FORMULAIRE
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



    //Insertion des éléments dur formulaire dans le formulaire
    formCreateUser.appendChild(lblprenom);
    formCreateUser.appendChild(prenomUser);
    formCreateUser.appendChild(prenomError);

    formCreateUser.appendChild(lblnom);
    formCreateUser.appendChild(nomUser);
    formCreateUser.appendChild(nomError);

    formCreateUser.appendChild(lbllogin);
    formCreateUser.appendChild(loginUser);
    formCreateUser.appendChild(loginError);

    formCreateUser.appendChild(lblpassword);
    formCreateUser.appendChild(passwordUser);
    formCreateUser.appendChild(passwordError);

    formCreateUser.appendChild(lblconfirmpassword);
    formCreateUser.appendChild(confirmPasswordUser);
    formCreateUser.appendChild(confirmPasswordError);

    formCreateUser.appendChild(lblchoicefile);
    formCreateUser.appendChild(submitFile);
    formCreateUser.appendChild(submitCreateUser);

    divCorps.appendChild(title);
    divCorps.appendChild(p);
    divCorps.appendChild(hr);
    divCorps.appendChild(formCreateUser);
    divCorps.appendChild(avatarPhoto);
    divCorps.appendChild(lblavatarAdmin);



}