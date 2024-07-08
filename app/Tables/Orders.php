<?php

namespace App\Tables;

use Illuminate\Support\Collection;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Status;
use App\Models\Worker;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use Spatie\QueryBuilder\AllowedFilter;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\QueryBuilder;

class Orders extends AbstractTable
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
                       ->orWhere('order_date','LIKE', "%{$value}%")
                       ->orWhere('entry_date','LIKE', "%{$value}%");
               });
            });
        });

        return QueryBuilder::for(Order::class)
            ->leftJoin('order_fulls', 'order_fulls.order_id', '=', 'orders.id')
            ->select(Order::raw("orders.id as id ,orders.customer_id as customer_id,orders.worker_id as worker_id,SUM(products.price * order_fulls.quantity) as sum, orders.order_date as order_date, orders.entry_date as entry_date, orders.status_id as status_id"))
            ->leftJoin('products', 'order_fulls.product_id', '=', 'products.id')
            ->groupByRaw('orders.id')
            ->allowedFilters($globalSearch)
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
        $customer = Customer::pluck('name','id')->toArray();
        $status = Status::pluck('status','id')->toArray();
        $worker = Worker::pluck('last_name','id')->toArray();
        $table
          ->withGlobalSearch(columns: ['order_date','entry_date'])
            ->rowLink(function (Order $order){
                return route('order.view', $order->id);
            })
            ->column('id',label: 'Номер заказа' , sortable: true)
            ->column('customer.name',label: 'Покупатель')
            ->column('sum',label:'Сумма', sortable: true)
            ->column('worker.last_name', label: 'Сотрудник(доставщик)')
//            ->column('document', label: 'Накладная', hidden: true)
            ->column('order_date', label: 'Дата заказа', hidden: true)
            ->column('entry_date', label: 'Дата прибития', hidden: true)
            ->column('status.status', label: 'Статус')
            ->selectFilter('status_id', $status, label: 'Статус заказа')
            ->selectFilter('customer_id', $customer, label: 'Покупатель')
            ->selectFilter('worker_id', $worker, label: 'Сотрудник')
            ->column('action', label: 'Действия', exportAs: false)
            ->column('orderfull', label: 'Список товаров', canBeHidden: false, exportAs: false)
            ->export()
            ->paginate(10);

            // ->searchInput()
            // ->selectFilter()
            // ->withGlobalSearch()

            // ->bulkAction()
            // ->export()
    }
}
