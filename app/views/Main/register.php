<?php include 'app/views/_global/beforeContent.php'; ?>
    <div class="row">
        <form method="POST" id="register-form" action="<?php echo Configuration::BASE_URL; ?>register" class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 col-xl-6 offset-lg-3 mt-3" onsubmit="submitForm()">
            <div class="card">
                <div class="card-header">
                    Register
                </div>
                <?php if(isset($DATA['warning'])): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo htmlspecialchars($DATA['warning']); ?>
                    </div>
                <?php endif; ?>
                <?php if(isset($DATA['success'])): ?>
                    <div class="alert alert-success" role="success">
                        <?php echo htmlspecialchars($DATA['success']); ?>
                    </div>
                <?php endif; ?>
                <div class="card-body">
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <p id="p_email"></p>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email" onkeyup="emailValidation()" required>
                    </div>

                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <p id="p_first_name"></p>
                        <input type="text" class="form-control" id="first_name" name="first_name" aria-describedby="emailHelp" placeholder="Enter first name" onkeyup="firstnameValidation()" required>
                    </div>

                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <p id="p_last_name"></p>
                        <input type="text" class="form-control" id="last_name" name="last_name" aria-describedby="emailHelp" placeholder="Enter last name" onkeyup="lastnameValidation()" required>
                    </div>

                    <div class="form-group">
                        <label for="user_name">User Name</label>
                        <p id="p_user_name"></p>
                        <input type="text" class="form-control" id="user_name" name="user_name" aria-describedby="emailHelp" placeholder="Enter user name" onkeyup="usernameValidation()" required>
                    </div>

                    <div class="form-group">
                        <label for="password1">Password</label>
                        <p id="p_password1"></p>
                        <input type="password" class="form-control" id="password1" name="password1" placeholder="Enter password" onkeyup="password1Validation()" required>
                    </div>

                    <div class="form-group">
                        <label for="password2">Reapeat Password</label>
                        <p id="p_password2"></p>
                        <input type="password" class="form-control" id="password2" name="password2" placeholder="Reapeat password" onkeyup="password2Validation()" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </div>
        </form>
    </div>

<?php include 'app/views/_global/afterContent.php'; ?>