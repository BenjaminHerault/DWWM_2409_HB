export class Coureur {
    constructor(_nom, _pays, _temps) {
        this.nom = _nom;
        this.pays = _pays;
        this.temps = _temps;

        const [leNom, prenom] = this.nom.split(" ");

        // sa
        this.prenom = prenom;
        // ou pour mettre la premier lectre en mascule et le reste en miniscule
        this.prenom =
            prenom.charAt(0).toUpperCase() + prenom.slice(1).toLowerCase();

        this.leNom = leNom;
        this.nom = `${this.prenom}${this.leNom}`;
    }
}
