<?php include("header.php"); ?>    
<section>

<?php

    use \MarkdownExtended\MarkdownExtended;

    $nbArticles = count(glob('articles/*.md'));
    $pair = 0;

    for($i = $nbArticles ; $i > 0 && ($nbArticles - $i) < 5 ; $i--)
    {
        $articleName = 'article_' . $i . '.md';

        echo '<div class="index_article">';
        $content = MarkdownExtended::parseSource('articles/' . $articleName);
        
        $pos2 = strpos($content->getBody(), '<p>');
        $pos = strpos($content->getBody(), '</p>');
        $resume = substr($content->getBody(), $pos2, ($pos+3)-($pos2-1));
        
        if($pair%2)
            echo '<img src="img/' . $content->getMetadata()['image'] . '" width="200" height="200" class="index_article_image_right"/>';
        else
            echo '<img src="img/' . $content->getMetadata()['image'] . '" width="200" height="200" class="index_article_image_left"/>';
        
        echo '<a href="article.php?id=' . $i . '"><h1 class="index_article_title">' . $content->getTitle() . '</h1></a>';
        
        if(strlen($resume) < 500)
            echo $resume;
        else
            echo substr($resume, 0, 500) . '...';

        if($pair%2)
            echo '<div class="index_article_date index_article_date_left">' . $content->getMetadata()['date'] . '</div>';
        else
            echo '<div class="index_article_date index_article_date_right">' . $content->getMetadata()['date'] . '</div>';
        
        echo '</div>';
        
        $pair++;
    }
?>
    

</section>   
<?php include("footer.php"); ?>
