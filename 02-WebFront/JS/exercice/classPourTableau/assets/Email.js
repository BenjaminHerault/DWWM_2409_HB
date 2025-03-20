export class Email{
    constructor(){

        
    }
    
    uneAdresseMail(lePrenom, leNom){
        let Email = lePrenom.toLowerCase() + "." + leNom.toLowerCase() + "@example.com";
        console.log(Email);
        return Email;
    }
}

const email = new Email();
const adresse = email.uneAdresseMail