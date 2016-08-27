<?php include("header.php"); ?>    
<section>

<?php

$mysqli = mysqli_connect("localhost", "root", "Istiolorf3", "tls");
$pair = 0;

if (mysqli_connect_errno($mysqli)) {
    echo "Echec lors de la connexion à MySQL : " . mysqli_connect_error();
}

if($res = $mysqli->query("SELECT * FROM tls_articles ORDER BY article_id DESC LIMIT 5"))
{

    while ($row = $res->fetch_assoc())
    {
        echo '<div class="index_article">';
        $image;
        $date;
        
        if($pair%2)
        {
            $image = "index_article_image_right";
            $date = "index_article_date_left";
        }
        else
        {
            $image = "index_article_image_left";
            $date = "index_article_date_right";
        }

        echo '<img src="img/' . $row['article_image'] . '" width="200" height="200" class="' . $image . '" />';
        echo '<a href="article.php?n=' . $row['article_url_title'] . '"><h1 class="index_article_title">' . $row['article_title'] . '</h1></a>';

        echo $row['article_resume'];
            
        echo '<div class="index_article_date ' . $date . '">' . $row['article_date'] . '</div>';
        
        echo '</div>';

        $pair++;
    }

    $res->free();
}

$mysqli->close();

?>
    

</section>   
<?php include("footer.php"); ?>
