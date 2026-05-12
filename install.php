<?php

declare(strict_types=1);

require_once __DIR__ . '/config/db.php';

$db = getDbConnection();

echo "=== Gestion Tickets - Database Installer ===\n\n";

echo "[1/5] Dropping existing objects...\n";

$db->exec('CREATE EXTENSION IF NOT EXISTS "uuid-ossp"');

$db->exec('SET session_replication_role = replica');

$db->exec('DROP TABLE IF EXISTS ticket_tags CASCADE');
$db->exec('DROP TABLE IF EXISTS attachments CASCADE');
$db->exec('DROP TABLE IF EXISTS comments CASCADE');
$db->exec('DROP TABLE IF EXISTS ticket_history CASCADE');
$db->exec('DROP TABLE IF EXISTS tickets CASCADE');
$db->exec('DROP TABLE IF EXISTS categories CASCADE');
$db->exec('DROP TABLE IF EXISTS tags CASCADE');
$db->exec('DROP TABLE IF EXISTS ticket_number_sequences CASCADE');
$db->exec('DROP TYPE IF EXISTS ticket_status CASCADE');
$db->exec('DROP TYPE IF EXISTS ticket_priority CASCADE');

echo "    Done.\n\n";

echo "[2/5] Creating ENUM types...\n";

