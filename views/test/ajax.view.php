<?php include_once "views/_header.php" ?>

<div class="container">

    <div class="row justify-content-center">
        <div class="col">

            <input type="text" id="user_number" value="5">
            <button id="btn_get_users">Fetch</button>

            <div id="users">

            </div>

        </div>
    </div>

</div>

<?php include_once "views/_footer.php" ?>

<script>

    function getFullName(data) {
        return `${data.first} ${data.last}`;
    }


    function fetchUsers(n) {
        $.get("https://randomuser.me/api/", {
            "results": n
        }).done(function (data) {

            let users = data.results;

            let root = document.getElementById("users");
            let child = document.querySelector("#users ul");

            if (child !== null)
                root.removeChild(child);

            let ul = document.createElement("ul");
            ul.classList.add("list-group");


            for (let i = 0; i < users.length; i++) {

                let li = document.createElement("li");
                li.classList.add("list-group-item");
                li.innerText = getFullName(users[i].name);
                ul.append(li);
            }

            root.append(ul);

        });
    }


    let textUserNumber = document.getElementById("user_number");
    let btnFetch = document.getElementById("btn_get_users");


    btnFetch.addEventListener('click', function () {
        fetchUsers(parseInt(textUserNumber.value));
    });


</script>
