window.onscroll = function () { scrollFunction() };

//function to change size of contents of Navbar when scrolled.
function scrollFunction()
{
    if (window.scrollY == 0)
    {
        document.getElementById("navbar").style.padding = "30px";
        document.getElementById("navbar").style.height = "200px";
        document.getElementById("mainTitle").style.fontSize = "100px";
    }
    else
    {
        if (window.scrollY <= 100) {
            //new_value = old_value - (window.scrollY / 100) * total_possible_change_in_value
            document.getElementById("navbar").style.padding = Math.trunc(30 - (window.scrollY / 100) * 30).toString().concat("px");
            document.getElementById("navbar").style.height = Math.trunc(200 - (window.scrollY / 100) * 100).toString().concat("px");
            document.getElementById("mainTitle").style.fontSize = Math.trunc(100 - (window.scrollY / 100) * 50).toString().concat("px");
        }
        else
        {
            document.getElementById("navbar").style.padding = "0px";
            document.getElementById("navbar").style.height = "100px";
            document.getElementById("mainTitle").style.fontSize = "50px";
        }
    }
}

//Show the menu when hamburger icon is pressed on small screen
var s;
var c = 0;
function showMenu()
{
    s = document.getElementById("navbar").getElementsByTagName("li");
    c++;
    if (c % 2 == 1)
    {
        for (let i = 0; i < s.length; i++)
        {
            s[i].style.display = "flex";
        }
    }
    else
    {
        for (let i = 1; i < s.length; i++)
        {
            s[i].style.display = "none";
        }
    }
}

window.addEventListener("click", reverseSearchBackground);
temp = 0;
var items = document.getElementsByClassName("search");
for (let i = 0; i < items.length; i++) {
    items[i].addEventListener("mouseover", changeSearchBackground);
    items[i].addEventListener("mouseout", reverseSearchBackground);
}

function changeSearchBackground(x = 0) {
    if (x == 3) {
        temp = x;
        items[0].value = "";
    }
    else {
        temp++;
    }
    for (let i = 0; i < items.length; i++) {
        items[i].style.backgroundColor = "rgb(22, 183, 15)";
    }
}

function reverseSearchBackground() {
    if (temp == 1) {
        for (let i = 0; i < items.length; i++) {
            items[i].style.backgroundColor = "rgb(134, 132, 39)";
        }
        temp--;
        items[0].value = "Search";
    }
    else if (temp == 3 || temp == 2) {
        temp--;
    }
}

items[1].addEventListener("click", focusSearch);
function focusSearch() {
    if (temp == 2) {
        //search operation here...
    }
    else {
        temp = 2;
        changeSearchBackground();
        items[0].focus();
        items[0].value = "";
    }
}