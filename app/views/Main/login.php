<?php include 'app/views/_global/beforeContent.php'; ?>
    <div class="row">
        <form method="POST" action="<?php echo Configuration::BASE_URL; ?>login" class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 col-xl-6 offset-lg-3 align-middle mt-5" id="login-form">
            <div class="card">
                <div class="card-header">
                    Login
                </div>
                <?php if(isset($DATA['alert'])): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo htmlspecialchars($DATA['alert']); ?>
                    </div>
                 <?php endif; ?>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="user_name">User Name</label>
                            <input type="text" class="form-control" id="user_name" name="user_name" aria-describedby="emailHelp" placeholder="Enter user name" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                        </div>
                        
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </div>
        </form>
    </div>
<?php include 'app/views/_global/afterContent.php'; ?>