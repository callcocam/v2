<?php
/**
* Created by Bengs.
* User: contato@bengs.com.br
* https://www.bengs.com.br
*/
namespace Tall\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string component(string $name)
 * @method static ComponentResolver components()
 * @method static BladeDirectives directives()
 */
class Column extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Tall\Table\Column::class;
    }
}
