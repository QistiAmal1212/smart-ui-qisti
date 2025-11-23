<!-- =========================================================== -->
<!--            SMART UI QISTI – UPLOAD + PROFESSIONAL MODAL     -->
<!-- =========================================================== -->

@php
    // Default max file if not provided
    $maxFile = $maxFile ?? 5;
@endphp

<!-- ========================== PREVIEW MODAL ========================== -->
<div id="suq-preview-modal"
     style="display:none"
     class="fixed inset-0 z-[9999] bg-black/50 backdrop-blur-sm flex items-center justify-center">

    <div id="suq-preview-card"
         class="w-[92%] max-w-5xl max-h-[90vh] overflow-hidden flex flex-col
                transform scale-95 opacity-0 transition-all duration-200
                rounded-2xl shadow-2xl bg-white text-slate-900 border border-slate-200">

        <!-- HEADER -->
        <div class="flex items-center justify-between px-2 p-2 border-b border-slate-200 bg-slate-50">
            <h2 class="text-base sm:text-lg font-semibold">File Preview</h2>

            <div class="flex items-center gap-2">

                <!-- FULLSCREEN BUTTON -->
                <button type="button"
                        onclick="suqToggleFullscreen()"
                        class="w-10 h-10 flex items-center justify-center rounded-xl
                           hover:bg-slate-200 dark:hover:bg-slate-600
                           text-slate-700 dark:text-slate-200 transition">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="2">
                        <path d="M15 3h6v6M9 21H3v-6M21 15v6h-6M3 9V3h6"/>
                    </svg>
                </button>

                <!-- CLOSE BUTTON -->
                <button type="button"
                        onclick="suqCloseModal()"
                        class="w-10 h-10 flex items-center justify-center rounded-xl dark:text-white  hover:bg-slate-200 dark:hover:bg-slate-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"/>
                        <line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- CONTENT -->
        <div id="suq-modal-content"
             class="pb-4 sm:pb-4 overflow-auto max-h-[calc(90vh-72px)] suq-scroll flex justify-center py-2"></div>

    </div>
</div>

<!-- ======================= CONFIRM DELETE MODAL ====================== -->
<div id="suq-confirm-modal"
     style="display:none"
     class="fixed inset-0 z-[99999] bg-black/40 backdrop-blur-sm flex items-center justify-center p-4">

    <div id="suq-confirm-card"
         class="w-full max-w-sm p-6 rounded-2xl bg-white dark:bg-slate-900 
                border border-slate-200 dark:border-slate-700 shadow-xl
                scale-95 opacity-0 transition-all duration-200">

        <h2 class="text-lg font-semibold text-slate-800 dark:text-slate-100 text-center">
            Are you sure want to delete?
        </h2>

        <p id="suq-confirm-text"
           class="mt-2 text-slate-600 dark:text-slate-300 text-sm text-center">
            Are you sure you want to delete this file?
        </p>

        <div class="mt-6 flex items-center justify-end gap-3">
            <button type="button"
                    onclick="suqCloseConfirm()"
                    class="px-4 py-2 rounded-lg bg-slate-200 hover:bg-slate-300
                           dark:bg-slate-700 dark:hover:bg-slate-600
                           text-slate-700 dark:text-slate-200 transition">
                Cancel
            </button>

            <button type="button" id="suq-confirm-yes"
                    class="px-4 py-2 rounded-lg bg-rose-600 hover:bg-rose-700 text-white transition">
                Delete
            </button>
        </div>
    </div>
</div>

<!-- ==================== DOWNLOAD CONFIRMATION MODAL ================== -->
<div id="suq-download-modal"
     style="display:none"
     class="fixed inset-0 z-[99999] bg-black/40 backdrop-blur-sm flex items-center justify-center p-4">

    <div id="suq-download-card"
         class="w-full max-w-sm p-6 rounded-2xl bg-white dark:bg-slate-900 
                border border-slate-200 dark:border-slate-700 shadow-xl
                scale-95 opacity-0 transition-all duration-200">

        <h2 class="text-lg font-semibold text-slate-800 dark:text-slate-100 text-center">
            Download file?
        </h2>

        <p id="suq-download-text"
           class="mt-2 text-slate-600 dark:text-slate-300 text-sm text-center"></p>

        <div class="mt-6 flex items-center justify-end gap-3">
            <button type="button"
                    onclick="suqCloseDownload()"
                    class="px-4 py-2 rounded-lg bg-slate-200 hover:bg-slate-300
                           dark:bg-slate-700 dark:hover:bg-slate-600
                           text-slate-700 dark:text-slate-200 transition">
                Cancel
            </button>

            <a id="suq-download-yes"
               class="px-4 py-2 rounded-lg bg-emerald-600 hover:bg-emerald-700 
                      text-white transition cursor-pointer">
                Download
            </a>
        </div>
    </div>
