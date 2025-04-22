import java.util.concurrent.atomic.AtomicInteger;

public class Article {

    // Attributs
    private static final AtomicInteger ID_FACTORY = new AtomicInteger();   //ligne qui aide à faire l'auto-incrémentation
    private int article_id ;
    private String article_title;
    private String author;
    private String publication_date; 
    private double rating;
    private String avis;



// Constructeurs 
//public Article() {

//}

public Article (String article_title, String author, String publication_date, double rating, String avis){
    this.article_id = ID_FACTORY.getAndIncrement();    //article.id sera autoincrémenté
    this.article_title = article_title;
    this.author = author;
    this.publication_date = publication_date;
    this.rating = rating;
    this.avis = avis;

}

// Methodes 
 public String toString(){
    String result;

        result = "\n article_id : " + this.article_id;
        result += "\n article_title : " + this.article_title;
        result += "\n author : " + this.author;
        result += "\n publication_date : " + this.publication_date;
        result += "\n rating : " + this.rating;
        result += "\n avis : " + this.avis;
        result += "\n****************";
    return result;
 }
 
}

