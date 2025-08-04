{{-- Toast Notifier --}}
<div class="toast-container space-y-4 fixed right-5 bottom-5 z-50"></div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const showToast = (type, title, message) => {
            const container = document.querySelector('.toast-container');
            const toast = document.createElement('div');

            const colors = {
                success: 'bg-green-500',
                error: 'bg-red-500',
                warning: 'bg-yellow-500',
                info: 'bg-blue-500'
            };

            const icons = {
                success: `<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>`,
                error: `<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>`,
                warning: `<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>`,
                info: `<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>`
            };

            toast.className = `toast ${colors[type]} text-white p-4 rounded-lg shadow-lg flex items-start space-x-4 relative overflow-hidden`;
            toast.innerHTML = `
                <div class="flex-shrink-0">
                    ${icons[type]}
                </div>
                <div class="flex-1">
                    <h3 class="font-bold">${title}</h3>
                    <p class="text-sm opacity-90">${message}</p>
                </div>
                <button onclick="this.parentElement.remove()" class="flex-shrink-0 hover:opacity-75">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
                <div class="progress-bar absolute bottom-0 left-0 h-1 bg-white bg-opacity-30 w-full animate-progress"></div>
            `;

            container.appendChild(toast);

            setTimeout(() => {
                toast.classList.add('hide');
                setTimeout(() => toast.remove(), 500);
            }, 3000);
        };

        @if (session('success'))
            showToast('success', 'Éxito', @json(session('success')));
        @endif

        @if (session('error'))
            showToast('error', 'Error', @json(session('error')));
        @endif
    });
</script>

<style>
    @keyframes progress {
        from { width: 100%; }
        to { width: 0%; }
    }

    .animate-progress {
        animation: progress 3s linear forwards;
    }

    .toast {
        animation: slideIn 0.5s ease-out forwards;
    }

    .toast.hide {
        animation: slideOut 0.5s ease-in forwards;
    }

    @keyframes slideIn {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }

    @keyframes slideOut {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(100%); opacity: 0; }
    }
</style>
