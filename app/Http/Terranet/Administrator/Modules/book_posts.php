<?php

namespace App\Http\Terranet\Administrator\Modules;

use Terranet\Administrator\Contracts\Module\Editable;
use Terranet\Administrator\Contracts\Module\Exportable;
use Terranet\Administrator\Contracts\Module\Filtrable;
use Terranet\Administrator\Contracts\Module\Navigable;
use Terranet\Administrator\Contracts\Module\Sortable;
use Terranet\Administrator\Contracts\Module\Validable;
use Terranet\Administrator\Scaffolding;
use Terranet\Administrator\Traits\Module\AllowFormats;
use Terranet\Administrator\Traits\Module\AllowsNavigation;
use Terranet\Administrator\Traits\Module\HasFilters;
use Terranet\Administrator\Traits\Module\HasForm;
use Terranet\Administrator\Traits\Module\HasSortable;
use Terranet\Administrator\Traits\Module\ValidatesForm;
use App\Book_post;
use Terranet\Administrator\Field\BelongsTo;
use Terranet\Administrator\Filter\Enum;
use Terranet\Administrator\Filter\Text;
use Terranet\Administrator\Filter\DateRange;
use Illuminate\Database\Eloquent\Builder;

/**
 * Administrator Resource book_posts
 *
 * @package Terranet\Administrator
 */
class book_posts extends Scaffolding implements Navigable, Filtrable, Editable, Validable, Sortable, Exportable
{
    use HasFilters, HasForm, HasSortable, ValidatesForm, AllowFormats, AllowsNavigation;

    /**
     * The module Eloquent model
     *
     * @var string
     */
    protected $model = Book_post::class;
    public function columns(): \Terranet\Administrator\Collection\Mutable
    {
        return $this->scaffoldColumns()->push(BelongsTo::make('user')->useForTitle('username'))->except(['user_id'])->move('user','after:id');
    }

    public function sortable()
    {
        return[
            'title','author','publisher','condition','publishing_date','state','price'
        ];
    }
    public function filters()
    {   $arr1=['pending', 'rejected', 'accepted', 'sold'];
        $filter1 = new Enum('state');
        $filter1->setOptions($arr1);
        $filter1->setQuery(function(Builder $builder,$value) use ($arr1){
            return $builder->where('state','like',$arr1[$value]);
        });
        $filter2= new Text('title');
        $filter2->setQuery(function (Builder $builder, $value) {
            return $builder->where('title','like',$value);
        });
        $filter3 = new Text('author');
        $filter3->setQuery(function (Builder $builder, $value) {
            return $builder->where('author', 'like', $value);
        });
        $filter4 = new Text('publisher');
        $filter4->setQuery(function (Builder $builder, $value) {
            return $builder->where('publisher', 'like', $value);
        });
        $filter5 = new DateRange('publishingDate');
        $filter5->setQuery(function (Builder $builder, $value) {
            return $builder->whereBetween('publishing_date',$value);
        });
        $arr2 = ['very good', 'good', 'ok', 'worn', 'bad'];
        $filter6 = new Enum('condition');
        $filter6->setOptions($arr2);
        $filter6->setQuery(function (Builder $builder, $value) use ($arr2) {
            return $builder->where('state', 'like', $arr2[$value]);});

        $filter7 = new Text('User');
        $filter7->setQuery(function (Builder $builder, $value) {
            return $builder->join('users as u','u.id','=','user_id')
            ->where('username', 'like', $value);
        });
        return $this->scaffoldFilters()->push($filter7)->push($filter6)
        ->push($filter2)->push($filter3)->push($filter4)->push($filter5)->push($filter1);
    }
    public function scopes(){
        return $this->scaffoldScopes();
    }

}
