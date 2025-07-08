const ToastUtils = {
    toastQueue: [],
    MAX_TOASTS: 5,
    TRANSITION_DURATION: 300,

    showToast: (message, duration = 3000, type = 'info') => {
        if (typeof message !== 'string' || message.trim() === '') {
            console.warn('Invalid toast message');
            return;
        }
        if (typeof duration !== 'number' || duration < 0) {
            console.warn('Invalid duration, using default 3000ms');
            duration = 3000;
        }

        if (ToastUtils.toastQueue.length >= ToastUtils.MAX_TOASTS) {
            console.log(`Max toasts reached: ${ToastUtils.MAX_TOASTS}`);
            return;
        }

        let toastContainer = document.getElementById('toast-container');
        if (!toastContainer) {
            console.warn('Toast container not found. Creating one.');
            toastContainer = document.createElement('div');
            toastContainer.id = 'toast-container';
            toastContainer.className = 'toast-container';
            try {
                document.body.appendChild(toastContainer);
            } catch (e) {
                console.error('Failed to append toast container:', e);
                return;
            }
        }

        const toast = document.createElement('div');
        toast.className = `toast toast-${type}`;
        toast.setAttribute('role', 'alert');
        toast.setAttribute('aria-live', 'polite');
        toast.setAttribute('aria-atomic', 'true');
        toast.textContent = message;

        const closeBtn = document.createElement('span');
        closeBtn.textContent = '×';
        closeBtn.className = 'toast-close';
        closeBtn.onclick = () => {
            toast.classList.remove('show');
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.remove();
                    const index = ToastUtils.toastQueue.indexOf(toast);
                    if (index !== -1) {
                        ToastUtils.toastQueue.splice(index, 1);
                    }
                    console.log(`Toast closed manually: ${message}`);
                }
            }, ToastUtils.TRANSITION_DURATION);
            toast._timeouts.forEach(clearTimeout);
        };
        toast.appendChild(closeBtn);

        try {
            toastContainer.appendChild(toast);
            ToastUtils.toastQueue.push(toast);
            console.log(`Toast added to DOM: ${message}`);
        } catch (e) {
            console.error('Failed to append toast:', e);
            return;
        }

        const toastTimeouts = [];

        const showTimeout = setTimeout(() => {
            toast.classList.add('show');
            console.log(`Toast class 'show' added: ${message}`);
        }, 100);
        toastTimeouts.push(showTimeout);

        const hideTimeout = setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.remove();
                    const index = ToastUtils.toastQueue.indexOf(toast);
                    if (index !== -1) {
                        ToastUtils.toastQueue.splice(index, 1);
                    }
                    console.log(`Toast removed from DOM: ${message}`);
                }
            }, ToastUtils.TRANSITION_DURATION);
        }, duration);
        toastTimeouts.push(hideTimeout);

        toast._timeouts = toastTimeouts;
    },

    initializeStyles: () => {
        if (document.querySelector('style#toast-styles')) return;
        const style = document.createElement('style');
        style.id = 'toast-styles';
        style.textContent = `
            .toast-container {
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 10000;
            }
            .toast {
                font-family: 'Poppins', Arial, sans-serif;
                color: white;
                padding: 12px 20px;
                margin-bottom: 10px;
                border-radius: 4px;
                opacity: 0;
                transition: opacity ${ToastUtils.TRANSITION_DURATION}ms ease;
                max-width: 90vw;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            .toast.show {
                opacity: 1;
            }
            .toast-info {
                background-color: #f47b20;
            }
            .toast-success {
                background-color: #28a745;
            }
            .toast-error {
                background-color: #dc3545;
            }
            .toast-warning {
                background-color: #ffc107;
            }
            .toast-close {
                cursor: pointer;
                margin-left: 10px;
                font-weight: bold;
                font-size: 16px;
            }
            @media (max-width: 600px) {
                .toast-container {
                    top: 10px;
                    right: 10px;
                    left: 10px;
                    text-align: center;
                }
                .toast {
                    max-width: 100%;
                }
            }
        `;
        try {
            document.head.appendChild(style);
            console.log('Toast styles initialized');
        } catch (e) {
            console.error('Failed to append toast styles:', e);
        }
    },

    clearAllToasts: () => {
        ToastUtils.toastQueue.forEach(toast => {
            toast._timeouts?.forEach(clearTimeout);
            if (toast.parentNode) {
                toast.remove();
            }
        });
        ToastUtils.toastQueue = [];
        console.log('All toasts cleared');
    }
};

// ✅ Assign to global scope
window.ToastUtils = ToastUtils;
window.showToast = ToastUtils.showToast;  // <-- This line fixes your issue

// ✅ Initialize styles
ToastUtils.initializeStyles();

// ✅ Clear toasts on page change
window.addEventListener('pagehide', () => {
    ToastUtils.clearAllToasts();
});
