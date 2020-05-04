<?php 
    function getDefaultSuggestionQuery() {
        return 'SELECT * 
        FROM suggestions';
    }

    function get_all_suggestions() {
        global $db;
        $query = getDefaultSuggestionQuery();
        $statement = $db->prepare($query);
        $statement->execute();
        $suggestions = $statement->fetchAll();
        $statement->closeCursor();
        return $suggestions;
    }

    function get_suggestion($suggestion_id) {
        global $db;
        $query = 'SELECT * FROM suggestions WHERE id = :suggestion_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':suggestion_id', $suggestion_id);
        $statement->execute();
        $suggestion = $statement->fetch();
        $statement->closeCursor();
        return $suggestion;
    }

    function delete_suggestion($suggestion_id) {
        global $db;
        $query = 'DELETE FROM suggestions WHERE id = :suggestion_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':suggestion_id', $suggestion_id);
        $statement->execute();
        $statement->closeCursor();
    }

    function add_suggestion($text, $author, $category) {
        global $db;
        $query = 'INSERT INTO suggestions (text, author, category)
              VALUES
                 (:text, :author, :category)';
        $statement = $db->prepare($query);
        $statement->bindValue(':text', $text);
        $statement->bindValue(':author', $author);
        $statement->bindValue(':category', $category);
        $statement->execute();
        $statement->closeCursor();
    }
?>