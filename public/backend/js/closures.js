function confirmFormDelete(event, formId) {

    event.preventDefault();
    const form = document.getElementById(formId);

    if (confirm('Xóa sẽ không thể khôi phục, bạn có chắc vẫn tiếp tục?') && formId) {
        form.submit();
    }
}

function _notify(title, content, type = 'success') {
    new PNotify({title, content, type, styling: 'bootstrap3',});
}

function pNotifySuccess(title, content) {
    _notify(title, content);
}

function pNotifyError(title, content) {
    _notify(title, content, 'error');
}