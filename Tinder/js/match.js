// Eerste persoon op actief zetten
var eerstePersoon = document.querySelectorAll(".js-person")[0];
eerstePersoon.classList.add("is-active");

var melding = document.querySelector(".eind");
melding.style.display = "none";

var index = 0;

var likedPersons = [];
var dislikedPersons = [];

// Dislike button
document.querySelector("#dislike").addEventListener("click", function() {
    like(false);
})

// Like button
document.querySelector("#like").addEventListener("click", function() {
    like(true);
})

function like(isLiked) {
    var lengte = document.querySelectorAll(".js-person").length;

    var activeId = document.querySelector(".js-person.is-active").dataset.id;
    var PersonId = document.querySelector(".js-person").dataset.person;

    if (isLiked == true) {
        likedPersons.push(activeId);
    }
    else
    {
        dislikedPersons.push(activeId);
    }

    // vorige is active afsmijten
    document.querySelectorAll(".js-person")[index].classList.remove("is-active");

    // volgende persoon
    index++;

    // we zitten op het einde
    if (index == lengte)
    {
        var url = "/result.php?dislikedPersons=" + dislikedPersons.join() + "&likedPersons=" + likedPersons.join() + "&personId=" + PersonId;
        window.location.replace(url);
    } 
    else 
    {
        document.querySelectorAll(".js-person")[index].classList.add("is-active");
    }
}