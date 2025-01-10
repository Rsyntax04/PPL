// sidebar open & close
document.getElementById('toggle-btn').addEventListener('click', function() {
    var sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('collapsed');
  });

function toggleDropdown(event) {
    event.stopPropagation();

    var dropdownContent = event.target.closest('.nav-item').querySelector('.dropdown-content');

    if (dropdownContent.style.display === 'block') {
        dropdownContent.style.display = 'none';
    } else {
        dropdownContent.style.display = 'block';
    }
}

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.nav-link').forEach(function (navLink) {
        navLink.addEventListener('click', toggleDropdown);
    });
});

