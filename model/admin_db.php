<?php
function add_admin($username, $password) {
    global $db;
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $query = 'INSERT INTO administrators (username, password)
              VALUES (:username, :password)';
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->bindValue(':password', $hash);
    $statement->execute();
    $statement->closeCursor();
}

function is_valid_admin_login($username, $password) {
    global $db;
    $query = 'SELECT password FROM administrators
              WHERE username = :username';
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->execute();
    $row = $statement->fetch();
    $statement->closeCursor();
    $hash = $row['password'];
    return password_verify($password, $hash);
}
function get_users() {
global $db;
    $query = 'SELECT username FROM administrators';
    $statement = $db->prepare($query);
    $statement->execute();
    $users = $statement->fetch();
    $statement->closeCursor();
    if (empty($users)) {
        $users = [];
    }
    return $users;
}
?>