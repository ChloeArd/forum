// If the modal window has the error ID then it appears and clicking on the cross makes it disappear.
if (document.getElementById("error")) {
    document.getElementById("closeModal").style.display = "block";
    document.getElementById("error").style.display = "block";
    closeModal("error");
}

// If the modal window has the ID success then it appears and clicking on the cross makes it disappear.
if (document.getElementById("success")) {
    document.getElementById("closeModal").style.display = "block";
    document.getElementById("success").style.display = "block";
    closeModal("success");
}

function closeModal (idModal) {
    document.getElementById("closeModal").addEventListener("click", function () {
        document.getElementById(idModal).style.display = "none";
    });
}