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

          echo '<div class="article_date">' . $row['article_date'] . '</div>';

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
