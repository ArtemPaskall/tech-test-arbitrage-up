<?php
// Заголовки для дозволу CORS
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Отримання даних з POST запиту
$data = json_decode(file_get_contents("php://input"), true);

// Перевірка наявності необхідних полів
if (isset($data['firstname']) && isset($data['phone'])) {
    $apiUrl = 'https://tracking.affscalecpa.com/api/v2/affiliate/leads?api-key=adsbdb45dhnjcbd4567ghjdd';
    
    // Формування даних для відправки
    $postData = http_build_query($data);

    // Налаштування CURL запиту
    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/x-www-form-urlencoded'
    ));
    
    // Відправка запиту
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    // Закриття CURL
    curl_close($ch);
    
    // Перевірка статусу відповіді
    if ($httpCode === 200) {
        echo json_encode(['status' => 'success', 'message' => 'Дані успішно надіслані.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Помилка при відправці даних.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Недостатньо даних.']);
}
?>
