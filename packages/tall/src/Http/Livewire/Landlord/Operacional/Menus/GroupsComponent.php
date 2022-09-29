<?php
/**
* Created by Bengs.
* User: contato@bengs.com.br
* https://www.bengs.com.br
*/
namespace Tall\Http\Livewire\Landlord\Operacional\Menus;

use Livewire\Component;
use App\Models\Menu;
use App\Models\SubMenu;

class GroupsComponent extends Component
{
    public $currentModel;
    public $actionType;
    public $showModal=false;
    public $sortable=false;
    public $showToggle=[];
    public $model;
    public $filters = [];
    public $data = [];

    protected $listeners = ['loadMenusAdd'=>'loadMenus','closeModal'=>'showModalToggleManager'];

    public function mount(Menu $model, $filters=[])
    {
       $this->model = $model;
       $this->filters = $filters;
       data_set($this->data,'name', '');
       data_set($this->data,'menu_id', $model->id);
       data_set($this->data,'user_id', auth()->id());
       data_set($this->data,'status', 1);
       data_set($this->data,'created_at', now()->format("Y-m-d H:i:s"));
       data_set($this->data,'updated_at', now()->format("Y-m-d H:i:s"));
    }

    public function getMenusProperty()
    {
        return $this->loadMenus();
    }


    public function loadMenus()
    {
        $this->currentModel =  null;
        $this->actionType =  0;
        $query = $this->model->sub_menus()->with([
            'sub_menus' => fn ($sub_menu) => $sub_menu->orderByDesc('ordering')
        ]);
        if($search = data_get($this->filters, 'search')){
            $query->where('name', 'LIKE',"%{$search}%");
        }
        return $query->orderBy('ordering')->get();
    }

    public function render()
    {
        return view('tall::landlord.operacional.menus.groups-component');
    }
    public function reorderGroups($data)
    {
       
        $groups = SubMenu::query()->findMany($data);
 
        $groups->map(function (SubMenu $group) use ($data) {
            $arr = array_flip(array_filter($data));
            $group->ordering = data_get($arr, $group->id);
            return $group;
        });

        $groupsArrs =  $groups->toArray();
        $groupsArr=[];
        if($groupsArrs){
            foreach($groupsArrs as $group){
                unset($group['sub_menus']);
                $groupsArr[] = $group;
            }
        }
        SubMenu::query()->upsert(
            $groupsArr,
            ['id'],
            ['ordering']
        );
    }
    protected $rules = [
        'data.name' => 'required|min:6',
        'data.description' => 'required',
    ];
    public function addMenu()
    {
        $this->validate();
        $this->model->sub_menus()->create($this->data);
       $this->showModalToggle();
    }

    public function showToggle($model, $value)
    {
        $this->showToggle[$model] = $value;
    }

    public function toggleSortable()
    {
        $this->sortable = !$this->sortable;
    }
    
    public function showModalToggle()
    {
        $this->showModal = !$this->showModal;
    }
    
    public function showModalToggleManager($id = null, $actionType=0)
    {       $this->currentModel =  null;
            $this->actionType =  0;
        if($sub = $this->model->sub_menus()->where('id', $id)->first()){
            $this->currentModel =  $sub;
            $this->actionType =  $actionType;
        }
        
    }


}
