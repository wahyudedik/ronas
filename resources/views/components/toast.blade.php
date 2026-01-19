<div id="toast-container" class="fixed top-4 right-4 z-[9999] flex flex-col gap-2" aria-live="polite"></div>
<style>
    @keyframes toast-in {
        from { opacity: 0; transform: translateY(-6px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .toast-animate { animation: toast-in 180ms ease-out; }
    .sortable-ghost { opacity: 0.4; background-color: rgba(148, 163, 184, 0.15); }
</style>
<script>
    window.showToast = function (message, type = 'success', options = {}) {
        const container = document.getElementById('toast-container');
        if (!container) return;

        const toast = document.createElement('div');
        const base = 'toast-animate flex items-center gap-3 px-4 py-3 rounded-lg text-sm shadow-lg text-white';
        const colors = {
            success: 'bg-emerald-600',
            error: 'bg-rose-600',
            info: 'bg-slate-900'
        };
        toast.className = `${base} ${colors[type] || colors.info}`;
        toast.textContent = message;

        if (options.actionText && typeof options.onAction === 'function') {
            const action = document.createElement('button');
            action.className = 'ml-auto rounded-md bg-white/90 px-2 py-1 text-xs font-semibold text-slate-900 hover:bg-white';
            action.type = 'button';
            action.textContent = options.actionText;
            action.addEventListener('click', () => {
                options.onAction();
                toast.remove();
            });
            toast.appendChild(action);
        }

        container.appendChild(toast);
        const duration = options.duration ?? 2500;
        setTimeout(() => toast.remove(), duration);
    };
</script>
