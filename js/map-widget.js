function dropDownMapWidget() {
    var container = document.querySelector("#map-side");
    var listItems = container.querySelectorAll('li');
    for (let i = 0; i < listItems.length; i++) {
        listItems[i].addEventListener("click", clicked[i])
    }
    function clicked(i) {
        listItems[i].classList.add("boop")
    }
}
dropDownMapWidget();