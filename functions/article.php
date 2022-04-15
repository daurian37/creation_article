<?php

/**
 * Permet de retourner tous les
 * articles de la BDD.
 */
function getArticles() {
    global $dbh;
    $query = $dbh->query('
        SELECT *, a.id AS "id"
            FROM article a, auteur au
                WHERE a.auteur_id = au.id
                ORDER BY a.id DESC
    ');
    return $query->fetchAll();
}

/**
 * Permet de retourner un article
 * via son ID dans la base.
 *
 * @param $idArticle
 * @return mixed
 */
function getArticleById($idArticle) {
    global $dbh;
    $query = $dbh->prepare('
        SELECT * FROM article WHERE id = :id
    ');
    $query->bindValue(':id', $idArticle);
    $query->execute();
    return $query->fetch();
}

/**
 * Permet de retourner les articles
 * d'une catégorie.
 *
 * @param $idCategory
 * @return array|false
 */
function getArticlesByCategoryId($idCategory) {
    global $dbh;
    $query = $dbh->prepare('
        SELECT *, a.id AS "id" 
            FROM article a, auteur au
                WHERE a.auteur_id = au.id
                AND a.categorie_id = :id
                ORDER BY a.id DESC
    ');
    $query->bindValue(':id', $idCategory, PDO::PARAM_INT);
    $query->execute();
    return $query->fetchAll();
}

/**
 * Permet de retourner les articles
 * d'un auteur (journaliste)
 *
 * @param $idAuthor
 */
function getArticlesByAuthorId($idAuthor) {

    global $dbh;
    $query = $dbh->prepare('
        SELECT * FROM article WHERE auteur_id = :id
    ');
    $query->bindValue(':id', $idAuthor);
    $query->execute();
    return $query->fetchAll();
}

/**
 * Permet de retourner un article
 * via son ID dans la base.
 *
 * @param $idAuteur
 * @param $idCategorie
 * @param $titre
 * @param $contenu
 * @param $image
 */
function addArticle($idAuteur, $idCategorie, $titre, $contenu, $image) {
    global $dbh;
    $query = $dbh->prepare('
        INSERT INTO article (titre, contenu, image, categorie_id, auteur_id)
            VALUES (:titre, :contenu, :image, :categorie_id, :auteur_id)
    ');
    
    $query->bindValue(':titre', $titre, PDO::PARAM_STR);
    $query->bindValue(':contenu', $contenu, PDO::PARAM_STR);
    $query->bindValue(':image', $image, PDO::PARAM_STR);
    $query->bindValue(':categorie_id', $idCategorie, PDO::PARAM_INT);
    $query->bindValue(':auteur_id', $idAuteur, PDO::PARAM_INT);
    
    return $query->execute() ? $dbh->lastInsertId() : false;
}

/**
 * Permet de supprimer un article
 * via son ID dans la base.
 *
 * @param $idArticle
 */
function deleteArticle($idArticle) {

    global $dbh;
    $query = $dbh->prepare('
        DELETE FROM article WHERE id = :id
    ');
    $query->bindValue(':id', $idArticle);
    $query->execute();
    return $query->execute();
}