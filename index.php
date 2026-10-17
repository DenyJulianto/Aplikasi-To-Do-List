<?php

require_once __DIR__ . '/php/db.php';
require_once __DIR__ . '/php/functions.php';

// READ: Ambil semua tugas dari database
$stmt = $pdo->query(
    'SELECT id, task, is_completed, created_at
     FROM tasks
     ORDER BY id DESC'
);

$tasks = $stmt->fetchAll();

$total = count($tasks);

$completed = count(array_filter(
    $tasks,
    fn($task) => (int) $task['is_completed'] === 1
));

$pending = $total - $completed;

// Ambil tugas yang akan diedit
$editId = filter_var(
    $_GET['edit'] ?? null,
    FILTER_VALIDATE_INT
);

$editTask = null;

if ($editId !== false && $editId !== null && $editId > 0) {
    $stmt = $pdo->prepare(
        'SELECT id, task, is_completed
         FROM tasks
         WHERE id = :id'
    );

    $stmt->execute(['id' => $editId]);
    $editTask = $stmt->fetch() ?: null;
}

require __DIR__ . '/views/index.php';