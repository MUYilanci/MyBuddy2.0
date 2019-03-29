<div class="limiter">
    <div class="container-login100");">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
            <?php
            if (isset($_SESSION['error'])) {
                echo '<div class="alert alert-danger" role="alert">';
                echo $_SESSION['error'];
                echo '</div>';

                $_SESSION['error'] = NULL;
            }
            ?>
            <form class="login100-form validate-form" action="php/login.php" method="post">
					<span class="login100-form-title p-b-49">
						Login
					</span>

                <div class="wrap-input100 validate-input m-b-23" data-validate = "Email is required">
                    <span class="label-input100">Email</span>
                    <input class="input100" type="email" name="email" placeholder="Type your email">
                    <span class="focus-input100" data-symbol="&#xf206;"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <span class="label-input100">Password</span>
                    <input class="input100" type="password" name="password" placeholder="Type your password">
                    <span class="focus-input100" data-symbol="&#xf190;"></span>
                </div>

                <div class="text-right p-t-8 p-b-31">
                    <a href="#">
                        Forgot password?
                    </a>
                </div>

                <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button class="login100-form-btn" type="submit" name="submit">
                            Login
                        </button>
                    </div>
                </div>

                <div class="txt1 text-center p-t-54 p-b-20">
						<span class="txt1 p-b-17">
							Or Sign Up Using
						</span>

                    <a href="index.php?page=register" class="txt2">
                        Sign Up
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>