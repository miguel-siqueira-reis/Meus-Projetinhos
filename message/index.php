<?php
require_once('process/check.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/icon" href="img/favicon.png" />
    <link rel="stylesheet" href="./style/homepage.css">
    <link rel="stylesheet" href="./style/chat.css">
    <link rel="stylesheet" href="./style/profile.css">
    <link rel="stylesheet" href="./style/inbox.css">
    <script src="js/sweetalert2.js"></script>
    <script src="js/index.js"></script>
    <title>QuickTalk</title>

</head>
<body>
    <div id="loading">Loading&#8230;</div>

    <div id="inbox" class="colunm">
        <h2 class="title">Conversation</h2>
        <input type="text" name="username" class="seach_field" id="" maxlength="15" placeholder="Seach users" onkeyup="search()">
        <div id="search_container"></div>
        <div class="container contentSearch"></div>
    </div>

    <div id="chat" class="colunm"></div>

    <div id="profile" class="colunm">
        <h2 class="title">Profile</h2>
        <div class="container"></div>
        <div class="menu">
            <button>exit</button>
        </div>
    </div>
    <script>

   
    
    function loadInbox() {
        
    }
    


    function chat(id = 0) {

    }

    function search() {
        const containerSearch = $('#search_container');
        const term = $('input.seach_field').value;
        fadeIn(false,'#search_container');
        if (term.length >=3) {
            const url = "process/search.php?term=" + term;
            fetch(url).then(response => {
                if (!response.ok) {
                    console.log(response)
                    Swal.fire({
                        title: "Error!",
                        text: response.statusText,
                        icon: 'error',
                        confirmButtonText: "Ok"
                    })
                    return;
                }
                return response.json();
            }).then(data => {
                containerSearch.innerHTML = "";
                if (data.notFound) {
                    const p = document.createElement('p')
                    p.classList.add('noResult');
                    p.innerHTML = 'not found user.';
                    containerSearch.appendChild(p);
                    return;
                }
                data.forEach(user => {

                    const img = document.createElement('img')
                    img.setAttribute('src', `profilePics/${user.picture}`);
                    const p = document.createElement('p')
                    p.innerHTML = `${user.username}`;
    
                    const div = document.createElement('div')
                    div.classList.add('row');
                    
                    div.appendChild(img);
                    div.appendChild(p);
                    containerSearch.appendChild(div);
                })
                console.log(containerSearch);

            })
        } else {
            containerSearch.innerHTML = "";
        }
    }
    </script>
    <script type="module" src="js/index/index.js"></script>
</body>
</html>