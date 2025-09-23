<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimplePie;
use Illuminate\Support\Facades\Cache;

class NewsController extends Controller
{
    public function index()
    {
        // Récupérer les articles du cache Laravel si disponibles, sinon recharger
        $all_items = Cache::remember('news_feed_items', 43200, function () {
            $feed = new SimplePie();
            $feed_urls = [
                'https://www.rei.com/blog/hike/feed',
                'https://www.i-trekkings.net/feed/',
                'https://bigskywalker.com/feed/',
            ];
            
            // Configurer le cache de SimplePie
            $feed->set_cache_location(storage_path('app/simplepie/cache'));
            $feed->set_cache_duration(43200); // Cache de 12 heures pour SimplePie
            
            // Initialiser un tableau pour stocker tous les articles
            $all_items = [];

            // Parcourir chaque URL de flux RSS
            foreach ($feed_urls as $url) {
                $feed->set_feed_url($url);
                $feed->init();
                $items = $feed->get_items();

                foreach ($items as $item) {
                    $image_url = null;

                    // Extraire l'image de l'article en vérifiant plusieurs sources possibles
                    if ($item->get_enclosure()) {
                        $image_url = $item->get_enclosure()->link;
                    } elseif (preg_match('/<img.*?src=["\'](.*?)["\']/', $item->get_description(), $matches)) {
                        $image_url = $matches[1];
                    } elseif ($encoded_content = $item->get_item_tags('http://purl.org/rss/1.0/modules/content/', 'encoded')) {
                        preg_match('/<img.*?src=["\'](.*?)["\']/', $encoded_content[0]['data'], $matches);
                        $image_url = $matches[1] ?? null;
                    } elseif ($media_content = $item->get_item_tags('http://search.yahoo.com/mrss/', 'content')) {
                        $image_url = $media_content[0]['attribs']['']['url'] ?? null;
                    }

                    // Ajouter les données d'image et de date à l'article
                    $item->image_url = $image_url;
                    $item->pubDate = $item->get_date('Y-m-d H:i:s');
                }

                // Ajouter les articles de chaque flux au tableau général
                $all_items = array_merge($all_items, $items);
            }

            // Trier les articles par date de publication, plus récents en premier
            usort($all_items, function ($a, $b) {
                return strtotime($b->pubDate) - strtotime($a->pubDate);
            });

            return $all_items;
        });

        // Passer les articles à la vue
        return view('news.index', ['items' => $all_items]);
    }
}
