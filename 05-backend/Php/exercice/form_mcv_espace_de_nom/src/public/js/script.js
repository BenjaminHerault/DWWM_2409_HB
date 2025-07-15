document.querySelectorAll(".supprimer-utilisateur").forEach(function (lien) {
    lien.addEventListener("click", function (event) {
        if (!confirm("Supprimer cet utilisateur ?")) {
            event.preventDefault();
        }
    });
});
