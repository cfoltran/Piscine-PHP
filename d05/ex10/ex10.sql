select titre AS 'Titre', resum AS 'Resum', annee_prod FROM film AS F INNER JOIN genre AS G ON F.id_genre = G.id_genre WHERE G.nom LIKE 'erotic' ORDER BY annee_prod DESC;