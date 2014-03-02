<div class="b-modal modal-image-upload" id="window_upload_img">
    <header class="b-modal-header">
        <button type="button" class="b-modal-close" data-type="modal-close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>{$aLang.uploadimg}</h3>
    </header>

    <div class="b-modal-content">
        <ul class="b-modal-nav nav nav-tabs">
            <li class="active js-block-upload-img-item">
                <a href="#block_upload_img_content_pc" data-toggle="tab">{$aLang.uploadimg_from_pc}</a>
            </li>
            <li class="js-block-upload-img-item">
                <a href="#block_upload_img_content_link" data-toggle="tab">{$aLang.uploadimg_from_link}</a>
            </li>
        </ul>

        <div class="tab-content">
            <form method="POST" action="" enctype="multipart/form-data" id="block_upload_img_content_pc"
                  onsubmit="return false;" class="tab-pane active js-block-upload-img-content uniform">
                <p>
                    <label for="img_file">{$aLang.uploadimg_file}:</label>
                    <input type="file" name="img_file" id="img_file" value="" class="input-file input-width-full"/>
                </p>

                {hook run="uploadimg_source"}

                <p>
                    <label for="form-image-align">{$aLang.uploadimg_align}:</label>
                    <select name="align" id="form-image-align" class="input-width-full">
                        <option value="">{$aLang.uploadimg_align_no}</option>
                        <option value="left">{$aLang.uploadimg_align_left}</option>
                        <option value="right">{$aLang.uploadimg_align_right}</option>
                        <option value="center">{$aLang.uploadimg_align_center}</option>
                    </select>
                </p>

                <p>
                    <label for="form-image-title">{$aLang.uploadimg_title}:</label>
                    <input type="text" name="title" id="form-image-title" value="" class="input-text input-width-full"/>
                </p>

                {hook run="uploadimg_additional"}

                <button type="submit" class="btn btn-primary"
                        onclick="ls.ajaxUploadImg('#block_upload_img_content_pc','{$sToLoad}');">
                    {$aLang.uploadimg_submit}
                </button>
            </form>


            <form method="POST" action="" enctype="multipart/form-data" id="block_upload_img_content_link"
                  onsubmit="return false;" class="tab-pane js-block-upload-img-content uniform">
                <p>
                    <label for="img_file">{$aLang.uploadimg_url}:</label>
                    <input type="text" name="img_url" id="img_url" value="http://" class="input-text input-width-full"/>
                </p>

                <p>
                    <label for="form-image-url-align">{$aLang.uploadimg_align}:</label>
                    <select name="align" id="form-image-url-align" class="input-width-full">
                        <option value="">{$aLang.uploadimg_align_no}</option>
                        <option value="left">{$aLang.uploadimg_align_left}</option>
                        <option value="right">{$aLang.uploadimg_align_right}</option>
                        <option value="center">{$aLang.uploadimg_align_center}</option>
                    </select>
                </p>

                <p>
                    <label for="form-image-url-title">{$aLang.uploadimg_title}:</label>
                    <input type="text" name="title" id="form-image-url-title" value=""
                           class="input-text input-width-full"/>
                </p>

                {hook run="uploadimg_link_additional"}

                <button type="submit" class="btn btn-primary"
                        onclick="ls.topic.insertImageToEditor($('#img_url').val(),$('#form-image-url-align').val(),$('#form-image-url-title').val());">
                {$aLang.uploadimg_link_submit_paste}
                </button>
                {$aLang.word_or}
                <button type="submit" class="btn btn-primary"
                        onclick="ls.ajaxUploadImg('#block_upload_img_content_link','{$sToLoad}');">
                {$aLang.uploadimg_link_submit_load}
                </button>
            </form>
        </div>
    </div>
</div>