

// Store data in local storage
function storeDataInLocalStorage(profiles, handlers) {
    localStorage.setItem('profileData', JSON.stringify(profiles));
    localStorage.setItem('profileHandlers', JSON.stringify(handlers));
}

// Retrieve data from local storage
// Retrieve data from local storage
function getDataFromLocalStorage() {
    const profileData = localStorage.getItem('profileData');
    const profileHandlers = localStorage.getItem('profileHandlers');

    // Parse only if data exists
    const profiles = profileData ? JSON.parse(profileData) : [];
    const handlers = profileHandlers ? JSON.parse(profileHandlers) : [];

    return { profiles, handlers };
}


// Render Profile Data Table
function renderProfileTable(profiles) {
    const profileTableBody = document.querySelector('table:nth-of-type(1) tbody');
    profileTableBody.innerHTML = '';

    profiles.forEach((profile, index) => {
        const row = `
            <tr>
                <th scope='row'>${index + 1}</th>
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
        profileTableBody.insertAdjacentHTML('beforeend', row);
    });
}

// Render Profile Handler Table
function renderHandlerTable(handlers) {
    const handlerTableBody = document.querySelector('#handlerTable tbody');

    handlerTableBody.innerHTML = '';

    handlers.forEach((handler, index) => {
        const row = `
            <tr>
                <th scope='row'>${index + 1}</th>
                <td>${handler.NAME}</td>
                <td>${handler.EMAIL}</td>
                <td>${handler.CONTACT}</td>
                <td>${handler.TOTAL_STUDENTS}</td>
                <td></td>
            </tr>
        `;
        handlerTableBody.insertAdjacentHTML('beforeend', row);
    });
}

// Filter profiles based on criteria
// Filter profiles based on criteria
function filterProfiles(filter, searchTerm) {
    const { profiles } = getDataFromLocalStorage();
    let filteredProfiles = profiles;

    if (filter === 'Name') {
        filteredProfiles = profiles.filter(profile =>
            profile.PROFILE_NAME.toLowerCase().includes(searchTerm.toLowerCase())
        );
    } 

   else if (filter === 'Admin') {
        filteredProfiles = profiles.filter(profile =>
            profile.PROFILE_ADMIN.toLowerCase().includes(searchTerm.toLowerCase())
        );
    } else if (filter === 'Institution') {
        filteredProfiles = profiles.filter(profile =>
            profile.INSTITUTION.toLowerCase().includes(searchTerm.toLowerCase())
        );
    } else if (filter === 'Writer') {
        filteredProfiles = profiles.filter(profile =>
            profile.PROFILE_HANDLER.toLowerCase().includes(searchTerm.toLowerCase())
        );
    } else if (filter === 'Status') {
        filteredProfiles = profiles.filter(profile =>
            profile.STATUS.toLowerCase().includes(searchTerm.toLowerCase())
        );
    }

    renderProfileTable(filteredProfiles);

}

// Event Listener for Filter
document.querySelector('#filter-button').addEventListener('click', (e) => {
    e.preventDefault();
    const selectedFilter = document.querySelector('#profile-filter').value;
    const searchTerm = document.querySelector('input[name="search_term"]').value;
    
    if (selectedFilter !== 'Select Filter') {
        filterProfiles(selectedFilter, searchTerm);
    } else {
        alert('Please select a filter.');
    }
});




// Initial Render on Page Load
document.addEventListener('DOMContentLoaded', () => {
    const { profiles, handlers } = getDataFromLocalStorage();
    renderProfileTable(profiles);
    renderHandlerTable(handlers);

    console.log(profileData);
    console.log(profileHandlers);

});
