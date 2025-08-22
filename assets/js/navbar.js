document.addEventListener('DOMContentLoaded', function () {
    // Wait a bit if navbar is loaded via fetch
    setTimeout(function () {
        var navbar = document.querySelector('.navbar');
        if (!navbar) return; // If navbar not found, exit
        window.addEventListener('scroll', function () {
            if (window.scrollY > 10) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    }, 300); // Adjust delay if needed
});
function popup() {
    document.getElementById('overlay').style.display = 'block';
    document.getElementById('box').style.display = 'block';
    document.body.style.overflow = 'hidden'; // Prevent scrolling when popup is open
}

function closePopup() {
    document.getElementById('overlay').style.display = 'none';
    document.getElementById('box').style.display = 'none';
    document.body.style.overflow = ''; // Restore scrolling
}

function deleteAccount() {
    if (confirm("Are you sure you want to delete your account? This action cannot be undone.")) {
        window.location.href = '../auth/delete_account.php';
    } else {
        alert("Account deletion cancelled.");
    }
}

// Close popup when clicking outside (on the overlay)
document.addEventListener('DOMContentLoaded', function () {
    var overlay = document.getElementById('overlay');
    if (overlay) {
        overlay.addEventListener('click', function (e) {
            if (e.target === this) {
                closePopup();
            }
        });
    }

   
});

