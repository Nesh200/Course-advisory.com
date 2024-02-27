const btn = document.getElementById("change-color-btn");
btn.addEventListener("click", function() {
    const body = document.querySelector("body");
    body.style.backgroundColor = "yellow";
    const link = document.getElementById("link");
    link.style.color = 'salmon';
})
;
