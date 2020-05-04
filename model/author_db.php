<?php 
    function getDefaultAuthorQuery() {
        return 'SELECT id, name 
        FROM authors';
    }

    function get_all_authors() {
        global $db;
        $query = getDefaultAuthorQuery();
        $statement = $db->prepare($query);
        $statement->execute();
        $authors = $statement->fetchAll();
        $statement->closeCursor();
        return $authors;
    }

    function get_author($author_id) {
        global $db;
        $query = 'SELECT * FROM authors WHERE id = :author_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':author_id', $author_id);
        $statement->execute();
        $author = $statement->fetch();
        $statement->closeCursor();
        return $author;
    }

    function delete_author($author_id) {
        global $db;
        $query = 'DELETE FROM authors WHERE id = :author_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':author_id', $author_id);
        $statement->execute();
        $statement->closeCursor();
    }

    function add_author($name) {
        global $db;
        $query = 'INSERT INTO authors (name)
              VALUES
                 (:name)';
        $statement = $db->prepare($query);
        $statement->bindValue(':name', $name);
        $statement->execute();
        $statement->closeCursor();
    }
?>