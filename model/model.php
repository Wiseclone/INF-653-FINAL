<?php 
    require('database.php');
    require('admin_db.php');
    require('author_db.php');
    require('category_db.php');
    require('quote_db.php');
    require('suggestion_db.php');

    function getIdFromName($set,$name){
        foreach($set as $item):
            if($item['name'] == $name){
                return $item['id'];
            }
        endforeach;
        return false;
    }
    function getNameFromId($set,$id){
        foreach($set as $item):
            if($item['id'] == $id){
                return $item['name'];
            }
        endforeach;
        return false;
    }

    function addEachMissing($quote){
        $authors = get_all_authors();
        $categories = get_all_categories();

        // Assign quote text
        $text = $quote['text'];

        // Check to see if a new author needs to be added to the database
        $author_id = getIdFromName($authors,$quote['author']);
        if($author_id == false){ // Add author to database and update list
            add_author($quote['author']);
            $authors = get_all_authors();
            $author_id = getIdFromName($authors,$quote['author']);
        }

        // Check to see if a new category needs to be added to the database
        $category_id = getIdFromName($categories,$quote['category']);
        if($category_id == false){ // Add category to database and update list
            add_category($quote['category']);
            $categories = get_all_categories();
            $category_id = getIdFromName($categories,$quote['category']);
        }

        add_quote($text, $author_id, $category_id);
    }

    function approveSuggestion($suggestion_id) {
        $suggestion = get_suggestion($suggestion_id);
        addEachMissing($suggestion);
        delete_suggestion($suggestion_id);
    }
?>