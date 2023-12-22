document.addEventListener("DOMContentLoaded", () => {

    const div = this.document.querySelector("#addComment");
    const btn = this.document.querySelector("#addBtn");
    const cancelBtn = this.document.querySelector("#deleteBtn");

    btn.addEventListener("click", () => {
        div.classList.toggle("active");
        btn.classList.toggle("active");
        cancelBtn.classList.toggle("active");
    })

})

function mettreEnPremierPlan(image) {
    image.style.position = "fixed";
    image.style.top = "50%";
    image.style.left = "50%";
    image.style.transform = "translate(-50%, -50%)";
    image.style.zIndex = "999";
    image.onclick = function () {
        image.style.position = "";
        image.style.top = "";
        image.style.left = "";
        image.style.transform = "";
        image.style.zIndex = "";
        image.onclick = function () {
            mettreEnPremierPlan(image);
        };
    };
}