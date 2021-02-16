<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Tests\Browse;

class PageTest extends DuskTestCase
{

    public function Login()
    {
        $Logging_user = new LoginTest;
        $Logging_user->testLogin();
    }


    /**  
     * @group All
     * @group TrainingLocations
     */
    public function testTrainingLocations()
    {
        $this->Login();
        $this->browse(
            function ($browser) {
                $app_url = "https://demo.b2b-fahrsicherheit.de/";
                $dir = 'adac-' . date("Y-m-d-H") . '/Trainingsstandorte' . '/';
                $browser->visit('/trainingsstandorte')
                //clickLink('Trainingsstandorte')
                    ->resize(1920, 3000)
                    ->pause(1200)
                    ->screenshot($dir . 'test2');

                //navigate through all pages.
                $pages = $browser->elements('.pagination a');
                $i = 1;
                for ($i = 1; $i < (sizeof($pages)) - 1; $i++) {
                    if ($i > 1) {
                        $pages[$i]->click();
                        $browser->screenshot($dir . 'page-' . $i);
                        $pages = $browser->elements('.pagination a');
                    }
                }
                // go to the item details page.
                $links = $browser->elements('.pgm-info-button a');
                $prepared_link = array();
                foreach ($links as $link) {
                    $link_short = str_replace($app_url, '/', $link->getAttribute('href'));
                    array_push($prepared_link, $link_short);
                }
                $j = 1;
                foreach ($prepared_link as $link) {
                    if ($link != '/trainingsstandorte') {
                        $browser->visit($link)
                            ->pause(200)
                            ->resize(1920, 2500)
                            ->screenshot($dir . 'step-' . $j . str_replace('/', '-', $link));
                    }
                    $j++;
                }
            }
        );
    }



    /**
     * @group All
     * @group Booking
     */
    public function testBooking()
    {
        $this->Login();
        $this->browse(
            function ($browser) {
                $dir = 'adac-' . date("Y-m-d-H") . '/Booking/';
                $app_url = "https://demo.b2b-fahrsicherheit.de/";
                $browser->visit('/');
                $browser->clickLink('Trainingsangebote')
                    ->pause(1000)
                    ->clickAtXPath('/html/body/div[2]/div[3]/div/div[1]/nav/div/div[1]/div/div[6]/div[1]/a')
                    ->pause(100)
                    ->screenshot($dir . 'tarinings')
                    ->clickLink('Buchungen')
                    ->screenshot($dir . 'Buchungen');

                $tabs = $browser->elements('.pgm-datatable-column-toggle-DT_bookings span');
                $j = 1;

                //click on all tabs.
                foreach ($tabs as $tab) {
                    $tab->click();
                    $browser->screenshot($dir . 'step-' . $j . '-' . $tab->getAttribute('innerHTML'));
                    $j++;
                }
                //revert changes.
                $tabs = $browser->elements('.pgm-datatable-column-toggle-DT_bookings span');
                foreach ($tabs as $tab) {
                    $tab->click();
                }

                //click through all pages.
                $pages = $browser->elements('.paginate_button  a');
                for ($i = 0; $i < (sizeof($pages)) - 1; $i++) {
                    if ($i > 1) {
                        $pages[$i]->click();
                        $browser->screenshot($dir . 'page-' . $i);
                        //update element position.
                        $pages = $browser->elements('.paginate_button  a');
                    }
                }
            }
        );
    }

    /**
     * @group All
     * @group Project
     */
    public function testProject()
    {
        $this->Login();
        $this->browse(
            function ($browser) {
                $dir = 'adac-' . date("Y-m-d-H") . '/Project/';
                $app_url = "https://demo.b2b-fahrsicherheit.de/";
                $browser->visit('/');
                $browser->clickLink('Trainingsangebote')
                    ->pause(1000)
                    ->clickLink('Projekte')
                    ->screenshot($dir . 'Project')
                    ->clickLink('Alle Projekte')
                    ->screenshot($dir . 'All-Projects')
                    ->clickAtXPath('/html/body/div[2]/div[3]/div/div[2]/div/div[3]/div/div/div[1]/div[2]/a[2]')
                    ->screenshot($dir . 'New-project')
                    ->clickAtXPath('/html/body/div[2]/div[3]/div/div[2]/div/div[3]/div/div/div/div/div[2]/div/div[2]/div[2]/a/span/span')
                    ->pause(1000)
                    ->screenshot($dir . 'Close-window');

                //click through all pages.
                $pages = $browser->elements('.paginate_button  a');
                for ($i = 0; $i < (sizeof($pages)) - 1; $i++) {
                    if ($i > 1) {
                        $pages[$i]->click();
                        $browser->screenshot($dir . 'page-' . $i);
                        //update element position.
                        $pages = $browser->elements('.paginate_button  a');
                    }
                }
            }
        );
    }



