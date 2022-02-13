<?php

namespace AngryMoustache\Arnold\Http\Livewire;

use AngryMoustache\Rambo\Http\Livewire\Fields\FormField;

class Arnold extends FormField
{
    public $component = 'arnold::livewire.arnold';

    public $originalValue = null;

    public $rows = [];

    public $blocks = [];

    public $rowModal = null;

    public function mount($field = null, $item = null, $rules = [])
    {
        parent::mount($field, $item, $rules);
        $this->originalValue = $this->value;
    }

    /**
     * ROWS
     */

    public function addRow($index = null)
    {
        // TODO: insert at $index
        $this->rows[] = [
            'name' => 'New row',
            'columns' => [
                'amount' => 1,
                'data' => [[/** New blocks/columns wil be inserted here */]]
            ],
        ];
    }

    public function editRow($index)
    {
        $this->rowModal = $this->rows[$index];
        $this->rowModal['index'] = $index;
    }

    public function deleteRow($index)
    {
        // TODO: show warning
        unset($this->rows[$index]);
    }

    public function saveRow()
    {
        $row = $this->rowModal;
        unset($row['index']);

        while ((int) $row['columns']['amount'] > count($row['columns']['data'])) {
            $row['columns']['data'][] = [];
        }

        // TODO: Don't delete stuff, client might lose progress, show warning first instead
        while ((int) $row['columns']['amount'] < count($row['columns']['data'])) {
            array_pop($row['columns']['data']);
        }

        $this->rows[$this->rowModal['index']] = $row;
        $this->closeModal();
    }

    public function closeModal()
    {
        $this->rowModal = null;
    }

    public function sortRows()
    {
        // TODO
    }

    /**
     * BLOCKS
     */
    public function addBlock($rowKey, $colKey)
    {

    }
}
