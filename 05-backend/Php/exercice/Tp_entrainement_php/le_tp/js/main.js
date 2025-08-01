document.addEventListener("DOMContentLoaded", function () {
    const printBtn = document.getElementById("printBtn");
    printBtn.addEventListener("click", function () {
        window.print();
    });
});

const selectAllCheckbox = document.getElementById("selectAll");
const typeCheckboxes = document.querySelectorAll(".type-checkbox");

if (selectAllCheckbox && typeCheckboxes.length > 0) {
    // Fonction pour cocher/décocher toutes les checkboxes
    selectAllCheckbox.addEventListener("change", function () {
        typeCheckboxes.forEach((checkbox) => {
            checkbox.checked = this.checked;
        });
    });

    // Fonction pour décocher "Sélectionner tout" si une checkbox est décochée
    typeCheckboxes.forEach((checkbox) => {
        checkbox.addEventListener("change", function () {
            if (!this.checked) {
                selectAllCheckbox.checked = false;
            } else {
                // Vérifier si toutes les checkboxes sont cochées
                const allChecked = Array.from(typeCheckboxes).every(
                    (cb) => cb.checked
                );
                selectAllCheckbox.checked = allChecked;
            }
        });
    });

    // Vérifier l'état initial au chargement de la page
    const allChecked = Array.from(typeCheckboxes).every((cb) => cb.checked);
    selectAllCheckbox.checked = allChecked && typeCheckboxes.length > 0;
}
