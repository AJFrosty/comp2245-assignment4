window.onload = function () {
    const lookupBtn = document.getElementById("lookup");
    const lookupCitiesBtn = document.getElementById("lookup-cities");

    lookupBtn.addEventListener("click", function () {
        const country = document.getElementById("country").value.trim();

        fetch("world.php?country=" + encodeURIComponent(country))
            .then(response => response.text())
            .then(data => {
                document.getElementById("result").innerHTML = data;
            })
            .catch(error => console.error(error));
    });

    lookupCitiesBtn.addEventListener("click", function () {
        const country = document.getElementById("country").value.trim();

        fetch("world.php?country=" + encodeURIComponent(country) + "&lookup=cities")
            .then(response => response.text())
            .then(data => {
                document.getElementById("result").innerHTML = data;
            })
            .catch(error => console.error(error));
    });
};
