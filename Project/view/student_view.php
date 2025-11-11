<div class="container">

<?php
require_once "./class/Student.php";
$student = new Student();

// ADD
if (isset($_POST['add'])) {
    $student->insert($_POST['name'], $_POST['major']);
    header("Location: index.php?page=student");
    exit;
}

// UPDATE
if (isset($_POST['update'])) {
    $student->update($_POST['id'], $_POST['name'], $_POST['major']);
    header("Location: index.php?page=student");
    exit;
}

// DELETE
if (isset($_GET['delete'])) {
    $student->delete($_GET['delete']);
    header("Location: index.php?page=student");
    exit;
}

// EDIT MODE → ambil data
$editData = null;
if (isset($_GET['edit_id'])) {
    $editData = $student->getById($_GET['edit_id']);
}

$data = $student->getAll();
?>

<h2>Student List</h2>

<form method="POST">

    <!-- ID untuk update -->
    <input type="hidden" name="id" value="<?= $editData['id'] ?? '' ?>">

    <input type="text" name="name" placeholder="Student name"
           value="<?= $editData['name'] ?? '' ?>" required>

    <input type="text" name="major" placeholder="Major"
           value="<?= $editData['major'] ?? '' ?>" required>

    <button type="submit" name="<?= $editData ? 'update' : 'add' ?>">
        <?= $editData ? 'Update' : 'Add' ?>
    </button>

</form>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Major</th>
        <th>Action</th>
    </tr>

<?php while ($row = $data->fetch(PDO::FETCH_ASSOC)) { ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['name'] ?></td>
        <td><?= $row['major'] ?></td>
        <td>

            <!-- EDIT BUTTON -->
            <a class="btn btn-edit"
                href="index.php?page=student&edit_id=<?= $row['id'] ?>">
                Edit
            </a>

            <!-- DELETE BUTTON -->
            <a class="btn btn-delete"
                onclick="return confirm('Hapus student ini?')"
                href="index.php?page=student&delete=<?= $row['id'] ?>">
                Delete
            </a>
        </td>
    </tr>
<?php } ?>

</table>

</div>
