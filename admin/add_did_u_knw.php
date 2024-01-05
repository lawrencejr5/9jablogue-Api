<?php
include './create.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - add did u know</title>
</head>

<body>
    <h1>Add Did You Know <button id="refresh">Refresh</button></h1>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="duk_id" id="duk_id">
        <input type="file" accept="" name="img">
        <input type="hidden" id="duk_img" name="duk_img">
        <input type="text" placeholder="duk" id="duk_txt" name="text">
        <button type="submit" id="submit" name="add_did_u_knw">Add</button>
    </form>

    <h1>Items</h1>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Item</th>
                <th>Img</th>
                <th>Datetime</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data->get_duk()->fetchAll(PDO::FETCH_ASSOC) as $d) { ?>
                <form action="" method="post">

                    <td><?= $d['id'] ?></td>
                    <td><?= $d['duk'] ?></td>
                    <td><?= $d['img'] ?></td>
                    <td><?= $d['datetime'] ?></td>
                    <td><button value="" class="edit_duk" data-id="<?= $d['id'] ?>" data-img="<?= $d['img'] ?>" data-duk="<?= $d['duk'] ?>">Edit</button></td>
                    <td><button value="<?= $d['id'] ?>" name="del_duk">Delete</button></td>
                </form>
                <tr>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <script>
        const editBtn = document.querySelectorAll('.edit_duk')
        const dukId = document.querySelector("#duk_id")
        const dukTxt = document.querySelector("#duk_txt")
        const dukImg = document.querySelector("#duk_img")
        const updateBtn = document.querySelector("#submit")
        editBtn.forEach((btn) => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                updateBtn.name = "update_duk"
                updateBtn.textContent = "Update"
                dukId.value = e.currentTarget.dataset.id
                dukTxt.value = e.currentTarget.dataset.duk
                dukImg.value = e.currentTarget.dataset.img
            })
        })
        const btn = document.querySelector('#refresh')
        btn.addEventListener('click', () => {
            window.location.reload()
        })
    </script>
</body>

</html>