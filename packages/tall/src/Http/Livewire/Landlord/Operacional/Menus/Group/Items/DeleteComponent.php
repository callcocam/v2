<?php
/**
* Created by Bengs.
* User: contato@bengs.com.br
* https://www.bengs.com.br
*/
namespace Tall\Http\Livewire\Landlord\Operacional\Menus\Group\Items;

use Tall\Http\Livewire\AbstractDeleteComponent;
use App\Models\SubMenu;

class DeleteComponent extends AbstractDeleteComponent
{
    public $showModal=false;

    public function mount(SubMenu $model, $showModal= false)
    {
        $this->showModal =$showModal;
        $this->model =$model;
        $this->data =$model->toArray();
    }

    public function view()
    {
        return 'tall::landlord.operacional.menus.group.items.delete';
    }
    public function trashConfirm($callback=null)
    {
        $this->model->sub_menus->map(function(SubMenu $model){
            $model->delete();
        });

        return parent::trashConfirm(function($model){        
            $this->emit('closeModal');
        });

    }

    public function showModalToggle()
    {
        $this->showModal = false;        
        $this->emit('closeModal');
    }
}
