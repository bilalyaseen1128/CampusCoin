// ================= ADD CATEGORY MODAL =================

const openModal = document.getElementById("openModal");
const modalOverlay = document.getElementById("modalOverlay");
const closeModal = document.getElementById("closeModal");
const cancelModal = document.getElementById("cancelModal");
const categoryForm = document.getElementById("categoryForm");
const categoryName = document.getElementById("categoryName");

// Open Modal
if (openModal && modalOverlay) {
    openModal.addEventListener("click", function () {
        modalOverlay.classList.add("show");

        if (categoryName) {
            categoryName.focus();
        }
    });
}

// Close using X
if (closeModal && modalOverlay) {
    closeModal.addEventListener("click", function () {
        modalOverlay.classList.remove("show");
    });
}

// Close using Cancel
if (cancelModal && modalOverlay) {
    cancelModal.addEventListener("click", function () {
        modalOverlay.classList.remove("show");
    });
}

// Close by clicking outside modal
if (modalOverlay) {
    modalOverlay.addEventListener("click", function (event) {

        if (event.target === modalOverlay) {
            modalOverlay.classList.remove("show");
        }

    });
}

// Close with Escape key
document.addEventListener("keydown", function (event) {

    if (event.key === "Escape" && modalOverlay) {
        modalOverlay.classList.remove("show");
    }

});