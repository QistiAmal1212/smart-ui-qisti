

{{-- Container sets theming variables and exposes limits via data-* --}}
<div
    class="smartuiqisti-upload-container smartuiqisti-upload-force-full">

    {{-- Title --}}
    <div class="smartuiqisti-upload-header">
        <div class="smartuiqisti-upload-label">
                upload
                <span class="smartuiqisti-upload-required">*</span>
        </div>
    </div>

    {{-- Drop area and file input trigger --}}
    <div class="smartuiqisti-upload-drop smartuiqisti-upload-force-full" data-smartuiqisti-upload-drop style="width:100%;max-width:100%;min-width:0;">
        <div class="smartuiqisti-upload-icon-circle">
            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="none" viewBox="0 0 24 24">
                <path d="M12 15.5V5m0 0 4 4M12 5l-4 4" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6"/>
                <path d="M6.5 11a5.5 5.5 0 1 0 2.735 10.34l.052-.024A5.5 5.5 0 0 0 17.5 11" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6"/>
            </svg>
        </div>
        <div class="smartuiqisti-upload-inner-title">Drag and drop to upload file</div>
        <div class="smartuiqisti-upload-inner-sub-title">Maximum upload file size is 5 MB per upload.</div>
        <div class="smartuiqisti-upload-inner-accepted-file-type-text">Accepted: .doc,.docx,.xls,.xlsx,.zip,.pdf,.png,.jpg,.jpeg</div>
        <label class="smartuiqisti-upload-inner-browse-file-button">
            <input
                type="file"
                class="hidden"/>
            Browse files
        </label>
    </div>

</div>
