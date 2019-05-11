<?php
                                                              #-----------------------------#
                                                              #     Author - MI SHAJIB      #
                                                              #-----------------------------#

#----------------------------------------------------
#             Include Necessary Files
#----------------------------------------------------
include 'inc/header.php';
include 'inc/navbar.php';
include 'lib/User.php';
//Check Login for Logged In user
Session::checkLogin();
?>
<?php
//Instantiate User Class
    $user = new User();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
        $usrLogin = $user->userLogin($_POST);
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
                        <h2>User Login</h2>
                    </div>
                    <div class="card-body">
                    <div style="max-width: 600px; margin: 0 auto;">
<?php
  //Show User Login Message
    if(isset($usrLogin)){
        echo $usrLogin;
    }
?>
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" name="login" class="btn btn-primary">Sign in</button>
                                    <button type="submit" class="btn btn-link">Forgot Password?</button>
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
