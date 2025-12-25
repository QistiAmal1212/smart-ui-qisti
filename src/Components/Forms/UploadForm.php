<?php

namespace Qisti\SmartUi\Components\Forms;

use Illuminate\View\Component;

class UploadForm extends Component
{
    public string $label;
    public ?int $maxFile;
    public ?int $maxSize;
    public string $accept;
    public string $mainColor;
    public string $dropzoneColor;
    public string $dropzoneBorderColor;
    public string $dropzoneActiveColor;
    public string $dropzoneClass;
    public string $labelClass;
    public string $innerIconClass;
    public string $innerTitleClass;
    public string $innerTitleSubClass;
    public string $innerAcceptedClass;
    public bool $required;
    public bool $disable;
    public bool $aiEnable;
    public bool $previewOutside;
    public bool $bulkDelete;
    public bool $autoCompress;
    public ?int $maxFiles;

    public function __construct(
        string $label = 'Upload',
        int $maxFile = 1,
        ?int $maxFiles = null,
        int $maxSize = 1,
        string $accept = '.doc,.docx,.xls,.xlsx,.zip,.pdf,.png,.jpg,.jpeg',
        string $mainColor = '',
        string $dropzoneColor = '',
        string $dropzoneBorderColor = '',
        string $dropzoneActiveColor = '',
        string $dropzoneClass = '',
        string $labelClass = '',
        string $innerIconClass = '',
        string $innerTitleClass = '',
        string $innerTitleSubClass = '',
        string $innerAcceptedClass = '',
        bool $required = false,
        bool $disable = false,
        bool $aiEnable = false,
        bool $previewOutside = false,
        bool $bulkDelete = false,
        bool $autoCompress = false,
    ) {
        $this->label = $label;
        $this->maxFile = $maxFile;
        $this->maxFiles = $maxFiles ?? $maxFile;
        $this->maxSize = $maxSize;
        $this->accept = $accept;
        $this->mainColor = $mainColor;
        $this->dropzoneColor = $dropzoneColor;
        $this->dropzoneBorderColor = $dropzoneBorderColor;
        $this->dropzoneActiveColor = $dropzoneActiveColor;
        $this->dropzoneClass = $dropzoneClass;
        $this->labelClass = $labelClass;
        $this->innerIconClass = $innerIconClass;
        $this->innerTitleClass = $innerTitleClass;
        $this->innerTitleSubClass = $innerTitleSubClass;
        $this->innerAcceptedClass = $innerAcceptedClass;
        $this->required = $required;
        $this->disable = $disable;
        $this->aiEnable = $aiEnable;
        $this->previewOutside = $previewOutside;
        $this->bulkDelete = $bulkDelete;
        $this->autoCompress = $autoCompress;
    }

    public function render()
    {
        return view('smartuiqisti::components.forms.upload-form');
    }
}
