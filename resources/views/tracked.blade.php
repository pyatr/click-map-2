<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tracked sites</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">

    <style>
        html, body {
            width: 100%;
            height: 100%;
            margin: 0;
        }

        body {
            display: grid;
            justify-content: center;
            align-content: center;
        }

        table, th, td {
            border: 1px solid black;
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 5px;
            text-align: left;
        }

        button {
            margin: 4px;
        }
    </style>
</head>
<body>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<div id="tableRoot"></div>
<script>
    axios.get("http://" + window.location.host + "/get-tracked-domains").then((domains) => {
        let root = document.body;
        let newDomainInputField = document.createElement("input");
        let addNewButton = document.createElement("button");
        addNewButton.innerHTML = "Add new domain";
        addNewButton.addEventListener("click", () => {
            if (newDomainInputField.value !== "") {
                axios.post("http://" + window.location.host + "/add-new-domain", {
                    newDomain: newDomainInputField.value
                }).then(() => window.location.reload());
            }
        })
        if (domains.data.length === 0) {
            let note = document.createElement("div");
            note.innerHTML = "No tracked domains";
            root.appendChild(note);
            root.appendChild(newDomainInputField);
            root.appendChild(addNewButton);
        } else {
            let tableRoot = document.getElementById("tableRoot");
            let baseTable = document.createElement("div");
            let tableCode = "<table><th>Domain</th>";
            let deleteButtons = [];
            domains.data.forEach((table) => {
                let newDeleteButtonID = table.domain;
                deleteButtons.push(newDeleteButtonID);
                tableCode += '<tr><td><button id="' + newDeleteButtonID + '">-</button>' + table.domain + '</td></tr>';
            });
            tableCode += "</table>";
            baseTable.innerHTML = tableCode;
            tableRoot.appendChild(baseTable);
            tableRoot.appendChild(newDomainInputField);
            tableRoot.appendChild(addNewButton);
            deleteButtons.forEach((buttonID) => {
                document.getElementById(buttonID).addEventListener("click", () => {
                    axios.post("http://" + window.location.host + "/delete-domain", {
                        domainToDelete: buttonID
                    }).then(() => window.location.reload());

                });
            });
        }
    });
</script>
</body>
</html>
