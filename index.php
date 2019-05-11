<?php
                                                      #-----------------------------#
                                                      #     Author - MI SHAJIB      #
                                                      #-----------------------------#


#----------------------------------------------------
# Include User.php class and header.php & navbar.php
#----------------------------------------------------
    include 'lib/User.php';
    include 'inc/header.php';
    include 'inc/navbar.php';
    //Session Check for logged out user
    Session::checkSession();
?>
<?php
    //Get Login Message by Session
    $loginMsg = Session::get("loginMsg");
    if(isset($loginMsg)){
        echo $loginMsg;
    }
    //Set Login Message into null. when user reload the page login message will not be shown.
    Session::set("loginMsg", NULL);
?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card bg-info">
                    <div class="card-header text-center">
                        PHP Login Register System with OOP
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header bg-success">
                        <h2>User List <span class="float-right"><strong>Welcome!</strong>
                        <?php
                            //Get Logged in User "Name"
                            $name = Session::get("name");
                            if(isset($name)){
                                echo $name;
                            }
                        ?>
                        </span></h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Username</th>
                                <th scope="col">Email</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                              <?php
                                //Show All User Data Into Table
                                    $user = new User();
                                    $userData = $user->getUserData();
                                    if ($userData) {
                                      foreach ($userData as $key => $value) { ?>
                                        <tr>
                                            <th scope="row"><?php echo ++$key;?></th>
                                            <td><?php echo $value['name'];  ?></td>
                                            <td><?php echo $value['username'];  ?></td>
                                            <td><?php echo $value['email'];  ?></td>
                                            <td>
                                                <a class="btn btn-primary" href="profile.php?id=<?php echo $value['id']; ?>">View</a>
                                            </td>
                                        </tr>
                            <?php          }
                          }else { ?>

                            <tr>
                              <td colspan="5"><h2>No User Data Found....</h2></td>
                            </tr>

                  <?php        }
                               ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
    //Include footer.php page
    include 'inc/footer.php';
?>