</div>

<!-- =========================================================== -->
<!--                 STYLING + DARK MODE + ERROR STATE           -->
<!-- =========================================================== -->
<style>
/* Scrollbar */
.suq-scroll::-webkit-scrollbar { width: 8px; }
.suq-scroll::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 999px; }
.suq-scroll::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

/* Excel/CSV table */
#suq-modal-content table {
    width:100%!important;
    border-collapse:collapse;
    font-size:.875rem;
    display:block;
    overflow-x:auto;
}
#suq-modal-content table td,
#suq-modal-content table th {
    border:1px solid #e5e7eb!important;
    padding:.5rem .75rem!important;
    white-space:nowrap;
}
#suq-modal-content table tr:nth-child(even) { background:#f9fafb; }
#suq-modal-content table th { background:#f3f4f6; font-weight:600; }

/* Modal image responsive */
#suq-modal-content img {
    width:100%;
    height:auto;
    max-height:75vh;
    object-fit:contain;
}

/* PDF responsive */
#suq-modal-content iframe {
    width:100%;
    height:75vh;
}

/* Dark Mode */
@media (prefers-color-scheme: dark) {
    #suq-preview-modal { background-color:rgba(15,23,42,0.8); }

    #suq-preview-card {
        background-color:#020617;
        color:#e5e7eb;
        border-color:#1f2937;
        box-shadow:0 20px 45px rgba(0,0,0,0.8);
    }
    #suq-preview-card .border-b { border-color:#1f2937; }
    #suq-preview-card .bg-slate-50 { background-color:#020617; }

    .suq-scroll::-webkit-scrollbar-thumb { background:#475569; }
    .suq-scroll::-webkit-scrollbar-thumb:hover { background:#64748b; }

    #suq-modal-content table { background:#020617; color:#e5e7eb; }
    #suq-modal-content table td, #suq-modal-content table th { border-color:#1f2937!important; }
    #suq-modal-content table tr:nth-child(even) { background:#020617; }
    #suq-modal-content table th { background:#020617; }
}

/* FULLSCREEN */
#suq-preview-card.suq-fullscreen {
    width:100vw!important;
    height:100vh!important;
    max-width:none!important;
    max-height:none!important;
    border-radius:0!important;
}
#suq-preview-card.suq-fullscreen #suq-modal-content {
    max-height:calc(100vh)!important;
}

/* MOBILE */
@media (max-width: 640px) {
    #suq-preview-card {
        width:100%!important;
        max-height:88vh!important;
        border-radius:1rem!important;
    }
    #suq-modal-content {
        max-height:calc(88vh - 60px)!important;
    }
}

/* ERROR: border red */
.suq-error {
    border-color:#dc2626 !important;
    background-color:rgba(220,38,38,0.05);
}

/* Shake animation */
@keyframes suq-shake {
    0% { transform:translateX(0); }
    25% { transform:translateX(-4px); }
    50% { transform:translateX(4px); }
    75% { transform:translateX(-4px); }
    100% { transform:translateX(0); }
}
.suq-shake { animation: suq-shake 0.25s ease-in-out; }
</style>

<!-- XLSX LIB -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

<!-- =========================================================== -->
<!--                       UPLOAD COMPONENT                       -->
<!-- =========================================================== -->

