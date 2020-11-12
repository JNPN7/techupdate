localStorage.setItem("noKeyword", 0);
window.onscroll = function () { scrollFunction() };

//function to change size of contents of Navbar when scrolled.
var oldScrollValue = 0;
var gotoTop = document.getElementById("gotoTop");

function scrollFunction() {
    if(window.scrollY >= 300)
    {
        if(c%2 == 0)
        {
            if(window.scrollY > oldScrollValue)
            {
                document.getElementById("navbar").style.top = "-1000px";
            }
            else 
            {
                document.getElementById("navbar").style.top = "0px";
            }
        }
    }
    if(window.innerWidth > 1024) {
        scrollFunction2();
    }
    oldScrollValue = window.scrollY;
}

function scrollFunction2(){
    var newScrollValue = window.scrollY;
    if (window.scrollY == 0){
        document.getElementById("mainTitle").getElementsByTagName("a")[0].style.fontSize = "100px";
        document.getElementById("mainTitle").getElementsByTagName("img")[0].style.height = "100px";
    }
    else{
        if (window.scrollY <= 100) {
            if(Math.abs(newScrollValue - oldScrollValue) >= 2){
                //new_value = old_value - (window.scrollY / 100) * total_possible_change_in_value
                document.getElementById("mainTitle").getElementsByTagName("a")[0].style.fontSize = Math.trunc(100 - (window.scrollY / 100) * 50).toString().concat("px");
                document.getElementById("mainTitle").getElementsByTagName("img")[0].style.height = Math.trunc(100 - (window.scrollY / 100) * 50).toString().concat("px");
            }
        }
        else{
            document.getElementById("mainTitle").getElementsByTagName("a")[0].style.fontSize = "50px";
            document.getElementById("mainTitle").getElementsByTagName("img")[0].style.height = "50px";
        }
    }
    if(window.scrollY >= 500) {
        gotoTop.style.display = "block";
    }
    else {
        gotoTop.style.display = "none";
    }
}

//Show the menu when hamburger icon is pressed on small screen
var s;
var c = 0;
function showMenu(){
    s = document.getElementById("navbar").getElementsByTagName("ul");
    var icon = document.getElementById("menu").getElementsByTagName("i");
    c++;
    if (c % 2 == 1){
        s[0].style.display = "block";
        icon[0].classList.remove("fa-bars");
        icon[0].classList.add("fa-times");
    }
    else{
        s[0].style.display = "none";
        icon[0].classList.remove("fa-times");
        icon[0].classList.add("fa-bars");
    }
}

temp = 0;
var items = document.getElementsByClassName("search");
// for (let i = 0; i < items.length; i++) {
//     items[i].addEventListener("mouseover", changeSearchBackground);
//     items[i].addEventListener("mouseout", reverseSearchBackground);
// }

// function changeSearchBackground(x = 0) {
//     if (x == 3) {
//         temp = x;
//         items[0].value = "";
//     }
//     else {
//         temp++;
//     }
//     for (let i = 0; i < items.length; i++) {
//         items[i].style.backgroundColor = "rgb(22, 183, 15)";
//     }
// }

// function reverseSearchBackground() {
//     if (temp == 1) {
//         for (let i = 0; i < items.length; i++) {
//             items[i].style.backgroundColor = "rgb(134, 132, 39)";
//         }
//         temp--;
//         items[0].value = "Search";
//     }
//     else if (temp == 3 || temp == 2) {
//         temp--;
//     }
// }

// items[1].addEventListener("click", focusSearch);
// function focusSearch() {
//     if (temp == 2) {
//         //search operation here...
//     }
//     else {
//         temp = 2;
//         changeSearchBackground();
//         items[0].focus();
//         items[0].value = "";
//     }
// }

//Goto Top button
gotoTop.addEventListener("click", GOTO);
function GOTO() {
    window.scrollTo(0, 0);
}

var searchButton = document.getElementById("navbar").getElementsByClassName("searchButton");
var searchPage = document.getElementById("searchPage");
searchButton[0].addEventListener("click", toggleSearch);
searchPage.addEventListener("mouseup", function (e) {
    if(!searchPage.getElementsByClassName("searchPageBox")[0].contains(e.target)) {
        toggleSearch();
    }
});

function toggleSearch() {
    if(document.getElementById("searchPage").style.display == "block") {
        document.getElementById("searchPage").style.display = "none";
        document.getElementById("noKeywordMessage").style.display = "none";
    }
    else {
        document.getElementById("searchPage").style.display = "block";
        document.getElementById("searchPage").getElementsByClassName("searchPageBox")[0].focus();
    }
}

