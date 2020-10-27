window.onscroll = function () { scrollFunction() };

//function to change size of contents of Navbar when scrolled.
var oldScrollValue = 0;
var gotoTop = document.getElementById("gotoTop");
function scrollFunction2()
{
    var newScrollValue = window.scrollY;
    if (window.scrollY == 0)
    {
        document.getElementById("mainTitle").style.fontSize = "100px";
    }
    else
    {
        if (window.scrollY <= 100) {
            if(Math.abs(newScrollValue - oldScrollValue) >= 2)
            {
                //new_value = old_value - (window.scrollY / 100) * total_possible_change_in_value
                document.getElementById("mainTitle").style.fontSize = Math.trunc(100 - (window.scrollY / 100) * 50).toString().concat("px");
            }
        }
        else
        {
            document.getElementById("mainTitle").style.fontSize = "50px";
        }
    }
    if(window.scrollY >= 500) {
        gotoTop.style.display = "block";
    }
    else {
        gotoTop.style.display = "none";
    }
}

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

//Show the menu when hamburger icon is pressed on small screen
var s;
var c = 0;
function showMenu()
{
    s = document.getElementById("navbar").getElementsByTagName("ul");
    var icon = document.getElementById("menu").getElementsByTagName("i");
    c++;
    if (c % 2 == 1)
    {
        s[0].style.display = "block";
        icon[0].classList.remove("fa-bars");
        icon[0].classList.add("fa-times");
    }
    else
    {
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
    }
    else {
        document.getElementById("searchPage").style.display = "block";
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