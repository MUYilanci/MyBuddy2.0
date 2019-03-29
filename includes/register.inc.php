<!--<div class="container">
    <div class="jumbotron myBackground">
        <h1>Registreren</h1>
        <br>
        <form class="needs-validation" novalidate method="post" action="php/register.php">
            <div class="form-row">
                <div class="col-md-3 mb-3">
                    <input type="text" class="form-control" name="name" placeholder="Voornaam" value="" required>
                    <div class="invalid-feedback">
                        Vul uw voornaam in.
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-3 mb-3">
                    <input type="text" class="form-control" name="surname" placeholder="Achternaam" value="" required>
                    <div class="invalid-feedback">
                        Vul uw achternaam in.
                    </div>
                    <hr>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-3 mb-3">
                    <input type="text" class="form-control" name="email" placeholder="E-Mail" value="" required>
                    <div class="invalid-feedback">
                        Vul uw E-Mail in.
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-3 mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Wachtwoord" value=""
                           required>
                    <div class="invalid-feedback">
                        Vul uw Wachtwoord in.
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-3 mb-3">
                    <input type="password" class="form-control" name="repeat_password" placeholder="Herhaal Wachtwoord" value=""
                           required>
                    <div class="invalid-feedback">
                        Vul uw Wachtwoord in.
                    </div>
                </div>
            </div>
            <button class="btn btn-primary" name="submit" type="submit">Meld aan</button>
        </form>
    </div>
</div>

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
        'use strict';
        window.addEventListener('load', function () {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>-->

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
        <form class="login100-form validate-form" action="php/register.php" method="post">
					<span class="login100-form-title p-b-49">
						Register
					</span>

            <div class="wrap-input100 validate-input m-b-23" data-validate = "Name is required">
                <span class="label-input100">Name</span>
                <input class="input100" type="text" name="name" placeholder="Type your name">
                <span class="focus-input100" data-symbol="&#xf206;"></span>
            </div>

            <div class="wrap-input100 validate-input m-b-23" data-validate = "Surname is required">
                <span class="label-input100">Surname</span>
                <input class="input100" type="text" name="surname" placeholder="Type your surname">
                <span class="focus-input100" data-symbol="&#xf206;"></span>
            </div>

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

            <div class="wrap-input100 validate-input" data-validate="Password is required">
                <span class="label-input100">Password</span>
                <input class="input100" type="password" name="repeat_password" placeholder="Type your password">
                <span class="focus-input100" data-symbol="&#xf190;"></span>
            </div>

            <div class="text-right p-t-8 p-b-31">

            </div>

            <div class="container-login100-form-btn">
                <div class="wrap-login100-form-btn">
                    <div class="login100-form-bgbtn"></div>
                    <button class="login100-form-btn" type="submit" name="submit">
                        Register
                    </button>
                </div>
            </div>

            <div class="txt1 text-center p-t-54 p-b-23">
						<span class="txt1 p-b-17">
							Or
						</span>

                <a href="index.php?page=login" class="txt2">
                    Log in
                </a>
            </div>

        </form>
    </div>
</div>
</div>