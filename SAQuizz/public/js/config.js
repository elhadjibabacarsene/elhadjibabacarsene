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