<?php

declare(strict_types=1);

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true) ?? [];
$db = getDbConnection();

if ($method === 'GET') {
    $id = $_GET['id'] ?? null;

    if ($id) {
        if (!validateUuid($id)) {
            sendResponse(jsonError('Invalid category ID'), 400);
        }

        $stmt = $db->prepare('SELECT * FROM categories WHERE id = :id');
        $stmt->execute([':id' => $id]);
        $category = $stmt->fetch();

        if (!$category) {
            sendResponse(jsonError('Category not found'), 404);
        }

        sendResponse(jsonSuccess($category));
    }

    $stmt = $db->query('SELECT * FROM categories ORDER BY name ASC');
    $categories = $stmt->fetchAll();

    sendResponse(jsonSuccess($categories));
}

if ($method === 'POST') {
    $missing = validateRequired($input, ['name']);
    if ($missing) {
        sendResponse(jsonError('Missing required fields: ' . implode(', ', $missing)), 400);
    }

    $name = trim($input['name']);
    if (strlen($name) > 100) {
        sendResponse(jsonError('Name must be 100 characters or less'), 400);
    }

    $description = trim($input['description'] ?? '');

    $check = $db->prepare('SELECT id FROM categories WHERE LOWER(name) = LOWER(:name)');
    $check->execute([':name' => $name]);
    if ($check->fetch()) {
        sendResponse(jsonError('A category with this name already exists'), 400);
    }

    $stmt = $db->prepare(
        'INSERT INTO categories (name, description) VALUES (:name, :desc) RETURNING *'
    );
    $stmt->execute([':name' => $name, ':desc' => $description]);
    $category = $stmt->fetch();

    sendResponse(jsonSuccess($category), 201);
}

if ($method === 'PUT') {
    $id = $_GET['id'] ?? null;
    if (!$id) {
        sendResponse(jsonError('Missing category ID'), 400);
    }

    if (!validateUuid($id)) {
        sendResponse(jsonError('Invalid category ID'), 400);
    }

    $check = $db->prepare('SELECT id FROM categories WHERE id = :id');
    $check->execute([':id' => $id]);
    if (!$check->fetch()) {
        sendResponse(jsonError('Category not found'), 404);
    }

    $missing = validateRequired($input, ['name']);
    if ($missing) {
        sendResponse(jsonError('Missing required fields: ' . implode(', ', $missing)), 400);
    }

    $name = trim($input['name']);
    if (strlen($name) > 100) {
        sendResponse(jsonError('Name must be 100 characters or less'), 400);
    }

    $description = trim($input['description'] ?? '');

    $checkName = $db->prepare('SELECT id FROM categories WHERE LOWER(name) = LOWER(:name) AND id != :id');
    $checkName->execute([':name' => $name, ':id' => $id]);
    if ($checkName->fetch()) {
        sendResponse(jsonError('A category with this name already exists'), 400);
    }

    $stmt = $db->prepare(
        'UPDATE categories SET name = :name, description = :desc, updated_at = NOW() WHERE id = :id RETURNING *'
    );
    $stmt->execute([':name' => $name, ':desc' => $description, ':id' => $id]);
    $category = $stmt->fetch();

    sendResponse(jsonSuccess($category));
}

if ($method === 'DELETE') {
    $id = $_GET['id'] ?? null;
    if (!$id) {
        sendResponse(jsonError('Missing category ID'), 400);
    }

    if (!validateUuid($id)) {
        sendResponse(jsonError('Invalid category ID'), 400);
    }

    $check = $db->prepare('SELECT id FROM categories WHERE id = :id');
    $check->execute([':id' => $id]);
    if (!$check->fetch()) {
        sendResponse(jsonError('Category not found'), 404);
    }

    $used = $db->prepare('SELECT id FROM tickets WHERE category_id = :id LIMIT 1');
    $used->execute([':id' => $id]);
    if ($used->fetch()) {
        sendResponse(jsonError('Cannot delete category that is assigned to tickets'), 400);
    }

    $db->prepare('DELETE FROM categories WHERE id = :id')->execute([':id' => $id]);

    http_response_code(204);
    exit;
}

sendResponse(jsonError('Method not allowed'), 405);