<div x-data="{ open: true }">
    <link href="{{ asset('vendor/arnold/css/arnold.css') }}" rel="stylesheet">

    <a class="button mr-1" x-on:click="open = true">
        Edit content
    </a>

    @if ($value !== $originalValue)
        <br>
        <br>
        <div class="rambo-warning">
            <i class="fas fa-exclamation-triangle"></i>
            <p>
                Warning, you have unsaved changes!<br>
                Remember to save the resource to save your changes.
            </p>
        </div>
    @endif

    <div
        x-show="open"
        {{-- style="display: none" --}}
        class="arnold"
    >
        <div class="arnold-content-overlay" wire:loading.flex wire:target="savePage">
            <x-rambo::loading />
        </div>

        <div class="arnold-content">
            <div class="arnold-content-page" {{-- wire:sortable="sortRows" --}}>
                @foreach ($rows as $rowKey => $row)
                    <x-arnold::rows.new :index="$rowKey" />

                    <div
                        wire:sortable.item="{{ $rowKey }}"
                        wire:key="block-{{ $rowKey }}"
                    >
                        <div class="arnold-content-page-row">
                            <div class="arnold-content-page-row-name">
                                <h1>{{ $row['name'] }}</h1>

                                <div class="arnold-content-page-row-name-actions">
                                    <a wire:sortable.handle class="move-cursor">
                                        <i class="fas fa-bars"></i>
                                    </a>

                                    <x-arnold::rows.actions :index="$rowKey" />
                                </div>
                            </div>

                            <div class="arnold-content-page-row-columns">
                                @foreach ($row['columns']['data'] as $colKey => $column)
                                    <x-arnold::columns.column
                                        :row-key="$rowKey"
                                        :col-key="$colKey"
                                        :column="$column"
                                    />
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach

                <x-arnold::rows.new />
            </div>
        </div>

        <div class="arnold-tools">
            <div class="arnold-tools-blocklist">
                <h2>Blocks</h2>
                {{-- <ul wire:sortable="sortBlocks">
                    @foreach ($blockValues as $key => $block)
                        <li wire:sortable.item="{{ $key }}" wire:key="tool-block-{{ $key }}">
                            <span wire:sortable.handle class="move-cursor">
                                <i class="fas fa-bars"></i>
                                {{ $block->getName() }}
                            </span>

                            <div class="arnold-tools-blocklist-actions">
                                <x-arnold::block-actions :index="$key" />
                            </div>
                        </li>
                    @endforeach
                </ul> --}}
            </div>

            <div class="arnold-tools-buttons">
                <div class="button" wire:click="savePage">
                    Save
                </div>

                <div class="button-link" x-on:click="open = false">
                    Cancel
                </div>
            </div>
        </div>
    </div>

    @if ($rowModal)
        <x-rambo::modal>
            <x-slot name="title">{{ $rowModal['name'] }}</x-slot>
            <x-slot name="loader"></x-slot>

            <x-slot name="content" class="no-padding">
                <div class="crud-form-field">
                    <div class="crud-form-field-label">
                        <label for="name">Name</label>
                    </div>

                    <div class="crud-form-field-input">
                        <input
                            type="text"
                            id="name"
                            name="name"
                            placeholder="Row name"
                            wire:model.lazy="rowModal.name"
                        >
                    </div>
                </div>

                <div class="crud-form-field">
                    <div class="crud-form-field-label">
                        <label for="columns">Columns</label>
                    </div>

                    <div class="crud-form-field-input">
                        <input
                            type="number"
                            id="columns"
                            name="columns"
                            placeholder="Column count"
                            wire:model.lazy="rowModal.columns.amount"
                            min="1"
                            max="{{ $field->getMaxColsPerRow() }}"
                        >
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <a wire:click.prevent="closeModal" class="button-link">
                    Cancel
                </a>

                <a wire:click.prevent="saveRow" class="button">
                    Save changes
                </a>
            </x-slot>
        </x-rambo::modal>
    @endif

    {{-- @if ($modal)
        <div class="arnold-modal modal">
            <div class="modal-card w-60 no-padding">
                <div class="modal-card-title">
                    <h4>{{ $modal['title'] }}</h4>
                </div>

                @if ($modal['type'] !== 'deleting')
                    <div class="modal-card-subtitle">
                        <select wire:model="modal.selected">
                            <option value="">- Select a block -</option>
                            @foreach ($blocks as $block)
                                <option value="{{ get_class($block) }}">
                                    {{ $block->getName() }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif

                <div class="modal-card-content-fixed no-padding">
                    @if ($modal['type'] === 'deleting')
                        <table class="crud-show-table">
                            @foreach (optional($modal['block'])->fields() ?? [] as $field)
                                <tr>
                                    <td class="crud-show-table-label">
                                        <span>
                                            {{ $field->getLabel() }}
                                        </span>
                                    </td>

                                    <td class="crud-show-table-value">
                                        <span class="crud-index-table-content">
                                            {{ $field->item($modal['fields'])->renderShow() }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        @if ($modal['selected'] !== '')
                            <div wire:key="{{ $modal['selected'] }}">
                                @foreach($blocks[$modal['selected']]->fields() as $field)
                                    {{
                                        $field
                                            ->item($modal['fields'])
                                            ->emit('field:arnold-update')
                                            ->render()
                                    }}
                                @endforeach
                            </div>
                        @endif
                    @endif
                </div>

                <div class="modal-card-footer">
                    <div class="button" wire:click="saveBlock">
                        {{ $modal['button_text'] }}
                    </div>

                    <a wire:click.prevent="closeModal" class="button-link">
                        Cancel
                    </a>
                </div>
            </div>
        </div>
    @endif --}}
</div>
