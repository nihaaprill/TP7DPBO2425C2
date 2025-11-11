<div class="container">

<?php
require_once "./class/Item.php";

$item = new Item();

// ADD
if (isset($_POST['add'])) {
    $item->insert($_POST['name'], $_POST['type'], $_POST['stock']);
    header("Location: index.php?page=item");
    exit;
}

// DELETE
if (isset($_GET['delete'])) {
    $deleteSuccess = $item->delete($_GET['delete']);

    if (!$deleteSuccess) {
        echo "<script>alert('Gagal menghapus! Item sedang dipinjam dan tidak dapat dihapus.');</script>";
    }

    echo "<script>window.location='index.php?page=item';</script>";
    exit;
}

// UPDATE
$editData = null;
if (isset($_GET['edit_id'])) {
    $editData = $item->getById($_GET['edit_id']);
}

if (isset($_POST['update'])) {
    $item->update($_POST['id'], $_POST['name'], $_POST['type'], $_POST['stock']);
    header("Location: index.php?page=item");
    exit;
}

$data = $item->getAll();
?>

<h2>Item List</h2>

<form method="POST">
    <input type="hidden" name="id" value="<?= $editData['id'] ?? '' ?>">

    <input type="text" name="name" placeholder="Item name"
        value="<?= $editData['name'] ?? '' ?>" required>

    <input type="text" name="type" placeholder="Type"
        value="<?= $editData['type'] ?? '' ?>" required>

    <input type="number" name="stock" placeholder="Stock"
        value="<?= $editData['stock'] ?? '' ?>" required>

    <button type="submit" 
        name="<?= $editData ? 'update' : 'add' ?>">
        <?= $editData ? 'Update' : 'Add' ?>
    </button>
</form>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Type</th>
        <th>Stock</th>
        <th>Action</th>
    </tr>

<?php while ($row = $data->fetch(PDO::FETCH_ASSOC)) { ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['name'] ?></td>
        <td><?= $row['type'] ?></td>
        <td><?= $row['stock'] ?></td>
        <td>
            <a class="btn btn-delete" 
                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" 
                href="index.php?page=item&delete=<?= $row['id'] ?>">Delete</a>
            <a class="btn btn-edit"
                href="index.php?page=item&edit_id=<?= $row['id'] ?>">Edit</a>
        </td>
    </tr>
<?php } ?>
</table>

</div>
