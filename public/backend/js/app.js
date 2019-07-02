const MyApp = function() {

    return {

        getGlobalImgPath: function() {
            return '/backend/img/';
        },

        blockUI: function(options) {
            options = $.extend(true, {}, options);
            const html = '<div class="loading-message ' + (options.boxed ? 'loading-message-boxed' : '') + '"><img src="' + this.getGlobalImgPath() + 'loading-spinner-grey.gif" align=""><span>&nbsp;&nbsp;' + (options.message ? options.message : 'LOADING...') + '</span></div>';

            if (options.target) { // element blocking
                const el = $(options.target);
                if (el.height() <= ($(window).height())) {
                    options.cenrerY = true;
                }
                el.block({
                    message: html,
                    baseZ: options.zIndex ? options.zIndex : 1000,
                    centerY: options.cenrerY !== undefined ? options.cenrerY : false,
                    css: {
                        top: '10%',
                        border: '0',
                        padding: '0',
                        backgroundColor: 'none'
                    },
                    overlayCSS: {
                        backgroundColor: options.overlayColor ? options.overlayColor : '#555',
                        opacity: options.boxed ? 0.05 : 0.1,
                        cursor: 'wait'
                    }
                });
            } else { // page blocking
                $.blockUI({
                    message: html,
                    baseZ: options.zIndex ? options.zIndex : 1000,
                    css: {
                        border: '0',
                        padding: '0',
                        backgroundColor: 'none'
                    },
                    overlayCSS: {
                        backgroundColor: options.overlayColor ? options.overlayColor : '#555',
                        opacity: options.boxed ? 0.05 : 0.1,
                        cursor: 'wait'
                    }
                });
            }
        },

        unblockUI: function(target) {
            if (target) {
                $(target).unblock({
                    onUnblock: function() {
                        $(target).css('position', '');
                        $(target).css('zoom', '');
                    }
                });
            } else {
                $.unblockUI();
            }
        },

        initAjaxSetup: function() {
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        },
        notifySuccess: function(title, content){
            new PNotify({
                title: title,
                text: content,
                styling: 'bootstrap3',
                type: 'success',
            });
        },
        notifyError: function(title, content){
            new PNotify({
                title: title,
                text: content,
                styling: 'bootstrap3',
                type: 'error',
            });
        }
    };

}();

/**
 * Thực hiện chạy những function init khi trang đã được load hoàn tất
 * @type {MyApp}
 */
$(document).ready(function () {
    MyApp.initAjaxSetup();
});
