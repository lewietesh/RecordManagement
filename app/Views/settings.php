<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Record Manager - Settings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg bg-dark border-body bg-body-tertiary" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <h1>ELATED CO.</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse p-2 " id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Settings</a>
                        </li>
                    </ul>
                    <div>
                        <a class="btn btn-warning" href="<?php echo base_url('logout') ?>"> Logout</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <div class="container my-5">
        <h2 class="mb-4">Settings</h2>

        <!-- Flash Messages -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success'); ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <p><?= $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Navigation Tabs -->
        <ul class="nav nav-tabs" id="settingsTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                    type="button" role="tab" aria-controls="profile" aria-selected="true">Profile</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="password-tab" data-bs-toggle="tab" data-bs-target="#password" type="button"
                    role="tab" aria-controls="password" aria-selected="false">Update Password</button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content mt-3" id="settingsTabsContent">
            <!-- Profile Tab -->
            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="text-center mb-4">
                    <img src="https://cdn.pixabay.com/photo/2016/03/31/19/56/avatar-1295397__340.png"
                        class="rounded-circle" width="150" alt="Profile Image">
                </div>
                <form>
                    <div class="mb-3">
                        <label for="adminName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="adminName" value="<?= esc($admin['ADMIN_NAME']); ?>"
                            readonly>
                    </div>
                    <div class="mb-3">
                        <label for="adminEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="adminEmail"
                            value="<?= esc($admin['ADMIN_EMAIL']); ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="adminBio" class="form-label">Bio</label>
                        <textarea class="form-control" id="adminBio" rows="3"
                            readonly><?= esc($admin['BIO']); ?></textarea>
                    </div>
                </form>
            </div>

            <!-- Update Password Tab -->
            <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                <form action="<?= base_url('settings/updatePassword') ?>" method="post">
                    <div class="mb-3">
                        <label for="currentPassword" class="form-label">Current Password</label>
                        <input type="password" class="form-control" id="currentPassword" name="current_password"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="newPassword" name="new_password" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirm_password"
                            required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Password</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
    // Select form and input fields
    const form = document.querySelector("form");
            const newPassword = document.getElementById("newPassword");
            const confirmPassword = document.getElementById("confirmPassword");

            // Password validation regex
            const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

            // Form submit event listener
            form.addEventListener("submit", function (event) {
                // Clear any previous alerts
                clearAlerts();

            // Prevent form submission if validation fails
            if (!validatePassword()) {
                event.preventDefault();
        }
    });

            // Function to validate passwords
            function validatePassword() {
        const newPasswordValue = newPassword.value;
            const confirmPasswordValue = confirmPassword.value;

            // Check if new password meets criteria
            if (!passwordRegex.test(newPasswordValue)) {
                renderAlert("Password must be at least 8 characters long and contain at least one letter, one number, and one special character.");
            return false;
        }

            // Check if new password and confirm password match
            if (newPasswordValue !== confirmPasswordValue) {
                renderAlert("New password and confirm password do not match.");
            return false;
        }

            return true;
    }

            // Function to render a Bootstrap alert
            function renderAlert(message) {
        const alertBox = document.createElement("div");
            alertBox.className = "alert alert-warning alert-dismissible fade show";
            alertBox.role = "alert";
            alertBox.innerHTML = `
            <strong>Warning!</strong> ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        `;

        // Insert alert before the form
        form.prepend(alertBox);
    }

    // Function to clear existing alerts
    function clearAlerts() {
        const existingAlerts = form.querySelectorAll(".alert");
        existingAlerts.forEach(alert => alert.remove());
    }
});
    </script>

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>