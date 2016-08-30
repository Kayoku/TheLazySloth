<?php include("header-1.php"); ?>

<meta name="description" content="Envie de me contacter directement ? De critiquer un article ? De boire une bière avec moi ? C'est ici que tout devient possible.">
<title>The Lazy Sloth - Contact</title>

<?php include("header-2.php"); ?>

<section>

<form id="contact" method="post" action="contact.php">
    <p><label for="nom">Nom</label><br /><input type="text" id="nom" name="nom" tabindex="1" /></p>
    <p><label for="email">Email</label><br /><input type="text" id="email" name="email" tabindex="2" /></p>
            
    <p><label for="message">Message</label><br /><textarea id="message" name="message" tabindex="4" cols="50" rows="8"></textarea></p>
        
    <div style="text-align:center;"><input type="submit" value=" Envoyer " /></div>
</form> 
    

</section>   
<?php include("footer.php"); ?>
