<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <!-- CATEGORY FORM -->
                <div class="card card-primary col-12">
                    <div class="card-header">
                        <h3 class="card-title"><strong>PUBLIC USERS ACCOUNT</strong></h3>
                    </div>

                    <!-- ADD ITEM BUTTON -->

                    <buttton class="btn btn-lg btn-success" data-toggle="modal" data-target="#form_modal"><span class="fas fa-plus"></span> ADD USER</buttton>
                </div>

                <!-- ADD IMAGE MODAL -->
                <div class="modal fade" id="form_modal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="POST" enctype="multipart/form-data">
                                <div class="modal-header">
                                    <h3 class="modal-title">Add Users</h3>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-12 ">

                                        <div class="form-group text-left">
                                            <label>Image:</label>
                                            <div id="selectedBanner"></div>
                                            <input type="file" class="form-control" name="user_avatar" id="user_avatar" required="required" />
                                        </div>
                                        <div class="form-group text-left">
                                            <label>First Name:</label>
                                            <input type="text" class="form-control" name="user_fname" required="required" />
                                        </div>
                                        <div class="form-group text-left">
                                            <label>Last Name:</label>
                                            <input type="text" class="form-control" name="user_lname" required="required" />
                                        </div>
                                        <div class="form-group text-left">
                                            <label>Email:</label>
                                            <input type="email" class="form-control" name="user_email" required="required" />
                                        </div>
                                        <div class="form-group text-left">
                                            <label>Username:</label>
                                            <input type="text" class="form-control" name="username" required="required" />
                                        </div>
                                        <div class="form-group text-left">
                                            <label>Password:</label>
                                            <input type="password" class="form-control" name="user_password" required="required" />
                                        </div>


                                    </div>
                                </div>
                                <br style="clear:both;" />
                                <div class="modal-footer">
                                    <button class="btn btn-danger" type="button" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
                                    <button class="btn btn-primary" name="submit_puser"><span class="glyphicon glyphicon-save"></span> Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- DELETE POP UP FORM (Bootstrap MODAL) -->
                <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"> Delete User Data </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>




                            <form method="POST">

                                <div class="modal-body">

                                    <input type="hidden" name="user_id" id="delete_id">

                                    <h4> Do you want to Delete this Data ?</h4>
                                </div>
                                <div class=" modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"> NO </button>
                                    <button type="submit" name="delete_data" class="btn btn-primary"> Yes </butron>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

                <!-- List  of Category Table -->
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">List of Public Users Account</h3>
                        </div>
                        <!-- /.card-header -->
                        <?php insertUsersPub(); ?>
                        <?php updateUsersPub(); ?>
                        <?php deleteUsersPub(); ?>
                        <div class="card-body">
                            <table id="example1" class="table table-head-fixed text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Date Created</th>
                                        <th></th>


                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $user_ses_id = $_SESSION['user_id'];

                                    $query = "SELECT * FROM public_users WHERE user_ID NOT IN($user_ses_id) ORDER BY user_id DESC ";
                                    $all_user_query = mysqli_query($connection, $query);
                                    if (!$all_user_query) {
                                        die("CONNECTION FAILED" . " " . mysqli_error($connection));
                                    }
                                    while ($row = mysqli_fetch_assoc($all_user_query)) {
                                        $user_id = $row['user_id'];
                                        $username = $row['username'];
                                        $user_avatar = $row['user_avatar'];
                                        $user_fname = $row['user_fname'];
                                        $user_lname = $row['user_lname'];
                                        $user_email = $row['user_email'];
                                        $joindate  = date("F j, Y, g:i a", strtotime($row["joindate"]));
                                        $user_password = $row['user_password'];

                                    ?>
                                        <tr>
                                            <td> <?php echo $user_id; ?> </td>
                                            <td><img src="<?php echo $user_avatar ?>" width='100px' height='100px' alt='user_avatar'></td>
                                            <td><?php echo $user_fname . " " . $user_lname; ?> </td>
                                            <td><?php echo $user_email; ?> </td>

                                            <td><?php echo  $joindate; ?> </td>
                                            <td>
                                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#edit<?php echo $user_id ?>"><i class='fas fa-pen'></i></button><button class='btn btn-danger deletebtn' data-toggle='modal'><i class='fas fa-trash'></i></button>
                                            </td>

                                            <!-- ========EDIT MODAL=========== -->
                                            <div class="modal fade" id="edit<?php echo $user_id ?>" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form method="POST" enctype="multipart/form-data" action="">
                                                            <div class="modal-header bg-info">
                                                                <h4 class="modal-title">Edit User</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="col-md-2"></div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <h5>Current Photo</h5>

                                                                        <img src="<?php echo $user_avatar ?>" height="120" width="150" />
                                                                        <hr>
                                                                        <h5 class="text-left">New Photo</h5>
                                                                        <input type="file" class="form-control" name="user_avatar" value="<?php echo $user_avatar; ?>" />
                                                                    </div>
                                                                    <div class="form-group text-left">
                                                                        <label for="editCategory">First Name:</label>
                                                                        <div class="input-group">
                                                                            <input type="hidden" value="<?php echo $user_id; ?>" name="user_id" />
                                                                            <input type="text" class="form-control mb-3" name="user_fname" id="user_fname" value="<?php echo $user_fname; ?>">
                                                                        </div>
                                                                        <label for="editCategory">Last Name:</label>
                                                                        <div class="input-group">

                                                                            <input type="text" class="form-control mb-3" name="user_lname" id="user_lname" value="<?php echo $user_lname; ?>">
                                                                        </div>
                                                                        <label for="editCategory">User Email:</label>
                                                                        <div class="input-group">
                                                                            <input type="text" class="form-control mb-3" name="user_email" id="user_email" value="<?php echo $user_email; ?>">
                                                                        </div>

                                                                        <label for="editCategory">Username:</label>
                                                                        <div class="input-group">
                                                                            <input type="text" class="form-control mb-3" name="username" id="username" value="<?php echo $username; ?>">
                                                                        </div>
                                                                        <label for="editCategory">User Password:</label>
                                                                        <div class="input-group">
                                                                            <input type="password" class="form-control mb-3" name="user_password" id="user_password" required>
                                                                        </div>

                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <br style="clear:both;" />
                                                            <div class="modal-footer">
                                                                <button class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
                                                                <button type="submit" class="btn btn-primary" name="update-pusers"><span class="glyphicon glyphicon-save"></span> Update</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </tr>

                                    <?php
                                    } ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

            </div>
        </div>

    </section>

</div>