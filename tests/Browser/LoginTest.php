<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * @group All
     * @group TrainingLocations
     * @group Links
     * @group Booking
     * @group Footer
     * @group Header
     * @group Leftnav
     * @group Project
     * @group Setting
     * @group Coupons
     * @group Menu
     * @group SettingsOptions
     */
    public function testLogin()
    {
        $this->browse(
            function ($browser) {
                $username = $username ?? env('DUSK_adac_USER', 'admin');
                $password = $password ?? env('DUSK_adac_PASS', 'admin');
                $dir = 'adac-' . date("Y-m-d-H") . '/Login_' . $username . '/';

                $browser->visit('/')
                    ->pause(200)
                    ->resize(1920, 2700);
                if ($browser->seeLink('Login')) {
                    $browser->clickLink(' Login')
                        ->type('it105', $username)
                        ->type('it102', $password)
                        ->pause(100)
                        ->screenshot($dir . 'Loggin_form')
                        ->clickAtXPath('/html/body/div[2]/div[3]/div/div/div/div[2]/div[1]/form/div[2]/a')
                        ->pause(500)
                        ->screenshot($dir . 'Logged-In-user');
                }             
       
            }
        );
    }
}
