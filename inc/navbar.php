<?php
                                                        #-----------------------------#
                                                        #     Author - MI SHAJIB      #
                                                        #-----------------------------#

#------------------------------------------------------------------
# Check If user try log out then it will destroy the session
#------------------------------------------------------------------
  if (isset($_GET['action']) && $_GET['action'] == "logout") {
    Session::destroy();
  }
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <ul class="nav justify-content-center">
                    <?php
                    //Check if user is logged in then it will show other wise show else block
                        $id = Session::get("id");
                        $userLogin = Session::get("login");
                        if ($userLogin == true) {
                          ?>
                          <li class="nav-item">
                              <a class="nav-link" href="index.php">Home</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="profile.php?id=<?php echo $id; ?>">Profile</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="?action=logout">Logout</a>
                          </li>

                    <?php
                    }else {

                      ?>
                      <li class="nav-item">
                          <a class="nav-link" href="login.php">Login</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="register.php">Register</a>
                      </li>
                <?php
              }
                     ?>

                </ul>
            </div>
        </div>
    </div>
</div>
<br>
