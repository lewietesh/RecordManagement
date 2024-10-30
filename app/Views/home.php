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
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?php echo base_url('settings')?>">Settings</a>
                        </li>


                    </ul>
       <div>
       <a class="btn btn-warning" href="<?php echo base_url('logout')?>"> Logout</a>

       </div>
                </div>
            </div>
        </nav>
    </header>

    <div class="hero">
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
                <?php foreach ($profiledata as $index => $profile): ?>
                    <tr class="text-dark">
                        <th scope='row'><?= $index + 1 ?></th>
                        <td><?= esc($profile['PROFILE_NAME']) ?></td>
                        <td><?= esc($profile['PROFILE_ADMIN']) ?></td>
                        <td><?= esc($profile['PROFILE_HANDLER']) ?></td>
                        <td><?= esc($profile['INSTITUTION']) ?></td>
                        <td><?= esc($profile['TOTAL_COURSES']) ?></td>
                        <td><?= esc($profile['MAJOR']) ?></td>
                        <td><?= esc($profile['GENDER']) ?></td>
                        <td><?= esc($profile['STATUS']) ?></td>
                        <td>
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                data-bs-target="#editModal" data-id="${profile.ID}" data-name="${profile.PROFILE_NAME}"
                                data-admin="${profile.PROFILE_ADMIN}" data-handler="${profile.PROFILE_HANDLER}"
                                data-institution="${profile.INSTITUTION}" data-major="${profile.MAJOR}"
                                data-gender="${profile.GENDER}" data-status="${profile.STATUS}">
                                <i class="fa fa-edit" aria-hidden="true"></i> Edit
                            </button>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#deleteModal" data-id="${profile.ID}" data-name="${profile.PROFILE_NAME}">
                                <i class="fa fa-trash" aria-hidden="true"></i> Delete
                            </button>
                        </td>

                    </tr>
                <?php endforeach; ?>
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

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Courses</label>
                            <input type="number" name="courses" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Major</label>
                            <input type="text" name="major" class="form-control">
                        </div>

                        <div class="mb-3">
                            <select name="gender" class="form-select" aria-label="Default select example">
                                <option selected>Gender</option>
                                <option value="1">Male</option>
                                <option value="0">Female</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Status</label>
                            <select class="form-select" name="status" aria-label="Default select example">
                                <option selected>Status</option>
                                <option value="Active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="Terminated">Terminated</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- DELETE DATA MODAL -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete the profile?
                </div>

                <div class="modal-footer">
                    <form id="deleteForm" method="post" enctype="multipart/form-data"
                        action="<?= base_url('deleteprofile'); ?>">
                        <input type="hidden" name="id" id="deleteId">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- EDIT MODAL -->
    <!-- Edit Profile Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Example of the Edit Profile Form -->
                    <form id="editForm" action="<?= base_url('editprofile/' . $profile['ID']); ?>" method="post" enctype="multipart/form-data">

                        <input type="hidden" name="id" id="editId"
                            value="<?= isset($profile['ID']) ? esc($profile['ID']) : '' ?>">

                        <div class="mb-3">
                            <label for="editName" class="form-label">Name</label>
                            <input type="text" name="profile_name" class="form-control" id="editName"
                                value="<?= isset($profile['PROFILE_NAME']) ? esc($profile['PROFILE_NAME']) : '' ?>">
                        </div>

                        <div class="mb-3">
                            <label for="editAdmin" class="form-label">Admin</label>
                            <input type="text"  name="profile_owner" class="form-control" id="editAdmin"
                                value="<?= isset($profile['PROFILE_ADMIN']) ? esc($profile['PROFILE_ADMIN']) : '' ?>">
                        </div>

                        <div class="mb-3">
                            <label for="editHandler" class="form-label">Writer</label>
                            <input type="text" name="writer" class="form-control" id="editHandler"
                                value="<?= isset($profile['PROFILE_HANDLER']) ? esc($profile['PROFILE_HANDLER']) : '' ?>">
                        </div>

                        <div class="mb-3">
                            <label for="editInstitution" class="form-label">Institution</label>
                            <input type="text" name="institution" class="form-control" id="editInstitution"
                                value="<?= isset($profile['INSTITUTION']) ? esc($profile['INSTITUTION']) : '' ?>">
                        </div>

                        <div class="mb-3">
                            <label for="editMajor" class="form-label">Major</label>
                            <input type="text" name="major" class="form-control" id="editMajor"
                                value="<?= isset($profile['MAJOR']) ? esc($profile['MAJOR']) : '' ?>">
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Courses</label>
                            <input type="number" name="courses" class="form-control" id="editCourses"
                                value="<?= isset($profile['TOTAL_COURSES']) ? esc($profile['TOTAL_COURSES']) : '' ?>">
                        </div>

                        <div class="mb-3">
                            <label for="editGender" class="form-label">Gender</label>
                            <select name="gender" class="form-select" id="editGender">
                                <option value="1" <?= isset($profile['GENDER']) && $profile['GENDER'] === '1' ? 'selected' : '' ?>>Male</option>
                                <option value="0" <?= isset($profile['GENDER']) && $profile['GENDER'] === '0' ? 'selected' : '' ?>>Female</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="editStatus" class="form-label">Status</label>
                            <select name="status" class="form-select" id="editStatus">
                                <option value="Active" <?= isset($profile['STATUS']) && $profile['STATUS'] === 'Active' ? 'selected' : '' ?>>Active</option>
                                <option value="Inactive" <?= isset($profile['STATUS']) && $profile['STATUS'] === 'Inactive' ? 'selected' : '' ?>>Inactive</option>
                                <option value="Terminated" <?= isset($profile['STATUS']) && $profile['STATUS'] === 'Terminated' ? 'selected' : '' ?>>Terminated</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>


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
                <td>  
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" 
                        data-bs-target="#editModal" data-id="${profile.ID}" 
                        data-name="${profile.PROFILE_NAME}" data-admin="${profile.PROFILE_ADMIN}" 
                        data-handler="${profile.PROFILE_HANDLER}" data-institution="${profile.INSTITUTION}" 
                        data-major="${profile.MAJOR}"  data-courses="${profile.TOTAL_COURSES}" data-gender="${profile.GENDER}" 
                        data-status="${profile.STATUS}">
                        <i class="fa fa-edit" aria-hidden="true"></i> Edit
                    </button>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" 
                        data-bs-target="#deleteModal" data-id="${profile.ID}">
                        <i class="fa fa-trash" aria-hidden="true"></i> Delete
                    </button>
                </td>
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


        document.addEventListener('DOMContentLoaded', function () {

            // Add click event listener to all edit buttons
            document.querySelectorAll('[data-bs-target="#editModal"]').forEach(button => {
                button.addEventListener('click', function () {
                    // Create an object to store profile data from the button's data attributes
                    const profileData = {
                        id: this.getAttribute('data-id'),
                        name: this.getAttribute('data-name'),
                        admin: this.getAttribute('data-admin'),
                        handler: this.getAttribute('data-handler'),
                        institution: this.getAttribute('data-institution'),
                        major: this.getAttribute('data-major'),
                        courses: this.getAttribute('data-courses'),
                        gender: this.getAttribute('data-gender'),
                        status: this.getAttribute('data-status')
                    };

                    // Populate the modal fields using the profile data
                    document.getElementById('editId').value = profileData.id;
                    document.getElementById('editName').value = profileData.name;
                    document.getElementById('editAdmin').value = profileData.admin;
                    document.getElementById('editHandler').value = profileData.handler;
                    document.getElementById('editInstitution').value = profileData.institution;
                    document.getElementById('editMajor').value = profileData.major;
                    document.getElementById('editCourses').value = profileData.courses;

                    // Set the correct option for the gender select field
                    const genderSelect = document.getElementById('editGender');
                    genderSelect.value = profileData.gender;

                    // Set the correct option for the status select field
                    const statusSelect = document.getElementById('editStatus');
                    statusSelect.value = profileData.status;
                });
            });


            // 
            document.addEventListener('click', function (event) {
                if (event.target.closest('.btn-danger') && event.target.closest('[data-bs-target="#deleteModal"]')) {
                    const button = event.target.closest('.btn-danger');

                    const profileName = button.getAttribute('data-name');
                    const profileId = button.getAttribute('data-id');

                    const profileNameElement = document.getElementById('profileNameToDelete');
                    const deleteIdElement = document.getElementById('deleteId');

                    // Check if the elements exist before setting their properties
                    if (profileNameElement) {
                        profileNameElement.textContent = profileName;
                    }

                    if (deleteIdElement) {
                        deleteIdElement.value = profileId;
                    }
                }
            });


            // Event delegation for dynamically added elements
            document.addEventListener('click', function (event) {
                if (event.target.closest('.btn-danger') && event.target.closest('[data-bs-target="#deleteModal"]')) {
                    const button = event.target.closest('.btn-danger');

                    // Retrieve the profile name and ID from data attributes
                    const profileName = button.getAttribute('data-name');
                    const profileId = button.getAttribute('data-id');

                    // Populate the modal with the profile name and set the form action
                    document.getElementById('profileNameToDelete').textContent = profileName;
                    document.getElementById('deleteId').value = profileId;
                }
            });
        });



    </script>
</body>

</html>