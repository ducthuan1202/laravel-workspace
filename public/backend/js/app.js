const BackendApp = {
    confirmFormDelete: function(formId){
        event.preventDefault();
        const form = document.getElementById(formId);
        confirm('Xóa sẽ không thể khôi phục, bạn có chắc vẫn tiếp tục?') && form && form.submit();
    }
};