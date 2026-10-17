<?php

require_once __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../index.php');
    exit;
}

$action = $_POST['action'] ?? '';
$id = filter_var(
    $_POST['id'] ?? null,
    FILTER_VALIDATE_INT
);

try {
    switch ($action) {
        // CREATE: Tambah tugas
        case 'add':
            $task = trim($_POST['task'] ?? '');

            if ($task !== '' && strlen($task) <= 200) {
                $stmt = $pdo->prepare(
                    'INSERT INTO tasks (task) VALUES (:task)'
                );

                $stmt->execute(['task' => $task]);
            }
            break;

        // UPDATE: Edit nama tugas
        case 'edit':
            $task = trim($_POST['task'] ?? '');

            if (
                $id !== false && $id !== null && $id > 0 &&
                $task !== '' && strlen($task) <= 200
            ) {
                $stmt = $pdo->prepare(
                    'UPDATE tasks SET task = :task WHERE id = :id'
                );

                $stmt->execute([
                    'task' => $task,
                    'id' => $id
                ]);
            }
            break;

        // UPDATE: Ubah status tugas
        case 'toggle':
            if ($id !== false && $id !== null && $id > 0) {
                $stmt = $pdo->prepare(
                    'UPDATE tasks
                     SET is_completed = 1 - is_completed
                     WHERE id = :id'
                );

                $stmt->execute(['id' => $id]);
            }
            break;

        // DELETE: Hapus tugas
        case 'delete':
            if ($id !== false && $id !== null && $id > 0) {
                $stmt = $pdo->prepare(
                    'DELETE FROM tasks WHERE id = :id'
                );

                $stmt->execute(['id' => $id]);
            }
            break;
    }
} catch (PDOException $e) {
    error_log($e->getMessage());

    http_response_code(500);
    exit('Operasi database gagal. Silakan periksa log server.');
}

header('Location: ../index.php');
exit;