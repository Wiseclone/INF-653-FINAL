<?php
    // Assign all the variables
    function setVars($action){
        $id = trim(filter_input($action, 'id'));
        $text = trim(filter_input($action, 'text'));
        $author = trim(filter_input($action, 'author'));
        $authorId = trim(filter_input($action, 'authorId'));
        $category = trim(filter_input($action, 'category'));
        $categoryId = trim(filter_input($action, 'categoryId'));
        $data = array("id"=>$id, "text"=>$text,
            "author"=>$author, "authorId"=>$authorId,
            "category"=>$category, "categoryId"=>$categoryId);
        return $data;
    }

    // Set the header, output, and response code
    function prepData($responseCode,$data){
        header('Content-Type: application/json');
        echo json_encode($data);
        http_response_code($responseCode);
    }

    // Getter
    function accessDatabase($data){

    }

    // Setter
    function editDatabase($data){

    }

    //------------------------------------------------------------------------------------------
    
    switch($_SERVER["REQUEST_METHOD"]) {
        case "GET": // Handle GET requests
            prepData(200,setVars(INPUT_GET));
        break;
        case "POST": // Handle POST requests
            if (!isset($_SERVER["CONTENT_TYPE"])) { // Respond to improper request headers
                $data = array("message"=>"Required: Content-Type header");
                prepData(400,$data);
            } elseif ($_SERVER["CONTENT_TYPE"] == "application/json") { // Get values
                $json = file_get_contents('php://input');
                $data = json_decode($json);
                //$data = accessDatabase($data);
                prepData(200,$data);
            } else { // Set values
                $data = setVars(INPUT_POST);
                //$data = editDatabase($data);
                prepData(200,$data);
            }
        break;
        default: // Respond to improper request types
            $data = array("message"=>"You did not send a GET or POST request");
            prepData(400,$data);
    }

?>
