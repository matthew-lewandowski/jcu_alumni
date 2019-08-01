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
    i.classList.add("boop");
    var category = i.innerHTML;
    var children = i.children;
    var symbol = i.children[0].children[0];
    symbol.classList.add("fa-minus");
    symbol.classList.remove("fa-plus");
    console.log(symbol);
    i.innerHTML = category;
    for(var x = 0; x < children.length; x++){
        var tableChild = children[x];
        if (tableChild.classList.contains("show")) {
            tableChild.classList.remove("show");
            symbol.classList.remove("fa-minus");
            symbol.classList.add("fa-plus");
            
        } else {
            tableChild.classList.add("show");
            symbol.classList.add("fa-minus");
            symbol.classList.remove("fa-plus");
        }
    }
}