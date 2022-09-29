<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/

namespace Tall\Table;


abstract class AbstractColumn
{
    /**
     * @var
     */
    protected $key;
    /**
     * @var
     */
    protected $name;
    /**
     * @var
     */
    protected $label;
    /**
     * @var
     */
    protected $order;
    /**
     * @var
     */
    protected $formatCallback;
    /**
     * @var bool
     */
    protected $sortable = false;

    /**
     * @var bool
     */
    protected $searchable = false;

    /**
     * @var []
     */
    protected $options = [];
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label, $name=null)
    {
        $this->init($label, $name);
    }

    public function init($label, $name=null)
    {
        if($label){
            if(empty($name)){
                $name = \Str::slug($label, '_');
            }
            $this->key = $name;
            $this->name = $name;
            $this->label = $label;
            $this->id = uniqid();
        }      
        
    }
    public static function make($label = null, $name=null)
    {
       return new static($label, $name);
    }

    public function view()
    {
        return null;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render($model)
    {
        if($view = $this->view()){
            return view(sprintf('tall::table.%s', $view), compact('model'))->with(get_object_vars($this));
        }
        elseif($this->isFormatted()){
            return $this->formatted($model, get_object_vars($this));
        }
        return data_get($model, $this->key);
    }

    public function options($options)
    {
        $this->options = $options;

        return $this;
    }

    public function span($span)
    {
        $this->span = $span;

        return $this;
    }

   /**
     * @param callable $callable
     *
     * @return $this
     */
    public function format(callable $callable): Column
    {
        $this->formatCallback = $callable;

        return $this;
    }


    public function order($order)
    { 
        $this->order =  $order;

        return $this;
    }
    
    public function __get($name)
    {
        return data_get(get_object_vars($this), $name);
    }

     /**
     * @return bool
     */
    public function isFormatted(): bool
    {
        return is_callable($this->formatCallback);
    }

    
    /**
     * @return bool
     */
    public function isSortable(): bool
    {
        return $this->sortable === true;
    }
    
    /**
     * @return bool
     */
    public function isSearchable(): bool
    {
        return $this->searchable === true;
    }

    /**
     * @param $model
     * @param $column
     *
     * @return mixed
     */
    public function formatted($model, $column)
    {
        return app()->call($this->formatCallback, ['model' => $model, 'column' => $column]);
    }
}
