<?php

namespace App\Orchid\Screens\SiteCollectionProduct;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Picture;

use App\Models\SiteCollection;
use App\Models\SiteCollectionProduct;
use App\Models\SiteSize;
use App\Models\SiteProductSize;

class AddEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'AddEditScreen';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'AddEditScreen';

    /**
     * @var bool
     */
    public $exists = false;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(SiteCollectionProduct $product): array
    {
        $this->exists = $product->exists;

        if ($this->exists)
        {
            $this->name = 'Edit record';
        }

        return [
            'product' => $product
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            // Button::make('Remove')
            //     ->icon('trash')
            //     ->method('remove')
            //     ->canSee($this->exists),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            Layout::rows([
                Relation::make('product.collection')
                    ->title('Collection')
                    ->fromModel(SiteCollection::class, 'name'),

                Input::make('product.name')
                    ->title('name'),

                Input::make('product.description')
                    ->title('description'),

                Input::make('product.price')
                    ->title('price')
                    ->type('number'),

                Relation::make('product.product_sizes.')
                    ->fromModel(SiteSize::class, 'size')
                    ->multiple()
                    ->title('Sizes'),

                Input::make('product.image')
                    ->type('file'),

                Button::make('Save')->method('createOrUpdate')
            ])
        ];
    }

    public function createOrUpdate(SiteCollectionProduct $product, Request $request)
    {
        $validate = $request->validate([
            'product.collection' => 'required',
            'product.name' => 'required|max:200|',
            'product.description' => 'required',
            'product.price' => 'required',
            'product.image' => $product->image ? '' : 'required',
            'product.product_sizes' => 'array'
        ]);

        $data = $request->get('product');

        if($request->file('product.image'))
        {
            $path = $request->file('product.image')->store('public/collections/products');
            $path = str_replace('public/', 'storage/', $path);
            $data['image'] = $path;
        }

        $product->fill($data)->save();

        $product->product_sizes()->detach();

        if(isset($data['product_sizes']))
            $product->product_sizes()->attach($data['product_sizes']);

        Alert::info('You have successfully created product');

        return redirect()->route('platform.site-collection-products');
    }

    public function remove(SiteCollectionProduct $product)
    {
        $product->delete();

        Alert::info('You have successfully deleted product');

        return redirect()->route('platform.site-collection-products');
    }
}
