//toast
const displayToast = (type, message) => {
    const toastContent = `
               <div class='d-flex'>
                    <div class="toast-body">
                        ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
               </div>
            `;
    if (type === 'success') {
        $('.toast.text-bg-success').html(toastContent);
        const toast = new bootstrap.Toast($('.toast.text-bg-success'));
        toast.show();
    }
    if (type === 'error') {
        $('.toast.text-bg-danger').html(toastContent);
        const toast = new bootstrap.Toast($('.toast.text-bg-danger'));
        toast.show();
    }
};