    /**
     * @group All
     * @group Settings
     */
    public function testSettingCompany()
    {
        $this->Login();
        $this->browse(
            function ($browser) {
                $dir = 'adac-' . date("Y-m-d-H") . '/Setting/';
                $app_url = "https://demo.b2b-fahrsicherheit.de/";
                $browser->visit('/');
                $browser->clickLink('Trainingsangebote')
                    ->pause(1000)
                    ->clickLink('Einstellungen')
                    ->screenshot($dir . 'settings')
                    ->pause(100)
                    ->clickLink('Firma')
                    ->screenshot($dir . 'Firma')
                    ->clickAtXPath('/html/body/div[2]/div[3]/div/div[2]/div/div[3]/div/div/div[1]/div[2]/a[2]')
                    ->pause(300)
                    ->screenshot($dir . 'Add new')
                    ->clickAtXPath('/html/body/div[8]/div[2]/div/div/div[3]/a[2]/span')
                    ->screenshot($dir . 'Close window')
                    ->pause(300)
                    ->clickAtXPath('/html/body/div[2]/div[3]/div/div[2]/div/div[3]/div/div/div[2]/span/div[2]/div[2]/table/tbody/tr[1]/td[9]/a')
                    ->screenshot($dir . 'Edit');

                //lop throgh the all tabs.
                $tabs = $browser->elements('.profile-usermenu  li');
                for ($i = 1; $i < (sizeof($tabs)); $i++) {
                    $tabs[$i]->click();
                    $browser->screenshot($dir . 'tab-' . $i);
                    //update element position.
                    $tabs = $browser->elements('.profile-usermenu  li');
                }
            }
        );
    }


    /**
     * @group All
     * @group Settings
     */
    public function testSettingCompanyPages()
    {
        $this->Login();
        $this->browse(
            function ($browser) {
                $dir = 'adac-' . date("Y-m-d-H") . '/Setting/Pages/';
                $browser->visit('/');
                $browser->clickLink('Trainingsangebote')
                    ->pause(1000)
                    ->clickLink('Einstellungen')
                    ->pause(100)
                    ->clickLink('Firma')
                    ->screenshot($dir . 'Firma');

                //click through all pages.
                $pages = $browser->elements('.paginate_button  a');
                for ($i = 0; $i < (sizeof($pages)) - 1; $i++) {
                    if ($i > 1) {
                        $pages[$i]->click();
                        $browser->screenshot($dir . 'page-' . $i);
                        //update element position.
                        $pages = $browser->elements('.paginate_button  a');
                    }
                }

                $tabs = $browser->elements('.portlet-body span');
                $j = 1;
                //click on all tabs.
                foreach ($tabs as $tab) {
                    if ($j > 1) {
                        $tab->click();
                        $browser->screenshot($dir . 'tab-' . $j . '-' . $tab->getAttribute('innerHTML'));
                    }
                    $j++;
                }
            }
        );
    }

    /**
     * @group All
     * @group Setting
     */
    public function testSettingUser()
    {
        $this->Login();
        $this->browse(
            function ($browser) {
                $dir = 'adac-' . date("Y-m-d-H") . '/Setting/user/';
                $browser->visit('/');
                $browser->clickLink('Trainingsangebote')
                    ->pause(1000)
                    ->clickLink('Einstellungen')
                    ->pause(100)
                    ->clickLink('Nutzer')
                    ->screenshot($dir . 'Nutzer');

                //click through all pages.
                $pages = $browser->elements('.paginate_button  a');
                for ($i = 0; $i < (sizeof($pages)) - 1; $i++) {
                    if ($i > 1) {
                        $pages[$i]->click();
                        $browser->screenshot($dir . 'page-' . $i);
                        //update element position.
                        $pages = $browser->elements('.paginate_button  a');
                    }
                }

                $tabs = $browser->elements('.portlet-body span');
                $j = 1;
                //click on all tabs.
                foreach ($tabs as $tab) {
                    if ($j > 1 && $j < ((sizeof($tabs)) - 3)) {
                        $tab->click();
                        $browser->screenshot($dir . 'tab-' . $j . '-');
                    }
                    $j++;
                }
            }
        );
    }
}
