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
    var category = i.innerHTML;
    var child = i.children[1];
    var symbol = i.children[0];
    // i.innerHTML = category;
    
    if (!child.classList.contains("show")) {
        child.classList.add("show");
        symbol.classList.remove("fa-plus")
        symbol.classList.add("fa-minus")

    } else {
        child.classList.remove("show");
        symbol.classList.remove("fa-minus")
        symbol.classList.add("fa-plus")
    }
}