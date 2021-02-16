<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class MenuTest extends DuskTestCase
{
     
    public function Login()
    {
        $Logging_user = new LoginTest;
        $Logging_user->testLogin();
    }
    
    /**
     * @group All
     * @group Menu
     */
    public function testDropdownMenuRight()
    {
        $this->Login();
        $this->browse(
            function ($browser) {
                $dir = 'adac-' . date("Y-m-d-H") . '/' . 'DropdownMenuRight/';
                $tabs = $browser->elements('.dropdown-menu a');
                $browser->mouseover('.dropdown-user')
                    ->pause(1200)
                    ->screenshot($dir . 'menu');
                //click on all tabs.
                for ($j = 0; $j < sizeof($tabs); $j++) {
                    $tabs[$j]->click();
                    $browser->pause(1200)
                        ->screenshot($dir . 'link-' . $j);
                    $tabs = $browser->elements('.dropdown-menu a');
                    $browser->mouseover('.dropdown-user')
                        ->pause(1200);
                }
            }
        );
    }

      /**
       * @group All
       * @group Menu
       */
    public function testHeader()
    {
        $this->Login();
        $this->browse(
            function ($browser) {
                $dir = 'adac-' . date("Y-m-d-H") . '/Header/';
                $app_url = "https://demo.b2b-fahrsicherheit.de/";

                $pages = $browser->elements('.nav a');
                $prepared_link = array();
                foreach ($pages as $page) {
                    $link_short = str_replace($app_url, '/', $page->getAttribute('href'));
                    array_push($prepared_link, $link_short);
                }
                $i = 1;
                foreach ($prepared_link as $link) {
                    if ($link != '/trainingsstandorte') {
                        $browser->visit($link)
                            ->pause(200)
                            ->resize(1920, 2500)
                            ->screenshot($dir . 'step-' . $i . str_replace('/', '-', $link));
                    }
                    $i++;
                }
            }
        );
    }

    /**
     * @group All
     * @group Menu
     */
    public function testLeftNav()
    {   
        $this->Login();
        $this->browse(
            function ($browser) {
                $dir = 'adac-' . date("Y-m-d-H") . '/LeftNav/';
                $app_url = "https://demo.b2b-fahrsicherheit.de/";
                $browser->clickLink('Trainingsangebote')
                    ->pause(1000);
                $pages = $browser->elements('.panel-default a');
                $prepared_link = array();
                foreach ($pages as $page) {
                    $link_short = str_replace($app_url, '/', $page->getAttribute('href'));
                    array_push($prepared_link, $link_short);
                }
                $i = 1;
                foreach ($prepared_link as $link) {
                    if ($link != '/b2bmaillog' && $link != 'https://pm.circuit-booking.com/servicedesk/customer/portal/1') {
                        $browser->visit($link)
                            ->pause(200)
                            ->resize(1920, 2500)
                            ->screenshot($dir . 'step-' . $i . str_replace('/', '-', $link));
                    }
                    $i++;
                }
            }
        );
    }

     /**
      * @group All
      * @group Menu
      */
    public function testFooter()
    {
        $this->Login();
        $this->browse(
            function ($browser) {
                $dir = 'adac-' . date("Y-m-d-H") . '/Footer/';
                $app_url = "https://demo.b2b-fahrsicherheit.de/";
                $browser->visit('/');
                $pages = $browser->elements('.full a');
                $prepared_link = array();
                foreach ($pages as $page) {
                    $link_short = str_replace($app_url, '/', $page->getAttribute('href'));
                    array_push($prepared_link, $link_short);
                }

                foreach ($prepared_link as $link) {
                    $browser->visit($link)
                        ->pause(200)
                        ->resize(1920, 2500)
                        ->screenshot($dir . str_replace('/', '', $link));
                }
            }
        );
    }
}
