<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {}

        .btn-color {
            background-color: #0e1c36;
            color: #fff;

        }

        .profile-image-pic {
            height: 200px;
            width: 200px;
            object-fit: cover;
        }



        .cardbody-color {
            background-color: #ebf2fa;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>

<body
    style="background-image: url('<?= base_url('./assets/images/naturebg.jpg') ?>'); background-size: cover; background-position: center; background-attachment:fixed;">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card my-5">
                    <?php if (session()->getFlashdata('error')): ?>

                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong> <?= session()->getFlashdata('error') ?></strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>


                    <form class="card-body cardbody-color p-lg-5" id="loginForm" action="<?= base_url('auth/login') ?>"
                        method="post">
                        <h2 class="text-center text-dark mt-0">Elevated Manager</h2>

                        <div class="text-center">
                            <img src="https://cdn.pixabay.com/photo/2016/03/31/19/56/avatar-1295397__340.png"
                                class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3" width="200px"
                                alt="profile">
                        </div>

                        <div class="mb-3">
                            <input type="text" class="form-control" id="Username" name="username" placeholder="Username"
                                required>
                        </div>

                        <div class="mb-3" style="position:relative;">
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Password" required>
                                <button type="button" id="togglePassword" class="btn btn-sm btn-link position-absolute"
                            style="top: 0.5rem; right: 0.5rem;">
                            Show
                        </button>
                        </div>


                        <div class="text-center"><button type="submit"
                                class="btn btn-color px-5 mb-5 w-100">Login</button></div>
                        <div id="emailHelp" class="form-text text-center mb-5 text-dark">Forgot your password? <a
                                href="#" class="text-dark fw-bold"> <b>Reset Now</b></a>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
    <!-- JavaScript for Form Validation and Toggle Password Visibility -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Form validation on submit
            document.getElementById("loginForm").addEventListener("submit", function (event) {
                const username = document.getElementById("Username").value.trim();
                const password = document.getElementById("password").value.trim();

                if (!username || !password) {
                    event.preventDefault(); // Prevent form submission
                    alert("Both username and password are required.");
                }
            });

            // Toggle password visibility
            const togglePasswordButton = document.getElementById("togglePassword");
            const passwordField = document.getElementById("password");

            togglePasswordButton.addEventListener("click", function () {
                // Toggle the type attribute between 'password' and 'text'
                const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
                passwordField.setAttribute("type", type);

                // Update button text based on current visibility state
                this.textContent = type === "password" ? "Show" : "Hide";
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>