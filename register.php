<?php
                                                            #-----------------------------#
                                                            #     Author - MI SHAJIB      #
                                                            #-----------------------------#
                                                            
#----------------------------------------------------
#             Include Needed Files
#----------------------------------------------------
include 'inc/header.php';
include 'inc/navbar.php';
include 'lib/User.php';
?>
<?php
    //Instantiate User Class
    $user = new User();
    //Check request method and register button clicked or not
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
        //Called userRegistration() Method from User.php Class.
        $usrRegi = $user->userRegistration($_POST);
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
                        <h2>User Registration</h2>
                    </div>
                    <div class="card-body">
                    <div style="max-width: 600px; margin: 0 auto;">
<?php
    //Show User Registration Message
    if(isset($usrRegi)){
        echo $usrRegi;
    }
?>
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Name" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="username" class="col-sm-2 col-form-label">User Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="username" class="form-control" id="username" placeholder="User Name" required>
                                </div>
                            </div>
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
                                    <button type="submit" name="register" class="btn btn-primary">Sign Up</button>
                                    <a href="login.php" class="btn btn-success">Login</a>
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
