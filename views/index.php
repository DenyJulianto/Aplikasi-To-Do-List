<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Todo List</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="container">

    <!-- HEADER -->
    <header class="header">
        <div class="brand-icon">✓</div>
        <h1>To-Do List</h1>
        <p>Kelola tugasmu dengan lebih mudah.</p>
    </header>

    <!-- STATISTIK -->
    <section class="stats">

        <div class="stat-card">
            <span>Total Tugas</span>
            <strong><?= (int) $total ?></strong>
        </div>

        <div class="stat-card">
            <span>Selesai</span>
            <strong><?= (int) $completed ?></strong>
        </div>

        <div class="stat-card">
            <span>Belum Selesai</span>
            <strong><?= (int) $pending ?></strong>
        </div>

    </section>

    <!-- FORM TAMBAH TUGAS -->
    <section class="panel">

        <h2>Tambah Tugas</h2>

        <form
            method="POST"
            action="php/process.php"
            class="add-form"
        >

            <input
                type="hidden"
                name="action"
                value="add"
            >

            <input
                type="text"
                name="task"
                placeholder="Apa yang ingin kamu kerjakan?"
                maxlength="200"
                required
            >

            <button
                type="submit"
                class="btn btn-primary"
            >
                + Tambah
            </button>

        </form>

    </section>

    <!-- FORM EDIT TUGAS -->
    <?php if ($editTask !== null): ?>

        <section class="panel edit-panel">

            <h2>Edit Tugas</h2>

            <form
                method="POST"
                action="php/process.php"
                class="add-form"
            >

                <input
                    type="hidden"
                    name="action"
                    value="edit"
                >

                <input
                    type="hidden"
                    name="id"
                    value="<?= (int) $editTask['id'] ?>"
                >

                <input
                    type="text"
                    name="task"
                    value="<?= e($editTask['task']) ?>"
                    maxlength="200"
                    placeholder="Masukkan nama tugas"
                    required
                >

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Simpan
                </button>

                <a
                    href="index.php"
                    class="btn btn-secondary"
                >
                    Batal
                </a>

            </form>

        </section>

    <?php endif; ?>

    <!-- DAFTAR TUGAS -->
    <section class="panel">

        <div class="list-header">
            <h2>Daftar Tugas</h2>

            <span class="task-badge">
                <?= (int) $total ?> tugas
            </span>
        </div>

        <?php if (empty($tasks)): ?>

            <div class="empty-state">
                <div class="empty-icon">📝</div>

                <h3>Belum ada tugas</h3>

                <p>
                    Tambahkan tugas pertamamu menggunakan
                    formulir di atas.
                </p>
            </div>

        <?php else: ?>

            <ul class="task-list">

                <?php foreach ($tasks as $task): ?>

                    <?php
                    $done = (int) $task['is_completed'] === 1;
                    ?>

                    <li class="task-item">

                        <!-- INFORMASI TUGAS -->
                        <div class="task-info">

                            <span
                                class="status-dot <?= $done
                                    ? 'status-done'
                                    : 'status-pending' ?>"
                            ></span>

                            <span
                                class="task-name <?= $done
                                    ? 'completed'
                                    : '' ?>"
                            >
                                <?= e($task['task']) ?>
                            </span>

                        </div>

                        <!-- TOMBOL AKSI -->
                        <div class="actions">

                            <!-- UBAH STATUS -->
                            <form
                                method="POST"
                                action="php/process.php"
                            >

                                <input
                                    type="hidden"
                                    name="action"
                                    value="toggle"
                                >

                                <input
                                    type="hidden"
                                    name="id"
                                    value="<?= (int) $task['id'] ?>"
                                >

                                <button
                                    type="submit"
                                    class="btn btn-status"
                                >
                                    <?= $done
                                        ? 'Batal'
                                        : 'Selesai' ?>
                                </button>

                            </form>

                            <!-- EDIT -->
                            <a
                                href="index.php?edit=<?= (int) $task['id'] ?>"
                                class="btn btn-edit"
                            >
                                Edit
                            </a>

                            <!-- HAPUS -->
                            <form
                                method="POST"
                                action="php/process.php"
                                onsubmit="return confirm('Yakin ingin menghapus tugas ini?')"
                            >

                                <input
                                    type="hidden"
                                    name="action"
                                    value="delete"
                                >

                                <input
                                    type="hidden"
                                    name="id"
                                    value="<?= (int) $task['id'] ?>"
                                >

                                <button
                                    type="submit"
                                    class="btn btn-delete"
                                >
                                    Hapus
                                </button>

                            </form>

                        </div>

                    </li>

                <?php endforeach; ?>

            </ul>

        <?php endif; ?>

    </section>

    <!-- FOOTER -->
    <footer>
        Todo List App &middot; Dibuat dengan PHP dan MySQL
    </footer>

</div>

</body>
</html>