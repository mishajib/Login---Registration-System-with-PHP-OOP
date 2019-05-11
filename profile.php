<?php
                                                            #-----------------------------#
                                                            #     Author - MI SHAJIB      #
                                                            #-----------------------------#

#----------------------------------------------------
# Include Necessary Files
#----------------------------------------------------
  include 'lib/User.php';
  include 'inc/header.php';
  include 'inc/navbar.php';
?>

<?php
//Get User Id
if (isset($_GET['id'])) {
      $userId = (int)$_GET['id'];
}
//Instantiate User Class
$user = new User();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    //Called userUpdate() method for user update
    $usrUpdate = $user->userUpdate($userId, $_POST);
}
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
                <div class="card">
                    <div class="card-header bg-success">
                        <h2>User Profile <span class="float-right"><a class="btn btn-dark" href="index.php">Back</a></span></h2>
                    </div>
                    <div class="card-body">
                    <div style="max-width: 600px; margin: 0 auto;">
                        <?php
                        //Show User Update Message
                            if (isset($usrUpdate)) {
                              echo $usrUpdate;
                            }
                         ?>
                        <?php
                          //Called getUserById() Method Called for getting single user by id.
                            $userData = $user->getUserById($userId);
                            if ($userData) {
                         ?>
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="<?php echo $userData->name; ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="username" class="col-sm-2 col-form-label">User Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="username" class="form-control" id="username" value="<?php echo $userData->username; ?>" placeholder="User Name" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" name="email" class="form-control" value="<?php echo $userData->email; ?>" id="email" placeholder="Email" required>
                                </div>
                            </div>
                            <?php
                              //get user id by session
                              // And Check $userId & $sessionId is matched or not. If matched then show the buttons otherwise it will not shown here.
                              $sessionId = Session::get('id');
                              if ($userId == $sessionId){
                             ?>
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" name="update" class="btn btn-success">Update</button>
                                    <a class="btn btn-info" href="changePassword.php?id=<?php echo $userId; ?>">Change Password</a>
                                </div>
                            </div>
                          <?php } ?>
                        </form>
                      <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
//Include footer.php page
include 'inc/footer.php';
?>
