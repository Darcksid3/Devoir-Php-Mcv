/*****************************************
 * Récupération des Elements
******************************************/
//* récupération du checkAll
const checkAll = document.getElementById("checkAll")
//* récupération de la liste des checkbox solo
const checkMulty = document.querySelectorAll(".checkMulty")

/*****************************************
 * Logique de code
******************************************/
// listener sur la checkbox checkAll
checkAll.addEventListener("change", (event) => {
    if (checkAll.checked) {
        checkMulty.forEach(checkbox => {
            checkbox.setAttribute("checked", true)
        });
    } else {
        checkMulty.forEach(checkbox => {
            checkbox.removeAttribute("checked")
        });
    }
})
// listener sur le lien de validation
deleteAll.addEventListener("click", (event) => {
    event.preventDefault()
    let checkId = []
    checkMulty.forEach(checkbox => {
        if (checkbox.checked) {
            checkId.push(checkbox.id)
        }
    });
    // Création d'un formulaire caché pour faire passé l'array a PHP
    console.log(checkId)
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '/DeleteTrajet'; // Page de destination

    // Création du champ caché pour envoyait l'array
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'checked_json';
    input.value = JSON.stringify(checkId); // Transformation du tableau en string

    // Ajout de l'input au formulaire, et du formulaire au document
    form.appendChild(input);
    document.body.appendChild(form);

    // Validation Du formulaire: envoie les données et redirige immédiatement
    form.submit();
})