$.fn.deletePopUp = function () {
    $(this).click(function () {
        var _this = this;
        console.log(_this)
        swal({
                title: $(this).data('title') || "Are you sure?",
                text: $(this).data('confirm') || "you can`t undo this action !",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel plx!",
                closeOnConfirm: false,
                closeOnCancel: true
            },
            function (isConfirm) {
                if (isConfirm) {
                    swal("Deleted!", "Your imaginary file has been deleted.", "success");
                    window.location.href = $(_this).attr('href')
                }
            });
        return false;
    })
};