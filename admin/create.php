<!-- http://localhost/9jablogueApi/admin/uploads/36875.jpg -->
<?php
include '../modules/Data.php';
$data = new Data();
if (isset($_POST['add_did_u_knw'])) {
    $text = $_POST['text'];

    // get img and upload
    $file_name = $_FILES['img']['name'];
    $file_tmp_name = $_FILES['img']['tmp_name'];
    $exp_ext = explode('.', $file_name, 2);
    $ext = $exp_ext[1];
    $allowed = ['jpg', 'jpeg', 'png', 'jfif', 'webp'];
    $img =  $exp_ext[0] . '_' . time() . '.' . $ext;
    $path = './uploads/' . $img;



    try {
        //code...
        if (in_array($ext, $allowed)) {
            if (move_uploaded_file($file_tmp_name, $path)) {
                if ($data->add_did_u_knw($img, $text)) {
                    echo 'success';
                } else {
                    echo "err";
                }
            } else {
                echo 'err';
            }
        } else {
            echo 'file not format';
        }
    } catch (PDOException $th) {
        return $th->getMessage();
    }
}
if (isset($_POST['add_category'])) {
    $text = $_POST['category'];
    $desc = $_POST['cat_desc'];

    // get img and upload
    $file_name = $_FILES['cat_img']['name'];
    $file_tmp_name = $_FILES['cat_img']['tmp_name'];
    $exp_ext = explode('.', $file_name, 2);
    $ext = $exp_ext[1];
    $allowed = ['jpg', 'jpeg', 'png', 'jfif', 'webp'];
    $img =  $exp_ext[0] . '_' . time() . '.' . $ext;
    $path = './uploads/' . $img;



    try {
        //code...
        if (in_array($ext, $allowed)) {
            if (move_uploaded_file($file_tmp_name, $path)) {
                if ($data->add_category($text, $img, $desc)) {
                    echo 'success';
                } else {
                    echo "err";
                }
            } else {
                echo 'err';
            }
        } else {
            echo 'file not format';
        }
    } catch (PDOException $th) {
        return $th->getMessage();
    }
}
if (isset($_POST['add_post'])) {
    $post = $_POST['post'];
    $cat1 = $_POST['cat1'];
    $cat2 = $_POST['cat2'];
    $cat3 = $_POST['cat3'];
    $title = $_POST['post_title'];
    $desc = $_POST['post_desc'];

    // get img and upload
    $file_name = $_FILES['post_img']['name'];
    $file_tmp_name = $_FILES['post_img']['tmp_name'];
    $exp_ext = explode('.', $file_name, 2);
    $ext = $exp_ext[1];
    $allowed = ['jpg', 'jpeg', 'png', 'jfif', 'webp'];
    $img =  $exp_ext[0] . '_' . time() . '.' . $ext;
    $path = './uploads/' . $img;



    try {
        //code...
        if (in_array($ext, $allowed)) {
            if (move_uploaded_file($file_tmp_name, $path)) {
                if ($data->add_post($cat1, $cat2, $cat3, $title, $desc, $img, $post)) {
                    echo 'success';
                } else {
                    echo "err";
                }
            } else {
                echo 'err';
            }
        } else {
            echo 'file not format';
        }
    } catch (PDOException $th) {
        return $th->getMessage();
    }
}

if (isset($_POST['del_duk'])) {
    $id = $_POST['del_duk'];
    if ($data->del_duk($id)) {
        echo "item deleted";
    } else {
        echo "err";
    }
}

if (isset($_POST['del_cat'])) {
    $id = $_POST['del_cat'];
    if ($data->del_cat($id)) {
        echo "item deleted";
    } else {
        echo "err";
    }
}

if (isset($_POST['del_post'])) {
    $id = $_POST['del_post'];
    if ($data->del_post($id)) {
        echo "item deleted";
    } else {
        echo "err";
    }
}
if (isset($_POST['update_post'])) {
    // code....
    $id = $_POST['post_id'];
    $title = $_POST['post_title'];
    $desc = $_POST['post_desc'];
    $post = $_POST['post'];
    $cat1 = $_POST['cat1'];
    $cat2 = $_POST['cat2'];
    $cat3 = $_POST['cat3'];

    if ($_FILES['post_img']['name']) {
        $file_name = $_FILES['post_img']['name'];
        $file_tmp_name = $_FILES['post_img']['tmp_name'];
        $exp_ext = explode('.', $file_name, 2);
        $ext = $exp_ext[1];
        $allowed = ['jpg', 'jpeg', 'png', 'jfif', 'webp'];
        $thumb =  $exp_ext[0] . '_' . time() . '.' . $ext;
        $path = './uploads/' . $thumb;
        if (in_array($ext, $allowed)) {
            move_uploaded_file($file_tmp_name, $path);
        } else {
            echo 'file not format';
            die();
        }
    } else {
        $thumb = $_POST['img'];
    }

    if ($data->update_post($id, $title, $thumb, $desc, $post, $cat1, $cat2, $cat3)) {
        echo "Updated Successfully";
    } else {
        echo "fuckk!!";
    }
}
if (isset($_POST['update_duk'])) {
    $id = $_POST['duk_id'];
    $duk = $_POST['text'];

    if ($_FILES['img']['name']) {
        $file_name = $_FILES['img']['name'];
        $file_tmp_name = $_FILES['img']['tmp_name'];
        $exp_ext = explode('.', $file_name, 2);
        $ext = $exp_ext[1];
        $allowed = ['jpg', 'jpeg', 'png', 'jfif', 'webp'];
        $img =  $exp_ext[0] . '_' . time() . '.' . $ext;
        $path = './uploads/' . $img;
        if (in_array($ext, $allowed)) {
            move_uploaded_file($file_tmp_name, $path);
        } else {
            echo 'file not format';
            die();
        }
    } else {
        $img = $_POST['duk_img'];
    }

    if ($data->update_duk($id, $duk, $img)) {
        echo "Updated Successfully";
    } else {
        echo "fuckk!!";
    }
}
if (isset($_POST['update_category'])) {
    // code...
    $id = $_POST['cat_id'];
    $text = $_POST['category'];
    $desc = $_POST['cat_desc'];
    if ($_FILES['cat_img']['name']) {
        $file_name = $_FILES['cat_img']['name'];
        $file_tmp_name = $_FILES['cat_img']['tmp_name'];
        $exp_ext = explode('.', $file_name, 2);
        $ext = $exp_ext[1];
        $allowed = ['jpg', 'jpeg', 'png', 'jfif', 'webp'];
        $img =  $exp_ext[0] . '_' . time() . '.' . $ext;
        $path = './uploads/' . $img;
        if (in_array($ext, $allowed)) {
            move_uploaded_file($file_tmp_name, $path);
        } else {
            echo 'file not format';
            die();
        }
    } else {
        $img = $_POST['cat_imgg'];
    }
    if ($data->update_category($id, $text, $desc, $img)) {
        echo "Category with id of $id has been updated successfully";
    } else {
        echo "err";
    }
}
$getCategories = $data->get_categories();
$allCategories = $getCategories->fetchAll(PDO::FETCH_ASSOC);
