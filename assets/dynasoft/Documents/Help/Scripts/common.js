window.onload = function () {
    var isIE6 = ! -[1, ] && !window.XMLHttpRequest;
    if (!isIE6) {
        window.parent.postMessage(
        // get height of the content
            document.getElementById("content") != null
            ? document.getElementById("content").scrollHeight + 50 //not the index page, 50 is for the div of class 'apiIndex'
            : document.getElementById("docs-index-content").scrollHeight //the index page
        // set target domain
            , "*"
    )
    }
};