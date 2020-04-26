
function formEmptyControl(form,idsubmit){
    //Récupération des inputs du formulaire
    var inputs = form.getElementsByTagName("input");
    //Récupération du boutton
    var imgAvatar = document.getElementById("avatar-create-user-img");
    //Evement qui permet de détecter si au moins un caractère a été saisi
        for(input of inputs){
            if(input.id === idsubmit){
                var submit = input;
            }
            //On récupère l'attribut typepassword
            if(input.type === "password"){
                if(input.hasAttribute("typepassword")){
                    if(input.getAttribute("typepassword") === "password"){
                        var password = input;
                    }
                    if(input.getAttribute("typepassword") === "confirmpassword"){
                        var confirmpassword = input;
                    }
                }
            }
            input.addEventListener("keyup",function(e){
                if(e.target.hasAttribute("error")){
                    messageErrorAttribute = e.target.getAttribute("error");
                    messageError = document.getElementById(messageErrorAttribute);
                    messageError.innerText = "";
                    messageError.innerHTML = "<br>";
                }

            })
        }
    //Evenement qui permet de détecter si les champs sont saisis ou pas
        submit.addEventListener("click",function(e){
            var error = false;
            //Affichage du message d'erreur ce champs est obligatoire
            for(input of inputs){
                if(!input.value &&  !input.id.match(/^reponse[0-9]/)){
                    error = true;
                        if(input.hasAttribute("error")){
                            //Récupération de l'attribut erreur de l'input
                            messageErrorAttribute = input.getAttribute("error");
                            //Récupération de l'attribut erreur par son id
                            messageError = document.getElementById(messageErrorAttribute);
                            //Affichage de l'erreur
                            messageError.innerText = "Ce champ est obligatoire";
                        }
                }
            }
            //On affiche l'erreur si le mot de pass contient moins de caractère
            if(typeof(password) != "undefined" && password.value.length>0 && password.value.length<8){
                error = true;
                //Récupération de l'attribut erreur de l'input
                messageErrorAttribute = password.getAttribute("error");
                //Récupération de l'attribut erreur par son id
                messageError = document.getElementById(messageErrorAttribute);
                //Affichage de l'erreur
                messageError.innerText = "Le mot de pass doit contenir au moins 8 caractères";
            }
            //On affiche l'erreur si les mots de pass ne sont pas identiques
            if(typeof(confirmpassword) != "undefined" && typeof(password) != "undefined" && confirmpassword.value.length>0 && confirmpassword.value != password.value){
                error = true;
                //Récupération de l'attribut erreur de l'input
                messageErrorAttribute = confirmpassword.getAttribute("error");
                //Récupération de l'attribut erreur par son id
                messageError = document.getElementById(messageErrorAttribute);
                //Affichage de l'erreur
                messageError.innerText = "Les deux mots de pass ne sont pas identiques";
            }

            if(error){//Bloquer l'envoi s'il y'a une erreur
                e.preventDefault();
            }
        })
}



switch (id_page) {
    case "form-login" :
        //On contrôle le formulaire de connexion (login)
        var formLogin = document.getElementById('form-login');
        formEmptyControl(formLogin, "se-connecter");
        break;

    case "container-create-user" :
        //On contrôle le formulaire create user
        var formCreateUser = document.getElementById("form-create-user");
        formEmptyControl(formCreateUser, "create-user");
        break;

    case "create-question" :
        //On contrôle le formulaire create question
        var formCreateQuestion = document.getElementById("form-create-question");
        formEmptyControl(formCreateQuestion,"save_question");
        break;
}





