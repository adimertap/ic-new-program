<?php
/**
 * Author  		: Hamzah
 * Email 		: if.hamzah93@gmail.com
 * Since       	: Version 1.2 Modified
 * Dilarang merubah apapun tanpa sepengetahuan pembuat
 */

namespace App\Helpers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Menu {

	public static function load_query()
	{
		$otori = Auth::User()->role;
		Session::forget('menu-'.$otori);
		if (Session::exists('menu-'.$otori)) {
			return Session::get('menu-'.Auth::User()->role);
	    } else {
			$sql = DB::table('dyn_menu AS a')
	        ->select('a.id', 'a.url', 'a.title', 'a.parent_id','a.is_parent','b.show_menu')
	        ->join('otori AS b', 'a.id', '=', 'b.menu_id')
	        ->where('b.user_id','=',$otori)
	        ->where('b.show_menu','=','1')
	        ->orderBy('a.id', 'ASC')
	        ->get();
	        Session::put('menu-'.$otori, $sql);
	        return $sql;
	    }
	}

	public static function has_children($rows, $id)
	{
		foreach ($rows as $row) {
			if ($row['parent'] == $id)
			return true;
		}
		return false;
	}

	public static function build_menu($table = '', $type = '0',$otori = '0')
    {
        $menu = array();
        $tampung = array();
        $sql = Menu::load_query();

        $x = 1;
        if (count($sql) > 0)
        {
            foreach ($sql as $row)
            {
				$tampung[$x] = $row->id;
				$x = $x+1;
				
                $menu[$row->id]['id'] = $row->id;
                $menu[$row->id]['title'] = $row->title;
                $menu[$row->id]['url'] = $row->url;
                $menu[$row->id]['parent'] = $row->parent_id;
                $menu[$row->id]['is_parent']  = $row->is_parent;
                $menu[$row->id]['show'] = $row->show_menu;
            }
        }

        $html_out  = '<ul class="navbar-nav">';
		$x = 1;
        for ($a = 1; $a <= count($menu); $a++)
        {
		$xid = $tampung[$a];
			if (is_array($menu[$xid]))
            {
                if ($menu[$xid]['parent'] == 0)
                {
					if (Menu::has_children($menu, $menu[$xid]['id'])  == TRUE)
                    {
                        $html_out .= '<li class="nav-item dropdown">';
                        $html_out .= '<a class="nav-link dropdown-toggle arrow-none" href="'.url($menu[$xid]['url']).'" id="topnav-dashboard" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
	                    $html_out .= '<i class="bx bx-home-circle mr-2"></i>'.$menu[$xid]['title'].' <div class="arrow-down"></div>';
	                    $html_out .= '</a>';
	                    $html_out .= '<div class="dropdown-menu">';
                    }
                    else
                    {
                        if ($menu[$xid]['parent'] == 0 && (!empty($menu[$xid]['url']) || $menu[$xid]['url'] <> "#" || $menu[$xid]['url'] <> 'javascript:void(0);'))
                        {
                            $html_out .= '<li class="nav-item">';
                            $html_out .= '<a href="'.url($menu[$xid]['url']).'" class="nav-link dropdown-item">'.$menu[$xid]['title'].'</a>';
                        } else {
                            $html_out .= '<a href="'.url($menu[$xid]['url']).'" class="dropdown-item">'.$menu[$xid]['title'].'</a>';
                        }
                    }

                    $html_out .= Menu::get_childs($menu, $xid, $tampung);
                    // $html_out .= '</div>' . "\n";
                    $html_out .= '</li>'."\n";
                }
            }
            else
            {
                exit (sprintf('menu nr %s must be an array', $xid));
            }
		}

        $html_out .= '</ul>';
        return $html_out;
    }

    private static function get_childs($menu, $parent_id)
    {
        $has_subcats = FALSE;

        $html_out  = '';
        foreach ($menu as $val) {
            if ($val['parent'] == $parent_id)
            {
                $has_subcats = TRUE;

                if (Menu::has_children($menu, $val['id']) == TRUE)
                {
                    $html_out .= '<div class="dropdown">';
                    $html_out .= '<a class="dropdown-item dropdown-toggle arrow-none" href="'.$val['url'].'" id="topnav-email" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.$val['title'].' <div class="arrow-down"></div></a>';
                    $html_out .= '<div class="dropdown-menu">';
                    $html_out .= Menu::get_childs($menu, $parent_id);
                    $html_out .= '</div>' . "\n";
                    $html_out .= '</div>' . "\n";
                }
                else
                {
                    if ($val['parent'] == 0 && (!empty($val['url']) || $val['url'] <> "#" || $val['url'] <> 'javascript:void(0);'))
                    {
                        $html_out .= '<li class="nav-item">';
                        $html_out .= '<a href="'.url($val['url']).'" class="nav-link dropdown-item">'.$val['title'].'</a>';
                    } else {
                        $html_out .= '<a href="'.url($val['url']).'" class="dropdown-item">'.$val['title'].'</a>';
                    }
                }
            }
        }

        return ($has_subcats) ? $html_out : FALSE;
    }
}