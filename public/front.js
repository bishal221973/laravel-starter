const jsonUrl = './airport.json';

const searchWrapper = document.querySelector(".search-input");
const depart = document.querySelector("#depart");
const inputBox = searchWrapper.querySelector(".depart");
const suggBox = searchWrapper.querySelector(".autocom-box");
const icon = searchWrapper.querySelector(".icon");
const destination = document.querySelector("#destination");

const destinationInput = document.querySelector(".destination");


const searchWrappers = document.querySelector(".search-inputs");
const suggBox1 = searchWrappers.querySelector(".autocom-box1");
let linkTag = searchWrapper.querySelector("a");
let webLink;

let suggestions = [];

fetch(jsonUrl)
    .then(response => response.json())
    .then(data => {
        suggestions = data; // Store the entire data for filtering
    })
    .catch(error => console.error(error));
inputBox.onkeyup = (e) => {
    let userData = e.target.value;
    let emptyArray = [];


    if (userData) {
        emptyArray = suggestions.filter(airport => {
            return Object.values(airport).some(value =>
                String(value).toLowerCase().includes(userData.toLowerCase())
            );
        });

        console.log(emptyArray);

        emptyArray = emptyArray.map(airport => {
            return `<li>
            <div class="d-flex justify-content-between align-items-center">
                <div class="border p-2 iataCode label-10">${airport.code}</div> &nbsp;&nbsp;&nbsp;
                <div class="d-block iataAddress label-10" style="font-size:14px">${airport.city}, ${airport.country}</div>
            </div>
            </li>`;
        });



        searchWrapper.classList.add("active");
        showSuggestions(emptyArray);

        let allList = suggBox.querySelectorAll("li");
        for (let i = 0; i < allList.length; i++) {
            allList[i].setAttribute("onclick", "select(this)");
        }
    } else {
        searchWrapper.classList.remove("active");
    }
}

destinationInput.onkeyup = (e) => {
    let userData = e.target.value;
    let emptyArray = [];

    if (userData) {
        emptyArray = suggestions.filter(airport => {
            return Object.values(airport).some(value =>
                String(value).toLowerCase().includes(userData.toLowerCase())
            );
        });

        emptyArray = emptyArray.map(airport => {
            return `<li>
            <div class="d-flex justify-content-between align-items-center">
                <div class="border p-2 iataCode iataCode1 label-10" style="font-size:14px">${airport.code}</div> &nbsp;&nbsp;&nbsp;
                <div class="d-block iataAddress iataAddress1 label-10" style="font-size:14px">${airport.city}, ${airport.country}</div>
            </div>
            </li>`;
        });
        searchWrappers.classList.add("active"); // Show autocomplete box
        showSuggestions1(emptyArray);

        let allList = suggBox1.querySelectorAll("li");
        for (let i = 0; i < allList.length; i++) {
            allList[i].setAttribute("onclick", "select1(this)");
        }
    } else {
        searchWrappers.classList.remove("active"); // Hide autocomplete box
    }
}





function select(element) {
    let selectData = element.querySelector(".iataAddress").textContent; // Get the airport code
    inputBox.value = selectData;
    let code = element.querySelector(".iataCode").textContent; // Get the airport code
    depart.value = code;

    searchWrapper.classList.remove("active");
}

function showSuggestions(list) {
    let listData;
    if (!list.length) {
        userValue = inputBox.value;
        listData = `<li>${userValue}</li>`;
    } else {
        listData = list.join('');
    }
    suggBox.innerHTML = listData;
}


function select1(element) {
    let selectData = element.querySelector(".iataAddress1").textContent; // Get the airport code
    destinationInput.value = selectData;
    let code = element.querySelector(".iataCode1").textContent; // Get the airport code
    destination.value = code;

    searchWrappers.classList.remove("active");
}

function showSuggestions1(list) {
    let listData;
    if (!list.length) {
        userValue = inputBox.value;
        listData = `<li>${userValue}</li>`;
    } else {
        listData = list.join('');
    }
    suggBox1.innerHTML = listData;
}












