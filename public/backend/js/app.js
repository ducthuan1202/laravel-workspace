const BackendApp = {
    confirmFormDelete: function(formId, sendEmail = false){
        event.preventDefault();
        const form = document.getElementById(formId);
        if(sendEmail){
            confirm('Xóa sẽ gửi email tới admin và dữ liệu không thể khôi phục, bạn có chắc vẫn tiếp tục?') && form && form.submit();
        } else {
            confirm('Xóa sẽ không thể khôi phục, bạn có chắc vẫn tiếp tục?') && form && form.submit();
        }

    }
};