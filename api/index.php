<?php
    require("../model/model.php");
    // Assign all the variables
    function setVars($action){
        $id = trim(filter_input($action, 'id'));
        $text = trim(filter_input($action, 'text'));
        $author = trim(filter_input($action, 'author'));
        $authorId = trim(filter_input($action, 'authorId'));
        $category = trim(filter_input($action, 'category'));
        $categoryId = trim(filter_input($action, 'categoryId'));
        $limit = trim(filter_input($action, 'limit'));
        $random = trim(filter_input($action, 'random'));
        $data = array("id"=>$id, "text"=>$text,
            "author"=>$author, "authorId"=>$authorId,
            "category"=>$category, "categoryId"=>$categoryId,
            "limit"=>$limit, "random"=>$random);
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
        // Fetch results from database
        if($data["authorId"] != "" && $data["categoryId"] != ""){
            if(filter_var($data['authorId'], FILTER_VALIDATE_INT) && filter_var($data['categoryId'], FILTER_VALIDATE_INT)){
                $results = get_quotes_by_both($data['authorId'],$data["categoryId"]);
            } else {
                return array("message"=>"Invalid Request: Id must be of type int or 'all'");
            }
        } elseif($data["authorId"] != "") {
            if($data["authorId"] == "all"){
                $results = get_all_authors();
            } else {
                if(filter_var($data['authorId'], FILTER_VALIDATE_INT)){
                    $results = get_quotes_by_author($data['authorId']);
                } else {
                    return array("message"=>"Invalid Request: Id must be of type int or 'all'");
                }
            }
        } elseif($data["categoryId"] != "") {
            if($data["categoryId"] == "all"){
                $results = get_all_catagories();
            } else {
                if(filter_var($data['categoryId'], FILTER_VALIDATE_INT)){
                    $results = get_quotes_by_category($data['categoryId']);
                } else {
                    return array("message"=>"Invalid Request: Id must be of type int or 'all'");
                }
            }
        } else {
            $results = get_all_quotes();
        }

        // Apply modifiers
        if($data["random"] != "" && $data["limit"] != ""){
            if (filter_var($data['limit'], FILTER_VALIDATE_INT)){
                $results = getRandom($results,$data["limit"]);
            } else {
                return array("message"=>"Invalid Request: Limit must be of type int");
            }
        } else if($data["random"] != ""){
            $results = getRandom($results,1);
        } else if($data["limit"] != ""){
            if (filter_var($data['limit'], FILTER_VALIDATE_INT)){
                $results = array_slice($results,0,$data['limit']);
            } else {
                return array("message"=>"Invalid Request: Limit must be of type int");
            }
        }

        return $results;
    }

    // Setter
    function editDatabase($data){

    }

    //------------------------------------------------------------------------------------------
    switch($_SERVER["REQUEST_METHOD"]) {
        case "GET": // Handle GET requests
            $data = INPUT_GET;
            $data = setVars(INPUT_GET);
            $data = accessDatabase($data);
            prepData(200,$data);
        break;
        case "POST": // Handle POST requests
            if (!isset($_SERVER["CONTENT_TYPE"])) { // Respond to improper request headers
                $data = array("message"=>"Required: Content-Type header");
                prepData(400,$data);
            } elseif ($_SERVER["CONTENT_TYPE"] == "application/json") { // Get values
                $json = file_get_contents('php://input');
                $data = json_decode($json);
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
