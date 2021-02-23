<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Tests\Browse;

class PageTest extends DuskTestCase
{
    private $title = "";
    private $scope="";
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
                    ->screenshot($dir . 'Trainingsstandorte');
                    $this->title =  'Trainingsstandorte';
                    $this->scope='.main-container';
                    $this->validate();
                //navigate through all pages.
                $pages = $browser->elements('.pagination a');
                $size = sizeof($pages) / 2;
                //$i = 1;
                for ($i = 0; $i < $size; $i++) {
                    if ($i > 1) {
                        $pages[$i]->click();
                        $browser->screenshot($dir . 'page-' . $i);
                        $this->title =  'page-' . $i;
                        $this->scope='.main-container';
                        $this->validate();
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
                            $this->title =  'step-' . $j . str_replace('/', '-', $link);
                            $this->scope='.main-container';
                            $this->validate();
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
                    ->clickLink('Buchungen')
                    ->screenshot($dir . 'Buchungen');
                    $this->title = 'Buchungen';
                    $this->scope='.main-nav-left';
                    $this->validate();

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
                        $this->title =  'page-' . $i;
                        $this->scope='.main-container';
                        $this->validate();
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
                    ->screenshot($dir . 'All-Projects');
                    $this->title = 'All-Projects';
                    $this->scope='.main-nav-left';
                    $this->validate();
                $browser->clickAtXPath('/html/body/div[2]/div[3]/div/div[2]/div/div[3]/div/div/div[1]/div[2]/a[2]')
                    ->screenshot($dir . 'New-project');
                    $this->title = 'All-Projects';
                    $this->scope='.main-container';
                    $this->validate();
                $browser->clickAtXPath('/html/body/div[2]/div[3]/div/div[2]/div/div[3]/div/div/div/div/div[2]/div/div[2]/div[2]/a/span/span')
                    ->pause(1000)
                    ->screenshot($dir . 'Close-window');
                    $this->title = 'Close-window';
                    $this->scope='.main-container';
                    $this->validate();

                //click through all pages.
                $pages = $browser->elements('.paginate_button  a');
                for ($i = 0; $i < (sizeof($pages)) - 1; $i++) {
                    if ($i > 1) {
                        $pages[$i]->click();
                        $browser->screenshot($dir . 'page-' . $i);
                        $this->title = 'page-' . $i;
                        $this->scope='.portlet-body';
                        $this->validate();
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
                $this->dir = $dir;
                $app_url = "https://demo.b2b-fahrsicherheit.de/";
                $browser->visit('/');
                $browser->clickLink('Trainingsangebote')
                    ->pause(1000)
                    ->clickLink('Einstellungen')
                    ->screenshot($dir . 'settings')
                    ->pause(100)
                    ->clickLink('Firma');
                $this->title = 'Firma';
                $this->scope='.main-nav-left';
                $this->validate();
                // ->screenshot($dir . 'Firma')
                $browser->clickAtXPath('/html/body/div[2]/div[3]/div/div[2]/div/div[3]/div/div/div[1]/div[2]/a[2]')
                    ->pause(300)
                    ->screenshot($dir . 'Add new');
                     
                     $this->scope='.modal-content';
                     $this->title = 'Add new';
                     $this->validate();
                $browser->clickAtXPath('/html/body/div[8]/div[2]/div/div/div[3]/a[2]/span');
               
                $browser->pause(300)
                    ->clickAtXPath('/html/body/div[2]/div[3]/div/div[2]/div/div[3]/div/div/div[2]/span/div[2]/div[2]/table/tbody/tr[1]/td[9]/a')
                    ->screenshot($dir . 'Edit');
                     $this->title = 'Edit';
                     $this->scope='.main-container';
                     $this->validate();

                //lop throgh the all tabs.
                $tabs = $browser->elements('.profile-usermenu  li');
                for ($i = 1; $i < (sizeof($tabs)); $i++) {
                    $tabs[$i]->click();
                    $this->scope='.profile-content';
                    $this->title = 'tab-' . $i;
                    $this->validate();
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
                $this->dir = $dir;
                $browser->visit('/');
                $browser->clickLink('Trainingsangebote')
                    ->pause(1000)
                    ->clickLink('Einstellungen')
                    ->pause(100)
                    ->clickLink('Firma')
                    ->screenshot($dir . 'Firma');
                    $this->scope='.main-nav-left';
                    $this->title = 'Firma';
                    $this->validate();

                //click through all pages.
                $pages = $browser->elements('.paginate_button  a');
                for ($i = 0; $i < (sizeof($pages)) - 1; $i++) {
                    if ($i > 1) {
                        $pages[$i]->click();
                        $this->title = 'page-' . $i;
                        $this->scope='.main-container';
                        $this->validate();
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
                        $this->scope='.main-container';
                        $this->title = $tab->getAttribute('innerHTML');
                        $this->validate();
                        $browser->screenshot($dir . 'tab-' . $j . '-' . $tab->getAttribute('innerHTML'));
                    }
                    $j++;
                }
            }
        );
    }

    /**
     * @group All
     * @group Settings
     */
    public function testSettingUser()
    {
        $this->Login();
        $this->browse(
            function ($browser) {
                $dir = 'adac-' . date("Y-m-d-H") . '/Setting/user/';
                $this->dir = $dir;
                $browser->visit('/');
                $browser->clickLink('Trainingsangebote')
                    ->pause(1000)
                    ->clickLink('Einstellungen')
                    ->pause(100)
                    ->clickLink('Nutzer')
                    ->screenshot($dir . 'Nutzer');
                    $this->scope='.main-nav-left';
                    $this->title = 'Nutzer';
                    $this->validate();

                //click through all pages.
                $pages = $browser->elements('.paginate_button  a');
                for ($i = 0; $i < (sizeof($pages)) - 1; $i++) {
                    if ($i > 1) {
                        $pages[$i]->click();
                        $browser->screenshot($dir . 'page-' . $i);
                        $this->scope='.main-container';
                        $this->title = 'page-' . $i;
                        $this->validate();
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
                        $browser->screenshot($dir .  'tab-' . $j);
                        $this->scope='.main-container';
                        $this->title = 'tab-' . $j . '-';
                        $this->validate();
                    }
                    $j++;
                }
            }
        );
    }

         /**
          */
    public function validate()
    {
        $this->browse(
            function ($browser) {
                $error_dir = 'adac-' . date("Y-m-d-H") . '/Error/';
                try {
                    $browser->with(
                        $this->scope, function ($table) {
                            $table->assertDontSee('sql')
                                ->assertDontSee('t::')
                                ->assertDontSee('angelcore/class.core.php')
                                ->assertDontSee(':core::getBackTrace')
                                ->assertDontSee(':core::erro')
                                ->assertDontSee('Die aufgerufene Seite konnte leider nicht gefunden werden.')
                                ->assertDontSee('php');    
                        }
                    );
                } catch(\Exception $e) {
                    $url = $browser->driver->getCurrentURL();
                    $browser->screenshot($error_dir  .  $this->title);
                }
            }
        );
    }
}
