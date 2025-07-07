const ToastUtils = {
    toastQueue: [],
    MAX_TOASTS: 5,
    TRANSITION_DURATION: 300,
    timeouts: [],
    showToast: (message, duration = 3000) => {
        if (ToastUtils.toastQueue.length >= ToastUtils.MAX_TOASTS) {
            console.log("Max toasts reached:", ToastUtils.MAX_TOASTS);
            return;
        }
        let toastContainer = document.getElementById("toast-container");
        if (!toastContainer) {
            console.warn("Toast container not found. Creating one.");
            toastContainer = document.createElement("div");
            toastContainer.id = "toast-container";
            toastContainer.className = "toast-message-container";
            document.body.appendChild(toastContainer);
        }
       
        const toast = document.createElement("div");
        toast.className = "toast";
        toast.setAttribute("role", "alert");
        toast.setAttribute("aria-live", "polite");
        toast.setAttribute("data-message", message);
        toast.textContent = message;
        toastContainer.appendChild(toast);
        ToastUtils.toastQueue.push(toast);
        console.log("Toast added to DOM:", message);
        const showTimeout = setTimeout(() => {
            toast.classList.add("show");
            console.log("Toast class 'show' added:", message);
        }, 100);
        const hideTimeout = setTimeout(() => {
            toast.classList.remove("show");
            setTimeout(() => {
                toast.remove();
                ToastUtils.toastQueue.splice(ToastUtils.toastQueue.indexOf(toast), 1);
                console.log("Toast removed from DOM:", message);
            }, ToastUtils.TRANSITION_DURATION);
        }, duration);
        ToastUtils.timeouts.push(showTimeout, hideTimeout);
    },
    initializeStyles: () => {
        if (document.querySelector("style#toast-styles")) return;
        const style = document.createElement("style");
        style.id = "toast-styles";
        style.textContent = `
            .toast-message-container { position: fixed; top: 20px; right: 20px; z-index: 10000 !important; }
            .toast { background-color: #f47b20; font-family: 'Poppins', Arial, sans-serif; color: white; padding: 12px 20px; margin-bottom: 10px; border-radius: 4px; opacity: 0; transition: opacity 0.3s ease; }
            .toast.show { opacity: 1; }
        `;
        document.head.appendChild(style);
        console.log("Toast styles initialized");
    }
};

window.ToastUtils = ToastUtils;
ToastUtils.initializeStyles();
window.addEventListener("pagehide", () => {
    ToastUtils.timeouts.forEach(clearTimeout);
    console.log("Timeouts cleared on pagehide");
});