<div class="smartuiqisti-upload-container {{ $dropzoneClass }}"
     style="
        --suq-main-color: {{ $mainColor }};
        --suq-drop-bg: {{ $dropzoneColor }};
        --suq-drop-border: {{ $dropzoneBorderColor }};
        --suq-drop-active-bg: {{ $dropzoneActiveColor }};
     ">

    <div class="smartuiqisti-upload-label {{ $labelClass }}">
        {{ $label }} @if($required)<span class="smartuiqisti-upload-required">*</span>@endif
    </div>

    <!-- Dropzone -->
    <div class="smartuiqisti-upload-drop @if($disable) opacity-50 cursor-not-allowed @endif">

        <div class="smartuiqisti-upload-icon-circle {{ $innerIconClass }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="none" viewBox="0 0 24 24">
                <path d="M12 15.5V5m0 0 4 4M12 5l-4 4"
                      stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                <path d="M6.5 11a5.5 5.5 0 1 0 2.7 10.34A5.5 5.5 0 0 0 17.5 11"
                      stroke="currentColor" stroke-width="1.6"/>
            </svg>
        </div>

        <div class="smartuiqisti-upload-inner-title {{ $innerTitleClass }}">
            Drag and drop to upload file
        </div>

        <div class="smartuiqisti-upload-inner-sub-title {{ $innerTitleSubClass }}">
            Maximum upload file size is {{ $maxSize }} MB.
        </div>

        <div class="smartuiqisti-upload-inner-accepted-file-type-text {{ $innerAcceptedClass }}">
            Accepted: {{ $accept }}
        </div>

        <label class="smartuiqisti-upload-inner-browse-file-button">
            Browse files
            <input type="file"
                   multiple
                   accept="{{ $accept }}"
                   class="suq-input hidden"
                   @if($disable) disabled @endif>
        </label>

        @if(!$previewOutside)
            <div class="suq-preview suq-preview-inside hidden space-y-3 mt-4"></div>
        @endif
    </div>

    <!-- error msg -->
    <div class="suq-error-msg hidden text-red-600 dark:text-red-400 text-sm font-medium mt-2"></div>

    @if($previewOutside)
        <div class="suq-preview suq-preview-outside hidden space-y-3 mt-4"></div>
    @endif

    <!-- ==================== BULK ACTION BAR (PER COMPONENT) ==================== -->
    <div class="suq-bulk-bar hidden fixed bottom-6 left-1/2 -translate-x-1/2
                px-6 py-3 rounded-2xl shadow-xl border
                bg-white/90 dark:bg-slate-800/90 backdrop-blur-xl
                border-slate-300 dark:border-slate-600
                flex items-center gap-4 z-[999999]">

        <span class="text-sm font-semibold text-slate-700 dark:text-slate-200">
            <span class="suq-selected-count">0</span> selected
        </span>

        <button type="button"
                class="suq-clear-btn px-3 py-2 rounded-lg bg-slate-200 hover:bg-slate-300
                       dark:bg-slate-700 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-200
                       text-sm transition">
            Clear
        </button>

        <button type="button"
                class="suq-bulk-delete-btn px-4 py-2 rounded-xl bg-rose-600 hover:bg-rose-700
                       text-white text-sm font-semibold transition">
            Delete Selected
        </button>
    </div>
</div>

<!-- =========================================================== -->
<!--                   SCRIPT – MULTIPLE + MODAL                 -->
<!-- =========================================================== -->

