import { Room } from "./huone.js";

// Document ready
window.addEventListener('load', function () {
    console.log("Document loaded.");

    // SAMPE -> ?sijainti=1&huoneenKoko=1&startDate=1990-11-11&endDate=1990-12-12&sendSearch=Hae
    const urlSearch = window.location.search;
    if (urlSearch) crossSiteSearch(urlSearch);

    // Get post
    document.forms['searchForm'].addEventListener('submit', function (event) {
        // Interrupt default post behavior
        event.preventDefault();

        let location = document.getElementById("sijainti").value;
        let roomSize = document.getElementById("huoneenKoko").value;
        let startDate = document.getElementById("startDate").value;
        let endDate = document.getElementById("endDate").value;

        // AJAX
        ajaxSearch(location, roomSize, startDate, endDate);

    });

}, false);


// Functions
function ajaxSearch(location, roomSize, startDate, endDate) {
    let ajax = new XMLHttpRequest();

    ajax.open('POST', 'etsi-huone.php', true);

    ajax.onload = async () => {
        if (ajax.status === 200) {
            let results = JSON.parse(ajax.responseText);
            document.getElementById('roomsContainer').innerHTML = '<div id="displayRoomsAfter" style="display: none; "></div>';
            await results.forEach((room) => AddNewRoom(room));
            updateResultText();
        } else {
            throw new Error(ajax.status + ":" + ajax.responseText + " | Bad request.");
        }
    }

    // Send JSON
    const searchData = {
        location: location,
        roomSize: roomSize,
        startDate: startDate,
        endDate: endDate
    }

    console.log("asdsd");
    console.log(searchData);
    const jsonData = JSON.stringify(searchData);
    ajax.send(jsonData);

    // Update URL to allow saving search data (history, bookmarks)
    let urlSearch = "?sijainti=" + location + "&huoneenKoko=" + roomSize + "&startDate=" + startDate + "&endDate=" + endDate + "&sendSearch=Hae";
    history.replaceState(null, null, urlSearch)
}

function crossSiteSearch(urlData) {

    // Parse URL data
    urlData = urlData.replace("?", "");
    urlData = urlData.split('&');

    // Instantiate array
    let search = [];

    // Splits search data to an array
    for (let i = 0; i < urlData.length; i++) {
        search[i] = urlData[i].split("=");
    }

    // Assign url data
    // Nasty assignment logic, fix later (search[entry][value])
    let location = search[0][1];
    let roomSize = search[1][1];
    let startDate = search[2][1];
    let endDate = search[3][1];

    // Search
    ajaxSearch(location, roomSize, startDate, endDate);

}

function updateResultText() {
    // Update results text
    let resultText = document.getElementById("numResults");
    let numRooms = document.getElementById("roomsContainer").childElementCount - 1; // -1 for the hidden element
    resultText.innerHTML = "Löytyi " + numRooms + " huonetta"
}

async function AddNewRoom(input) {
    let entryPoint = document.getElementById('displayRoomsAfter');
    let room = new Room(input['huone_ID'], input['hotelli_ID'], input['vuodepaikat']);
    console.log(room);
    room.displayBefore(entryPoint, 'roomTemplate');
}