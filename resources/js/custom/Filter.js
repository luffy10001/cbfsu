$(document).ready(function () {
    $('body').on('click', '.SearchFilterPanel .filterBtn', async function () {
        const elem = $(this);

        let selected_checkbox = [];
        var table = elem.parents('div.form-group').attr('table');

        const Buttontext = await elem.html();
       /* showLoader();*/
        if (window.LaravelDataTables[table]){
            await elem.html("Please wait ..").addClass('disabled').prop('disabled', true);
            await window.LaravelDataTables[table].on('preXhr.dt', function (e, settings, data) {
                $('.SearchFilterPanel .input-col.form-group').each(function (Index, Elem) {
                    var Elem = $(Elem).find('.formFieldName');
                    data[Elem.attr('name')] = Elem.val();
                });
            });
            await elem.html(Buttontext).prop('disabled', false).removeClass('disabled');
            await window.LaravelDataTables[table].draw();
        }
/*
        hideLoader();
*/
    });

    $('body').on('keypress','.SearchFilterPanel input,.SearchFilterPanel select',function (e){
        const elem  = $(this);

        if (e.key ==='Enter'){
           $('.SearchFilterPanel .filterBtn').click();
        }
       /* console.log(e,elem,e.key,'ddd');*/
    })

    $('body').on('click', '.mws-filter', function () {
        const elem = $(this);
    
        const SearchFilterPanel = $('.SearchFilterPanel');
        if (SearchFilterPanel.hasClass('active')){
            SearchFilterPanel.removeClass('active');
            elem.removeClass('minus')
            elem.addClass('plus')
            window.resizeWindow(0);
        } else{
            SearchFilterPanel.addClass('active');
            window.resizeWindow(16);
            elem.addClass('minus')
            elem.removeClass('plus')
        }

        if (SearchFilterPanel.hasClass('active')){
            $('.card-header.mws-main-header').removeAttr('style');
            window.resizeWindow(0);
        }else{
            // $('.card-header.mws-main-header').css({
            //     display:'none'
            // });
            window.resizeWindow(16);
        }
    });
    /*$('body').on('click', '.SearchFilterPanel .filterBtn', function () {
        const elem = $(this);
        let selected_checkbox = [];
        var table = elem.parents('div.form-group').attr('table');
        window.LaravelDataTables[table].on('preXhr.dt', function (e, settings, data) {
            window.showLoader();
            $('.SearchFilterPanel .input-col.form-group').each(function (Index, Elem) {
                var el = $(Elem).find('.formFieldName');
                data[el.attr('name')] = el.val();
            });
        });

        window.LaravelDataTables[table].on('xhr.dt', function (e, settings, data) {
            window.LaravelDataTables[table].draw();
            window.hideLoader();
        });
    });*/
    $('body').on('click', '.SearchFilter', function () {
        const elem = $(this);
    
        var SearchFilterPanel = elem.parents('div.SearchFilterPanel');
        if (SearchFilterPanel.hasClass('active')) {
            SearchFilterPanel.removeClass('active');
            elem.removeClass('btn-danger').addClass('btn-success');
            elem.find('i').removeAttr('class').addClass('fal fa-filter');
        
        } else {
            SearchFilterPanel.addClass('active');
        
            elem.removeClass('btn-success').addClass('btn-danger');
            elem.find('i').removeAttr('class').addClass('fal fa-close');
        }
    });

    $('body').on('click', '.SearchFilterPanel .filterBtnReset', function () {
        let selected_checkbox = [];
        showLoader();
        const elem = $(this);
        var table = elem.parents('div.form-group').attr('table');
        $('.SearchFilterPanel .form-group').each(function (Index, Elem) {
            var Elem = $(Elem).find('.formFieldName');
            if (Elem.val() == undefined) {
                Elem.val('');
            } else {
                if (Elem.prop('tagName') == 'SELECT') {
                    Elem.find(`option[value="all"]`).attr('selected', 'selected');
                    if ($('.select2-hidden-accessible').length > 0) {
                        $('.select2-hidden-accessible').each(function () {
                            $(Elem).val('all').trigger('change');
                        });
                    } else {
                        $(Elem).val('all').trigger('change');
                    }
                } else {
                    Elem.val('');
                }
            }

        });
        window.LaravelDataTables[table].draw();
        hideLoader();
    });

});


