<?php

namespace App\Tables;

use App\Models\Post;
use App\Models\Worker;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class Workers extends AbstractTable
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
        return Worker::query();
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $post = Post::pluck('post','id')->toArray();
        $table
            ->withGlobalSearch(columns: ['name','last_name','father_name','post.post'])
            ->rowLink(function (Worker $worker){
                return route('worker.view', $worker->id);
            })
            ->column('name',label: 'Имя' , sortable: true)
            ->column('last_name',label: 'Фамилия' , sortable: true)
            ->column('father_name',label: 'Отчество' , sortable: true)
            ->column('post.post',label: 'Должность', sortable: true)
            ->selectFilter('post_id', $post, label: 'Должность')
            ->column('phone', label: 'Номер телефона', sortable: true, hidden: true)
            ->column('email', label: 'Эл.Почта', sortable: true, hidden: true)
            ->column('passport', label: 'Паспортные данные', sortable: true, hidden: true)
            ->column('regaddress', label: 'Адрес прописки', sortable: true, hidden: true)
            ->column('address_id', label: 'Фактический адрес', sortable: true, hidden: true)
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
