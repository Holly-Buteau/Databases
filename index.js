/**
 * Created by Origin on 8/7/2016.
 */

document.addEventListener('DOMContentLoaded', setYears);
document.addEventListener('DOMContentLoaded', makeRating);
document.addEventListener('DOMContentLoaded', makeGenre);

function makeRating() {
    var rating = ["Early Childhood (CE)", "Everyone (E)", "Everyone 10+ (E10+)", "Teen (T)", "Mature (M)", "Adult Only (AO)"];

    var sel = document.getElementById('vg_rating');

    for(var i = 0; i < rating.length; i++) {
        var opt = document.createElement("option");
        opt.value = i;
        opt.text = rating[i];
        sel.add(opt);
    }
}

function makeGenre() {
    var genre = ["Action", "Adventure", "Action-Adventure", "RPG", "Simulation", "Sports", "Strategy", "MMO", "FPS", "Horror",
    "Fighting", "Stealth", "Casual"];

    var sel = document.getElementById('vg_genre');

    for(var i = 0; i < genre.length; i++) {
        var opt = document.createElement("option");
        opt.value = genre[i];
        opt.text = genre[i];
        sel.add(opt);
    }
}

/*
 * Function to set the number of years in the drop down menu in the index.php
 */
function setYears() {
    var end = 1975;
    var start = new Date().getFullYear();
    var options = "";
    for (var year = start; year >= end+1; year--) {
        options += "<option name='" + year + "'>" + year + "</option>";
    }
    document.getElementById("vg_year").innerHTML = options;
}