$(document).ready(function () {

    $('.image_text').css('display', 'none');
    $(document).on('click', '.image_checkbox', function (e) {
        /*alert('clicked');*/
        $('.image_text').css('display', 'none');
        if ($(this).is(":checked")) {
            $(this).siblings('.image_text').css('display', 'inline-block');
        } else {
            $(this).siblings('.image_text').css('display', 'none');
        }
    });

    function previewImage(input, previewContainer) {
        $(previewContainer).empty();
        if (input.files && input.files[0]) {
            let reader = new FileReader();
            reader.onload = function (e) {
                $(previewContainer).append('<img src="' + e.target.result + '">');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Image preview when a new image is selected
    $('.image').change(function () {
        previewImage(this, '#image-preview');
    });



    $('body').on('change', '.image_input', function (e) {
        const input = e.target;
        const imagePreviewID = `#imagePreview_${$(this).data('row-id')}`;

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $(imagePreviewID).attr('src', e.target.result).css('display', 'block');
            };
            reader.readAsDataURL(input.files[0]);
        }
    });

    $('body').on('click', '.image_remove', function (e) {
        const rowID = $(this).data('row-id');
        $(`.image_row_${rowID}`).remove();
        imageCounter--;
        $('.image_upload_section').show();
    });
    let imageCounters = 0;
    $(document).on('click', '#addImage', function (e) {
       /* e.preventDefault();*/
        var total_images = /*($('.image_append').attr('total') !==undefined)?Number($('.image_append').attr('total')):0;*/ $(".image_row").find("img").length ;
        console.log('length',total_images);



        if (total_images == 0) {
            // let imageCounters = 2;
            imageCounters = 1;
        } else  {
            // let imageCounters = total_images + 1;
            imageCounters = total_images + 1 ;
        }

        let imageCounter = imageCounters ;
        console.log('ds',imageCounter);
        if (imageCounter < 20) {
            var html = `
                    <div class="image_row image_row_${imageCounter}">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="radio-label">
                                <input type="radio" class="image_checkbox" name="cover" value="${imageCounter}" data-row-id="${imageCounter}">
                                    <span class="image_text" style="color: red;display: none;"><strong> SetCover</strong> </span>
                                </label>
                                <input type="file" name="imageQty[${imageCounter}]" class="form-control image_input input-imageQty_${imageCounter}"  id="selectImage_${imageCounter}" value="" data-row-id="${imageCounter}">


                            </div>
                            <div class="col-md-2">
                                <label class="text-danger mt-4  image_remove" style="margin-left: -15px;padding-top: 10px;cursor: pointer;" data-row-id="${imageCounter}">Remove</label>
                            </div>

                        </div>
                        <div class="row mt-2 ml-1">
                            <div class="col-md-3">
                                <img id="imagePreview_${imageCounter}" src="#" alt="Selected Image" style="display: none; max-width: 100%; max-height: 200px;">

                            </div>
                        </div>
                    </div>
                `;

            $('.image_append').append(html);
            /*$('.image_append').attr('total',(Number(total_images)+1));*/
            imageCounter++;
            console.log('counter',imageCounter);

            $('.image_append').find('.image_text').css('display', 'none');


        }
        if (imageCounter == 19) {
            $('.image_upload_section').hide();
        }
    });

    $('.image_append').on('click', '.image_checkbox', function () {
        $('.image_text').hide(); // Hide all text elements
        $('.image_checkbox:checked').siblings('.image_text').css('display', 'inline-block'); // Show text for checked radio buttons
    });
});