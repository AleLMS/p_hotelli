import { Room } from "./huone.js";

const bookButton = document.getElementById('bookRoom');
bookButton.addEventListener('click', (e) => {
    document.getElementById("fs-content").innerHTML = document.getElementById('varaus-step1').innerHTML;
    bookButton.style.display = "none";
});

var selectedRoom = [];

// Document ready
window.addEventListener('load', function () {

    dateEvents();
    datesToToday();

    // Limit room size selection
    const roomSizeSelector = document.getElementById('huoneenKoko');
    roomSizeSelector.addEventListener('change', function (e) {
        if (roomSizeSelector.value > parseInt(roomSizeSelector.getAttribute('max')))
            roomSizeSelector.value = parseInt(roomSizeSelector.getAttribute('max'));
    });

    // SAMPLE -> ?sijainti=1&huoneenKoko=1&startDate=1990-11-11&endDate=1990-12-12&sendSearch=Hae
    const urlSearch = window.location.search;
    if (urlSearch) crossSiteSearch(urlSearch);
    else ajaxSearch(1, 1, document.getElementById("startDate").value, document.getElementById("endDate").value)

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
    rooms = [];
    // store for later
    selectedRoom['location'] = location;
    selectedRoom['roomSize'] = roomSize;
    selectedRoom['startDate'] = startDate;
    selectedRoom['endDate'] = endDate;

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
            addEventListeners();
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

function datesToToday() {
    // Get date form fields
    const startDateSelector = document.getElementById("startDate");
    const endDateSelector = document.getElementById("endDate");

    // Store current date
    const today = new Date();
    const yyyy = today.getFullYear().toString().padStart(2, 0);
    const mm = (today.getMonth() + 1).toString().padStart(2, 0);
    const dd = today.getDate().toString().padStart(2, 0);

    startDateSelector.value = yyyy + '-' + mm + '-' + dd;
    endDateSelector.value = yyyy + '-' + mm + '-' + dd;
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

var rooms = [];
async function addNewRoom(input) {
    const room = new Room(input);
    rooms.push(room);
    const parent = document.getElementById('roomsContainer');
    room.displayAsChild(parent, 'roomTemplate');

}

function addEventListeners(element) {
    let a = Array.from(document.getElementsByClassName("varaa"));
    a.forEach(function (e) {
        e.addEventListener("click", function () {
            startBooking(e);
        });
    });
}

function startBooking(huoneID) {
    selectedRoom['huone-id'] = huoneID.value;
    console.log(selectedRoom);

    document.getElementById("fs-content").innerHTML = document.getElementById('varaus-step1').innerHTML;

    // Show form
    const form = document.getElementById('bookRoom');
    form.style.display = "flex";

    // Cancel button
    const cancel = document.getElementById('cancelBooking');
    cancel.addEventListener("click", (e) => {
        document.getElementById("fs-content").innerHTML = document.getElementById('varaus-step1').innerHTML;
        form.style.display = "none";
    }, { once: true });

    // Next button
    const next = document.getElementById('next');
    next.addEventListener("click", nextEvent, { once: true })
}

function nextEvent() {
    let formElements = [document.getElementById('firstname'), document.getElementById('lastname'),
    document.getElementById('email'), document.getElementById('phone')];
    if (checkFormEmpty(formElements)) {
        const next = document.getElementById('next');
        next.addEventListener("click", nextEvent, { once: true })
    } else {
        bookingSummary();
    }

}

function checkFormEmpty(elements) {
    let error = false;
    elements.forEach((e) => {
        if (e.value === "") {
            e.style.borderColor = "red";
            error = true;
        }
    })
    return error;
}

function bookingSummary() {
    let room = rooms.find((r) => Number(r.huone_ID) === Number(selectedRoom['huone-id']));
    console.log(room);
    // parse previous form, foreach variable replace in template 😴 . . .
    var results = [];
    let forms = document.forms['tiedotForm'];
    for (let i = 0; i < forms.length; i++) {
        results[forms[i].name] = forms[i].value;
    }

    let etunimi = forms['etunimi'].value;
    let sukunimi = forms['sukunimi'].value;
    let puhelin = forms['puhelin'].value;
    let sposti = forms['sposti'].value;
    let hotel = room['hotelli_ID'];
    let huoneID = room['huone_ID'];
    let size = room['vuodepaikat'];
    let enterDate = selectedRoom['startDate'];
    let exitDate = selectedRoom['endDate'];
    let price = room['hinta'];
    let roomName = room['nimi'];
    let kuva = room['kuva'];

    const orderData = new OrderData(etunimi, sukunimi, puhelin, sposti, hotel, huoneID, size, enterDate, exitDate, price, roomName, kuva);

    // Next page
    let template = document.getElementById("yhteenveto").innerHTML;
    const container = document.getElementById("formCont");

    for (const [key, value] of Object.entries(orderData)) {
        const replace = "{{" + key + "}}";
        console.log(key + " | " + value);
        template = template.replaceAll(replace, value);
    }
    container.innerHTML = template;

    // Confirm order button
    const next = document.getElementById('next');
    next.innerHTML = "Tee varaus"
    next.addEventListener("click", (e) => {
        console.log("lähetä varaus!");
        AjaxUpload(orderData, container);
    }, { once: true })
    // Ajax, upload booking into database, do error and confirm messages 😿 . . .

}

function AjaxUpload(data, container) {
    const ajax = new XMLHttpRequest();

    ajax.open('POST', 'varaa-huone.php', true);

    ajax.onload = async () => {
        if (ajax.status === 200) {
            console.log(ajax.responseText);
            container.innerHTML = "Huone varattu!";
            document.getElementById('next').remove();
            document.getElementById('cancelBooking').innerHTML = "Sulje";
        } else {
            let results = ajax.responseText;
            let code = ajax.status;
            console.log(results + " | " + code);
            container.innerHTML = "Huoneen varaaminen epäonnistui, virhe: " + results;
        }
    }

    // Send JSON
    const jData = {
        etunimi: data['etunimi'],
        sukunimi: data['sukunimi'],
        huoneID: data['huoneID'],
        enterDate: data['enterDate'],
        exitDate: data['exitDate'],
        sposti: data['sposti'],
        puhelin: data['puhelin']
    }

    // Send JSON
    const jsonData = JSON.stringify(jData);
    ajax.send(jsonData);
}

class OrderData {
    constructor(etunimi, sukunimi, puhelin, sposti, hotel, huoneID, size, enterDate, exitDate, price, roomName, kuva) {
        this.etunimi = etunimi;
        this.sukunimi = sukunimi;
        this.puhelin = puhelin;
        this.sposti = sposti;
        this.hotel = hotel;
        this.huoneID = huoneID;
        this.size = size;
        this.enterDate = enterDate;
        this.exitDate = exitDate;
        this.price = price;
        this.roomName = roomName;
        this.kuva = kuva;
    }
}