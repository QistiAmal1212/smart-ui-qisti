<?php

namespace Qisti\SmartUi\Components\Forms;

use Illuminate\View\Component;

class UploadForm extends Component
{
    public function __construct(
    ) {
    }

    public function render()
    {
        return view('smartuiqisti::components.forms.upload-form');
    }
}
