<?php

$goodreads = simplexml_load_file('http://www.goodreads.com/review/list/4056420.xml?key=8RVRgpjTsEUEYXdU0WLd1g&v=2&shelf=currently-reading&id=4056420');

foreach ($goodreads->reviews->review as $review) {

    $link = $review->book->link;
    $title = $review->book->title;
    
    $authors = array();
    foreach ($review->book->authors as $author) {
        array_push($authors, $author->author->name);
    }
    $authors = implode(', ', $authors);
 
    //$img = $review->book->image_url;
    $img = $review->book->small_image_url;
    
    echo "<div class='reading-book'>";
    echo "<a href='$link' target='_blank'><img class='reading-book-image' src='$img' /></a>";
    echo "<div class='reading-title'><a href='$link' target='_blank'>$title</a></div>";
    echo "<div class='reading-author'>$author</div>";
    echo "</div>";

    break;
}

?>