/**
 * permet de demander la confirmation de l'utilisateur pour la déconnexion
 * @param id_button identifiant du button déconnexion
 */
function messageDeconnexion(id_button)
{
    let buttons = document.getElementsByName(id_button);
    buttons[0].addEventListener("click",function(e){
        if(!confirm("Cliquer sur OK pour confirmer votre déconnexion !"))
        {
            e.preventDefault();
        }
    });
}

messageDeconnexion("deconnexion");


/**
 * fonction qui permet de vérifier si un nombre est un entier ou pas
 * @param value
 * @returns {boolean}
 */
function is_int(value)
{
    $st=true;
    if(value.match(/\./))
    {
        $st=false
    }else{
        $st=true;
    }

    return $st;
}