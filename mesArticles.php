<?php

# Inclusion du header sur la page
require_once(__DIR__ . '/partials/header.php');

# Récupération de l'auteur


# Récupération des articles
$idAuthor= $user['id'] ?? 0;
$articles = getArticlesByAuthorId($idAuthor);

?>

	 <div class="p-3 mx-auto text-center">
        <h1 class="display-4">Mes articles</h1>
    </div>

	<table class="table container">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Titre</th>
      <th scope="col">Image</th>
      <th scope="col">Action</th>
    </tr>
  </thead>

<?php 

foreach ($articles as $article) { ?>
 
  <tbody>
    <tr>
      <th scope="row"><?= $article['id'] ?></th>

      <td><?= $article['titre'] ?></td>

      <td> 
      	<img class="card-img-top" style="width:50px;"
             src="assets/uploads/<?=$article['image']?>"
             alt="<?= $article['titre'] ?>">
      </td>

       <td>  

       	<a href="suppressionArticle.php?idArticle=<?= $article['id']; ?>"> <button type="submit" class="btn btn-danger" name="suprimer_produit">suprimer</button>
       	</a> 
       </td>
    </tr>
    
  </tbody>


<?php
	
}


 ?> 
</table>
