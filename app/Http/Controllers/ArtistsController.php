<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Models\Features\StyleFeatures;
use App\Models\Features\UserFeatures;
use App\Models\UserInfo;
use App\Helper\FeaturesHelper;

use Illuminate\Http\Request;

class ArtistsController extends Controller
{
    public function index($filters = [])
    {
        $filters['pagination_count'] = FeaturesHelper::getSiteFeature('artists_pagination_count');
        $filters['without_current'] = true;
        $styles = StyleFeatures::getStyles();

        $result = UserFeatures::paginateArtists($filters);
        $artists = $result['artists'];
        $pages_count = $result['pages_count'];
        $current_page_number = $result['current_page_number'];

        $data = [];
        $data['styles'] = $styles;
        $data['artists'] = $artists;
        $data['pages_count'] = $pages_count;
        $data['current_page_number'] = $current_page_number;

        if(isset($filters['artist_sort']))
        {
            $data['current_style_id'] = $filters['style'] ?? 0;
            $current_style_index = 0;

            foreach ($styles as $id => $style) {

                if($id != $filters['style'])
                    ++$current_style_index;

            }

            $data['current_style_index'] = $current_style_index;
        }

        return $this->handleView('artists', $data);
    }

    public function filterArtists(Request $request)
    {
        return $this->index(['style' => $request->style_sort ?? null, 'artist_sort' => $request->artist_sort ?? null, 'without_current' => true, 
            'offset' => $request->offset ?? 0]);
    }

    public function artist($id)
    {
        $artist = UserFeatures::getArtist($id);
        return $this->handleView('artist', [ 'artist' => $artist ]);
    }

    public function artistWork()
    {
        return $this->handleView('artist_work');
    }

    
}
