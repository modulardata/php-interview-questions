<?php
// PHP and MySQL Project
// menu related stuff

class Menu
{
	public $companyName = 'Sweets Complete';
	public $page 		= 'home';
	public $menuPages	= array();
	// menus = page => array('page' => 'label')
	// list of menu choices on each page
	public $menus		= array('home' => array('about'		=> 'About Us',
												'products'	=> 'Products',
												'specials'	=> 'Specials',
												'contact'	=> 'Contact Us'),
								'about' => array('home'		=> 'Home',
												'products'	=> 'Products',
												'specials'	=> 'Specials',
												'contact'	=> 'Contact Us'),
								'products' => array('home' 	=> 'Home',
												'about'		=> 'About Us',
												'specials'	=> 'Specials',
												'contact'	=> 'Contact Us'),
								'specials' => array('home' 	=> 'Home',
												'about'		=> 'About Us',
												'products'	=> 'Products',
												'contact'	=> 'Contact Us'),
								'contact' => array('home' 	=> 'Home',
												'about'		=> 'About Us',
												'products'	=> 'Products',
												'specials'	=> 'Specials'),
								'detail' => array('home' 	=> 'Home',
												'about'		=> 'About Us',
												'products'	=> 'Products',
												'contact'	=> 'Contact Us'),
								'search' => array('home' 	=> 'Home',
												'about'		=> 'About Us',
												'specials'	=> 'Specials',
												'contact'	=> 'Contact Us'),
								'purchase' => array('home' 	=> 'Home',
												'about'		=> 'About Us',
												'products'	=> 'Products',
												'contact'	=> 'Contact Us'),
								'cart' => array('home' 	=> 'Home',
												'about'		=> 'About Us',
												'products'	=> 'Products',
												'contact'	=> 'Contact Us'),
								'members' => array('home'	=> 'Home',
												'products'	=> 'Products',
												'specials'	=> 'Specials',
												'contact'	=> 'Contact Us'),
								'addmember' => array('home'	=> 'Home',
												'products'	=> 'Products',
												'specials'	=> 'Specials',
												'contact'	=> 'Contact Us'),
								'login' => array('home'	=> 'Home',
												'products'	=> 'Products',
												'specials'	=> 'Specials',
												'contact'	=> 'Contact Us'),
								'top'  => array('login'		=> 'Login',
												'members'	=> 'Our Members',
												'cart'		=> 'Shopping Cart')
	);
	public function __construct()
	{
		$this->menuPages = array_keys($this->menus);
	}
	/*
	 * Produces a search form
	 * @param array $titles = array[product_id] = title [optional]
	 */
	public function searchForm($titles = NULL)
	{
		$output = '<form name="search" method="get" action="?page=search" id="search">' . PHP_EOL;
		$output .= '<input type="text" value="keywords" name="keyword" class="s0" />' . PHP_EOL;
		if ($titles) {
			$output .= '<br />' . PHP_EOL;
			$output .= '<select name="title" class="searchTitle">' . PHP_EOL;
			foreach ($titles as $id => $title) {
				$output .= sprintf('<option value="%s">%s</option>', $id, $title);
			}
			$output .= '</select>' . PHP_EOL;
			$output .= '<br />' . PHP_EOL;
		}
		$output .= '<input type="submit" name="search" value="Search Products" class="button marT5" />' . PHP_EOL;
		$output .= '<input type="hidden" name="page" value="search" />' . PHP_EOL;
		$output .= '</form><br /><br />' . PHP_EOL;
		return $output;
	}
}
