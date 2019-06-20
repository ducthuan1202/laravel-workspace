function confirmFormDelete(formId) {
    event.preventDefault();

    const form = document.getElementById(formId);
    if (confirm('Xóa sẽ không thể khôi phục, bạn có chắc vẫn tiếp tục?') && formId) {
        form.submit();
    }
}

function themeInit() {
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
}