<script>
document.addEventListener("DOMContentLoaded", () => {
    const components = document.querySelectorAll(".smartuiqisti-upload-container");

    components.forEach(component => {
        const input = component.querySelector(".suq-input");
        let preview =
            component.querySelector(".suq-preview-outside") ||
            component.querySelector(".suq-preview-inside");

        if (!input || !preview) return;

        let filesArr = [];
        const errorMsg = component.querySelector(".suq-error-msg");
        const dropzone = component.querySelector(".smartuiqisti-upload-drop");
        const maxSizeMB = {{ $maxSize }};
        const maxSizeBytes = maxSizeMB * 1024 * 1024;
        const maxFile = {{ $maxFile }};

        const bulkBar = component.querySelector(".suq-bulk-bar");
        const bulkDeleteBtn = component.querySelector(".suq-bulk-delete-btn");
        const clearBtn = component.querySelector(".suq-clear-btn");
        const selectedCountEl = component.querySelector(".suq-selected-count");

        function updateBulkBar() {
            if (!bulkBar || !selectedCountEl) return;
            const checked = component.querySelectorAll(".suq-file-check:checked");
            const selectedCount = checked.length;
            selectedCountEl.textContent = selectedCount;
            if (selectedCount > 0) bulkBar.classList.remove("hidden");
            else bulkBar.classList.add("hidden");
        }

        if (clearBtn) {
            clearBtn.addEventListener("click", () => {
                suqClearSelection(component);
            });
        }

        if (bulkDeleteBtn) {
            bulkDeleteBtn.addEventListener("click", () => {
                const checks = component.querySelectorAll(".suq-file-check:checked");
                if (!checks.length) return;

                const indexes = [...checks].map(c => Number(c.dataset.index));

                suqConfirmDelete(`Delete ${indexes.length} selected files?`, () => {
                    indexes.sort((a, b) => b - a);
                    indexes.forEach(i => {
                        if (i >= 0 && i < filesArr.length) {
                            filesArr.splice(i, 1);
                        }
                    });

                    syncInput();
                    renderPreview();
                    suqClearSelection(component);
                });
            });
        }

        input.addEventListener("change", function () {
            if (!this.files.length) return;

            Array.from(this.files).forEach(file => {
                if (filesArr.length >= maxFile) {
                    errorMsg.textContent = `Maximum ${maxFile} files allowed.`;
                    errorMsg.classList.remove("hidden");

                    dropzone.classList.add("suq-error", "suq-shake");
                    setTimeout(() => dropzone.classList.remove("suq-shake"), 300);
                    setTimeout(() => {
                        dropzone.classList.remove("suq-error");
                        errorMsg.classList.add("hidden");
                    }, 3000);

                    return;
                }

                if (file.size > maxSizeBytes) {
                    errorMsg.textContent = `${file.name} exceeds the ${maxSizeMB} MB limit.`;
                    errorMsg.classList.remove("hidden");

                    dropzone.classList.add("suq-error", "suq-shake");
                    setTimeout(() => dropzone.classList.remove("suq-shake"), 300);
                    setTimeout(() => {
                        dropzone.classList.remove("suq-error");
                        errorMsg.classList.add("hidden");
                    }, 3000);

                    return;
                }

                filesArr.push(file);
            });

            syncInput();
            renderPreview();
        });

        function syncInput() {
            const dt = new DataTransfer();
            filesArr.forEach(f => dt.items.add(f));
            input.files = dt.files;
        }

        function renderPreview() {
            preview.innerHTML = "";
            if (!filesArr.length) {
                preview.classList.add("hidden");
                suqClearSelection(component);
                return;
            }

            preview.classList.remove("hidden");

            filesArr.forEach((file, index) => {
                const row = document.createElement("div");
                row.className =
                    "flex items-center justify-between p-4 rounded-2xl border shadow-sm " +
                    "bg-white/70 dark:bg-slate-800/60 backdrop-blur-xl " +
                    "border-slate-200 dark:border-slate-700 " +
                    "hover:shadow-lg hover:scale-[1.01] transition-all duration-300";

                const left = document.createElement("div");
                left.className = "flex items-center gap-4 min-w-0";

                const checkbox = document.createElement("input");
                checkbox.type = "checkbox";
                checkbox.className = "suq-file-check w-4 h-4 accent-slate-700 dark:accent-slate-300 cursor-pointer";
                checkbox.dataset.index = index;
                checkbox.addEventListener("change", updateBulkBar);
                left.appendChild(checkbox);

                const thumb = document.createElement("div");
                thumb.className =
                    "w-8 h-8 rounded-xl overflow-hidden border border-slate-300 dark:border-slate-600 " +
                    "bg-slate-100 dark:bg-slate-700 flex items-center justify-center";

                if (file.type.startsWith("image/")) {
                    const img = document.createElement("img");
                    img.src = URL.createObjectURL(file);
                    img.className = "w-full h-full object-cover hover:scale-110 transition-all duration-300";
                    thumb.appendChild(img);
                } else {
                    thumb.innerHTML = `
                        <span class="px-2 py-1 rounded-md text-xs font-semibold 
                        bg-slate-900/5 dark:bg-white/10 text-slate-700 dark:text-slate-200">
                            ${(file.name.split('.').pop() || "").toUpperCase()}
                        </span>`;
                }

                left.appendChild(thumb);

                const info = document.createElement("div");
                info.className = "flex flex-col min-w-0";

                const name = document.createElement("div");
                name.className =
                    "truncate max-w-[240px] text-sm font-semibold text-slate-800 dark:text-slate-100";
                name.textContent = file.name;

                info.appendChild(name);
                left.appendChild(info);

                row.appendChild(left);

                const actions = document.createElement("div");
                actions.className = "flex items-center shrink-0 gap-1";

                const prevBtn = document.createElement("button");
                prevBtn.type = "button";
                prevBtn.className =
                    "w-8 h-8 flex items-center justify-center rounded-lg hover:bg-slate-200 dark:hover:bg-slate-700 transition";

                prevBtn.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-slate-600 dark:text-slate-200"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.458 12C3.732 7.943 7.477 5 12 5c4.523 0 8.268 2.943 9.542 7-1.274 4.057-5.019 7-9.542 7-4.523 0-8.268-2.943-9.542-7z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>`;
                prevBtn.onclick = () => {
                    suqClearSelection(component);
                    suqHandlePreview(file);
                };

                const rmBtn = document.createElement("button");
                rmBtn.type = "button";
                rmBtn.className =
                    "w-8 h-8 flex items-center justify-center rounded-lg hover:bg-rose-100 dark:hover:bg-rose-900 transition";

                rmBtn.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-rose-600 dark:text-rose-400"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m-8 0h10M10 4h4a1 1 0 011 1v-1H9V5a1 1 0 011-1z"/>`;
                
                rmBtn.onclick = () => {
                    suqConfirmDelete(`Delete "${file.name}"?`, () => {
                        filesArr.splice(index, 1);
                        syncInput();
                        renderPreview();
                        suqClearSelection(component);
                    });
                };

                actions.appendChild(prevBtn);
                actions.appendChild(rmBtn);
                row.appendChild(actions);

                preview.appendChild(row);
            });

            updateBulkBar();
        }
    });
});

/* Clear selection for one component */
function suqClearSelection(component) {
    if (!component) return;
    const checks = component.querySelectorAll(".suq-file-check");
    checks.forEach(c => c.checked = false);

    const bar = component.querySelector(".suq-bulk-bar");
    if (bar) bar.classList.add("hidden");

    const countEl = component.querySelector(".suq-selected-count");
    if (countEl) countEl.textContent = 0;
}

/* ================= PREVIEW MODAL ================= */

function suqOpenModal() {
    document.querySelectorAll(".suq-bulk-bar").forEach(bar => bar.classList.add("hidden"));

    const modal = document.getElementById("suq-preview-modal");
    const card  = document.getElementById("suq-preview-card");

    modal.style.display = "flex";

    requestAnimationFrame(() => {
        card.classList.remove("scale-95", "opacity-0");
        card.classList.add("scale-100", "opacity-100");
    });
}

function suqCloseModal() {
    const modal = document.getElementById("suq-preview-modal");
    const card  = document.getElementById("suq-preview-card");

    card.classList.add("scale-95", "opacity-0");
    card.classList.remove("scale-100", "opacity-100");

    setTimeout(() => { modal.style.display = "none"; }, 180);
}

function suqHandlePreview(file) {
    const lowerName = file.name.toLowerCase();

    if (
        file.type.startsWith("image/") ||
        file.type === "application/pdf" ||
        lowerName.endsWith(".xlsx") ||
        lowerName.endsWith(".xls") ||
        lowerName.endsWith(".csv")
    ) {

        suqOpenModal();
        const content = document.getElementById("suq-modal-content");
        content.innerHTML = "";

        if (file.type.startsWith("image/")) {
            content.innerHTML = `
                <div class="flex justify-center">
                    <img src="${URL.createObjectURL(file)}"
                         class="rounded-xl shadow-lg" />
                </div>`;
        }
        else if (file.type === "application/pdf") {
            content.innerHTML = `
                <iframe src="${URL.createObjectURL(file)}"
                        class="rounded-lg border bg-white dark:border-slate-700"></iframe>`;
        }
        else if (lowerName.endsWith(".xlsx") || lowerName.endsWith(".xls")) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const data = new Uint8Array(e.target.result);
                const wb = XLSX.read(data, { type: "array" });
                const sheet = wb.Sheets[wb.SheetNames[0]];
                const html = XLSX.utils.sheet_to_html(sheet);

                content.innerHTML =
                    `<div class="overflow-auto suq-scroll">${html}</div>`;
            };
            reader.readAsArrayBuffer(file);
        }
        else if (lowerName.endsWith(".csv")) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const csv = e.target.result;
                const wb = XLSX.read(csv, { type: "string" });
                const sheet = wb.Sheets[wb.SheetNames[0]];
                const html = XLSX.utils.sheet_to_html(sheet);

                content.innerHTML =
                    `<div class="overflow-auto suq-scroll">${html}</div>`;
            };
            reader.readAsText(file);
        }
    } else {
        suqCloseModal();
        suqConfirmDownload(file);
    }
}

let suqFullscreen = false;
function suqToggleFullscreen() {
    const card = document.getElementById("suq-preview-card");
    suqFullscreen = !suqFullscreen;
    if (suqFullscreen) card.classList.add("suq-fullscreen");
    else card.classList.remove("suq-fullscreen");
}

window.addEventListener("resize", () => {
    const modal = document.getElementById("suq-preview-modal");
    const card = document.getElementById("suq-preview-card");
    if (modal.style.display === "flex") card.style.margin = "auto";
});

/* Close preview modal by clicking outside */
document.getElementById("suq-preview-modal").addEventListener("click", (e) => {
    const card = document.getElementById("suq-preview-card");
    if (!card.contains(e.target)) {
        suqCloseModal();
    }
});

/* ================= CONFIRM DELETE MODAL ================= */

let suqDeleteCallback = null;

function suqConfirmDelete(message, callback) {
    document.getElementById("suq-confirm-text").textContent = message;
    suqDeleteCallback = callback;

    const modal = document.getElementById("suq-confirm-modal");
    const card  = document.getElementById("suq-confirm-card");

    modal.style.display = "flex";
    requestAnimationFrame(() => {
        card.classList.remove("scale-95", "opacity-0");
        card.classList.add("scale-100", "opacity-100");
    });

    document.getElementById("suq-confirm-yes").onclick = () => {
        if (typeof suqDeleteCallback === "function") suqDeleteCallback();
        suqCloseConfirm();
    };
}

function suqCloseConfirm() {
    const modal = document.getElementById("suq-confirm-modal");
    const card  = document.getElementById("suq-confirm-card");

    card.classList.add("scale-95", "opacity-0");
    card.classList.remove("scale-100", "opacity-100");

    setTimeout(() => { modal.style.display = "none"; }, 180);
}

/* Close confirm modal by clicking outside */
document.getElementById("suq-confirm-modal").addEventListener("click", (e) => {
    const card = document.getElementById("suq-confirm-card");
    if (!card.contains(e.target)) suqCloseConfirm();
});

/* ================= DOWNLOAD CONFIRM MODAL ================= */

let suqDownloadUrl = null;

function suqConfirmDownload(file) {
    const modal = document.getElementById("suq-download-modal");
    const card  = document.getElementById("suq-download-card");
    const text  = document.getElementById("suq-download-text");
    const actionBtn = document.getElementById("suq-download-yes");

    suqDownloadUrl = URL.createObjectURL(file);
    text.textContent = `"${file.name}" cannot be previewed.`;

    actionBtn.setAttribute("href", suqDownloadUrl);
    actionBtn.setAttribute("download", file.name);

    modal.style.display = "flex";
    requestAnimationFrame(() => {
        card.classList.remove("scale-95", "opacity-0");
        card.classList.add("scale-100", "opacity-100");
    });
}

function suqCloseDownload() {
    const modal = document.getElementById("suq-download-modal");
    const card  = document.getElementById("suq-download-card");

    card.classList.add("scale-95", "opacity-0");
    card.classList.remove("scale-100", "opacity-100");

    setTimeout(() => {
        modal.style.display = "none";
        if (suqDownloadUrl) {
            URL.revokeObjectURL(suqDownloadUrl);
            suqDownloadUrl = null;
        }
    }, 180);
}

/* Close download modal by clicking outside */
document.getElementById("suq-download-modal").addEventListener("click", (e) => {
    const card = document.getElementById("suq-download-card");
    if (!card.contains(e.target)) suqCloseDownload();
});

/* ============ GLOBAL UX: CLICK OUTSIDE & ESC CLEAR SELECTION ============ */

document.addEventListener("click", e => {
    if (!e.target.closest(".smartuiqisti-upload-container") &&
        !e.target.closest("#suq-preview-modal") &&
        !e.target.closest("#suq-confirm-modal") &&
        !e.target.closest("#suq-download-modal")) {

        document.querySelectorAll(".suq-bulk-bar").forEach(bar => bar.classList.add("hidden"));
        document.querySelectorAll(".suq-file-check").forEach(c => c.checked = false);
        document.querySelectorAll(".suq-selected-count").forEach(c => c.textContent = 0);
    }
});

document.addEventListener("keydown", e => {
    if (e.key === "Escape") {
        document.querySelectorAll(".suq-bulk-bar").forEach(bar => bar.classList.add("hidden"));
        document.querySelectorAll(".suq-file-check").forEach(c => c.checked = false);
        document.querySelectorAll(".suq-selected-count").forEach(c => c.textContent = 0);
    }
});
</script>
