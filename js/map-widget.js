/**
 * when a child item is clicked, it will refresh the map
 * with the name of the category
 * @param i is the child item
 */
function clickedChild(i) {
    var category = i.children[1].innerText;
    let itemsArray;


    if (localStorage.getItem('items')) {
        itemsArray = JSON.parse(localStorage.getItem('items')); //if localstorage, creates list
    } else {
        itemsArray = []; //checks if local storage is set
    }
    if (itemsArray.includes(category.toString())){
        for (var x = itemsArray.length - 1; x >= 0; x--) {
            if (itemsArray[x] === category){
                itemsArray.splice(x,1); //removes item if it already exists
            }
        }
    }  else {
        itemsArray.push(category); //adds item if it doesnt exist.
    }
    localStorage.setItem("items", JSON.stringify(itemsArray));
    var data = JSON.parse(localStorage.getItem('items')).join(); //returns comma seperated string


    updateMap(data);
    changeChildColor(i);
    //document.location.reload(false);
}


/**
 * simple function that changes the color of whatever is passed over
 * @param i element to add darken to.
 */
function changeChildColor(i) {
    i.classList.toggle("darken");
}


/**
 * when the "Search by" button is clicked, it adds classes to change the width
 * of different elements and toggles the symbol
 * @param i is the symbol
 */
function searchBarClicked(i) {
    var searchMenu = document.getElementById("page-secondary");
    var map = document.getElementById("mapShortcode");
    var symbols = document.getElementsByClassName("fa-plus")[1];
    if (i.classList.contains("fa-bars")) {
        i.classList.remove("fa-bars");
        i.classList.add("fa-times");
        searchMenu.classList.add("show-menu");
        map.classList.add("small-map");
        symbols.classList.add("hide");
    } else {
        i.classList.remove("fa-times");
        i.classList.add("fa-bars");
        searchMenu.classList.remove("show-menu");
        map.classList.remove("small-map");
        symbols.classList.add("hide");
    }


}

/**
 * sends the map shortcode and category number to functions.php
 * to change the Session var to the shortcode and reload page.
 * can also be used to refresh shortcode without refreshing page,
 * does not work with novo-maps.
 * @param shortCode
 * @param number
 */
function updateMap(number){
    jQuery.ajax({
        method: 'POST',
        url: '/wp-admin/admin-ajax.php',
        data: {
            action: 'handle_shortcode', //You can pass other parameters to be used in shortcode
            shortcode_number: number,
        },
        success: function(data)
        {
            // run recieved shortcode and display it in addcontainer
            document.getElementById("mapShortcode").innerHTML = data;
        }
    });
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