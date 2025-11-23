window.onload = function () {
    const lookupBtn = document.getElementById("lookup");
    
    lookupBtn.addEventListener("click", function () {
        const country = document.getElementById("country").value.trim();

        fetch("world.php?country=" + encodeURIComponent(country))
            .then(response => response.text())
            .then(data => {
                document.getElementById("result").innerHTML = data;
            })
            .catch(error => {
                document.getElementById("result").innerHTML =
                    "<p>Error fetching data.</p>";
                console.error("Error:", error);
            });
    });
};
