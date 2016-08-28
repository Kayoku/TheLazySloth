<?php include("header.php"); ?>

<section>

  <div class="article">

      <?php

      $n = $_GET['n'];

      $mysqli = mysqli_connect("localhost", "root", "Istiolorf3", "tls");
 
      if (mysqli_connect_errno($mysqli)) {
          echo "Echec lors de la connexion à MySQL : " . mysqli_connect_error();
      }

      if($res = $mysqli->query("SELECT * FROM tls_articles WHERE tls_articles.article_url_title='" . $mysqli->real_escape_string($n) . "'"))
      {
          $row = $res->fetch_assoc();

          echo '<h1 class="article_title">' . $row['article_title'] . '</h1>';

          
          echo '<div class="article_sub">' . $row['article_date'] . '<br/>';
          echo 'Tag(s) : ' . $row['article_tag'] . '<br/>';
          echo 'Catégorie(s) : ';

          $categories_query = "SELECT category_name FROM tls_categories JOIN tls_article_category JOIN tls_articles WHERE article_id = ac_article_id AND category_id = ac_category_id AND article_id = " . $row['article_id'];

          if($res_cat = $mysqli->query($categories_query))
          {
              while($row_cat = $res_cat->fetch_assoc())
                  echo ' ' . $row_cat['category_name'];
          }

          $res_cat->free();
          
          echo '</div>';

          echo $row['article_content'];
          
          $res->free();
      }

      $mysqli->close();
      
      ?>

      <?php
        include("module_commentaire.php");
      ?>
        
    </div>

</section>

<?php include("footer.php"); ?>
