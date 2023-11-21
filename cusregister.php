<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Load XML file
    $xml = simplexml_load_file('customer.xml');

    
    foreach ($xml->user as $user) {
        if ((string)$user->email === $email) {
            echo json_encode(['success' => false, 'message' => 'Email is already registered']);
            exit;
        }
    }
    if (!preg_match('/^(0\d{8}|0\d\s\d{7})$/', $phone)) {
        echo json_encode(['message' => 'Invalid phone number format']);
        exit;
    }
    $customerId = count($xml->xpath('//user')) + 1;
    
    $newUser = $xml->addChild('user');
    $newUser->addChild('id', $customerId);
    $newUser->addChild('firstname', $firstname);
    $newUser->addChild('lastname', $lastname);
    $newUser->addChild('phone', $phone);
    $newUser->addChild('email', $email);
    $newUser->addChild('password', $password);

    $xml->asXML('customer.xml');

    echo json_encode(['success' => true, 'message' => 'Registration successful!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