var user = document.getElementById("user");
user.addEventListener("click", toggleUserOptions);
//var userOptions = document.getElementById("userOptions");
function toggleUserOptions() {
    if(document.getElementById("userOptions").style.display == "flex") {
        document.getElementById("userOptions").style.display = "none";
    }
    else {
        document.getElementById("userOptions").style.display = "flex";
    }
}

var show_password = document.getElementsByClassName("showpassword");
var password = document.getElementsByClassName("password");
function toggleShowPassword(){
    if(show_password[0].classList.contains("fa-eye")){
        show_password[0].classList.remove("fa-eye");
        show_password[0].classList.add("fa-eye-slash");
        password[0].setAttribute("type", "password");
    }else if(show_password[0].classList.contains("fa-eye-slash")){
        show_password[0].classList.remove("fa-eye-slash");
        show_password[0].classList.add("fa-eye");
        password[0].setAttribute("type", "text");
    }
}

var postThumb = document.getElementsByClassName("post-thumb");
for(let i = 0; i < postThumb.length; i++) {
    postThumb[i].addEventListener("mouseover", function () {
        addTransformFunction(i);
    });
    postThumb[i].addEventListener("mouseout", function () {
        removeTransformFunction(i);
    });
}

function addTransformFunction(t) {
    postThumb[t].style.transform = "scale(1.2)";
}

function removeTransformFunction(t) {
    postThumb[t].style.transform = "scale(1)";
}

window.onload = function () {
    hideLoadingAnimation();
}

function hideLoadingAnimation () {
    setTimeout(() => {document.getElementById("loading").style.display = "none";}, 200);  
}

// Search
var searchBar = document.getElementById("searchPage").getElementsByClassName("searchPageBox")[0];
searchBar.addEventListener("keyup", function(event) {
    if (event.key == "Escape") {
        toggleSearch();
    }
  });


var replyBox = document.getElementById("replyBox");
if(document.body.contains(document.getElementById("commentContainer"))) {
    var replyLinks = document.getElementById("commentContainer").getElementsByClassName("replyButton");
    for(var i = 0; i < replyLinks.length; i++) {
        replyLinks[i].addEventListener("click", function () {
            toggleReplyBox();
        });
    }
    var ReplyLink = document.getElementById("commentContainer").getElementsByTagName("input")[0];
    ReplyLink.addEventListener("click", function () {
        toggleReplyBox();
    });
}


if(document.body.contains(document.getElementById("replyBox"))) {
    var textarea = document.getElementById("replyBox").getElementsByTagName("textarea")[0];
    textarea.addEventListener("keyup", function (event) {
        if(event.key == "Escape") {
            toggleReplyBox();
        }
    });

    var cancelButton = document.getElementById("replyBox").getElementsByClassName("cancelButton")[0];
    cancelButton.addEventListener("click", function () {
        toggleReplyBox();
    });

    replyBox.addEventListener("mouseup", function (e) {
        if(!replyBox.getElementsByClassName("replyForm")[0].contains(e.target)) {
            toggleReplyBox();
        }
    });

}

function toggleReplyBox() {
    if(replyBox.style.display == "flex") {
        replyBox.style.display = "none";
    }
    else {
        replyBox.style.display = "flex";
        textarea.focus();
    }
}




var signInAlert = document.getElementById("signInAlert");
signInAlert.addEventListener("mouseup", function (e) {
    if(!signInAlert.getElementsByClassName("alertBox")[0].contains(e.target)) {
        toggleSignInAlert();
    }
});

function toggleSignInAlert () {
    if(signInAlert.style.display == "flex") {
        signInAlert.style.display = "none";
    }
    else {
        signInAlert.style.display = "flex";
    }
}

var buttons = document.getElementById("signInAlert").getElementsByTagName("button");
buttons[0].addEventListener("click", function () {
    toggleSignInAlert();
});
buttons[1].addEventListener("click", function () {
    location.href = "login";
});
buttons[2].addEventListener("click", function () {
    location.href = "register";
});

if(document.body.contains(document.getElementById("subscribePopup"))) {
    var subscribePopup = document.getElementById("subscribePopup");
    subscribePopup.addEventListener("mouseup", function (e) {
        if(!subscribePopup.getElementsByClassName("subscribeMessageContainer")[0].contains(e.target)) {
            hideSubscribeMessage();
        }
    });
    var okayButton = document.getElementById("subscribePopup").getElementsByTagName("button")[0];
    okayButton.addEventListener("click", function() {
        hideSubscribeMessage();
    });
}


function hideSubscribeMessage() {
    document.getElementById("subscribePopup").style.display = "none";
}