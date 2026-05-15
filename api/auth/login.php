<?php

$method = $_SERVER['REQUEST_METHOD'];

if ($method !== 'POST') {
  sendResponse(jsonError('Método no permitido'), 405);
}

$input = json_decode(file_get_contents('php://input'), true) ?? [];

$email = trim($input['email'] ?? '');
$password = $input['password'] ?? '';

if ($email === '' || $password === '') {
  sendResponse(jsonError('Email y contraseña son requeridos'), 400);
}

$verifySSL = !in_array($_SERVER['SERVER_NAME'] ?? '', ['localhost', '127.0.0.1', '::1']);

$ch = curl_init('https://centro-medico-app-dvjk.onrender.com/login.php');
curl_setopt_array($ch, [
  CURLOPT_POST => true,
  CURLOPT_POSTFIELDS => http_build_query(['email' => $email, 'password' => $password]),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_HEADER => true,
  CURLOPT_FOLLOWLOCATION => false,
  CURLOPT_TIMEOUT => 10,
  CURLOPT_SSL_VERIFYPEER => $verifySSL,
]);

$response = curl_exec($ch);
if ($response === false) {
  sendResponse(jsonError('Error de conexión al servidor de autenticación'), 502);
}
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
$headers = substr($response, 0, $headerSize);

preg_match_all('/PHPSESSID=([^;]+)/', $headers, $matches);
$phpsessid = !empty($matches[1]) ? end($matches[1]) : null;

if ($httpCode !== 302 || !$phpsessid) {
  sendResponse(jsonError('Credenciales inválidas'), 401);
}

$cookieHeader = "Cookie: PHPSESSID=$phpsessid";

$ch2 = curl_init('https://centro-medico-app-dvjk.onrender.com/api/usuarios.php?email=' . urlencode($email));
curl_setopt_array($ch2, [
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_TIMEOUT => 10,
  CURLOPT_HTTPHEADER => [$cookieHeader],
  CURLOPT_SSL_VERIFYPEER => $verifySSL,
]);
$usersResponse = curl_exec($ch2);
if ($usersResponse === false) {
  sendResponse(jsonError('Error de conexión al obtener datos del usuario'), 502);
}
$httpCodeUsers = curl_getinfo($ch2, CURLINFO_HTTP_CODE);

if ($httpCodeUsers === 403) {
    sendResponse(jsonError('Acceso no autorizado. Este usuario no tiene permisos para acceder al gestor de incidencias'), 403);
}

if ($httpCodeUsers !== 200) {
    sendResponse(jsonError('Error al obtener datos del usuario'), 502);
}

$usersData = json_decode($usersResponse, true);
$users = $usersData['data'] ?? [];
curl_close($ch2);

$user = null;
foreach ($users as $u) {
  if (($u['email'] ?? '') === $email) {
    $user = $u;
    break;
  }
}

if (!$user) {
  sendResponse(jsonError('Usuario no encontrado'), 404);
}

$allowedRoles = ['admin', 'administracion', 'gestor', 'medico'];
$userRoles = array_map('trim', explode(',', $user['roles'] ?? ''));
if (empty(array_intersect($userRoles, $allowedRoles))) {
    sendResponse(jsonError('Acceso no autorizado. Este usuario no tiene permisos para acceder al gestor de incidencias'), 403);
}

$chAll = curl_init('https://centro-medico-app-dvjk.onrender.com/api/usuarios.php');
curl_setopt_array($chAll, [
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_TIMEOUT => 10,
  CURLOPT_HTTPHEADER => [$cookieHeader],
  CURLOPT_SSL_VERIFYPEER => $verifySSL,
]);
$allResponse = curl_exec($chAll);
$allUsers = [];
if ($allResponse !== false) {
    $allData = json_decode($allResponse, true);
    $allUsers = $allData['data'] ?? [];

    $totalPages = $allData['pagination']['totalPages'] ?? 1;
    for ($page = 2; $page <= $totalPages; $page++) {
        $chPage = curl_init('https://centro-medico-app-dvjk.onrender.com/api/usuarios.php?page=' . $page);
        curl_setopt_array($chPage, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_HTTPHEADER => [$cookieHeader],
            CURLOPT_SSL_VERIFYPEER => $verifySSL,
        ]);
        $pageResponse = curl_exec($chPage);
        if ($pageResponse !== false) {
            $pageData = json_decode($pageResponse, true);
            $allUsers = array_merge($allUsers, $pageData['data'] ?? []);
        }
        curl_close($chPage);
    }
}
curl_close($chAll);

$_SESSION['user_id'] = $user['id'];
$_SESSION['user_email'] = $user['email'];
$_SESSION['user_name'] = trim(($user['nombre'] ?? '') . ' ' . ($user['apellidos'] ?? ''));
$_SESSION['user_role'] = $user['roles'] ?? '';
$_SESSION['user_first_name'] = $user['nombre'] ?? '';

$_SESSION['users_map'] = [];
foreach ($allUsers as $u) {
    $fullName = trim(($u['nombre'] ?? '') . ' ' . ($u['apellidos'] ?? ''));
    $_SESSION['users_map'][$u['id']] = $fullName ?: 'Usuario #' . $u['id'];
}
session_write_close();

sendResponse(jsonSuccess([
  'id' => $user['id'],
  'name' => trim(($user['nombre'] ?? '') . ' ' . ($user['apellidos'] ?? '')),
  'email' => $user['email'],
  'role' => $user['roles'] ?? '',
]));
