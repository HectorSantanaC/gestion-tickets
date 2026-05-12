<?php

declare(strict_types=1);

require_once __DIR__ . '/../config/db.php';

function generateTicketNumber(PDO $db, string $prefix): string
{
    $validPrefixes = ['TIC', 'INC', 'REQ', 'BUG'];
    $prefix = strtoupper($prefix);

    if (!in_array($prefix, $validPrefixes, true)) {
        throw new InvalidArgumentException(
            "Invalid prefix: '$prefix'. Valid prefixes: " . implode(', ', $validPrefixes)
        );
    }

    $db->beginTransaction();

    try {
        $stmt = $db->prepare(
            'SELECT last_number FROM ticket_number_sequences WHERE prefix = :prefix FOR UPDATE'
        );
        $stmt->execute([':prefix' => $prefix]);
        $row = $stmt->fetch();

        if (!$row) {
            $db->rollBack();
            throw new RuntimeException("Sequence prefix '$prefix' not found in ticket_number_sequences.");
        }

        $nextNumber = (int) $row['last_number'] + 1;

        $update = $db->prepare(
            'UPDATE ticket_number_sequences SET last_number = :num, updated_at = NOW() WHERE prefix = :prefix'
        );
        $update->execute([
            ':num' => $nextNumber,
            ':prefix' => $prefix,
        ]);

        $db->commit();

        return sprintf('%s-%04d', $prefix, $nextNumber);
    } catch (Throwable $e) {
        $db->rollBack();
        throw $e;
    }
}