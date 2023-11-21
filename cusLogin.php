<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Invalid email format']);
        exit;
    }

    $password = filter_var($data['password'], FILTER_SANITIZE_STRING);

    
    $xml = simplexml_load_file('customer.xml');

   
    $userFound = false;
    foreach ($xml->user as $user) {
        if ($user->email == $email && $user->password == $password) {
            $userFound = true;

            $_SESSION['customer_id'] = (int)$user->id;
            break;
        }
    }

    if ($userFound) {
        
        echo json_encode(['success' => true, 'message' => 'Login successful']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid email or password']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
