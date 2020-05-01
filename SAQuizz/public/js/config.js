function countTailleUserJson(nomJsonFile)
{
    let taille = 0;
    $.getJSON("data/"+nomJsonFile,function (data) {
            console.log(data.data);
    });
    return taille;
}

console.log(countTailleUserJson('utilisateur.json'));
