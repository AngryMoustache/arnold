<?php

namespace AngryMoustache\Arnold\Fields;

use AngryMoustache\Rambo\Fields\Field;

class ArnoldField extends Field
{
    public $bladeFormComponent = 'arnold::livewire.fields.form.arnold';
    public $bladeShowComponent = 'arnold::livewire.fields.show.arnold';

    public $maxColsPerRow = 5;
}
