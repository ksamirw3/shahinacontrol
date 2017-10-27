
$(document).ready(function () {
    tinymce.init({selector: 'textarea:not(.notRiche)'});
    $('.data_table').DataTable({"pageLength": 10, "language": {
            "zeroRecords": "No matching data found"
        }});
    function paginateScroll() {
        $('html, body').animate({
            scrollTop: 0
        }, 'slow');
        $(".paginate_button").unbind('click', paginateScroll);
        $(".paginate_button").bind('click', paginateScroll);
    }
    paginateScroll();

    $("[type=time]").each(function () {
        $(this).parent().addClass('bootstrap-timepicker timepicker')
        $(this).prop('type', 'text').timepicker({
            minuteStep: 1,
            template: 'modal',
            appendWidgetTo: 'body',
//                showSeconds: true,
            showMeridian: false,
//                defaultTime: false
        });

    });
    $("[type=date]").each(function () {

        $(this).prop('type', 'text').daterangepicker({
            'minDate': $(this).attr('min'),
            'maxDate': $(this).attr('max'),
            "singleDatePicker": true,
            autoUpdateInput: false,
            locale: {format: 'YYYY-MM-DD', }
        });
        $(this).on('hide.daterangepicker', function (e, picker) {
            console.log(e)
            $(this).val(picker.startDate.format('YYYY-MM-DD'))
        });

    });

    $('.resetBtn').click(function () {
        $(this).closest('form').find('input,select,textarea').each(function () {
            console.log('ss')
            $(this).val('');
        })
    })
    $('#cs-sidebar').height($('.site-min-height').height() + 20);
    $('.sidebar-toggle-box').click(function () {
        $('#cs-sidebar').addClass('cls').slideToggle()
    });
    if ($(window).width() < 768) {
        if (!$('#cs-sidebar').hasClass('cls')) {
            $('#cs-sidebar').slideUp();
        }
    }
    $(window).resize(function () {
        if ($(this).width() < 768) {
            if (!$('#cs-sidebar').hasClass('cls')) {
                $('#cs-sidebar').slideUp();
            }
        } else {

            $('#cs-sidebar').removeClass('cls').slideDown();
        }

    });
})




$('.has-confirmation-message').click(function (evt) {
    var _this = $(this);
    var title = _this.attr("data-title");
    var message = _this.attr("data-confirm");
    swal({
        title: title,
        text: message,
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ok",
        closeOnConfirm: false
    }, function () {
        console.log(_this.closest("form"));
        if (_this.attr('href') !== undefined) {
            window.location.href = _this.attr('href');
        } else {
            _this.closest("form").submit();
        }
    });
    evt.preventDefault();
    return false;
});
$('.has-confirmation-message-with-note').click(function (evt) {
    var _this = $(this);
    var title = _this.attr("data-title");
    var message = _this.attr("data-confirm-with-note");
    swal({
        title: title,
        text: message,
        type: "input",
        showCancelButton: true,
        closeOnConfirm: false,
        animation: "slide-from-top",
        inputPlaceholder: "Write something",
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ok",
        showLoaderOnConfirm: true
    }, function (inputValue) {
        if (inputValue === false)
            return false;
        if (inputValue === "") {
            swal.showInputError("You need to write something!");
            return false;
        }
        if (_this.attr('href') !== undefined) {
            window.location.href = _this.attr('href') + "?message=" + inputValue;
        } else {
            _this.closest("form").submit();
        }
    });
    evt.preventDefault();
    return false;
});

/*---LEFT BAR ACCORDION----*/
$(function () {
    $('#nav-accordion').dcAccordion({
        eventType: 'click',
        autoClose: true,
        saveState: true,
        disableLink: true,
        speed: 'slow',
        showCount: false,
        autoExpand: true,
//        cookie: 'dcjq-accordion-1',
        classExpand: 'dcjq-current-parent'
    });
});

