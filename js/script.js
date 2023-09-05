// Function to toggle the button's visibility
function toggleScrollButton() {
    const scrollButton = document.getElementById('scrollButton');
    if (window.scrollY > 300) {
        scrollButton.style.display = 'block';
    } else {
        scrollButton.style.display = 'none';
    }
}

// Add an event listener to the window's scroll event
window.addEventListener('scroll', toggleScrollButton);

// Initial check for the button's visibility on page load
toggleScrollButton();

// Function to scroll to the top
// Function to scroll to the top
function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

