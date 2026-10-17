<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (!isset($_SESSION['tasks'])) {
    $_SESSION['tasks'] = [
        [
            'id' => 1,
            'task' => 'Belajar dasar PHP',
            'done' => false
        ],
        [
            'id' => 2,
            'task' => 'Mengerjakan tugas kuliah',
            'done' => false
        ],
        [
            'id' => 3,
            'task' => 'Membaca dokumentasi HTML dan CSS',
            'done' => false
        ]
    ];

    $_SESSION['next_id'] = 4;
}

if (!isset($_SESSION['next_id'])) {
    $ids = array_column($_SESSION['tasks'], 'id');

    $_SESSION['next_id'] = empty($ids)
        ? 1
        : max($ids) + 1;
}