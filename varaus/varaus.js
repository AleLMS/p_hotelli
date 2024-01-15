import { Huone } from "./huone.js";

// Document ready
window.addEventListener('load', function () {
    console.log("Document loaded.");

    // Get post
    document.forms['searchForm'].addEventListener('submit', function (event) {
        // Interrupt default post behavior
        event.preventDefault();

        // AJAX
        ajaxSearch();
    });

}, false);

// Find rooms

function searchRooms() {
    document.getElementById("a").insertAdjacentHTML('beforebegin', "hello");
}

function ajaxSearch() {
    let ajax = new XMLHttpRequest();

    ajax.open('POST', 'etsi-huone.php', true);

    ajax.onload = () => {
        if (ajax.status === 200) {
            console.log(ajax.responseText)
        } else {
            console.log("error: " + ajax.status);
        }
    }

    console.log(Object.fromEntries(document.forms['searchForm']));


    const searchData = {
        location: document.getElementById("sijainti").value,
        roomSize: document.getElementById("huoneenKoko").value,
        startDate: document.getElementById("startDate").value,
        endDate: document.getElementById("endDate").value
    }

    const jsonData = JSON.stringify(searchData);

    ajax.send(jsonData);
}