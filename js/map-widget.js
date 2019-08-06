/**
 * when a child item is clicked, it will refresh the map
 * with the name of the category
 * @param i is the child item
 */
function clickedChild(i) {
    var category = i.innerHTML;
    i.innerHTML = category;
}

/**
 * when a parent item is clicked for the map nav, it displays its children
 * @param i is the parent list item
 */
function clickedParent(i) {
    var parents = document.getElementsByClassName("parentUL");
    var category = i.innerHTML;
    var child = i.parentElement.children[2];
    var symbol = i.parentElement.children[0];
    
    if (!child.classList.contains("show")) {
        for (var i = 0; i < parents.length; i++) {
            parents[i].children[2].classList.remove("show");
            parents[i].children[0].classList.remove("fa-minus");
            parents[i].children[0].classList.add("fa-plus");
        }
        child.classList.add("show");
        symbol.classList.remove("fa-plus")
        symbol.classList.add("fa-minus")

    } else {
        child.classList.remove("show");
        symbol.classList.remove("fa-minus")
        symbol.classList.add("fa-plus")
    }

}