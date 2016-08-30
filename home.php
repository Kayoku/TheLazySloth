<?php include("header-1.php"); ?>

<meta name="description" content="Blog pour les feignants avec pleins d'articles super cool vous permettant d'apprendre plein de choses. (enfin, j'espère). Parce que le savoir, c'est le pouvoir !">
<title>The Lazy Sloth - Accueil</title>

<?php include("header-2.php"); ?>

<section>
  <div class="side">
    <form>
      <input class="side_search" type="text" name="search" placeholder="Rechercher...">
    </form>
    <div class="side_media">
      <img src="/static/img/facebook-icon.png" alt="Icone de facebook" title="Face de bouc" width="32" height="32"/>
      <img src="/static/img/twitter-icon.png" alt="Icone de twitter" title="Le pigeon bleue" width="32" height="32"/>
      <img src="/static/img/git-icon.png" alt="Icone de github" title="L'octocat de github" width="32" height="32"/>
      <img src="/static/img/rss-icon.png" alt="Icone de flux RSS" title="Pour me stalker !" width="32" height="32"/>
    </div>
    <hr/>
    <div class="side_categories">
      <h4>Catégories</h4>
      <ul>
        <a href="/home?c=informatique"><li>Geek zone (Informatique)</li></a>
        <a href="/home?c=ecologie"><li>Green life (Ecologie)</li></a>
        <a href="/home?c=societe"><li>Ô paisible monde (Société)</li></a>
      </ul>
    </div>
    <br />
    <hr />
    
  </div>
  
<?php

$mysqli = mysqli_connect("localhost", "root", "Istiolorf3", "tls");

if (mysqli_connect_errno($mysqli)) {
    echo "Echec lors de la connexion à MySQL : " . mysqli_connect_error();
}

$pair = 0;
$old = 0;
$not_old = false;

if(isset($_GET['o']))
    $old = $_GET['o'];

echo '<div class="col_article">';

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

        echo '<a href="/article/' . $row['article_url_title'] . '"><img src="/static/img/' . $row['article_image'] . '" class="' . $image . '" /></a>';
        echo '<a href="/article/' . $row['article_url_title'] . '"><h2 class="index_article_title">' . $row['article_title'] . '</h1></a>';

        echo $row['article_resume'];
            
        echo '<div class="index_article_date ' . $date . '">' . $row['article_date'] . '</div>';
        
        echo '</div>';

        $pair++;
    }

    echo '</div>';
    $res->free();
}

$mysqli->close();

if(!$not_old)
    echo '<a href="/old/' . ($old+1) . '"><div class="index_article_old">Les anciens articles</div></a>';

?>

  <div class="bas"></div>
</section>

<?php include("footer.php"); ?>
