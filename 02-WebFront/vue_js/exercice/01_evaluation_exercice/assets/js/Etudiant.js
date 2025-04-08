export class Etudiant
{ 
    constructor(_fullname, _grade) {
        this.fullname = _fullname;
        this.grade = _grade;

        if (!this.fullname || this.grade === null || this.grade < 0 || this.grade > 20 ) {
            throw new Error("Veuillez entrer un nom complet");
        }

        const [prenom, ...nom] = this.fullname.split(" ");
        // Vérification des longueurs minimales

        
        if (!prenom || prenom.length < 2 || nom.join(" ").length <2  ) {
            throw new Error("Le prénom et le nom doivent contenir au moins 2 lettres chacun.");
        }

         // Vérification du format du nom complet pour accepter les lettres et les lettre accentuées
         const regexFullname = /^[A-Za-zÀ-ÖØ-öø-ÿ]+(?: [A-Za-zÀ-ÖØ-öø-ÿ]+)+$/;
         if(!regexFullname.test(this.fullname)) {
             throw new Error("Seulement des lettres.");
         }

        // Formater le prénom et le nom (majuscule pour la première lettre, minuscules pour le reste)
        this.prenom = prenom.charAt(0).toUpperCase() + prenom.slice(1).toLowerCase();

        this.nom = nom.map(n => n.charAt(0).toUpperCase() + n.slice(1).toLowerCase()).join(" ");
        
        this.fullname = `${this.prenom} ${this.nom}`;

        this.obtenu = this.grade >= 12 ? "Oui" : "Non";

    }

}
