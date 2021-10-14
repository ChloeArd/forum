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

// animate a letter of title
let span = document.getElementsByClassName("title");
if (span) {
    letterColorAndFont();
    setTimeout(letterColorAndFont2, 10000);
    setTimeout(letterColorAndFont, 20000);

    function letterColorAndFont () {
        let time = 500;
        for (let x = 0; x < span.length; x++) {
            setTimeout(function () {
                span[x].style.color = "salmon";
                span[x].style.fontStyle = "italic";
                span[x].style.padding = "0 10px 0 10px";
                span[x].style.fontSize = "50px";
            }, time);
            time = time + 800;
            console.log(span[x]);
        }
    }

    function letterColorAndFont2 () {
        let time = 500;
        for (let x = 0; x < span.length; x++) {
            setTimeout(function () {
                span[x].style.color = "black";
                span[x].style.fontStyle = "normal";
                span[x].style.padding = "0";
                span[x].style.fontSize = "35px";
            }, time);
            time = time + 800;
            console.log(span[x]);
        }
    }
}