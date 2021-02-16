<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CouponsTest extends DuskTestCase
{

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
                    ->screenshot($dir . 'allcampaigns')
                    ->click('.fa-pencil')
                    ->pause(1000)
                    ->screenshot($dir . 'Edit Kampagne')
                    ->click('.btn-warning')
                    ->pause(500)
                    ->screenshot($dir . 'Closeedit')
                    ->pause(1000)
                    ->click('.fa-user-plus')
                    ->pause(1000)
                    ->screenshot($dir . 'Coupon einer Person zuweisen')
                    ->click('.btn-warning')
                    ->pause(500)
                    ->click('.fa-user-ninja')
                    ->pause(1500)
                    ->screenshot($dir . 'Coupon einer externen Person zuweisen')
                    ->click('.btn-warning')
                    ->pause(500)
                    ->click('.fa-eye')
                    ->pause(1500)
                    ->screenshot($dir . 'Zugeordnete Personen anzeigen')
                    ->pause(500)
                    ->click('.fa-arrow-left')
                    ->pause(1000)
                    ->click('.fa-link')
                    ->pause(500)
                    ->screenshot($dir . 'Verknüpfte Trainings der Kampagne editieren')
                    ->click('.fa-arrow-left');
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
                    ->screenshot($dir . 'ActiveCampaign')
                    ->click('.fa-pencil')
                    ->pause(1000)
                    ->screenshot($dir . 'Edit Kampagne')
                    ->click('.btn-warning')
                    ->pause(500)
                    ->screenshot($dir . 'Closeedit')
                    ->pause(1000)
                    ->click('.fa-plus')
                    ->pause(1000)
                    ->screenshot($dir . 'Limitierte Kampagne um Coupon erweitern')
                    ->click('.btn-warning')
                    ->pause(500)
                    ->click('.fa-eye')
                    ->pause(1500)
                    ->screenshot($dir . 'Zugeordnete Personen anzeigen')
                    ->pause(500)
                    ->click('.fa-arrow-left')
                    ->pause(1000)
                    ->click('.fa-link')
                    ->pause(500)
                    ->screenshot($dir . 'Verknüpfte Trainings der Kampagne editieren')
                    ->click('.fa-arrow-left');
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
                    ->screenshot($dir . 'ClosedCampaigns')
                    ->click('.fa-pencil')
                    ->pause(1000)
                    ->screenshot($dir . 'Edit Kampagne')
                    ->click('.btn-warning')
                    ->pause(500)
                    ->screenshot($dir . 'Closeedit')
                    ->pause(500)
                    ->click('.fa-user-ninja')
                    ->pause(1500)
                    ->screenshot($dir . 'Coupon einer externen Person zuweisen')
                    ->click('.btn-warning')
                    ->pause(1000)
                    ->click('.fa-user-plus')
                    ->pause(1000)
                    ->screenshot($dir . 'Coupon einer Person zuweisen')
                    ->click('.btn-warning')
                    ->pause(500)
                    ->click('.fa-eye')
                    ->pause(1500)
                    ->screenshot($dir . 'Zugeordnete Personen anzeigen')
                    ->pause(500)
                    ->click('.fa-arrow-left')
                    ->pause(1000)
                    ->click('.fa-link')
                    ->pause(500)
                    ->screenshot($dir . 'Verknüpfte Trainings der Kampagne editieren')
                    ->click('.fa-arrow-left');
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
                    ->screenshot($dir . 'Redeemcoupon')
                    ->click('.btn-action')
                    ->pause(500)
                    ->screenshot($dir . 'Redeemcoupon form');
            }
        );
    }


}
