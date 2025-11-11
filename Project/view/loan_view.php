<div class="container">

<?php
require_once "./class/Loan.php";
require_once "./class/Item.php";
require_once "./class/Student.php";

$loan = new Loan();
$item = new Item();
$student = new Student();

// ADD
if (isset($_POST['add'])) {
    $loan->insert($_POST['id_item'], $_POST['id_student'], $_POST['loan_date']);
    header("Location: index.php?page=loan");
    exit;
}

// UPDATE
if (isset($_POST['update'])) {
    $loan->update($_POST['id'], $_POST['id_item'], $_POST['id_student'], $_POST['loan_date']);
    header("Location: index.php?page=loan");
    exit;
}

// DELETE
if (isset($_GET['delete'])) {
    $loan->delete($_GET['delete']);
    header("Location: index.php?page=loan");
    exit;
}

// EDIT MODE: ddata loan yang mau diedit
$editData = null;
if (isset($_GET['edit_id'])) {
    $editData = $loan->getById($_GET['edit_id']);
}

// list data
$data = $loan->getAll();
$itemData = $item->getAll();
$studentData = $student->getAll();
?>

<h2>Loan List</h2>

<!-- FORM ADD / EDIT -->
<form method="POST">

    <!-- hidden ID untuk update -->
    <input type="hidden" name="id" value="<?= $editData['id'] ?? '' ?>">

    <!-- ITEM -->
    <select name="id_item" required>
        <option value="">Select Item</option>
        <?php
        $items = $item->getAll();
        while ($i = $items->fetch(PDO::FETCH_ASSOC)) {
            $sel = ($editData && $editData['id_item'] == $i['id']) ? 'selected' : '';
            echo "<option value='{$i['id']}' $sel>{$i['name']}</option>";
        }
        ?>
    </select>

    <!-- STUDENT -->
    <select name="id_student" required>
        <option value="">Select Student</option>
        <?php
        $students = $student->getAll();
        while ($s = $students->fetch(PDO::FETCH_ASSOC)) {
            $sel = ($editData && $editData['id_student'] == $s['id']) ? 'selected' : '';
            echo "<option value='{$s['id']}' $sel>{$s['name']}</option>";
        }
        ?>
    </select>

    <!-- DATE -->
    <input type="date" name="loan_date"
           value="<?= $editData['loan_date'] ?? '' ?>" required>

    <!-- BUTTON -->
    <button type="submit" name="<?= $editData ? 'update' : 'add' ?>">
        <?= $editData ? 'Update' : 'Add' ?>
    </button>

</form>

<!-- TABEL LIST -->
<table>
    <tr>
        <th>ID</th>
        <th>Item</th>
        <th>Student</th>
        <th>Date</th>
        <th>Action</th>
    </tr>

<?php while ($row = $data->fetch(PDO::FETCH_ASSOC)) { ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['item'] ?></td>
        <td><?= $row['student'] ?></td>
        <td><?= $row['loan_date'] ?></td>
        <td>
            <!-- EDIT -->
            <a class="btn btn-edit"
               href="index.php?page=loan&edit_id=<?= $row['id'] ?>">
               Edit
            </a>

            <!-- DELETE -->
            <a class="btn btn-delete"
               onclick="return confirm('Hapus data peminjaman ini?')"
               href="index.php?page=loan&delete=<?= $row['id'] ?>">
               Delete
            </a>
        </td>
    </tr>
<?php } ?>

</table>

</div>
