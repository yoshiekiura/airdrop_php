function menu() {
    var x = document.getElementById("nav-menu");
    var y = document.getElementById("nav")
    if (x.className === "flex") {
        x.className += " responsive";
        y.className += " column";
    } else {
        x.className = "flex";
        y.className = "flex";
    }
}
