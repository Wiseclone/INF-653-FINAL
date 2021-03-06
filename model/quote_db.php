<?php 
    function getDefaultQuoteQuery() {
        return 'SELECT * 
        FROM quotes';
    }

    function get_quotes_by_author($author_id) {
        global $db;
        if ($author_id == NULL || $author_id == FALSE) {
            $query = getDefaultQuoteQuery();
        } else {
            $query = 'SELECT * 
            FROM quotes 
            WHERE authorId = :author_id ';
        }
        $statement = $db->prepare($query);
        $statement->bindValue(':author_id', $author_id);
        $statement->execute();
        $quotes = $statement->fetchAll();
        $statement->closeCursor();
        return $quotes;
    }

    function get_quotes_by_category($category_id) {
        global $db;
        if ($category_id == NULL || $category_id == FALSE) {
            $query = getDefaultQuoteQuery();
        } else {
            $query = 'SELECT * 
            FROM quotes  
            WHERE categoryId = :category_id';
        }
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $category_id);
        $statement->execute();
        $quotes = $statement->fetchAll();
        $statement->closeCursor();
        return $quotes;
    }

    function get_quotes_by_both($author_id, $category_id) {
        global $db;
        if ($author_id == NULL || $author_id == FALSE || $category_id == NULL || $category_id == FALSE) {
            $query = getDefaultQuoteQuery();
        } else {
            $query = 'SELECT * 
                FROM quotes
                WHERE authorId = :author_id AND categoryId = :category_id';
        }
        $statement = $db->prepare($query);
        $statement->bindValue(':author_id', $author_id);
        $statement->bindValue(':category_id', $category_id);
        $statement->execute();
        $quotes = $statement->fetchAll();
        $statement->closeCursor();
        return $quotes;
    }

    function get_all_quotes() {
        global $db;
        $query = getDefaultQuoteQuery();
        $statement = $db->prepare($query);
        $statement->execute();
        $quotes = $statement->fetchAll();
        $statement->closeCursor();
        return $quotes;
    }

    function get_quote($quote_id) {
        global $db;
        $query = 'SELECT * FROM quotes WHERE id = :quote_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':quote_id', $quote_id);
        $statement->execute();
        $quote = $statement->fetch();
        $statement->closeCursor();
        return $quote;
    }

    function delete_quote($quote_id) {
        global $db;
        $query = 'DELETE FROM quotes WHERE id = :quote_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':quote_id', $quote_id);
        $statement->execute();
        $statement->closeCursor();
    }

    function add_quote($text, $author_id, $category_id) {
        global $db;
        $query = 'INSERT INTO quotes (text, authorId, categoryId)
              VALUES
                 (:text, :author_id, :category_id)';
        $statement = $db->prepare($query);
        $statement->bindValue(':text', $text);
        $statement->bindValue(':author_id', $author_id);
        $statement->bindValue(':category_id', $category_id);
        $statement->execute();
        $statement->closeCursor();
    }
?>