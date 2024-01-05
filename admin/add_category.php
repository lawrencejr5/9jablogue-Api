<?php
include './create.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - add category</title>
</head>

<body>
    <h1>Add Category <button id="refresh">Refresh</button></h1>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" id="cat_id" name="cat_id">
        <input type="file" accept="" name="cat_img">
        <input type="hidden" name="cat_imgg" id="cat_img">
        <input type="text" id="cat_txt" name="category" placeholder="category">
        <input type="text" id="cat_desc" name="cat_desc" placeholder="desc">
        <button type="submit" id="submit" name="add_category">Add</button>
    </form>

    <h1>Items</h1>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Category</th>
                <th>Description</th>
                <th>Img</th>
                <th>Datetime</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data->get_categories()->fetchAll(PDO::FETCH_ASSOC) as $c) { ?>
                <form action="" method="post">

                    <td><?= $c['id'] ?></td>
                    <td><?= $c['category'] ?></td>
                    <td><?= $c['description'] ?></td>
                    <td><?= $c['img'] ?></td>
                    <td><?= $c['datetime'] ?></td>
                    <td><button value="<?= $c['id'] ?>" class="edit_cat" data-id="<?= $c['id'] ?>" data-img="<?= $c['img'] ?>" data-cat="<?= $c['category'] ?>" data-desc="<?= $c['description'] ?>">Edit</button></td>
                    <td><button value="<?= $c['id'] ?>" name="del_cat">Delete</button></td>
                </form>
                <tr>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <script>
        const editBtn = document.querySelectorAll('.edit_cat')
        const catId = document.querySelector("#cat_id")
        const catTxt = document.querySelector("#cat_txt")
        const catDesc = document.querySelector("#cat_desc")
        const catImg = document.querySelector("#cat_img")
        const updateBtn = document.querySelector("#submit")
        editBtn.forEach((btn) => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                updateBtn.name = "update_category"
                updateBtn.textContent = "Update"
                catId.value = e.currentTarget.dataset.id
                catTxt.value = e.currentTarget.dataset.cat
                catDesc.value = e.currentTarget.dataset.desc
                catImg.value = e.currentTarget.dataset.img
            })
        })
        const btn = document.querySelector('#refresh')
        btn.addEventListener('click', () => {
            window.location.reload()
        })
    </script>
</body>

</html>