$db->exec("
    CREATE TYPE ticket_status AS ENUM (
        'nueva',
        'en_progreso',
        'pendiente_verificacion',
        'resuelta',
        'cerrada'
    )
");
echo "    - ticket_status created\n";

$db->exec("
    CREATE TYPE ticket_priority AS ENUM (
        'baja',
        'normal',
        'alta',
        'urgente'
    )
");
echo "    - ticket_priority created\n\n";

echo "[3/5] Creating tables...\n";

$db->exec("
    CREATE TABLE categories (
        id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
        name VARCHAR(100) NOT NULL,
        description TEXT,
        created_at TIMESTAMP NOT NULL DEFAULT NOW(),
        updated_at TIMESTAMP NOT NULL DEFAULT NOW()
    )
");
echo "    - categories created\n";

$db->exec("
    CREATE TABLE tags (
        id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
        name VARCHAR(50) NOT NULL UNIQUE,
        created_at TIMESTAMP NOT NULL DEFAULT NOW()
    )
");
echo "    - tags created\n";

$db->exec("
    CREATE TABLE ticket_number_sequences (
        prefix VARCHAR(10) PRIMARY KEY,
        last_number INTEGER NOT NULL DEFAULT 0,
        updated_at TIMESTAMP NOT NULL DEFAULT NOW()
    )
");
echo "    - ticket_number_sequences created\n";

$db->exec("
    CREATE TABLE tickets (
        id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
        ticket_number VARCHAR(20) NOT NULL UNIQUE,
        subject VARCHAR(500) NOT NULL,
        description TEXT NOT NULL DEFAULT '',
        status ticket_status NOT NULL DEFAULT 'nueva',
        priority ticket_priority NOT NULL DEFAULT 'normal',
        category_id UUID REFERENCES categories(id),
        reporter_external_id INTEGER NOT NULL,
        assignee_external_id INTEGER,
        impact_level VARCHAR(100),
        created_at TIMESTAMP NOT NULL DEFAULT NOW(),
        updated_at TIMESTAMP NOT NULL DEFAULT NOW()
    )
");
echo "    - tickets created\n";

$db->exec("
    CREATE TABLE ticket_history (
        id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
        ticket_id UUID NOT NULL REFERENCES tickets(id) ON DELETE CASCADE,
        user_external_id INTEGER,
        action_type VARCHAR(50) NOT NULL,
        old_value TEXT,
        new_value TEXT,
        created_at TIMESTAMP NOT NULL DEFAULT NOW()
    )
");
echo "    - ticket_history created\n";

$db->exec("
    CREATE TABLE comments (
        id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
        ticket_id UUID NOT NULL REFERENCES tickets(id) ON DELETE CASCADE,
        author_external_id INTEGER NOT NULL,
        content TEXT NOT NULL DEFAULT '',
        created_at TIMESTAMP NOT NULL DEFAULT NOW(),
        updated_at TIMESTAMP NOT NULL DEFAULT NOW()
    )
");
echo "    - comments created\n";

$db->exec("
    CREATE TABLE attachments (
        id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
        ticket_id UUID REFERENCES tickets(id) ON DELETE CASCADE,
        comment_id UUID REFERENCES comments(id) ON DELETE CASCADE,
        filename VARCHAR(255) NOT NULL,
        file_path VARCHAR(500) NOT NULL,
        file_size INTEGER NOT NULL DEFAULT 0,
        mime_type VARCHAR(100) NOT NULL DEFAULT 'application/octet-stream',
        uploader_external_id INTEGER NOT NULL,
        created_at TIMESTAMP NOT NULL DEFAULT NOW()
    )
");
echo "    - attachments created\n";

$db->exec("
    CREATE TABLE ticket_tags (
        ticket_id UUID NOT NULL REFERENCES tickets(id) ON DELETE CASCADE,
        tag_id UUID NOT NULL REFERENCES tags(id) ON DELETE CASCADE,
        created_at TIMESTAMP NOT NULL DEFAULT NOW(),
        PRIMARY KEY (ticket_id, tag_id)
    )
");
echo "    - ticket_tags created\n\n";

echo "[4/5] Creating indexes...\n";

$db->exec('CREATE INDEX idx_tickets_status ON tickets(status)');
$db->exec('CREATE INDEX idx_tickets_priority ON tickets(priority)');
$db->exec('CREATE INDEX idx_tickets_category_id ON tickets(category_id)');
$db->exec('CREATE INDEX idx_tickets_reporter ON tickets(reporter_external_id)');
$db->exec('CREATE INDEX idx_tickets_assignee ON tickets(assignee_external_id)');
$db->exec('CREATE INDEX idx_tickets_created_at ON tickets(created_at DESC)');
$db->exec('CREATE INDEX idx_ticket_history_ticket_id ON ticket_history(ticket_id)');
$db->exec('CREATE INDEX idx_ticket_history_created_at ON ticket_history(created_at DESC)');
$db->exec('CREATE INDEX idx_comments_ticket_id ON comments(ticket_id)');
$db->exec('CREATE INDEX idx_comments_created_at ON comments(created_at DESC)');
$db->exec('CREATE INDEX idx_attachments_ticket_id ON attachments(ticket_id)');
$db->exec('CREATE INDEX idx_attachments_comment_id ON attachments(comment_id)');
$db->exec('CREATE INDEX idx_ticket_tags_tag_id ON ticket_tags(tag_id)');

echo "    - 13 indexes created\n\n";

echo "[5/5] Seeding data...\n";

$categories = [
    ['name' => 'Hardware', 'description' => 'Problemas con equipos fisicos y componentes'],
    ['name' => 'Software', 'description' => 'Errores y fallos en aplicaciones'],
    ['name' => 'Red', 'description' => 'Problemas de conectividad y red'],
    ['name' => 'Acceso a Cuentas', 'description' => 'Solicitudes de acceso y permisos'],
    ['name' => 'Facturacion', 'description' => 'Problemas relacionados con facturacion y pagos'],
    ['name' => 'Infraestructura Critica', 'description' => 'Incidencias en sistemas criticos de infraestructura'],
    ['name' => 'Errores de Software', 'description' => 'Bugs y errores en aplicaciones'],
    ['name' => 'Solicitudes de Acceso', 'description' => 'Peticiones de acceso a sistemas y recursos'],
    ['name' => 'Problemas de Red', 'description' => 'Fallos de conectividad y red'],
    ['name' => 'Consulta General', 'description' => 'Consultas y preguntas generales'],
];

$insertCategory = $db->prepare(
    'INSERT INTO categories (name, description) VALUES (:name, :desc)'
);
foreach ($categories as $cat) {
    $insertCategory->execute([
        ':name' => $cat['name'],
        ':desc' => $cat['description'],
    ]);
}
echo "    - 10 categories seeded\n";

$tags = [
    ['name' => 'Postgres'],
    ['name' => 'Latency'],
    ['name' => 'APAC'],
    ['name' => 'Backend'],
    ['name' => 'DB'],
    ['name' => 'Network'],
    ['name' => 'Security'],
    ['name' => 'API'],
];

$insertTag = $db->prepare('INSERT INTO tags (name) VALUES (:name)');
foreach ($tags as $tag) {
    $insertTag->execute([':name' => $tag['name']]);
}
echo "    - 8 tags seeded\n";

$sequences = [
    ['prefix' => 'TIC', 'last_number' => 0],
    ['prefix' => 'INC', 'last_number' => 0],
    ['prefix' => 'REQ', 'last_number' => 0],
    ['prefix' => 'BUG', 'last_number' => 0],
];

$insertSeq = $db->prepare(
    'INSERT INTO ticket_number_sequences (prefix, last_number) VALUES (:prefix, :num)'
);
foreach ($sequences as $seq) {
    $insertSeq->execute([':prefix' => $seq['prefix'], ':num' => $seq['last_number']]);
}
echo "    - 4 sequences seeded\n\n";

echo "=== Database installed successfully! ===\n\n";

echo "Tables created:\n";
$tables = $db->query("
    SELECT table_name
    FROM information_schema.tables
    WHERE table_schema = 'public'
    ORDER BY CASE table_name
        WHEN 'categories' THEN 1
        WHEN 'tags' THEN 2
        WHEN 'ticket_number_sequences' THEN 3
        WHEN 'tickets' THEN 4
        WHEN 'ticket_history' THEN 5
        WHEN 'comments' THEN 6
        WHEN 'attachments' THEN 7
        WHEN 'ticket_tags' THEN 8
    END
")->fetchAll();
foreach ($tables as $t) {
    echo "  - {$t['table_name']}\n";
}

echo "\nENUM types created:\n";
$enums = $db->query("SELECT typname FROM pg_type WHERE typtype = 'e'")->fetchAll();
foreach ($enums as $e) {
    echo "  - {$e['typname']}\n";
}

echo "\nReady! Run `php install.php` again to reset the database.\n";