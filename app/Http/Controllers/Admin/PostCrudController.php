<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PostRequest;
use App\Models\Category;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class PostCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PostCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Post::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/post');
        CRUD::setEntityNameStrings('Bài viết', 'Bài viết');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        //CRUD::setFromDb(); // columns

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
        CRUD::column('name')->label('Tiêu đề bài viết');

        //CRUD::addColumn(['name' => 'desc', 'type' => 'textarea', 'label' => 'Mô tả']);
        CRUD::addColumn(['name' => 'image', 'type' => 'image', 'label' => 'Image']);

        CRUD::addColumn([
            'name' => 'category_id',
            'entity' => 'category',
            'attribute' => 'name',
            'model' => 'App\Models\Category',
            'type' => 'select',
            'label' => 'Chuyên mục'
        ]);
        CRUD::addColumn([
            'label'     => 'Từ Khóa',
            'type'      => 'select_multiple',
            'name'      => 'tags',
            'entity'    => 'tags',
            'attribute' => 'name',
            'model'     => 'App\Models\Tag'
        ]);

        CRUD::addColumn([
            'name' => 'status',
            'type' => 'boolean',
            'label' => 'Trạng thái'
        ]);

        CRUD::addColumn([
            'name' => 'is_highlight_index',
            'type' => 'boolean',
            'label' => 'Nổi bật?'
        ]);

        CRUD::addColumn([
            'name' => 'is_focus_index',
            'type' => 'boolean',
            'label' => 'Tiêu điểm?'
        ]);

        CRUD::column('views')->type('number')->label('Lượt xem');

        CRUD::addFilter([
            'name'  => 'category_filter',
            'type'  => 'select2',
            'label' => 'Chuyên mục'
        ], function () {
            return Category::where('status', true)->pluck('name', 'id')->all();
        }, function ($value) { // if the filter is active
            CRUD::addClause('where', 'category_id', $value);
        });
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(PostRequest::class);

        //CRUD::setFromDb(); // fields

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
        CRUD::field('name')->label('Tiêu đề bài viết');

        CRUD::addField(['name' => 'desc', 'type' => 'textarea', 'label' => 'Mô tả']);
        CRUD::addField(['name' => 'content', 'type' => 'ckeditor', 'label' => 'Nội dung']);
        CRUD::addField(['name' => 'image', 'type' => 'browse', 'label' => 'Image']);

        CRUD::addField([
            'name' => 'category_id',
            'entity' => 'category',
            'attribute' => 'name',
            'model' => 'App\Models\Category',
            'type' => 'select2',
            'label' => 'Chuyên mục',
            'options'   => (function ($query) {
                return $query->whereDoesntHave('children')->orderBy('name', 'ASC')->get();
            }), //  you can use this to filter the results show in the select
        ]);
        CRUD::addField([
            'label'     => 'Từ Khóa',
            'type'      => 'select2_multiple',
            'name'      => 'tags',
            'entity'    => 'tags',
            'attribute' => 'name',
            'model'     => 'App\Models\Tag'
        ]);

        CRUD::addField([
            'name' => 'status',
            'type' => 'boolean',
            'label' => 'Trạng thái'
        ]);

        CRUD::addField([
            'name' => 'is_highlight_index',
            'type' => 'boolean',
            'label' => 'Nổi bật?'
        ]);

        CRUD::addField([
            'name' => 'is_focus_index',
            'type' => 'boolean',
            'label' => 'Tiêu điểm?'
        ]);



    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
