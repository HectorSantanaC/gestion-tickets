<?php

declare(strict_types=1);

function validateRequired(array $data, array $fields): array
{
    $missing = [];
    foreach ($fields as $field) {
        if (!isset($data[$field]) || trim((string) $data[$field]) === '') {
            $missing[] = $field;
        }
    }
    return $missing;
}

function validateEnum(string $value, array $allowed): bool
{
    return in_array($value, $allowed, true);
}

function validateUuid(string $value): bool
{
    return (bool) preg_match(
        '/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i',
        $value
    );
}