<div class="crud-form-field">
    <x-rambo::crud.fields.label :field="$field" />

    <div class="crud-form-field-input">
        <livewire:arnold
            :resource="$resource"
            :field="$field"
        />

        <x-rambo::crud.fields.error :field="$field" />
    </div>
</div>
