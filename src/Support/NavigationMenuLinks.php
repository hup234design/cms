<?php

namespace Hup234design\Cms\Support;

/**
 * Class FormatMenuLinks
 */
class NavigationMenuLinks
{
    public static function format($items) {

        $links = [];
        foreach( $items as $handle=>$item ) {
            if($item['type'] == 'external-link') {
                $links[] = [
                    'href' =>  $item['data']['url'],
                    'target' => $item['data']['target'],
                    'label' => $item['label']
                ];
            } else {
                switch($item['type']) {
                    case "page":
//                        if ($item['data']['slug'] == 'home' ) {
//                            $href = route('pages.home');
//                        }
//                        elseif ($item['data']['slug'] == 'posts' ) {
//                            $href = route('posts.index');
//                        }
//                        else {
                            $href = route('pages.page', $item['data']['slug']);
//                        }
                        break;
//                    case "service":
//                        $href = route('service', $item['data']['slug']);
//                        break;
//                    case "project":
//                        $href = route('project', $item['data']['slug']);
//                        break;
//                    case "event":
//                        $href = route('event', $item['data']['slug']);
//                        break;
                    default:
                        $href = route($item['data']['slug']);
                        break;
                }
                $links[] = [
                    'href'   =>  $href,
                    'target' => "_self",
                    'label'  => $item['label']
                ];
            }
        }
        return $links;
    }
}
