<?php
header('Content-Type: application/json');

$pdo = new PDO('pgsql:host=db;dbname=my_database', 'my_user', 'my_password');

if ($_GET['action'] === 'get_posts') {
    $stmt = $pdo->query('SELECT * FROM posts ORDER BY created_at DESC');
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($posts);
} elseif ($_GET['action'] === 'delete_post') {
    $stmt = $pdo->prepare('DELETE FROM posts WHERE id = :id');
    $stmt->execute(['id' => $_GET['id']]);
    http_response_code(204); 
} else {
    http_response_code(400); 
} elseif ($_GET['action'] === 'create_post') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_POST['author'];

    $stmt = $pdo->prepare('INSERT INTO posts (title, content, author) VALUES (:title, :content, :author)');
    $stmt->execute(['title' => $title, 'content' => $content, 'author' => $author]);
    http_response_code(201); 
} 
elseif ($_GET['action'] === 'search_posts') {
    $keyword = $_GET['keyword'];
    $stmt = $pdo->prepare('SELECT * FROM posts WHERE title LIKE :keyword OR content LIKE :keyword');
    $stmt->execute(['keyword' => "%$keyword%"]);
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($posts);
} 
elseif ($_GET['action'] === 'get_profile') {
   
    $profileData = [
        'username' => 'User123',
        'bio' => 'This is my profile bio.'
    ];
    echo json_encode($profileData);
} elseif ($_GET['action'] === 'save_profile') {
    $data = json_decode(file_get_contents('php://input'), true);
   
    $stmt = $pdo->prepare('UPDATE users SET bio = :bio WHERE username = :username');
    $stmt->execute(['bio' => $data['bio'], 'username' => 'User123']); // Assuming 'User123' is the current user's username
    http_response_code(204); 
} 

elseif ($_GET['action'] === 'create_post') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_POST['author'];

    $stmt = $pdo->prepare('INSERT INTO posts (title, content, author) VALUES (:title, :content, :author)');
    $stmt->execute(['title' => $title, 'content' => $content, 'author' => $author]);
    http_response_code(201); 
} 
elseif ($_GET['action'] === 'get_posts') {
    $stmt = $pdo->query('SELECT * FROM posts ORDER BY created_at DESC');
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($posts);
} 
elseif ($_GET['action'] === 'delete_post') {
    $id = $_GET['id'];
    $stmt = $pdo->prepare('DELETE FROM posts WHERE id = :id');
    $stmt->execute(['id' => $id]);
    http_response_code(204); 
} 
elseif ($_GET['action'] === 'get_profile') {
    $profileData = [
        'username' => 'User123',
        'bio' => 'This is my profile bio.'
    ];
    echo json_encode($profileData);
} 
elseif ($_GET['action'] === 'save_profile') {
    $data = json_decode(file_get_contents('php://input'), true);
   
    $stmt = $pdo->prepare('UPDATE users SET bio = :bio WHERE username = :username');
    $stmt->execute(['bio' => $data['bio'], 'username' => 'User123']); // Assuming 'User123' is the current user's username
    http_response_code(204); 
} 
elseif ($_GET['action'] === 'search_posts') {
    $keyword = $_GET['keyword'];
    $stmt = $pdo->prepare('SELECT * FROM posts WHERE title LIKE :keyword OR content LIKE :keyword');
    $stmt->execute(['keyword' => "%$keyword%"]);
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($posts);
}










