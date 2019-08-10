/**
 * when a child item is clicked, it will refresh the map
 * with the name of the category
 * @param i is the child item
 */

var number = 0;

function clickedChild(i) {
    var category = i.children[1].innerText;
    var shortCode = ("[novo-map id=1 category='"+category+"']");
    shortCode = shortCode.replace("", "");
    var map = document.getElementById('mapShortcode');
    number = category;
    updateMap(shortCode,category);
    document.location.reload(false);
}

function searchBarClicked(i) {
    var searchMenu = document.getElementById("page-secondary");
    var map = document.getElementsByClassName("post-content__body")[0];
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
function updateMap(shortCode, number){
    jQuery.ajax({
        method: 'POST',
        url: '/wp-admin/admin-ajax.php',
        data: {
            action: 'handle_shortcode', //You can pass other parameters to be used in shortcode
            shortcode_name: shortCode,
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