<?php

namespace App\Tables;

use App\Models\Category;
use App\Models\Characteristic;
use App\Models\Manufacturer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class Products extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the user is authorized to perform bulk actions and exports.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        return true;
    }

    /**
     * The resource or query builder.
     *
     * @return mixed
     */
    public function for()
    {
        $globalSearch = AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
               Collection::wrap($value)->each(function ($value) use ($query) {
                   $query
                       ->orWhere('name','LIKE', "%{$value}%")
                       ->orWhere('articul','LIKE', "%{$value}%");
               });
            });
        });

        return QueryBuilder::for(Product::class)
            ->leftJoin('shipment_fulls', 'shipment_fulls.product_id', '=', 'products.id')
            ->leftJoin('order_fulls', 'order_fulls.product_id', '=', 'products.id')
            ->select(Product::raw("products.id as id ,products.name as name ,products.category_id as category_id ,products.articul as articul,products.price as price, products.manufacturer_id as manufacturer_id ,products.unit as unit,products.quantity as quantity"))//SUM(shipment_fulls.quantity - order_fulls.quantity) as quantity
            ->groupByRaw('products.id')
            ->allowedFilters('category_id','manufacturer_id','unit', $globalSearch)
            ->allowedSorts('price','quantity');
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $category = Category::pluck('name','id')->toArray();
        $manufacturer = Manufacturer::pluck('name','id')->toArray();
        $table
            ->rowLink(function (Product $product){
                return route('product.view', $product->id);
            })
            ->withGlobalSearch(columns: ['name','articul'])
            ->column('name',label: 'Название' )
            ->column('category.name', label: 'Категория')
            ->selectFilter('category_id', $category, label: 'Категория')
            ->column('articul', label: 'Артикул')
            ->column('price', label: 'Цена', sortable: true)
            ->column('manufacturer.name', label: 'Производитель')
            ->selectFilter('manufacturer_id', $manufacturer, label: 'Производитель')
            ->selectFilter(key: 'unit', label: 'Ед.Измерения', options: [
                'Штука' => 'Штука',
                'Метр' => 'Метр',
            ])
            ->column('unit',label: 'Ед.значения')
            ->column('quantity', label: 'Количество', sortable: true)
            ->column('action', label: 'Действия', exportAs: false)
            ->column('characteristic', label: 'Характеристики', canBeHidden: false, exportAs: false)
            ->export( filename: "Товары.xlsx")
            ->paginate(10);

            // ->searchInput()
            // ->selectFilter()
            // ->withGlobalSearch()

            // ->bulkAction()
            // ->export()
    }
}
