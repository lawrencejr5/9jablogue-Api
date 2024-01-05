<?php

include "../config/Database.php";

class Data extends Database

{
    private $stmt;
    private $sql;

    public function add_did_u_knw($img, $text)
    {
        $this->sql = "INSERT INTO did_u_knw(img, duk) VALUES(:img, :duk)";
        try {
            $this->stmt = $this->conn->prepare($this->sql);
            $this->stmt->bindParam(':img', $img);
            $this->stmt->bindParam(':duk', $text);
            $this->stmt->execute();
            return true;
        } catch (PDOException $err) {
            return $err->getMessage();
        }
    }
    public function add_category($category, $img, $desc)
    {
        $this->sql = "INSERT INTO category(category, img, description) VALUES(:category, :img, :description)";
        try {
            $this->stmt = $this->conn->prepare($this->sql);
            $this->stmt->bindParam(':img', $img);
            $this->stmt->bindParam(':category', $category);
            $this->stmt->bindParam(':description', $desc);
            $this->stmt->execute();
            return true;
        } catch (PDOException $err) {
            return $err->getMessage();
        }
    }
    public function add_post($cat_id1, $cat_id2, $cat_id3, $title, $description, $thumb, $post)
    {
        $this->sql = "INSERT INTO posts(cat_id1, cat_id2, cat_id3, title, description, thumb, post) 
                        VALUES(:cat_id1, :cat_id2, :cat_id3, :title, :description, :thumb, :post)";
        try {
            $this->stmt = $this->conn->prepare($this->sql);
            $this->stmt->bindParam(':cat_id1', $cat_id1);
            $this->stmt->bindParam(':cat_id2', $cat_id2);
            $this->stmt->bindParam(':cat_id3', $cat_id3);
            $this->stmt->bindParam(':title', $title);
            $this->stmt->bindParam(':thumb', $thumb);
            $this->stmt->bindParam(':description', $description);
            $this->stmt->bindParam(':post', $post);
            $this->stmt->execute();
            return $this->stmt;
        } catch (PDOException $err) {
            return $err->getMessage();
        }
    }

    // get


    public function get_categories()
    {
        $this->sql = "SELECT * FROM category";
        try {
            //code...
            $this->stmt = $this->conn->prepare($this->sql);
            $this->stmt->execute();
            return $this->stmt;
        } catch (PDOException $th) {
            $th->getMessage();
        }
    }

    public function get_posts()
    {
        $this->sql = 'SELECT c1.category as x, c2.category as y, c3.category as z, p.id, p.cat_id1, 
        p.cat_id2, p.cat_id3, p.title, p.post, p.thumb, p.description, p.datetime
        FROM posts p 
        LEFT JOIN category c1 ON p.cat_id1 = c1.id
        LEFT JOIN category c2 ON p.cat_id2 = c2.id
        LEFT JOIN category c3 ON p.cat_id3 = c3.id
        ';
        try {
            //code...
            $this->stmt = $this->conn->prepare($this->sql);
            $this->stmt->execute();
            return $this->stmt;
        } catch (PDOException $th) {
            $th->getMessage();
        }
    }

    public function get_a_post($id)
    {
        $this->sql = 'SELECT c1.category as x, c2.category as y, c3.category as z, p.id, p.cat_id1, 
        p.cat_id2, p.cat_id3, p.title, p.post, p.thumb, p.description, p.datetime
        FROM posts p 
        LEFT JOIN category c1 ON p.cat_id1 = c1.id
        LEFT JOIN category c2 ON p.cat_id2 = c2.id
        LEFT JOIN category c3 ON p.cat_id3 = c3.id
        WHERE p.id = :id
        ';
        try {
            //code...
            $this->stmt = $this->conn->prepare($this->sql);
            $this->stmt->bindParam(':id', $id);
            $this->stmt->execute();
            return $this->stmt;
        } catch (PDOException $th) {
            $th->getMessage();
        }
    }

    public function get_duk()
    {
        $this->sql = "SELECT * FROM did_u_knw";
        try {
            //code...
            $this->stmt = $this->conn->prepare($this->sql);
            $this->stmt->execute();
            return $this->stmt;
        } catch (PDOException $th) {
            $th->getMessage();
        }
    }

    public function del_duk($id)
    {
        $this->sql = 'DELETE FROM did_u_knw WHERE id = ?';
        try {
            $this->stmt = $this->conn->prepare($this->sql);
            $this->stmt->execute([$id]);
            return true;
        } catch (PDOException $th) {
            return $th->getMessage();
        }
    }

    public function del_cat($id)
    {
        $this->sql = 'DELETE FROM category WHERE id = ?';
        try {
            $this->stmt = $this->conn->prepare($this->sql);
            $this->stmt->execute([$id]);
            return true;
        } catch (PDOException $th) {
            return $th->getMessage();
        }
    }

    public function del_post($id)
    {
        $this->sql = 'DELETE FROM posts WHERE id = ?';
        try {
            $this->stmt = $this->conn->prepare($this->sql);
            $this->stmt->execute([$id]);
            return true;
        } catch (PDOException $th) {
            return $th->getMessage();
        }
    }

    public function update_duk($id, $text, $img)
    {
        $this->sql = "UPDATE did_u_knw SET duk = ?, img = ? WHERE id = ?";
        try {
            //code...
            $this->stmt = $this->conn->prepare($this->sql);
            $this->stmt->execute([$text, $img, $id]);
            return true;
        } catch (PDOException $th) {
            return $th->getMessage();
        }
    }

    public function update_category($id, $category, $description, $img)
    {
        $this->sql = "UPDATE category SET category = ?, description = ?, img = ? WHERE id = ?";
        try {
            //code...
            $this->stmt = $this->conn->prepare($this->sql);
            $this->stmt->execute([$category, $description, $img, $id]);
            return true;
        } catch (PDOException $th) {
            return $th->getMessage();
        }
    }

    public function update_post($id, $title, $thumb, $desc, $post, $cat1, $cat2, $cat3)
    {
        $this->sql = "UPDATE posts SET title = ?, thumb = ?, description = ?, post = ?, cat_id1 = ?, cat_id2 = ?, cat_id3 = ? WHERE id = ?";
        try {
            //code...
            $this->stmt = $this->conn->prepare($this->sql);
            $this->stmt->execute([$title, $thumb, $desc, $post, $cat1, $cat2, $cat3, $id]);
            return true;
        } catch (PDOException $th) {
            return $th->getMessage();
        }
    }
}
