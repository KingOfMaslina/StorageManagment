<?php

namespace App\Tables;


use App\Models\Product;
use App\Models\Provider;
use App\Models\Shipment;
use App\Models\ShipmentFull;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class Shipments extends AbstractTable
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
                       ->orWhere('ship_date','LIKE', "%{$value}%");
               });
            });
        });

        return QueryBuilder::for(Shipment::class)
            ->leftJoin('shipment_fulls', 'shipment_fulls.shipment_id', '=', 'shipments.id')
            ->select(Shipment::raw("shipments.id as id ,shipments.provider_id as provider_id,SUM(products.price * shipment_fulls.quantity) as sum, shipments.ship_date as ship_date,  shipments.status_id as status_id"))
            ->leftJoin('products', 'shipment_fulls.product_id', '=', 'products.id')
            ->groupByRaw('shipments.id')
            ->allowedFilters('provider_id','status_id',$globalSearch)
            ->allowedSorts('id','sum');
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $product = Product::pluck('name','id')->toArray();
        $provider = Provider::pluck('name','id')->toArray();
        $status = Status::pluck('status','id')->toArray();
        $table
            ->withGlobalSearch(columns: ['ship_date'])
            ->column('id',label: 'Номер поставки' , sortable: true)
            ->column('provider.name', label: 'Поставщик')
            ->selectFilter('provider_id', $provider, label: 'Поставщик')
            ->column('sum',label:'Сумма', sortable: true)
            ->column('ship_date', label: 'Дата поставки')
//            ->column('document', label: 'Накладная на товар', hidden: true)
            ->column('status.status', label: 'Статус')
            ->selectFilter('status_id', $status, label: 'Статус')
            ->column('action', label: 'Действия', exportAs: false)
            ->column('shipmentfull', label: 'Список товаров', canBeHidden: false, exportAs: false)
            ->export()
            ->paginate(10);

            // ->searchInput()
            // ->selectFilter()
            // ->withGlobalSearch()

            // ->bulkAction()
            // ->export()
    }
}
