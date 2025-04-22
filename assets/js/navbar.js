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

// Close popup when clicking outside (on the overlay)
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('overlay').addEventListener('click', function(e) {
        if (e.target === this) {
            closePopup();
        }
    });
});

