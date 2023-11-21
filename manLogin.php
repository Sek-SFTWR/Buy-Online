<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $managerId = $_POST['managerId'];
    $password = $_POST['password'];

  
    $file = fopen('manager.txt', 'r');

    if ($file) {
        
        while (($line = fgets($file)) !== false) {
           
            $line = trim($line);

           
            list($storedManagerId, $storedPassword) = explode(',', $line);

           
            if ($storedManagerId == $managerId && $storedPassword == $password) {
                fclose($file); 
                echo json_encode(['success' => true, 'message' => 'Login successful']);
                exit;
            }
        }

        fclose($file);
    }

    
    echo json_encode(['success' => false, 'message' => 'Invalid manager ID or password']);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
