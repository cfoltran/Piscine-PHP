SELECT
    F.title AS 'Title',
    F.summary AS 'Summary',
    F.prod_year
FROM
    film AS F
    INNER JOIN genre AS G ON F.id_genre = G.id_genre
WHERE
    G.name LIKE 'erotic'
ORDER BY
    F.prod_year DESC;
