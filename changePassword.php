<?php
                                                            #-----------------------------#
                                                            #     Author - MI SHAJIB      #
                                                            #-----------------------------#
# Author - MI SHAJIB
#----------------------------------------------------

#----------------------------------------------------
#             Include Necessary Files
#----------------------------------------------------
  include 'lib/User.php';
  include 'inc/header.php';
  include 'inc/navbar.php';
?>

<?php
//Get User Id
if (isset($_GET['id'])) {
      $userId = (int)$_GET['id'];
      $sessionId = Session::get('id');
      //Check $userId & $sessionId is not equal then it will redirect into index.php page.
      if ($userId != $sessionId){
        header("Location: index.php");
      }
}
//Instantiate User Class
$user = new User();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updatePass'])) {
    //Called userPasswordUpdate() Method
    $updatePassword = $user->userPasswordUpdate($userId, $_POST);
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
                        <h2>Update Password <span class="float-right"><a class="btn btn-dark" href="profile.php?id=<?php echo $userId; ?>">Back</a></span></h2>
                    </div>
                    <div class="card-body">
                    <div style="max-width: 600px; margin: 0 auto;">
                        <?php
                          //Show Update Password Message
                            if (isset($updatePassword)) {
                              echo $updatePassword;
                            }
                         ?>
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label for="old_pass" class="col-sm-2 col-form-label">Old Password</label>
                                <div class="col-sm-10">
                                    <input type="password" name="old_pass" class="form-control" id="old_pass" placeholder="Old Password" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="new_pass" class="col-sm-2 col-form-label">New Password</label>
                                <div class="col-sm-10">
                                    <input type="password" name="new_pass" class="form-control" id="new_pass" placeholder="New Password" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" name="updatePass" class="btn btn-success">Update Password</button>
                                </div>
                            </div>
                        </form>
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
