<?php

use Cloudinary\Api\Upload\UploadApi;

if (isset($_GET['an_edit'])) {
    $the_post_id = $_GET['an_edit'];
}

$query = "SELECT * FROM posts WHERE post_id =  $the_post_id";
$select_edit_posts = mysqli_query($connection, $query);
while ($row  = mysqli_fetch_assoc($select_edit_posts)) {

    $post_author = $row['post_author'];
    $post_title = $row['post_title'];
    $post_category_id = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];

    $post_content = html_entity_decode($row['post_content']);
    $post_tags = $row['post_tags'];
    $post_comment_count = $row['post_comment_count'];
    $post_date = $row['post_date'];
    $post_desc = $row['post_desc'];
}

if (isset($_POST['update_post'])) {
    $post_title = $_POST['post_title'];
    $post_category_id = $_POST['post_category_id'];
    $post_author = $_POST['post_author'];
    $post_status = $_POST['post_status'];
    $post_desc = $_POST['post_desc'];
    if (!empty($_FILES["post_image"]["tmp_name"])) {
        $post_image = (new UploadApi())->upload($_FILES["post_image"]["tmp_name"]);
        $image_url = $post_image['secure_url'];
    }
    $post_tags = $_POST['post_tags'];
    $post_content = htmlentities($_POST['post_content']);



    if (empty($post_image)) {
        $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
        $select_image = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_array($select_image)) {
            $post_image = $row['post_image'];
        }
    }

    $query = "UPDATE posts SET ";
    $query .= "post_title = '{$post_title}', ";
    $query .= "post_category_id = '{$post_category_id}', ";
    $query .= "post_date = now(), ";
    $query .= "post_author = '{$post_author}', ";
    $query .= "post_status = '{$post_status}', ";

    if (!empty($image_url)) {
        $query .= "post_image = '{$image_url}', ";
    }
    $query .= "post_tags = '{$post_tags}', ";
    $query .= "post_desc = '{$post_desc}', ";
    $query .= "post_content = '{$post_content}' ";
    $query .= "WHERE post_id = {$the_post_id}";

    $update_post = mysqli_query($connection, $query);

    if (!$update_post) {
        die("QUERY CONNECTION FAILED " . mysqli_error($connection));
    }
    echo "
    <div class=' alert alert-success alert-dismissible fade show'>
    <h3 class=' text-right'><strong>{$post_title}</strong> post successfully updated! <a class='btn btn-success' href='../../singleNews.php?an_id={$the_post_id}' target= '_blank'>View Post</a> or <a class='btn btn-primary' href='./posts.php'>Edit other posts</a></h3> <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button></div>";
}
?>


<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><a class="btn btn-warning" href="./posts.php"><i class="fas fa-arrow-left"></i> BACK</a> Edit post</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>

                <form method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="postTitle">Post Title</label>
                            <input type="text" id="inputName" class="form-control" name="post_title" required value="<?php echo $post_title; ?> ">
                        </div>

                        <div class="form-group">
                            <label for="PostCategory">Post Category</label>
                            <br>
                            <select class="custom-select col-3" name="post_category_id" required>

                                <?php

                                $query = "SELECT * FROM categories ";
                                $select_all_cat = mysqli_query($connection, $query);
                                while ($row = mysqli_fetch_assoc($select_all_cat)) {
                                    $cat_title = $row['cat_title'];
                                    $cat_id = $row['cat_id'];
                                    if ($cat_id == $post_category_id) {

                                        echo "<option value='$cat_id' selected> {$cat_title}</option>";
                                    } else {

                                        echo "<option value='$cat_id'> {$cat_title}</option>";
                                    }
                                } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputStatus">Post Author</label>
                            <input type="text" id="inputName" class="form-control" name="post_author" value="<?php echo $post_author; ?>">
                        </div>
                        <div class="form-group">
                            <label for="PostCategory">Post Status</label>
                            <br>
                            <select class="custom-select col-3" name="post_status" required>
                                <?php
                                echo "<option value = '$post_status'>{$post_status}</option>";
                                if ($post_status == "published") {
                                    echo "<option value='draft'>Draft</option>";
                                    echo "<option value='resubmit for approval'>Resubmit for approval</option>";
                                    echo "<option value='declined'>Decline</option>";
                                } else {
                                    echo "<option value ='published'>Publish</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputClientCompany">Post Image</label>
                            <div id="selectedBanner"><img id="selectedBanner" src="<?php echo $post_image; ?>" width="20%" alt="post image"></div>

                            <input type="file" class="form-control" id="img" name="post_image" value="<?php echo $post_image; ?>">
                        </div>
                        <div class="form-group">
                            <label for="PostTags">Post Tags</label>
                            <input type="text" id="inputName" class="form-control" name="post_tags" value="<?php echo $post_tags; ?>">
                        </div>
                        <div class="form-group">
                            <label for="PostTags">Post Desc</label>
                            <textarea id="" cols="30" rows="5" class="form-control" name="post_desc" value="<?php echo $post_desc; ?>" required></textarea>

                        </div>
                        <div class="form-group">
                            <label for="PostCOntent">Post Content</label>
                            <textarea name="post_content" id="summernote" class="form-control"><?php echo $post_content; ?></textarea>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-outline-primary btn-lg btn-block " name="update_post" value="UPDATE">
                </form>
                <!-- /.card-body -->


            </div>
        </div>
    </section>
</div>