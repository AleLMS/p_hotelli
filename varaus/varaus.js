import { Room } from "./huone.js";

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

    ajax.onload = async () => {
        if (ajax.status === 200) {
            console.log(ajax.responseText);
            let results = JSON.parse(ajax.responseText);
            console.log(results);
            document.getElementById('roomsContainer').innerHTML = '<div id="displayRoomsAfter" style="display: none; "></div>';
            await results.forEach((room) => AddNewRoom(room));
        } else {
            console.log(ajax.status + " " + ajax.statusText);
        }
    }

    //console.log(Object.fromEntries(document.forms['searchForm']));

    const searchData = {
        location: document.getElementById("sijainti").value,
        roomSize: document.getElementById("huoneenKoko").value,
        startDate: document.getElementById("startDate").value,
        endDate: document.getElementById("endDate").value
    }

    const jsonData = JSON.stringify(searchData);

    ajax.send(jsonData);
}

async function AddNewRoom(input) {
    let entryPoint = document.getElementById('displayRoomsAfter');
    let room = new Room(input['huone_ID'], input['hotelli_ID'], input['vuodepaikat']);
    console.log(room);
    room.displayBefore(entryPoint, 'roomTemplate');
}