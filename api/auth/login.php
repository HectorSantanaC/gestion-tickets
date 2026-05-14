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

$ch = curl_init('https://centro-medico-app-dvjk.onrender.com/login.php');
curl_setopt_array($ch, [
  CURLOPT_POST => true,
  CURLOPT_POSTFIELDS => http_build_query(['email' => $email, 'password' => $password]),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_HEADER => true,
  CURLOPT_FOLLOWLOCATION => false,
  CURLOPT_TIMEOUT => 10,
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
$headers = substr($response, 0, $headerSize);
curl_close($ch);

preg_match('/PHPSESSID=([^;]+)/', $headers, $matches);
$phpsessid = $matches[1] ?? null;

if ($httpCode !== 302 || !$phpsessid) {
  sendResponse(jsonError('Credenciales inválidas'), 401);
}

$cookieHeader = "Cookie: PHPSESSID=$phpsessid";

$ch2 = curl_init('https://centro-medico-app-dvjk.onrender.com/api/usuarios.php');
curl_setopt_array($ch2, [
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_TIMEOUT => 10,
  CURLOPT_HTTPHEADER => [$cookieHeader],
]);
$usersResponse = curl_exec($ch2);
$httpCodeUsers = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
curl_close($ch2);

if ($httpCodeUsers !== 200) {
  sendResponse(jsonError('Error al obtener datos del usuario'), 502);
}

$usersData = json_decode($usersResponse, true);
$users = $usersData['data'] ?? [];

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

$rolesJson = @file_get_contents('https://centro-medico-app-dvjk.onrender.com/api/roles.php');
$rolesData = json_decode($rolesJson, true);
$roles = $rolesData['data'] ?? [];

$roleName = '';
foreach ($roles as $r) {
  if (($r['id'] ?? 0) === ($user['role_id'] ?? 0)) {
    $roleName = $r['nombre'] ?? '';
    break;
  }
}

$_SESSION['user_id'] = $user['id'];
$_SESSION['user_email'] = $user['email'];
$_SESSION['user_name'] = $user['nombre'] ?? $user['email'];
$_SESSION['user_role'] = $roleName;

sendResponse(jsonSuccess([
  'id' => $user['id'],
  'name' => $user['nombre'] ?? $user['email'],
  'email' => $user['email'],
  'role' => $roleName,
]));
