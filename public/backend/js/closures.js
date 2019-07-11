function confirmFormDelete(event, formId) {

    event.preventDefault();
    const form = document.getElementById(formId);

    if (confirm('Xóa sẽ không thể khôi phục, bạn có chắc vẫn tiếp tục?') && formId) {
        form.submit();
    }
}

function _notify(title, text, type = 'success') {
    new PNotify({title, text, type, styling: 'bootstrap3',});
}

function pNotifySuccess(title, text) {
    _notify(title, text);
}

function pNotifyError(title, text) {
    _notify(title, text, 'error');
}