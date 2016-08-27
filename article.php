<?php include("header.php"); ?>
<section>
    <div class="article">
    <?php
        use \MarkdownExtended\MarkdownExtended;

        $articleName = 'article_' . $_GET['id'] . '.md';
        $content = MarkdownExtended::parseSource('articles/' . $articleName);

        echo '<h1 class="article_title">' . $content->getTitle() . '</h1>';

        echo '<div class="article_date">' . $content->getMetadata()['date'] . '</div>';

        if(file_exists('articles/' . $articleName))
        {
            $content = MarkdownExtended::parseSource('articles/' . $articleName);
            echo $content->getBody(); 
        }
    ?>

    <?php
    include("module_commentaire.php");
    ?>
    
    </div>

</section>
<?php include("footer.php"); ?>
