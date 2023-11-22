document.addEventListener("DOMContentLoaded", function() {
    var container = document.getElementById("scrollContainer");
    var innerDivs = container.querySelectorAll(".inner-div");

    container.addEventListener("scroll", function() {
        var scrollTop = container.scrollTop;

        innerDivs.forEach(function(div, index) {
            var divTop = div.offsetTop;
            var divBottom = divTop + div.clientHeight;
            var isVisible = (divTop >= scrollTop && divTop < scrollTop + container.clientHeight) ||
                            (divBottom > scrollTop && divBottom <= scrollTop + container.clientHeight);

            if (isVisible) {
                div.classList.add("visible");
            } else {
                div.classList.remove("visible");
            }
        });
    });
});
