<?php 

$uri = $_SERVER['REQUEST_URI'];;
$methodHTTP = $_SERVER['REQUEST_METHOD'];

$emails = __DIR__ . '/emails.txt';

if($uri == '/emails' && $methodHTTP == 'GET') {

    $emails = file_get_contents($emails);
    $emails = explode('|', $emails);

    echo response($emails);
}

if($uri == '/emails' && $methodHTTP == 'POST') {
    
    // $email = $_POST['email'];
    $email = json_decode(file_get_contents('php://input'), true)['email'];

    //TO-DO: sanitizar e validar... PHP FILTERS VALIDATE API

    file_put_contents($emails, '|' . $email, FILE_APPEND);

    echo response([], 201);
}

function response($body, $statusCode = 200) {
    
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    http_response_code($statusCode);

    return json_encode($body);
}