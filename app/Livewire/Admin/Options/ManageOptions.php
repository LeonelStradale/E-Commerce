<?php

namespace App\Livewire\Admin\Options;

use App\Livewire\Forms\Admin\Options\NewOptionForm;
use App\Models\Option;
use Livewire\Component;
use Livewire\Attributes\On;


class ManageOptions extends Component
{
    public $options;

    public NewOptionForm $newOption;

    public function mount()
    {
        $this->options = Option::with('features')->get();
    }

    #[On('featureAdded')]
    public function updateOptionList()
    {
        $this->options = Option::with('features')->get();
    }

    public function addFeature()
    {
        $this->newOption->addFeature();
    }

    public function removeFeature($index)
    {
        $this->newOption->removeFeature($index);
    }

    public function addOption()
    {
        $this->newOption->save();

        $this->options = Option::with('features')->get();

        $this->dispatch('swal', [
            'icon' => 'success',
            'title' => 'Bien hecho',
            'text' => 'La opción se agrego correctamente.'
        ]);
    }

    public function render()
    {
        return view('livewire.admin.options.manage-options');
    }
}
