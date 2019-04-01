INSERT INTO
    ft_table (id, login, `group`, creation_date)
SELECT
    null,
    last_name,
    'other',
    birthdate
FROM
    user_card
WHERE
    CHARACTER_LENGTH(last_name) < 9
    AND last_name LIKE '%a%'
ORDER BY
    last_name ASC
LIMIT
    10;
