export class Employes {
    constructor(_id, _nom, _salaire, _age, _image) {
        this.id = _id;
        this.employee_name = _nom;
        this.employee_salary = _salaire;
        this.employee_age = _age;
        this.profile_image = _image;

        const [prenom, leNom] = this.employee_name.split(" ");
        this.prenom = prenom;
        this.leNom = leNom;

        this.mail = `${this.prenom}.${this.leNom}@email.com`;
    }
}
