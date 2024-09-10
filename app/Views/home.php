<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Recordmanager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">


    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js"></script>

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
                    </ul>

                    </a>
                </div>
            </div>
        </nav>
    </header>

    <div class="hero">
    <?php if(session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success'); ?>
    </div>
<?php endif; ?>

<?php if(session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger">
        <?php foreach(session()->getFlashdata('errors') as $error): ?>
            <p><?= $error; ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

    </div>
    <div class="container p-2">
        <h3 class="text-center">PROFILES</h3>

        <div class="d-flex justify-content-end">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary m-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fa-solid fa-plus"></i>
                Add New Profile
            </button>
        </div>

        <section>
            <div class="filter-box  d-flex ">


                <div class="w-50 p-2">
                    <input type="text" class="form-control d-inline bg-secondary text-light " name="search_term"
                        id="exampleFormControlInput1" placeholder="search term">
                </div>

                <div class="p-2">
                    <select id="profile-filter" class="form-select d-inline" aria-label="Default select example">
                        <option selected>Select Filter</option>
                        <option value="Name">Name</option>
                        <option value="Admin">Admin</option>
                        <option value="Institution">Institution</option>
                        <option value="Writer">Writer</option>
                        <option value="Status">Status</option>

                    </select>
                </div>
                <div class="p-2">

                    <button type="button" id="filter-button" class=" btn d-inline   btn-warning ">Apply</button>
                </div>


            </div>
        </section>

        <table id="profileTable" class="table my-4 table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Student Name</th>
                    <th scope="col">Admin</th>
                    <th scope="col">Writer</th>
                    <th scope="col">Institution</th>
                    <th scope="col">Courses</th>
                    <th scope="col">Major</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>

                </tr>
            </thead>
            <tbody>
                <?php

                foreach ($profiledata as $index => $profile) {
                    echo "<tr>";
                    echo "<th scope='row'>" . ($index + 1) . "</th>";
                    echo "<td>" . $profile['PROFILE_NAME'] . "</td>";
                    echo "<td>" . $profile['PROFILE_ADMIN'] . "</td>";
                    echo "<td>" . $profile['PROFILE_HANDLER'] . "</td>";
                    echo "<td>" . $profile['INSTITUTION'] . "</td>";
                    echo "<td>" . $profile['TOTAL_COURSES'] . "</td>";
                    echo "<td>" . $profile['MAJOR'] . "</td>";
                    echo "<td>" . $profile['GENDER'] . "</td>";
                    echo "<td>" . $profile['STATUS'] . "</td>";

                    echo "<td>" . "</td>";

                    echo "</tr>";
                }
                ?>

            </tbody>
        </table>

        <div id="pagination" class="d-flex justify-content-center">
            <!-- Pagination buttons will be dynamically inserted here -->
        </div>
    </div>



    <section>
        <div class="container">
            <h3 class="text-center">WRITERS</h3>
            <table id="handlerTable" class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">NAME</th>
                        <th scope="col">EMAIL</th>
                        <th scope="col">CONTACT</th>
                        <th scope="col">PROFILES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php


                    foreach ($profilehandlers as $index => $profile) {
                        echo "<tr>";
                        echo "<th scope='row'>" . ($index + 1) . "</th>";
                        echo "<td>" . $profile["NAME"] . "</td>";
                        echo "<td>" . $profile["EMAIL"] . "</td>";
                        echo "<td>" . $profile["CONTACT"] . "</td>";
                        echo "<td>" . $profile["TOTAL_STUDENTS"] . "</td>";
                        echo "<td>" . "</td>";
                        echo "</tr>";
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </section>


    <!-- MODAL TO ADD PROFILE -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Profile</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('saveprofile'); ?>" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Name</label>
                            <input type="text" name="profile_name" class="form-control" id="exampleInput">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Admin</label>
                            <input type="text" name="profile_owner" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Writer</label>
                            <input type="text" name="writer" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Institution</label>
                            <input type="text" name="institution" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="<?php echo base_url('assets/js/main.js') ?>"></script>

    <script>
        // Convert PHP arrays to JSON
        const profileData = <?php echo json_encode($profiledata); ?>;
        const profileHandlers = <?php echo json_encode($profilehandlers); ?>;

        const rowsPerPage = 10;
        let currentPage = 1;


        function renderTablePage(page) {
            const tableBody = document.querySelector('#profileTable tbody');
            tableBody.innerHTML = ''; // Clear existing rows

            // Calculate the start and end indices for the current page
            const start = (page - 1) * rowsPerPage;
            const end = start + rowsPerPage;
            const paginatedData = profileData.slice(start, end);

            // Render rows for the current page
            paginatedData.forEach((profile, index) => {
                const row = `
            <tr>
                <th scope='row'>${start + index + 1}</th>
                <td>${profile.PROFILE_NAME}</td>
                <td>${profile.PROFILE_ADMIN}</td>
                <td>${profile.PROFILE_HANDLER}</td>
                <td>${profile.INSTITUTION}</td>
                <td>${profile.TOTAL_COURSES}</td>
                <td>${profile.MAJOR}</td>
                <td>${profile.GENDER}</td>
                <td>${profile.STATUS}</td>
                <td></td>
            </tr>
        `;
                tableBody.insertAdjacentHTML('beforeend', row);
            });
        }

        function renderPagination() {
            const paginationContainer = document.getElementById('pagination');
            paginationContainer.innerHTML = ''; // Clear existing pagination buttons

            const pageCount = Math.ceil(profileData.length / rowsPerPage);

            for (let i = 1; i <= pageCount; i++) {
                const button = document.createElement('button');
                button.className = 'btn btn-sm btn-primary mx-1';
                button.textContent = i;
                button.addEventListener('click', () => {
                    currentPage = i;
                    renderTablePage(currentPage);
                    updatePaginationButtons();
                });
                paginationContainer.appendChild(button);
            }
        }

        function updatePaginationButtons() {
            const buttons = document.querySelectorAll('#pagination button');
            buttons.forEach((button, index) => {
                if (index + 1 === currentPage) {
                    button.classList.add('active');
                } else {
                    button.classList.remove('active');
                }
            });
        }

        // Store data in local storage
        localStorage.setItem('profileData', JSON.stringify(profileData));
        localStorage.setItem('profileHandlers', JSON.stringify(profileHandlers));

        // Now, you can use this data directly in your JavaScript
        document.addEventListener('DOMContentLoaded', () => {
            renderProfileTable(profileData);
            renderHandlerTable(profileHandlers);
            renderTablePage(currentPage);
            renderPagination();
            updatePaginationButtons();
        });
    </script>
</body>

</html>