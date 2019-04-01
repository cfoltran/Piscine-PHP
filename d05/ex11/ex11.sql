SELECT
    UPPER(U.last_name) AS 'NAME',
    U.first_name,
    S.price
FROM
    member AS M
    INNER JOIN user_card  AS U ON U.id_user = M.id_user_card
    INNER JOIN subscription AS S ON S.id_sub = M.id_sub
WHERE
    S.price > 42
ORDER BY
    U.last_name ASC,
    U.first_name ASC;