<?php 

$uri = $_SERVER['REQUEST_URI'];;
$methodHTTP = $_SERVER['REQUEST_METHOD'];

$emails = __DIR__ . '/emails.txt';

if($uri == '/emails' && $methodHTTP == 'GET') {

    $emails = file_get_contents($emails);
    $emails = explode('|', $emails);

    http_response_code(200);
    header('Content-Type: application/json');
    echo json_encode($emails);
}

if($uri == '/emails' && $methodHTTP == 'POST') {

    $email = $_POST['email'];

    file_put_contents($emails, '|' . $email);

    http_response_code(200);
    header('Content-Type: application/json');
    echo json_encode(['salvar email...']);
}