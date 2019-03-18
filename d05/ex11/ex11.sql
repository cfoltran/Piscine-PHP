SELECT F.nom AS 'NOM', F.prenom, A.prix FROM membre AS M INNER JOIN fiche_personne AS F ON F.id_perso=M.id_fiche_perso INNER JOIN abonnement AS A ON A.id_abo=M.id_abo WHERE A.prix > 42 ORDER BY F.nom, F.prenom;