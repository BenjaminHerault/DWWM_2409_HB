export class Employes {
    constructor(_id, _nom, _salaire, _age, _image) {
        this.id = _id;
        this.employee_name = _nom;
        this.employee_salary = _salaire;
        this.employee_age = _age;
        this.profile_image = _image;

        /*
        on split le nom et le prenom pour les separais 
        dans le prenom on recupere que la premier lettre mais en miniscule 
        et dans le nom on recupere tout qu'on mais en miniscule 
        */
        const [prenom, leNom] = this.employee_name.split(" ");
        this.prenom = prenom.charAt(0).toLowerCase();
        this.leNom = leNom.toLowerCase();
        this.mail = `${this.prenom}.${this.leNom}@email.com`;

        this.salaireMensuel = this.calculerSalaireMensuel();
        this.annerNaissance = this.calcuerAnnerNaissance();
    }

    calculerSalaireMensuel() {
        // Divise le salaire annuel par 12 et arrondit à deux décimales  exemple : 1567,26
        return Math.round((this.employee_salary / 12) * 100) / 100;
    }
    calcuerAnnerNaissance() {
        const annaisCourente = new Date().getFullYear(); // Récupère l'année actuelle
        return annaisCourente - this.employee_age;
    }
}
