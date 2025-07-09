(function () {
    let toastInProgress = false;

    const ToastUtils = {
        showToastMsg(message, duration = 3000) {
            if (toastInProgress) return;
            toastInProgress = true;

            let toastContainer = document.getElementById("toast-container");
            if (!toastContainer) {
                toastContainer = document.createElement("div");
                toastContainer.id = "toast-container";
                toastContainer.style.position = "fixed";
                toastContainer.style.bottom = "10%";
                toastContainer.style.right = "0";
                toastContainer.style.transform = "translateX(0%)";
                toastContainer.style.zIndex = "999999";
                toastContainer.style.display = "flex";
                toastContainer.style.flexDirection = "column";
                toastContainer.style.alignItems = "center";
                document.body.appendChild(toastContainer);
            }

            const toast = document.createElement("div");
            toast.style.backgroundColor = "#323232";
            toast.style.color = "white";
            toast.style.padding = "14px 20px";
            toast.style.margin = "10px";
            toast.style.borderRadius = "6px";
            toast.style.fontSize = "15px";
            toast.style.fontWeight = "500";
            toast.style.zIndex = "999999";
            toast.style.boxShadow = "0 4px 12px rgba(0, 0, 0, 0.25)";
            toast.style.maxWidth = "90vw";
            toast.style.textAlign = "center";
            toast.style.wordBreak = "break-word";
            toast.innerText = message;

            toastContainer.appendChild(toast);

            setTimeout(() => {
                toast.remove();
                toastInProgress = false;
            }, duration);
        }
    };

    window.showToastMsg = ToastUtils.showToastMsg.bind(ToastUtils);
})();
