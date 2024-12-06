<?php

namespace App\Livewire;

use Livewire\Component;

class TableAdmin extends Component
{
    public $modalTable = 'Assignment';

    public function setModalTable($table)
    {
        $this->modalTable = $table;
    }

    public function render()
    {
        return view('livewire.table-admin');
    }
}
