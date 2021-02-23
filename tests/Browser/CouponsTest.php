<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CouponsTest extends DuskTestCase
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
     * @group Coupons
     */
    public function testCouponsAllCampaigns()
    {
        $this->Login();
        $this->browse(
            function ($browser) {
                $dir = 'adac-' . date("Y-m-d-H") . '/Coupons/AllCampaigns/';
                $browser->visit('/');
                $browser->clickLink('Trainingsangebote')
                    ->pause(1000)
                    ->clickLink('Gutscheine')
                    ->pause(500)
                    ->clickLink('t::page_names::customer_allcampaigns')
                    ->screenshot($dir . 'Allcampaigns');
                    $this->scope='.main-nav-left';
                    $this->title = 'Allcampaigns';
                    $this->validate();
                    $browser->click('.fa-pencil')
                        ->pause(1000)
                        ->screenshot($dir . 'Edit Kampagne');
                    $this->scope='.main-container';
                    $this->title = 'Edit Kampagne';
                    $this->validate();
                    $browser->click('.btn-warning')
                        ->pause(500)
                        ->screenshot($dir . 'Closeedit')
                        ->pause(1000)
                        ->click('.fa-user-plus')
                        ->pause(1000)
                        ->screenshot($dir . 'Coupon einer Person zuweisen');
                    $this->scope='.main-container';
                    $this->title = 'Coupon einer Person zuweisen';
                    $this->validate();
                    $browser->click('.btn-warning')
                        ->pause(500)
                        ->click('.fa-user-ninja')
                        ->pause(1500)
                        ->screenshot($dir . 'Coupon einer externen Person zuweisen');
                    $this->scope='.modal-content';
                    $this->title = 'Coupon einer externen Person zuweisen';
                    $this->validate();
                    $browser->click('.btn-warning')
                        ->pause(500)
                        ->click('.fa-eye')
                        ->pause(1500)
                        ->screenshot($dir . 'Zugeordnete Personen anzeigen');
                    $this->scope='.main-container';
                    $this->title = 'Zugeordnete Personen anzeigen';
                    $this->validate();
                    $browser->pause(500)
                        ->click('.fa-arrow-left')
                        ->pause(1000)
                        ->click('.fa-link')
                        ->pause(500)
                        ->screenshot($dir . 'Verknüpfte Trainings der Kampagne editieren');
                    $this->scope='.main-container';
                    $this->title = 'Verknüpfte Trainings der Kampagne editieren';
                    $this->validate();
                    $browser->click('.fa-arrow-left');
            }
        );
    }

    /**
     * @group All
     * @group Coupons
     */
    public function testCouponsActiveCampaigns()
    {
        $this->Login();
        $this->browse(
            function ($browser) {
                $dir = 'adac-' . date("Y-m-d-H") . '/Coupons/ActiveCampaign/';
                $browser->visit('/');
                $browser->clickLink('Trainingsangebote')
                    ->pause(1000)
                    ->clickLink('Gutscheine')
                    ->pause(500)
                    ->clickLink('t::page_names::customer_activecampaigns')
                    ->screenshot($dir . 'ActiveCampaign');
                    $this->scope='.main-nav-left';
                    $this->title = 'ActiveCampaign';
                    $this->validate();
                    $browser->click('.fa-pencil')
                        ->pause(1000)
                        ->screenshot($dir . 'Edit Kampagne');
                    $this->scope='.main-container';
                    $this->title = 'Edit Kampagne';
                    $this->validate();
                    $browser->click('.btn-warning')
                        ->pause(500)
                        ->screenshot($dir . 'Closeedit')
                        ->pause(1000)
                        ->click('.fa-plus')
                        ->pause(1000)
                        ->screenshot($dir . 'Limitierte Kampagne um Coupon erweitern');
                    $this->scope='.main-container';
                    $this->title = 'Coupon einer Person zuweisen';
                    $this->validate();
                    $browser->click('.btn-warning')
                        ->pause(500)
                        ->click('.fa-eye')
                        ->pause(1500)
                        ->screenshot($dir . 'Zugeordnete Personen anzeigen');
                    $this->scope='.main-container';
                    $this->title = 'Zugeordnete Personen anzeigen';
                    $this->validate();
                    $browser->pause(500)
                        ->click('.fa-arrow-left')
                        ->pause(1000)
                        ->click('.fa-link')
                        ->pause(500)
                        ->screenshot($dir . 'Verknüpfte Trainings der Kampagne editieren');
                    $this->scope='.main-container';
                    $this->title = 'Verknüpfte Trainings der Kampagne editieren';
                    $this->validate();
                    $browser->click('.fa-arrow-left');
            }
        );
    }

    /**
     * @group All
     * @group Coupons
     */
    public function testCouponsClosedCampaigns()
    {
        $this->Login();
        $this->browse(
            function ($browser) {
                $dir = 'adac-' . date("Y-m-d-H") . '/Coupons/ClosedCampaigns/';
                $browser->visit('/');
                $browser->clickLink('Trainingsangebote')
                    ->pause(1000)
                    ->clickLink('Gutscheine')
                    ->pause(500)
                    ->clickLink('t::page_names::customer_closedcampaigns')
                    ->screenshot($dir . 'ClosedCampaigns');
                    $this->scope='.main-nav-left';
                    $this->title = 'ClosedCampaigns';
                    $this->validate();
                $browser->click('.fa-pencil')
                    ->pause(1000)
                    ->screenshot($dir . 'Edit Kampagne');
                    $this->scope='.main-container';
                    $this->title = 'Edit Kampagne';
                    $this->validate();
                    $browser->click('.btn-warning')
                        ->pause(500)
                        ->screenshot($dir . 'Closeedit')
                        ->pause(500)
                        ->click('.fa-user-ninja')
                        ->pause(1500)
                        ->screenshot($dir . 'Coupon einer externen Person zuweisen');
                    $this->scope='.modal-content';
                    $this->title = 'Coupon einer Person zuweisen';
                    $this->validate();
                    $browser->click('.btn-warning')
                        ->pause(1000)
                        ->click('.fa-user-plus')
                        ->pause(1000)
                        ->screenshot($dir . 'Coupon einer Person zuweisen');
                    $this->scope='.main-container';
                    $this->title = 'Coupon einer Person zuweisen';
                    $this->validate();
                    $browser->click('.btn-warning')
                        ->pause(500)
                        ->click('.fa-eye')
                        ->pause(1500)
                        ->screenshot($dir . 'Zugeordnete Personen anzeigen');
                    $this->scope='.main-container';
                    $this->title = 'Zugeordnete Personen anzeigen';
                    $this->validate();
                    $browser->pause(500)
                        ->click('.fa-arrow-left')
                        ->pause(1000)
                        ->click('.fa-link')
                        ->pause(500)
                        ->screenshot($dir . 'Verknüpfte Trainings der Kampagne editieren');
                    $this->scope='.main-container';
                    $this->title = 'Verknüpfte Trainings der Kampagne editieren';
                    $this->validate();
                    $browser->click('.fa-arrow-left');
            }
        );
    }

    /**
     * @group All
     * @group Coupons
     */
    public function testCouponsCustomerRedeem()
    {
        $this->Login();
        $this->browse(
            function ($browser) {
                $dir = 'adac-' . date("Y-m-d-H") . '/Coupons/CustomerRedeem/';
                $browser->visit('/');
                $browser->clickLink('Trainingsangebote')
                    ->pause(1000)
                    ->clickLink('Gutscheine')
                    ->pause(500)
                    ->clickLink('t::page_names::customer_redeemcoupon')
                    ->screenshot($dir . 'Redeemcoupon');
                    $this->scope='.main-nav-left';
                    $this->title = 'Redeemcoupon';
                    $this->validate();
                    $browser->click('.btn-action')
                        ->pause(500)
                        ->screenshot($dir . 'Redeemcoupon form');
                    $this->scope='.main-container';
                        $this->title = 'Redeemcoupon form';
                        $this->validate();
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
                    //return false;
                    $url = $browser->driver->getCurrentURL();
                    $browser->screenshot($error_dir  . preg_replace('/[^A-Za-z0-9\-]/', '', $this->title));
                     return false;

                }
             
            }
        );
    }

}
