/**
 * genrate thum of upload videos
 * @param {object} $attr
 * @returns object
 */
$.fn.amitThumb = function ($attr) {
    /*
     *
     *
     */

    var baseurl = $attr.baseUrl;
    var s3 = $attr.s3Url;
    //var uri = baseurl + "gallery/upload-media";
    if ($attr.files === undefined) {
        console.error('input must be insert in input attr');
        return this;
    }
    /*
     *  create default attrs
     * @type Number|@exp;$attr@pro;mediaWidth
     */
    var mediaWidth = $attr.mediaWidth || 100;
    var mediaHeight = $attr.mediaHeight || 100;
    var className = $attr.className || 'previewThumb';

    /*
     * init data
     *  reset contaner befor add items
     */
    //this.html('');
    //this.addClass('');
    /*
     *  create vars
     */
    var file;
    var _this = this;
    var input = $($attr.input)[0];
    var files = $attr.files;
    var view = $attr.viewFiles;
    var uploadz = $attr.upload;
    //var files = input.files;


    /*
     * helper area
     */
    var h = {
        image: function (input, file) {
            var img = $('<img/>');
            img.attr('src', s3 + file.files.path);
            img.attr('width', mediaWidth).attr('height', mediaHeight);
            //img.addClass(className);
            input.append(h.beforAppend(img, file.files.extension, file.files.id));

            /*var reader = new FileReader();
            reader.onload = function (e) {
                var img = $('<img/>');
                img.attr('src', e.target.result);
                img.attr('width', mediaWidth).attr('height', mediaHeight);
                //img.addClass(className);
                input.append(h.beforAppend(img, file.type));
            };
            reader.readAsDataURL(file);*/
        },
        video: function (input, file) {
            var video = document.createElement('video');
            var vid = document.createElement('source');
            vid.src = s3  + file.files.path;
            video.width = 100;
            video.height = 86;
            video.controls = true;
            video.style.border = '3px solid rgba(255, 87, 34, 0.48)';
            video.appendChild(vid);
            // console.info(file);

            console.info(video, file);


            input.append(h.beforAppend(video, file.files.extension, file.files.id));
        },
        beforAppend: function (ele, type, id) {
            /*
             * here  you can add what are you want tags
             * @type @arr;files
             */
            //console.log(type);
            var loader = '<div id="loader" class=""></div>'
            var thumbView = '<div class="thumbCommand"><button type="button" class="deleteThumb btn btn-danger btn-xs cs_delete_btn" index="' + id + '"><i class="ti-trash"></i></button> | <button class="featuredThumb btn btn-primary btn-xs" title="Set featured" type="button" index="' + id + '">Featured</button></div>';
            var $rt;
            if (type !== undefined && type == 'image') {
                $rt = $('<div class="previewThumb imagez"></div>').append(ele);
                $rt.prepend(loader);
                $rt.append(thumbView);
            }
            /*
             * if file is video
             */
            if (type !== undefined && type == 'video') {
                $rt = $('<div class="previewThumb videoz" data-feature="1"></div>').append(ele);
                $rt.prepend(loader);
                $rt.append(thumbView);
            }
            return $rt;
        },
        upload: function (file) {

            //fomr data for the ajax call
            var form_data = new FormData();
            form_data.append('media[]', file);
            // console.info(file);
            $.ajax({
                url: baseurl + "gallery/upload-media", // point to server-side PHP script
                //dataType: 'text', // what to expect back from the PHP script, if anything
                //                cache: true,
                contentType: false,
                async: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function (res) {
                    //console.info(res);
                    if (res.code == '3103') {
                        swal("Ops!", "You already uplaoded a video, please remove it first", "warning");
                    } else {


                        if (res.files.extension !== undefined && res.files.extension == 'image') {

                            h.image(_this, res);
                        }
                        /*
                         * if file is video
                         */
                        else if (res.files.extension !== undefined && res.files.extension == 'video') {

                            h.video(_this, res);
                        }
                    }
                }
            });
            //            form_data.delete('media[]');

        }
    };
    /*
     * loop files
     */
    /*for (var i in view) {
       var file = view[i];

        if (file.type !== undefined && file.type.match('image')) {

        }

        else if (file.type !== undefined && file.type.match('video')) {

        }
    }*/
    for (var i in files) {
        var file = files[i];
        /*
         * if file is image
         */
        if (file.type !== undefined && file.type.match('image')) {
            h.upload(file);
            // h.image(_this, file);
        }
        /*
         * if file is video
         */
        else if (file.type !== undefined && file.type.match('video')) {
            h.upload(file);
            // h.video(_this, file);
        }
    }

    return this;
};
