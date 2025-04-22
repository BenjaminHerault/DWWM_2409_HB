import java.time.LocalDateTime;  // classe pour avoir la date d'aujourd'hui. La data est stocké dans le type LocalDateTime donc on peut récupérer le mois, le jour..
import java.util.concurrent.atomic.AtomicInteger;

public class Review2 {

    // Attributs

    private static final AtomicInteger ID_FACTORY = new AtomicInteger();   //ligne qui aide à faire l'auto-incrémentation
    private int review_id;
    private String name_firstname;
    private String email;
    private int rating;
    private String description_review;
    private LocalDateTime comment_Date;
    private int pertinence_article; 

    // Constructeurs

    public Review2() {

    }

    public Review2(String name_firstname, String email, int rating, String description_review) {
        this.review_id = ID_FACTORY.getAndIncrement();    //article.id sera autoincrémenté
        this.name_firstname = name_firstname;
        this.email = email;
        this.rating = rating;
        this.description_review = description_review;
        this.comment_Date = LocalDateTime.now();
        this.pertinence_article = pertinence();
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
        result += "\n pertinence : " + this.pertinence_article;
        result += "\n****************";
        return result;

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
