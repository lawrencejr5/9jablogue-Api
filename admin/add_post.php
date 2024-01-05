<?php
include './create.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - add post</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <h1>Add Post <button id="refresh">Refresh</button></h1>
    <!-- <?php print_r($allCategories) ?> -->
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="post_id" class="post_id">
        <input type="hidden" name="img" class="img">
        <input type="hidden" id="cat3val">
        <input type="hidden" id="cat2val">
        <input type="hidden" id="cat1val">
        <input type="file" value="" accept="" name="post_img">
        <select name="cat1">
            <option value="">select category1</option>
            <?php foreach ($allCategories as $c) { ?>
                <option class="cat1" value="<?php echo $c['id'] ?>"><?php echo $c['category'] ?></option>
            <?php } ?>
        </select>
        <select name="cat2">
            <option value="">select category2(optional)</option>
            <?php foreach ($allCategories as $c) { ?>
                <option class="cat2" value="<?php echo $c['id'] ?>"><?php echo $c['category'] ?></option>
            <?php } ?>
        </select>
        <select name="cat3">
            <option value="">select category3(optional)</option>
            <?php foreach ($allCategories as $c) { ?>
                <option class="cat3" value="<?php echo $c['id'] ?>"><?php echo $c['category'] ?></option>
            <?php } ?>
        </select>
        <input type="text" class="title" name="post_title" placeholder="post_title">
        <input type="text" class="desc" name="post_desc" placeholder="post_desc">
        <textarea type="text" name="post" id="post" class="post"></textarea>
        <button type="submit" id="submit" name="add_post">Add</button>
    </form>

    <h1>Items</h1>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Categories</th>
                <th>Title</th>
                <th>Description</th>
                <th>Img</th>
                <th>Datetime</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data->get_posts()->fetchAll(PDO::FETCH_ASSOC) as $p) { ?>
                <form action="" method="post">

                    <td><?= $p['id'] ?></td>
                    <td><?= $p['x'] . ' ' . $p['y'] . ' ' . $p['z'] ?></td>
                    <td><?= $p['title'] ?></td>
                    <td><?= $p['description'] ?></td>
                    <td><?= $p['thumb'] ?></td>
                    <td><?= $p['datetime'] ?></td>
                    <td><button class="edit_btn" data-id="<?= $p['id'] ?>" data-post="<?= $p['post'] ?>" data-title="<?= $p['title'] ?>" data-img="<?= $p['thumb'] ?>" data-desc="<?= $p['description'] ?>" data-cat1="<?= $p['cat_id1'] ?>" data-cat2="<?= $p['cat_id2'] ?>" data-cat3="<?= $p['cat_id3'] ?>">Edit</button></td>
                    <td><button value="<?= $p['id'] ?>" name="del_post">Delete</button></td>
                </form>
                <tr>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <script src="../assets/ckeditor5-build-classic/ckeditor.js"></script>
    <script>
        let youreditor;
        ClassicEditor
            .create(document.getElementById('post'))
            .then(editor => {
                window.editor = editor
                youreditor = editor
            })


        const editBtn = document.querySelectorAll('.edit_btn')
        const formId = document.querySelector('.post_id')
        const post = document.querySelector('.post')
        const img = document.querySelector('.img')
        const title = document.querySelector('.title')
        const desc = document.querySelector('.desc')
        const cat1 = document.querySelectorAll('.cat1')
        const cat2 = document.querySelectorAll('.cat2')
        const cat3 = document.querySelectorAll('.cat3')
        const cat3val = document.querySelector('#cat3val')
        const cat2val = document.querySelector('#cat2val')
        const cat1val = document.querySelector('#cat1val')
        const updateBtn = document.querySelector("#submit")
        editBtn.forEach((btn) => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                youreditor.data.set(e.currentTarget.dataset.post)
                formId.value = e.currentTarget.dataset.id
                img.value = e.currentTarget.dataset.img
                desc.value = e.currentTarget.dataset.desc
                title.value = e.currentTarget.dataset.title

                cat3val.value = e.currentTarget.dataset.cat3
                cat3.forEach((option) => {
                    if (cat3val.value == option.value) {
                        option.value = cat3val.value
                        option.setAttribute('selected', true)
                    }
                })
                cat2val.value = e.currentTarget.dataset.cat2

                cat2.forEach((option) => {
                    if (cat2val.value == option.value) {
                        option.value = cat2val.value
                        option.setAttribute('selected', true)
                    }
                })
                cat1val.value = e.currentTarget.dataset.cat1
                cat1.forEach((option) => {
                    if (cat1val.value == option.value) {
                        option.value = cat1val.value
                        option.setAttribute('selected', true)
                    }
                })
                updateBtn.name = "update_post"
                updateBtn.textContent = "Update"
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                })
            })
        })
        const btn = document.querySelector('#refresh')
        btn.addEventListener('click', () => {
            window.location.reload()
        })
    </script>
</body>

</html>