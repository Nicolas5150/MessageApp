function myFunction() {
    event.preventDefault();
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}

// Append an image to the screen
function addImage(what) {
  var img = new Image();
  img.setAttribute("class", 'profileImg');
  img.setAttribute("alt", 'GenderImg');
  img.setAttribute("width", "10%");
  img.setAttribute("height", "10%");
  img.src = what;
  var pic = document.getElementById("avatar");
  pic.appendChild(img);
}
