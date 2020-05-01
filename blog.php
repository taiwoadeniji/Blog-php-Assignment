<?php
/**
 * Debugging error prior to posting the article
 */

  ini_set( 'display_errors', 1 );
  ini_set( 'display_startup_errors', 1 );
  error_reporting( E_ALL );
  include './includes/Blogs.Class.php';
  
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog Page</title>

</head>
<body>
  <h1>Blogs</h1>
  <?php include './includes/navigation.php'; ?>
  <?php
    // New object 
    $blognews = new Blogs( dirname( __FILE__ ) . '/data/article.json');
   
    // Output the blogs
    $blognews->output();
  ?>
  <h2>Search for article using the ID</h2>
  <p>Searched article with id... should display:<?php $id ?> </p>
  <?php
    // Output the id, title and content of the searched indexed
    $blognews->findblogByIndex( 15 );
  ?> 
</body>
</html>
