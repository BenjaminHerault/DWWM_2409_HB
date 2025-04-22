// dans cet exemple la date est stocké sous forme de String, donc difficile à recupérer le mois par exemple

import java.util.Date;
import java.text.DateFormat;
import java.text.SimpleDateFormat;

public class Review {

    // Attributs

    private int review_id;
    private String name_firstname;
    private String email;
    private int rating;
    private String description_review;
    private String comment_Date;

    // Constructeurs

    public Review() {

    }

    public Review(int review_id, String name_firstname, String email, int rating, String description_review) {
        this.review_id = review_id;
        this.name_firstname = name_firstname;
        this.email = email;
        this.rating = rating;
        this.description_review = description_review;
        this.comment_Date = getDateTime();

    }

    // Méthodes

    public String toString() {
        String result;

        result = "\n review_id : " + this.review_id;
        result += "\n name_firstname : " + this.name_firstname;
        result += "\n email : " + this.email;
        result += "\n rating : " + this.rating;
        result += "\n description_review : " + this.description_review;
        result += "\n comment_date : " + this.comment_Date;
        result += "\n pertinence : " + this.pertinence();
        result += "\n****************";
        return result;

    }

    public String getDateTime() {
        DateFormat dateFormat = new SimpleDateFormat("yyyy/MM/dd HH:mm:ss");
        Date comment_Date = new Date();
        return dateFormat.format(comment_Date);
    }

    public int nbCaract() {

        int count = 0;

        // Compter chaque caractère sauf l'espace
        for (int i = 0; i < this.description_review.length(); i++) {
            if (this.description_review.charAt(i) != ' ')
                count++;
        }

        return count;

    }

    public int pertinence() {

        int result = 0;

        int count = nbCaract();

        if (count < 50) {
            result = 1;

        } else if (count >= 50 && count < 250) {
            result = 2;

        } else if (count >= 250 && count < 500) {
            result = 3;
        } else {
            result = 0;
            System.out.println("Vous avez dépasser 500 caractères");
        }

        return result;
    }

}
