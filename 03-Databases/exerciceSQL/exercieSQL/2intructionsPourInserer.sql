USE rezoSocial;

TRUNCATE TABLE utilisateur;
TRUNCATE TABLE publication;

INSERT INTO utilisateur
(id, nom_utilisateur, email)
VALUES
(1,"Zorro","zorb@example.com"),
(2, "Patchouli", "patchouli@example.fr"),
(3, "Eva", "eva.stt@example.com");

INSERT INTO publication
(pub_id, pub_date, pub_titre, pub_contenu, id)
VALUES
(NULL,"2024-11-23 14:30" ,"	Il fait beau" , "Quel beau soleil aujourd'hui !" ,3),
(NULL,"2024-11-23 09:15" ,"Les bonbons" , "Les bonbons, c'est bon" ,2),
(NULL,"2024-11-27 08:17" ,"Super resto" , "J'ai découvert un super restaurant hier soir." ,1),
(NULL,"2024-12-05 17:52" ,"Album disponible" , "Nouvel album de mon groupe préféré !" ,2),
(NULL,"2024-12-15 10:05" ,"Aidez-moi" , "Je cherche une recette de gâteau au chocolat" ,3);