<?php

namespace App\Orchid\Screens\Artist;

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
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Picture;

use App\Models\SiteCollection;
use App\Models\SiteCollectionProduct;

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

                Input::make('product.price')
                    ->title('price')
                    ->type('number'),

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
            'product.price' => 'required',
            'product.image' => 'required',
        ]);

        $path = $request->file('product.image')->store('public/collections/products');
        $path = str_replace('public/', 'storage/', $path);
        
        $data = $request->get('product');
        $data['image'] = $path;

        $product->fill($data)->save();

        Alert::info('You have successfully edited product');

        return redirect()->route('platform.site-collection-products');
    }

    public function remove(SiteCollectionProduct $product)
    {
        $product->delete();

        Alert::info('You have successfully deleted product');

        return redirect()->route('platform.site-collection-products');
    }
}
