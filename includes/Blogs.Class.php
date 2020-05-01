<?php 
include_once dirname( __FILE__ ) . '/Blog.Class.php';
class Blogs
{
  // Properties.
  private $myBlogs = array();

  // Methods.

  function __construct ( $jsonFilePath = '' )
  { // Check if the file exists.
    if ( file_exists( $jsonFilePath ) )
    { // Will retrieve the file contents as a string.
      $jsonString = file_get_contents( $jsonFilePath );
      // Convert the JSON string to a PHP object.
      $jsonObject = json_decode( $jsonString );
      // Check if the "blogs" are an array.
      if ( is_array( $jsonObject->articles ) )
      { // Store the array in our property.
        $this->myBlogs = $jsonObject->articles;
      }
      // If blogs are NOT an array.
      else
      { // Show a warning in the browser.
        echo '<p>WARNING: The blog is irregular!</p>';
      }
    }
    // If file doesn't exist.
    else
    { // Show a warning in the browser.
      echo '<p>WARNING: This file does not exist!</p>';
    }
  }

  // Output all of the blogs.
  public function output ()
  { // If there ARE blogs.
    if ( is_array( $this->myBlogs ) && !empty( $this->myBlogs ) )
    { // Heading, and open our unordered list.
      echo '<h2>List of all blogs</h2><ol>';
      // Loop through the blogs!
      foreach ( $this->myBlogs as $theblog )
      { // Create an instance of our OTHER class: blog! Pass in the values.
        $Blognews = new Blog( $theblog->id, $theblog->title, $theblog->content );
        // Echo out our result.
        echo '<li>'.$Blognews->output( FALSE ).'</li>';
      } // Close the unordered list.
      echo '</ol>';
    }
  }

  // Find a particular blog.
  public function findblogByIndex ( $id = FALSE )
  { // Check if the submission is a number (integer.)
    if ( is_integer( $id ) )
    { // Check if the blog at this INDEX even EXISTS!?
      if ( isset( $this->myBlogs[$id] ) )
      { // Retrieve that blog from the array!
        $displayBlog = new Blog(
          $this->myBlogs[$id]->id,
          $this->myBlogs[$id]->title,
          $this->myBlogs[$id]->content
        );
        // Output that blog!
        $displayBlog->output();
      }
      // If the blog is not found...
      else
      { // Output a warning for the user.
        echo '<p>Sorry, we couldn\'t find a blog at ID: '.$id.'!</p>';
      }
    }
    // No ID, or an invalid ID was passed.
    else
    { // Output a warning for the user.
      echo '<p>No ID, or an invalid ID was passed; unable to find blog for ID: '.$id.'.</p>';
    }
  }
}