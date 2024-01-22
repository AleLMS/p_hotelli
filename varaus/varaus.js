import { Room } from "./huone.js";

// Document ready
window.addEventListener('load', function () {
    dateEvents();

    // Limit room size selection
    const roomSizeSelector = document.getElementById('huoneenKoko');
    roomSizeSelector.addEventListener('change', function (e) {
        if (roomSizeSelector.value > parseInt(roomSizeSelector.getAttribute('max')))
            roomSizeSelector.value = parseInt(roomSizeSelector.getAttribute('max'));
    });

    // SAMPLE -> ?sijainti=1&huoneenKoko=1&startDate=1990-11-11&endDate=1990-12-12&sendSearch=Hae
    const urlSearch = window.location.search;
    if (urlSearch) crossSiteSearch(urlSearch);

    // Get post
    document.forms['searchForm'].addEventListener('submit', function (event) {
        // Interrupt default post behavior
        event.preventDefault();

        // Get form values
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
    const ajax = new XMLHttpRequest();

    ajax.open('POST', 'etsi-huone.php', true);

    ajax.onload = async () => {
        if (ajax.status === 200) {
            let results = JSON.parse(ajax.responseText);
            document.getElementById('roomsContainer').innerHTML = null;
            if (results != "No rooms found.") {
                await results.forEach((room) => addNewRoom(room));
            }

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

    const jsonData = JSON.stringify(searchData);
    ajax.send(jsonData);

    // Update URL to allow saving search data (history, bookmarks)
    let urlSearch = "?sijainti=" + location + "&huoneenKoko=" + roomSize + "&startDate=" + startDate + "&endDate=" + endDate + "&sendSearch=Hae";
    history.replaceState(null, null, urlSearch);

}

function crossSiteSearch(urlData) {
    // Parse URL data
    const params = new URLSearchParams(urlData);

    // Assign url data
    let location = params.get("sijainti");
    let roomSize = params.get("huoneenKoko");
    let startDate = params.get("startDate");
    let endDate = params.get("endDate");

    // set form values to urlData values
    document.getElementById("startDate").value = startDate;
    if (new Date(startDate) < new Date(endDate))
        document.getElementById("endDate").value = endDate;
    else
        document.getElementById("endDate").value = startDate;
    document.getElementById("huoneenKoko").value = roomSize;
    document.getElementById("sijainti").value = location;

    // Search
    ajaxSearch(location, roomSize, startDate, endDate);

}

function updateResultText() {
    // Update the "results" text
    let resultText = document.getElementById("numResults");
    let numRooms = document.getElementById("roomsContainer").childElementCount;
    resultText.innerHTML = "Löytyi " + numRooms + " huonetta";
}

function dateEvents() {
    const dateSelectors = document.getElementsByClassName("dateSelector");
    for (let i = 0; i < dateSelectors.length; i++) {
        dateSelectors[i].addEventListener("change", (e) => {
            checkDates();
        })
    }

}

function checkDates() {
    // Get date form fields
    const startDateSelector = document.getElementById("startDate");
    const endDateSelector = document.getElementById("endDate");

    // Store current date
    const today = new Date();
    const yyyy = today.getFullYear().toString().padStart(2, 0);
    const mm = (today.getMonth() + 1).toString().padStart(2, 0);
    const dd = today.getDate().toString().padStart(2, 0);

    // Make sure the arrival date cannot be in the past
    if (new Date(endDateSelector.value) < new Date(startDateSelector.value))
        endDateSelector.value = startDateSelector.value;

    // Make sure the exit date cannot be earlier than the arrival date
    if (new Date(mm + "-" + dd + "-" + yyyy) > new Date(startDateSelector.value))
        startDateSelector.value = yyyy + '-' + mm + '-' + dd;

}

async function addNewRoom(input) {
    const room = new Room(input);

    const parent = document.getElementById('roomsContainer');
    room.displayAsChild(parent, 'roomTemplate');

    //let entryPoint = document.getElementById('displayRoomsAfter');
    //room.displayBefore(entryPoint, 'roomTemplate');

}