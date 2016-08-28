<?php

    ////////////////////////////////////////////////////
    ////////////////////////////////////////////////////
    //            Définitions des variables           //
    ////////////////////////////////////////////////////
    ////////////////////////////////////////////////////

 $debug = 1; //0=off / 1=on
 
 if(!empty($_POST))
 {
     // Recupere le pseudo
     $pseudo = $_POST['pseudo'];
     //Récupère le commentaire
     $commentaire = $_POST['commentaire'];
 }

 //Extrait le nom de la page et l'utilise pour le nom du fichier de sauvegarde en ".txt"
 $path = 'commentaries/article_' . $_GET['n'] . '.txt';

 //Affichage du formulaire
 echo '
 <div id="conteneur">
  <div class="title-post-wrapper article_title">Laisser un commentaire</div>
 <form enctype="multipart/form-data" name="comment_form" action="article.php?n=' . $_GET['n'] . '" method="POST"> 
 <label class="pseudo-style" for="pseudo-box">Pseudo : </label><br />
    	    <input type="text" name="pseudo" class="pseudo-box" placeholder="Entrez votre pseudo"><br />
 <label class="com-style">Votre commentaire :</label><br />
   			<textarea name="commentaire" cols="0" rows="0" class="com-box" placeholder="Entrez votre commentaire"></textarea>
			<br />
 <input class="button-style" type="submit" name="submit" value="Poster" />
 </form>
 ';
 
 //Enregistre et affiche les commentaires
 if(isset($_POST['submit']))
  save_comment($path,$pseudo,$commentaire);
 else
 //Affiche les commentaires
 if(file_exists($path))
     echo affiche_commentaires($path);  
 

    ////////////////////////////////////////////////////
    ////////////////////////////////////////////////////
    //                    Fonctions                   //
    ////////////////////////////////////////////////////
    ////////////////////////////////////////////////////

 //***************************
 //Affichage des commmentaires  
 //***************************

 function affiche_commentaires($path)
 {
  global $debug;

  $handletmp = fopen($path,"r");
  $tableau_content = file($path);
  fclose($handletmp);
  
  // boucle sur tous les elements
  $HTML  = '<div class="title-com-wrapper article_title">Vos commentaires</div>';
 
  for($i=0; $i < count($tableau_content); $i++)
  {
    if($i%2==0)
      {
       $HTML .= '<div class="user-wrapper">';
       $HTML .= $tableau_content[$i].'</div>';
      }
    else
     {
       $HTML .= '<div class="com-user-wrapper">';
       $HTML .= $tableau_content[$i].'</div>';
     }
  }
  $HTML .= '</div>';
  
  return $HTML;
 } 
 
 //*****************************
 //Enregistrement du commentaire	
 //*****************************

function save_comment($path,$pseudo,$commentaire)
{
    global $debug;
    
    //remplace le retour à la ligne par <br /> et le \' par '
    $commentaire=preg_replace("/\r\n/","<br />",$commentaire);
    $commentaire=preg_replace("/\\\'/","'",$commentaire); 
    
    if(file_exists($path))
    {
        $handle = fopen($path,"r");
        $tableau_content = file($path);
        fclose($handle);
    
        if(($commentaire != "") && (count($tableau_content) >= 1) && (($commentaire . "\r\n") != $tableau_content[count($tableau_content)-1]))
        {
            $handle = fopen($path,"w"); 
            for($i=0;$i < count($tableau_content); $i++)
            {  
                if(($tableau_content[$i] != "")&&($tableau_content[$i] != "\r\n"))
                fwrite($handle,$tableau_content[$i]);
            }     
            $str_out = '<span class="post-pseudo-style">' .$pseudo." </span> le ".date('d.m.y - H:i:s')."\r\n".$commentaire."\r\n";
            fwrite($handle,$str_out);   
            fclose($handle);
        }
        else
        {
            if($debug == 1)
                echo "<br /><br />Commentaire vide ou redondant !<br />";	
        }  
    }
    else
    {
        if($commentaire != "")
        {
            $handle = fopen($path,"w");  
            $str_out = '<span class="post-pseudo-style">' .$pseudo." </span> le ".date('d.m.y - H:i:s')."\r\n".$commentaire."\r\n";
            fwrite($handle,$str_out);   
            fclose($handle); 
        }
        else
        {
            if($debug == 1)
                echo "<br /><br />Commentaire vide ou redondant !<br />";	
        }  
    }
    

   echo Affiche_commentaires($path); 
 }
 
?>
