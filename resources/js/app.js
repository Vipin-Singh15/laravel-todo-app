document.addEventListener("DOMContentLoaded", function () {
    // Hide success message after 2 seconds
    setTimeout(function () {
        const successMessage = document.getElementById("success-message");
        if (successMessage) {
            successMessage.style.display = "none";
        }
    }, 2000);

    // Hide error message after 2 seconds
    setTimeout(function () {
        const errorMessage = document.getElementById("error-message");
        if (errorMessage) {
            errorMessage.style.display = "none";
        }
    }, 2000);
});
