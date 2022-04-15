<?php

# Inclusion du header sur la page
require_once(__DIR__ . '/partials/header.php');

# Récupération des paramètres
$categoryName = $_GET['NOM'] ?? '';
$categoryId = $_GET['ID'] ?? 0;

# Récupération des articles de la catégorie
$articles = getArticlesByCategoryId($categoryId);

?>

    <!-- Contenu de la page -->

    <div class="p-3 mx-auto text-center">
        <h1 class="display-4"><?= $categoryName ?></h1>
    </div>

    <div class="py-5 bg-light">
        <div class="container ">
            <div class="row">
                <?php if (empty($articles)) { ?>
                    <div class="mx-auto">
                        <div class="alert alert-warning">
                            Pas d'article dans cette catégorie.
                        </div>
                    </div>
                <?php } ?>
                <?php foreach ($articles as $article) { ?>
                    <div class="col-md-4 mt-4">
                        <div class="card shadow-sm">
                            <img class="card-img-top"
                                  src="assets/uploads/<?=$article['image']?>"
                                 alt="<?= $article['titre'] ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= $article['titre'] ?></h5>
                                <div class="card-text">
                                    <?= summarize($article['contenu']) ?>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="article.php?ID=<?= $article['id'] ?>" class="btn btn-primary">Lire la suite</a>
                                    <small class="text-muted"><?= $article['prenom'] ?> <?= $article['nom'] ?></small>
                                </div>
                            </div>
                        </div> <!-- Fin card -->
                    </div>
                <?php } // endforeach ?>
            </div>
        </div> <!-- Fin container -->
    </div>

<?php
# Inclusion du footer sur la page
require_once(__DIR__ . '/partials/footer.php');
