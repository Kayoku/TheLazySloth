<?php include("header-1.php"); ?>

<meta name="description" content="Blog pour les feignants avec pleins d'articles super trop cool vous permettant d'apprendre plein de chose. (enfin, j'espère). Parce que le pouvoir, c'est le savoir !">
<title>The Lazy Sloth - Accueil</title>

<?php include("header-2.php"); ?>

<section>

<?php

$mysqli = mysqli_connect("localhost", "root", "Istiolorf3", "tls");
$pair = 0;
$old = 0;
$not_old = false;

if(isset($_GET['o']))
    $old = $_GET['o'];

if (mysqli_connect_errno($mysqli)) {
    echo "Echec lors de la connexion à MySQL : " . mysqli_connect_error();
}

if($res = $mysqli->query("SELECT * FROM tls_articles ORDER BY article_id DESC LIMIT " . $old * 5 . ", 5"))
{
    if($res->num_rows == 0)
        $not_old = true;
    
    while ($row = $res->fetch_assoc())
    {
        if($row['article_id'] == 1)
            $not_old = true;

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

        echo '<a href="/article/' . $row['article_url_title'] . '"><img src="/static/img/' . $row['article_image'] . '" width="200" height="200" class="' . $image . '" /></a>';
        echo '<a href="/article/' . $row['article_url_title'] . '"><h2 class="index_article_title">' . $row['article_title'] . '</h1></a>';

        echo $row['article_resume'];
            
        echo '<div class="index_article_date ' . $date . '">' . $row['article_date'] . '</div>';
        
        echo '</div>';

        $pair++;
    }

    $res->free();
}

$mysqli->close();

if(!$not_old)
    echo '<a href="/old/' . ($old+1) . '"><div class="index_article_old">Les anciens articles</div></a>';

?>

</section>   
<?php include("footer.php"); ?>
