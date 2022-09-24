function loadUsers(users, table) {
    const tableHead = table.querySelector("thead");
    const tableBody = table.querySelector("tbody");
    let headers = ["Id", "Title", "Completed"];

    // Clear table
    tableHead.innerHTML = "<tr></tr>";
    tableBody.innerHTML = "";

    // Fill headers
    headers.forEach(header => {
        const headerElement = document.createElement("th");
        headerElement.textContent = header;
        tableHead.querySelector("tr").appendChild(headerElement);
    });

    // Fill rows
    users.forEach(user => {
        const rowElement = document.createElement("tr");

        for (const property in user) {
            const cellElement = document.createElement("td");

            if (property === "userId") {
                continue;
            }

            if (property === "completed") {
                if (user[property] === true) {
                    cellElement.className = "true";
                } else {
                    cellElement.className = "false";
                }
            }

            cellElement.textContent = user[property];
            rowElement.appendChild(cellElement);
        }

        tableBody.appendChild(rowElement);
    })

}

function getDataFromApi() {
    fetch("https://jsonplaceholder.typicode.com/todos/")
        .then(response => response.json())
        .then(users => loadUsers(users, document.querySelector("table")));
}