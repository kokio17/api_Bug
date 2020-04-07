let xhr = new XMLHttpRequest();
let typeUpdate = "";
let params = "";
function MakeRequest(e, idBug) {
    if (typeof e.path[1] !== "undefined") {
        if (e.path[1].id === "modify") {
            typeUpdate = e.path[1].id;
            params = "typeUpdate=" + typeUpdate;
        } else if (e.path[0].className === "no_resolve") {
            typeUpdate = e.path[0].className;
            params = "typeUpdate=" + typeUpdate + "&status=1";
        }
        let url = "update/" + idBug;
        xhr.onreadystatechange = UpdateBug;
        xhr.open("POST", url);
        xhr.setRequestHeader(
            "Content-Type",
            "application/x-www-form-urlencoded"
        );
        xhr.send(params);
    }
}

function UpdateBug() {
    console.log(typeUpdate);
    if (xhr.readyState === XMLHttpRequest.DONE) {
        switch (typeUpdate) {
            case "no_resolve":
                let response = JSON.parse(xhr.responseText);
                console.log(response);
                if (response.success) {
                    let bug = document.getElementById("bug_" + response.id);
                    bug.innerHTML = "Résolu";
                    bug.onclick = "";
                    bug.className = "resolve";
                }
                break;
            case "modify":
                // console.log(xhr.status);
                break;
            default:
                break;
        }
    }
}

function FilterByStatus(e) {
    let params;
    if (e.srcElement.checked) {
        console.log(e.srcElement.checked);
        params = "filtre=0";
    } else {
        params = "filtre=1";
        console.log(e.srcElement.checked);
    }

    let url = "list";
    xhr.onreadystatechange = FiltreBug;
    xhr.open("POST", url);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.setRequestHeader("XMLHttpRequest", true);
    xhr.send(params);
}

function FiltreBug() {
    if (xhr.readyState === XMLHttpRequest.DONE) {
        // Supprimer ancien tableau
        // Récupérer le tableau de bugs
        // Faire un foreach
        // create element
        // innerhtml

        // let tableau = document.getElementById("tab-bugs");
        let tableau = document.createElement("div");
        tableau.className = "tab-bugs";
        tableau.id = "tab-bugs";

        let head = document.createElement("div");
        head.className = "thead";

        let rowHead = document.createElement("div");
        rowHead.innerHTML = "ID";
        head.appendChild(rowHead);

        rowHead = document.createElement("div");
        rowHead.innerHTML = "Titre";
        head.appendChild(rowHead);

        rowHead = document.createElement("div");
        rowHead.innerHTML = "Date de création";
        head.appendChild(rowHead);

        rowHead = document.createElement("div");
        rowHead.innerHTML = "Status";
        head.appendChild(rowHead);

        rowHead = document.createElement("div");
        rowHead.innerHTML = "Action";
        head.appendChild(rowHead);

        rowHead = document.createElement("div");
        rowHead.innerHTML = "Modifier";
        head.appendChild(rowHead);

        tableau.appendChild(head);

        let listeBugs = JSON.parse(xhr.responseText);
        listeBugs["bugs"].forEach(element => {
            let row = document.createElement("div");
            row.className = "trow";
            let rowL = document.createElement("div");
            rowL.innerHTML = element["id"];
            row.appendChild(rowL);

            rowL = document.createElement("div");
            rowL.innerHTML = element["titre"];
            row.appendChild(rowL);

            rowL = document.createElement("div");
            rowL.innerHTML = element["createAt"];
            row.appendChild(rowL);

            rowL = document.createElement("div");
            let a = document.createElement("a");
            if (element["status"] == 0) {
                a.innerHTML = "Non Résolu";
                a.className = "no_resolve";
                a.id = "bug_" + element.id;

                // a.addEventListener("click", MakeRequest(event, element.id));
            } else {
                a.innerHTML = "Résolu";
                a.className = "resolve";
            }
            rowL.appendChild(a);
            row.appendChild(rowL);

            rowL = document.createElement("div");
            a = document.createElement("a");
            a.innerHTML = "Détails";
            a.href = "show/" + element["id"];
            rowL.appendChild(a);
            row.appendChild(rowL);

            /* A faire modify */
            rowL = document.createElement("div");
            a = document.createElement("a");
            a.className = "modify";
            let i = document.createElement("i");
            i.className = "fas fa-file-invoice";
            a.appendChild(i);
            a.href = "edit/" + element["id"];
            rowL.appendChild(a);
            row.appendChild(rowL);

            tableau.appendChild(row);
        });

        document.getElementById("tab-bugs").innerHTML = tableau.innerHTML;

        addListenerNoResolve(listeBugs["bugs"]);
    }
}

function API() {
    // GET
    fetch("https://jsonplaceholder.typicode.com/posts/1", { method: "GET" })
        .then(response => response.json())
        .then(json => console.log(json));

    // DELETE
    fetch("https://jsonplaceholder.typicode.com/posts/1", { method: "DELETE" });

    // POST
    fetch("https://jsonplaceholder.typicode.com/posts", {
        method: "POST",
        body: JSON.stringify({
            title: "foo",
            body: "bar",
            userId: 1
        }),
        headers: {
            "Content-type": "application/json; charset=UTF-8"
        }
    })
        .then(response => response.json())
        .then(json => console.log(json));

    // PATCH - UPDATE - PUT
    fetch("https://jsonplaceholder.typicode.com/posts/1", {
        method: "PATCH",
        body: JSON.stringify({
            title: "foo"
        }),
        headers: {
            "Content-type": "application/json; charset=UTF-8"
        }
    })
        .then(response => response.json())
        .then(json => console.log(json));
}

function addListenerNoResolve(bugs) {
    console.log(bugs);
    bugs.forEach(element => {
        if (element.status == 0) {
            let bug = document.getElementById("bug_" + element.id);
            console.log(bug);
            bug.onclick = function() {
                MakeRequest(event, element.id);
            };
        }
    });
}
