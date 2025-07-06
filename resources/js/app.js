import './bootstrap';


window.showToast = function (message, duration = 3000) {
    let toastContainer = document.getElementById("toast-container");

    if (!toastContainer) {
        toastContainer = document.createElement("div");
        toastContainer.id = "toast-container";
        toastContainer.className = "toast-container";
        document.body.appendChild(toastContainer);
    }

    const toast = document.createElement("div");
    toast.className = "toast";
    toast.textContent = message;
    toastContainer.appendChild(toast);

    setTimeout(() => toast.classList.add("show"), 100);
    setTimeout(() => {
        toast.classList.remove("show");
        setTimeout(() => toast.remove(), 300);
    }, duration);
};

// Optional CSS injection (once)
const toastStyle = document.createElement("style");
toastStyle.textContent = `
.toast-container {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
}
.toast {
    background-color: #f47b20;
    color: white;
    padding: 12px 20px;
    margin-bottom: 10px;
    border-radius: 4px;
    opacity: 0;
    transition: opacity 0.3s ease;
    font-family: 'Poppins', sans-serif;
}
.toast.show {
    opacity: 1;
}`;
document.head.appendChild(toastStyle);