var Script = function () {

    $("input[type=number]").keypress(function (e) {
        //if the letter is not digit then display error and don't type anything
        if (e.which > 31 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    });
//    sidebar toggle
    $(function () {
        function responsiveView() {
            var wSize = $(window).width();
            if (wSize <= 768) {
                $('#container').addClass('sidebar-close');
                $('#sidebar > ul').hide();
            }

            if (wSize > 768) {
                $('#container').removeClass('sidebar-close');
                $('#sidebar > ul').show();
            }
        }
        $(window).on('load', responsiveView);
        $(window).on('resize', responsiveView);
    });

    $('.fa-bars').click(function () {
        if ($('#sidebar > ul').is(":visible") === true) {
            $('#main-content').css({
                'margin-left': '0px'
            });
            $('#sidebar').css({
                'margin-left': '-210px'
            });
            $('#sidebar > ul').hide();
            $("#container").addClass("sidebar-closed");
        } else {
            $('#main-content').css({
                'margin-left': '210px'
            });
            $('#sidebar > ul').show();
            $('#sidebar').css({
                'margin-left': '0'
            });
            $("#container").removeClass("sidebar-closed");
        }
    });

// custom scrollbar
    $("#sidebar").niceScroll({styler: "fb", cursorcolor: "#4ECDC4", cursorwidth: '3', cursorborderradius: '10px', background: '#404040', spacebarenabled: false, cursorborder: ''});

    $("html").niceScroll({styler: "fb", cursorcolor: "#4ECDC4", cursorwidth: '6', cursorborderradius: '10px', background: '#404040', spacebarenabled: false, cursorborder: '', zindex: '1000'});

// widget tools

    jQuery('.panel .tools .fa-chevron-down').click(function () {
        var el = jQuery(this).parents(".panel").children(".panel-body");
        if (jQuery(this).hasClass("fa-chevron-down")) {
            jQuery(this).removeClass("fa-chevron-down").addClass("fa-chevron-up");
            el.slideUp(200);
        } else {
            jQuery(this).removeClass("fa-chevron-up").addClass("fa-chevron-down");
            el.slideDown(200);
        }
    });

    jQuery('.panel .tools .fa-times').click(function () {
        jQuery(this).parents(".panel").parent().remove();
    });


//    tool tips

    $('.tooltips').tooltip();

//    popovers

    $('.popovers').popover();



// custom bar chart

    if ($(".custom-bar-chart")) {
        $(".bar").each(function () {
            var i = $(this).find(".value").html();
            $(this).find(".value").html("");
            $(this).find(".value").animate({
                height: i
            }, 2000)
        })
    }

    /*
     * alert while clicking on link
     */
//$('a[data-confirm]').click(function (ev) {
//        var href = $(this).attr('href');
//        var title = $(this).data("title");
//        if (!$('#dataConfirmModal').length) {
//            $('body').append('  <div class="modal fade" id="dataConfirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">\n\
//						  <div class="modal-dialog">\n\
//						    <div class="modal-content">\n\
//						      <div class="modal-header">\n\
//						        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>\n\
//						        <h4 id="myModalLabel">' + title + '</h4>\n\
//						      </div>\n\
//						      <div class="modal-body">\n\
//						        Hi there, I am a Modal Example for Dashio Admin Panel.\n\
//						      </div>\n\
//						      <div class="modal-footer">\n\
//						        <button type="button" class="btn btn-default" data-dismiss="modal">إلغاء&nbsp;</button>\n\
//						        <a class="btn btn-danger" id="dataConfirmOK">&nbsp;نعم&nbsp;</a>\n\
//						      </div>\n\
//						    </div>\n\
//						  </div>\n\
//						</div> ');
//        }
//        $('#dataConfirmModal').find('.modal-body').text($(this).attr('data-confirm'));
//        $('#dataConfirmOK').attr('href', href);
//        $('#dataConfirmModal').modal({show: true});
//        return false;
//    });
//    $('a[data-confirm-with-note]').click(function (ev) {
//        var href = $(this).attr('href');
//        var title = $(this).data("title");
//        if (!$('#dataConfirmModal2').length) {
//            $('body').append('  <div class="modal fade" id="dataConfirmModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">\n\
//						  <div class="modal-dialog">\n\
//						    <div class="modal-content">\n\
//						      <div class="modal-header">\n\
//						        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>\n\
//						        <h4 id="myModalLabel">' + title + '</h4>\n\
//						      </div>\n\
//						      <div class="modal-body">\n\
//                                                        <form>\n\
//                                                            <div class="form-group">   \n\
//                                                            <label for="message-text" class="control-label" id="message_label">Message:</label>\n\
//                                                            <textarea class="form-control" id="message"></textarea>\n\
//                                                            </div>\n\
//                                                        </from>\n\
//                                                       <p style="color:red;" id="errorConfirmationMsg"></p>\n\
//						      </div>\n\
//						      <div class="modal-footer">\n\
//						        <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>\n\
//						        <a class="btn btn-danger" id="dataConfirmOK"> نعم </a>\n\
//						      </div>\n\
//						    </div>\n\
//						  </div>\n\
//						</div> ');
//        }
//        $('#dataConfirmModal2').find('.modal-body #message_label').text($(this).attr('data-confirm-with-note'));
//        $('#dataConfirmModal2').find('.modal-body #message').val('');
//        $('#dataConfirmModal2').find('#message').on('keyup keydown change', function () {
//            $('#dataConfirmOK').attr('href', href + '?message=' + $(this).val());
//        });
//        var validatEmptyMessage = function () {
//            if ($('#message').val().length == 0) {
//                $('#dataConfirmOK').attr('href', 'javascript:void(0)');
//                $('#errorConfirmationMsg').text('لا يمكنك ترك سبب الرفض فارغاً')
//            } else {
//                $('#dataConfirmOK').attr('href', href + '?message=' + $('#message').val());
//                $('#errorConfirmationMsg').text('')
//            }
//        }
//        $('body')
//                .off('keyup', '#message')
//                .on('keyup', '#message', function () {
//                    validatEmptyMessage();
//                });
//
//        $('#dataConfirmOK').click(function () {
//            validatEmptyMessage();
//        });
//
//        $('#dataConfirmModal2').modal({show: true});
//        return false;
//    });
    $(".colorPicker").minicolors({
        control: $(this).attr('data-control') || 'hue',
        defaultValue: $(this).attr('data-defaultValue') || '',
        format: $(this).attr('data-format') || 'hex',
        keywords: $(this).attr('data-keywords') || '',
        inline: $(this).attr('data-inline') === 'true',
        letterCase: $(this).attr('data-letterCase') || 'lowercase',
        opacity: $(this).attr('data-opacity'),
        position: $(this).attr('data-position') || 'bottom left',
        swatches: $(this).attr('data-swatches') ? $(this).attr('data-swatches').split('|') : [],
        change: function (hex, opacity) {
            var log;
            try {
                log = hex ? hex : 'transparent';
                if (opacity)
                    log += ', ' + opacity;
                console.log(log);
            } catch (e) {
            }
        },
        theme: 'default'
    });
    $('.colorPicker').prop("readonly", true);

    $("body").off('click', '.replayComment')
            .on('click', '.replayComment', function () {
                var email = $(this).attr('data-email');
                var name = $(this).attr('data-name');
                var comment = $(this).attr('data-comment');
                var id = $(this).attr('data-userid');
                var modale = $('#replayComment');
                modale.find('[name=email]').val(email);
                modale.find('[name=name]').val(name);
                modale.find('[name=comment]').val(comment);
                modale.find('[name=userid]').val(id);
                modale.modal('show');
            });

}();
$("input[type=submit], button[name=submit]").click(function () {
    var editorContent = tinyMCE.get('replay').getContent();
    if (editorContent == '')
    {
        $('label[for="replay"]').css({color: '#ff0000'});
        $(".replayTextArea").after("<span style='color:red;'>*This field is a required filed</span>");
        return false;
    } else
    {
        $(this).parents().find('form').submit();
    }
});

//$('.submitForm').one('submit', function() {
//    $(this).find('input[type="submit"]').attr('disabled','disabled');
//});