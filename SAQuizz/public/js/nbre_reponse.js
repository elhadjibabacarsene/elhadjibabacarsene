/**
 *
 * @param idForm l'id du form
 * @returns {number} le nombre de champs reponse dans notre formulaire
 */
function getNbreReponse(idForm)
{
    //On récupère le formulaire
    let form = document.getElementById(idForm);
    //On récupère les inputs du formulaire
    let inputs = form.getElementsByTagName("input");
    let cpt=0;
    for(input of inputs)
    {
        //Si ob rencontre un input de type text
        if(input.type === "text")
        {
            //Si l'id de l'input de type text contient un la value "reponse[0-9]"
            if(input.id.match(/^reponse[0-9]/))
            {
                cpt++;
            }
        }
    }
    return cpt;
}