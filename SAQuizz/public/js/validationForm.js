
function formEmptyControl(idForm){
    //Récupération des inputs du formulaire
    var inputs = idForm.getElementsByTagName("input");
    //Evement qui permet de détecter si au moins un caractère a été saisi
        for(input of inputs){
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
        idForm.addEventListener("submit",function(e){
            var error = false;
            //Affichage du message d'erreur ce champs est obligatoire
            for(input of inputs){
                if(!input.value){
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

            if(error){//Bloquer l'envoi s'il y'a une erreur
                e.preventDefault();
            }
        })
}


//Récupération du formulaire
var formLogin = document.getElementById("form-login");
formEmptyControl(formLogin);

