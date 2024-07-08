<?php

namespace App\Tables;

use App\Models\Manufacturer;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class Manufacturers extends AbstractTable
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
        return Manufacturer::query();
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $table
            ->withGlobalSearch(columns: ['name','address.address'])
            ->rowLink(function (Manufacturer $manufacturer){
                return route('manufacturer.view', $manufacturer->id);
            })
            ->column('name',label: 'Название' , sortable: true)
                ->column('boss', label: 'Имя директора', sortable: true, hidden: true)
                ->column('boss_last_name',label: 'Фамилия' , sortable: true, hidden: true)
                ->column('boss_father_name',label: 'Отчество' , sortable: true, hidden: true)
                ->column('address.address', label: 'Адрес', sortable: true)
                ->column('phone', label: 'Номер телефона', sortable: true, hidden: true)
                ->column('email', label: 'Эл.почта', sortable: true, hidden: true)
                ->column('inn', label: 'ИНН', sortable: true, hidden: true)
            ->column('action', label: 'Действия', exportAs: false)
            ->export()
            ->paginate(10);

            // ->searchInput()
            // ->selectFilter()
            // ->withGlobalSearch()

            // ->bulkAction()
            // ->export()
    }
}
