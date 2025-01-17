<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class SettingsOptionsTest extends DuskTestCase
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
     * @group SettingsOptions
     */
    public function testSettingsOptionsProfile()
    {
        $this->Login();
        $this->browse(
            function ($browser) {
                $dir = 'adac-' . date("Y-m-d-H") . '/SettingsOptions/Profile/';
                $browser->visit('/');
                $browser->clickLink('Trainingsangebote')
                    ->pause(1000)
                    ->clickLink('Einstellungen / Optionen')
                    ->pause(500)
                    ->clickLink('Profil')
                    ->screenshot($dir . 'Profil');
                    $this->title='Profil';
                    $this->scope='.main-nav-left';
                    $this->validate();
                    $browser->pause(500)
                        ->click('.fa-plus')
                        ->pause(1500)
                        ->screenshot($dir . 'Add new item');
                        $this->title='Add new item';
                        $this->scope='.modal-content';
                        $this->validate();
                        $browser->click('.btn-warning')
                            ->pause(500)
                            ->click('.fa-pencil')
                            ->pause(1500)
                            ->screenshot($dir . 'Edit item');
                        $this->title='Add new item';
                        $this->scope='.modal-content';
                        $this->validate();
                        $browser->click('.btn-warning')
                            ->pause(1500);

                $tabs = $browser->elements('.profile-usermenu a');
                //click on all tabs.
                for ($j = 0; $j < sizeof($tabs); $j++) {
                    $tabs[$j]->click();
                    $browser->pause(500)
                        ->screenshot($dir . 'tab-' . $j);
                        $this->title='tab-' . $j;
                        $this->scope='.profile-content';
                        $this->validate();
                    $tabs = $browser->elements('.profile-usermenu a');
                }
            }
        );
    }


    /**
     * @group All
     * @group SettingsOptions
     */
    public function testSettingsOptionsEmployee()
    {
        $this->Login();
        $this->browse(
            function ($browser) {
                $dir = 'adac-' . date("Y-m-d-H") . '/SettingsOptions/Employee/';
                $browser->visit('/');
                $browser->clickLink('Trainingsangebote')
                    ->pause(1000)
                    ->clickLink('Einstellungen / Optionen')
                    ->pause(500)
                    ->clickLink('Mitarbeiter')
                    ->screenshot($dir . 'Mitarbeiter');
                    $this->title='Mitarbeiter';
                    $this->scope='.main-nav-left';
                    $this->validate();
                //click through all pages.
                $pages = $browser->elements('.paginate_button  a');
                for ($i = 0; $i < (sizeof($pages)) - 1; $i++) {
                    if ($i > 1) {
                        $pages[$i]->click();
                        $browser->screenshot($dir . 'page-' . $i);
                        $this->title='page-' . $i;
                        $this->scope='.main-container';
                        $this->validate();
                        //update element position.
                        $pages = $browser->elements('.paginate_button  a');
                    }
                }

                //Go to the edit page
                $browser->click('.fa-pencil')
                    ->pause(1500)
                    ->screenshot($dir . 'Edit item')
                    ->pause(1500);
                    $this->title='Edit item';
                    $this->scope='.main-container';
                    $this->validate();

                $top_tabs = $browser->elements('.wTabs a');
                //click on all tabs.
                for ($j = 0; $j < sizeof($top_tabs); $j++) {
                    $top_tabs[$j]->click();
                    $browser->pause(500)
                        ->screenshot($dir . 'top-tab-' . $j);
                        $this->title='top-tab-' . $j;
                        $this->scope='.profile-content';
                        $this->validate();
                    $top_tabs = $browser->elements('.wTabs a');
                }

                //profile-content
                $tabs = $browser->elements('.profile-usermenu a');
                //click on all tabs.
                for ($j = 0; $j < sizeof($tabs); $j++) {
                    $tabs[$j]->click();
                    $browser->pause(500)
                        ->screenshot($dir . 'tab-' . $j);
                        $this->title='tab-' . $j;
                        $this->scope='.profile-content';
                        $this->validate();
                    $tabs = $browser->elements('.profile-usermenu a');
                }
            }
        );
    }

    /**
     * @group All
     * @group SettingsOptions
     */
    public function testTrainingManagement()
    {
        $this->Login();
        $this->browse(
            function ($browser) {
                $dir = 'adac-' . date("Y-m-d-H") . '/SettingsOptions/TrainingManagemen/';
                $browser->visit('/');
                $browser->clickLink('Trainingsangebote')
                    ->pause(1000)
                    ->clickLink('Einstellungen / Optionen')
                    ->pause(500)
                    ->clickLink('Trainingsverwaltung')
                    ->screenshot($dir . 'Trainingsverwaltung')
                    ->pause(500);
                    $this->title='Trainingsverwaltung';
                    $this->scope='.main-nav-left';
                    $this->validate();
                //click through all pages.
                $pages = $browser->elements('.paginate_button  a');
                for ($i = 0; $i < (sizeof($pages)) - 1; $i++) {
                    if ($i > 1) {
                        $pages[$i]->click();
                        $browser->screenshot($dir . 'page-' . $i);
                        $this->title='page-' . $i;
                        $this->scope='.main-container';
                        $this->validate();
                        //update element position.
                        $pages = $browser->elements('.paginate_button  a');
                    }
                }
                $browser->click('.fa-plus')
                    ->pause(1500)
                    ->screenshot($dir . 'Add new item');
                    $this->title='Add new item';
                    $this->scope='.modal-content';
                    $this->validate();
                    $browser->pause(500)
                        ->click('.red-intense')
                        ->pause(500)
                        ->click('.fa-pencil')
                        ->pause(1500)
                        ->resize(1920, 3000)
                        ->screenshot($dir . 'Edit item')
                        ->pause(500);
                    $this->title='Edit item';
                    $this->scope='.main-container';
                    $this->validate();

                $top_tabs = $browser->elements('.wTabs a');
                //click on all tabs.
                for ($j = 0; $j < sizeof($top_tabs); $j++) {
                    $top_tabs[$j]->click();
                    $browser->pause(500)
                        ->screenshot($dir . 'top-tab-' . $j);
                        $this->title='top-tab-' . $j;
                        $this->scope='.portlet-body';
                        $this->validate();
                    $top_tabs = $browser->elements('.wTabs a');
                }
            }
        );
    }

    /**
     * @group All
     * @group SettingsOptions
     */
    public function testModuleManagement()
    {
        $this->Login();
        $this->browse(
            function ($browser) {
                $dir = 'adac-' . date("Y-m-d-H") . '/SettingsOptions/ModuleManagement/';
                $browser->visit('/');
                $browser->clickLink('Trainingsangebote')
                    ->pause(1000)
                    ->clickLink('Einstellungen / Optionen')
                    ->pause(500)
                    ->clickLink('Modul Management')
                    ->screenshot($dir . 'Modul Management')
                    ->pause(500)
                    ->select('#location')
                    ->screenshot($dir . 'Selection');
                    $this->title='Selection';
                    $this->scope='.main-nav-left';
                    $this->validate();
                $tabs = $browser->elements('.profile-usermenu li');
                //click on all tabs.
                for ($j = 0; $j < sizeof($tabs); $j++) {
                    $tabs[$j]->click();
                    $browser->pause(900)
                        ->screenshot($dir . 'tab-' . $j);
                        $this->title='tab-' . $j;
                        $this->scope='.profile-content';
                        $this->validate();
                    $tabs = $browser->elements('.profile-usermenu li');
                }
            }
        );
    }

    /**
     * @group All
     * @group SettingsOptions
     */
    public function testResourceManagement()
    {
        $this->Login();
        $this->browse(
            function ($browser) {
                $dir = 'adac-' . date("Y-m-d-H") . '/SettingsOptions/ResourceManagement/';
                $browser->visit('/');
                $browser->clickLink('Trainingsangebote')
                    ->pause(1000)
                    ->clickLink('Einstellungen / Optionen')
                    ->pause(500)
                    ->clickLink('Ressourcen Verwaltung')
                    ->screenshot($dir . 'Ressourcen Verwaltung')
                    ->pause(500)
                    ->select('#location')
                    ->screenshot($dir . 'Selection');
                    $this->title='Selection';
                    $this->scope='.main-nav-left';
                    $this->validate();
                $tabs = $browser->elements('.profile-usermenu li');
                //click on all tabs.
                for ($j = 0; $j < sizeof($tabs); $j++) {
                    $tabs[$j]->click();
                    $browser->pause(900)
                        ->screenshot($dir . 'tab-' . $j);
                        $this->title='tab-' . $j;
                        $this->scope='#content-main';
                        $this->validate();
                    $tabs = $browser->elements('.profile-usermenu li');
                }
            }
        );
    }

          /**
           * @group All
           * @group SettingsOptions
           */
    public function testCatering()
    {
        $this->Login();
        $this->browse(
            function ($browser) {
                $dir = 'adac-' . date("Y-m-d-H") . '/SettingsOptions/Catering/';
                $browser->visit('/');
                $browser->clickLink('Trainingsangebote')
                    ->pause(1000)
                    ->clickLink('Einstellungen / Optionen')
                    ->pause(500)
                    ->clickLink('Catering')
                    ->screenshot($dir . 'Catering')
                    ->pause(500);
                    $this->title='Catering';
                    $this->scope='.main-nav-left';
                    $this->validate();
                //click through all pages.
                $pages = $browser->elements('.paginate_button  a');
                for ($i = 0; $i < (sizeof($pages)) - 1; $i++) {
                    if ($i > 1) {
                        $pages[$i]->click();
                        $browser->screenshot($dir . 'page-' . $i);
                        $this->title='page-' . $i;
                        $this->scope='.main-container';
                        $this->validate();
                        //update element position.
                        $pages = $browser->elements('.paginate_button  a');
                    }
                }

                //should check later
                $browser->pause(500)
                    ->click('.fa-plus')
                    ->pause(1500)
                    ->screenshot($dir . 'Add new item');
                    $this->title='Add new item';
                    $this->scope='.modal-content';
                    $this->validate();
                    $browser->click('.btn-default')
                        ->pause(500)
                        ->click('.fa-pencil')
                        ->pause(1500)
                        ->screenshot($dir . 'Edit');
                    $this->title='Edit';
                    $this->scope='.main-container';
                    $this->validate();
            }
        );
    }

        /**
         * @group All
         * @group SettingsOptions
         */
    public function testCustomerInsuranceAssociation()
    {
        $this->Login();
        $this->browse(
            function ($browser) {
                $dir = 'adac-' . date("Y-m-d-H") . '/SettingsOptions/CustomerInsuranceAssociation/';
                $browser->visit('/');
                $browser->clickLink('Trainingsangebote')
                    ->pause(1000)
                    ->clickLink('Einstellungen / Optionen')
                    ->pause(500)
                    ->clickLink('t::page_names::customer_insuranceassociation')
                    ->screenshot($dir . 'CustomerInsuranceAssociation')
                    ->pause(500);
                    $this->title='CustomerInsuranceAssociation';
                    $this->scope='.main-nav-left';
                    $this->validate();
                //click through all pages.
                $pages = $browser->elements('.paginate_button  a');
                for ($i = 0; $i < (sizeof($pages)) - 1; $i++) {
                    if ($i > 1) {
                        $pages[$i]->click();
                        $browser->screenshot($dir . 'page-' . $i);
                        $this->title='page-' . $i;
                        $this->scope='.main-container';
                        $this->validate();
                        //update element position.
                        $pages = $browser->elements('.paginate_button  a');
                    }
                }

                $browser->pause(500)
                    ->click('.fa-plus')
                    ->pause(1500)
                    ->screenshot($dir . 'Add new item');
                    $this->title='Add new item';
                    $this->scope='.modal-content';
                    $this->validate();
                    $browser->click('.btn-warning')
                        ->pause(500)
                        ->click('.fa-pencil')
                        ->pause(1500)
                        ->screenshot($dir . 'Edit');
                    $this->title='Edit';
                    $this->scope='.modal-content';
                    $this->validate();
            }
        );
    }

    
        /**
         * @group All
         * @group SettingsOptions
         */
    public function testStandorte()
    {
        $this->Login();
        $this->browse(
            function ($browser) {
                $dir = 'adac-' . date("Y-m-d-H") . '/SettingsOptions/Standorte/';
                $browser->visit('/');
                $browser->clickLink('Trainingsangebote')
                    ->pause(1000)
                    ->clickLink('Einstellungen / Optionen')
                    ->pause(500)
                    ->clickLink('Standorte')
                    ->screenshot($dir . 'Standorte')
                    ->pause(500);
                    $this->title='Standorte';
                    $this->scope='.main-nav-left';
                    $this->validate();
                //click through all pages.
                $pages = $browser->elements('.paginate_button  a');
                for ($i = 0; $i < (sizeof($pages)) - 1; $i++) {
                    if ($i > 1) {
                        $pages[$i]->click();
                        $browser->screenshot($dir . 'page-' . $i);
                        $this->title='page-' . $i;
                        $this->scope='.main-container';
                        $this->validate();
                        //update element position.
                        $pages = $browser->elements('.paginate_button  a');
                    }
                }

                $browser->pause(500)
                    ->click('.fa-plus')
                    ->pause(1500)
                    ->resize(1920, 4000)
                    ->screenshot($dir . 'Add new item');
                    $this->title='Add new item';
                    $this->scope='.modal-content';
                    $this->validate();
                    $browser->click('.btn-warning')
                        ->pause(500)
                        ->click('.fa-pencil')
                        ->pause(1500)
                        ->screenshot($dir . 'Edit');
                    $this->title='Edit';
                    $this->scope='.main-container';
                    $this->validate();
            }
        );
    }


          /**
           * @group All
           * @group SettingsOptions
           */
    public function testEmailTemplates()
    {
        $this->Login();
        $this->browse(
            function ($browser) {
                $dir = 'adac-' . date("Y-m-d-H") . '/SettingsOptions/EmailTemplates/';
                $browser->visit('/');
                $browser->clickLink('Trainingsangebote')
                    ->pause(1000)
                    ->clickLink('Einstellungen / Optionen')
                    ->pause(500)
                    ->clickLink('eMail Templates')
                    ->screenshot($dir . 'Standorte')
                    ->pause(500);
                    $this->title='Standorte';
                    $this->scope='.main-nav-left';
                    $this->validate();
                //click through all pages.
                $pages = $browser->elements('.paginate_button  a');
                for ($i = 0; $i < (sizeof($pages)) - 1; $i++) {
                    if ($i > 1) {
                        $pages[$i]->click();
                        $browser->screenshot($dir . 'page-' . $i);
                        $this->title='page-' . $i;
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
     * The following function check if there is any error on the page
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
                     $browser->screenshot($error_dir  . $this->title);
                }
             
            }
        );
    }

    
}
