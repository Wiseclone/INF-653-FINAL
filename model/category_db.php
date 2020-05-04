<?php 
    function getDefaultCategoryQuery() {
        return 'SELECT id, name 
        FROM categories';
    }

    function get_all_categories() {
        global $db;
        $query = getDefaultCategoryQuery();
        $statement = $db->prepare($query);
        $statement->execute();
        $categories = $statement->fetchAll();
        $statement->closeCursor();
        return $categories;
    }

    function get_category($category_id) {
        global $db;
        $query = 'SELECT * FROM categories WHERE id = :category_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $category_id);
        $statement->execute();
        $category = $statement->fetch();
        $statement->closeCursor();
        return $category;
    }

    function delete_category($category_id) {
        global $db;
        $query = 'DELETE FROM categories WHERE id = :category_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $category_id);
        $statement->execute();
        $statement->closeCursor();
    }

    function add_category($name) {
        global $db;
        $query = 'INSERT INTO categories (name)
              VALUES
                 (:name)';
        $statement = $db->prepare($query);
        $statement->bindValue(':name', $name);
        $statement->execute();
        $statement->closeCursor();
    }
?>