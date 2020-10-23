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