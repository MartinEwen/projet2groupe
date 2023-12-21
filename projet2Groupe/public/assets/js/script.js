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