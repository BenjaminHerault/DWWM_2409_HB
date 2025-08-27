export class Control_saisies {
    constructor(_username, _password, _passwordVerif) {
        this.username = _username;
        this.password = _password;
        this.passwordVerif = _passwordVerif;

        if (this.username.length < 3) {
            throw new Error(
                "Le nom d'utilisateur est trop court (3 caractères minimum)"
            );
        }
        if (this.password.length < 12) {
            throw new Error(
                "Le mot de passe est trop court (12 caracttères minimum)"
            );
        }
        if (this.password !== this.passwordVerif) {
            throw new Error("Les mots de passe ne sont pas identiques.");
        }
    }
}
