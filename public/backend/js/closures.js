function confirmFormDelete(event, formId) {

    event.preventDefault();
    const form = document.getElementById(formId);

    if (confirm('Xóa sẽ không thể khôi phục, bạn có chắc vẫn tiếp tục?') && formId) {
        form.submit();
    }
}

function pNotifySuccess(title, content){
    new PNotify({
        title: title,
        text: content,
        styling: 'bootstrap3',
        type: 'success',
    });
}