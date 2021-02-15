<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PageTest extends DuskTestCase
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
     */
    public function testLogin()
    {
        $this->browse(function ($browser) {
            $username = $username ?? env('DUSK_adac_USER', 'admin');
            $password = $password ?? env('DUSK_adac_PASS', 'admin');
            $dir = 'adac-'.date("Y-m-d-H") . '/Login_' . $username . '/';
         
            $browser->visit('/')
                ->pause(200)
                ->resize(1920, 2700)
                ->clickAtXPath('/html/body/div[1]/div/div/div[2]/div[2]/div[1]/nav/ul/li[2]/a/span[1]')
                ->type('it105', $username)
                ->type('it102', $password)
                ->pause(100)
                ->screenshot($dir.'Loggin_form')
                ->clickAtXPath('/html/body/div[2]/div[3]/div/div/div/div[2]/div[1]/form/div[2]/a')
                ->pause(500)
                ->screenshot($dir.'Logged-In-user');
        });
    }

    /**
     * @group TrainingLocations
     */
    public function testTrainingLocations()
    {
        $this->browse(function ($browser) {
             $app_url="https://demo.b2b-fahrsicherheit.de/";
             $dir = date("Y-m-d-H") . '/Trainingsstandorte' . '/';
            $browser->visit('/trainingsstandorte')
            // clickLink('Trainingsstandorte')
                 ->resize(1920, 3000)
                 ->pause(1200)
                 ->screenshot($dir.'test2');
                $pages = $browser->elements('.pagination a');
                $i=1;
                for($i=1; $i<(sizeof($pages))-1 ;$i++)
                {
                    if($i>1)
                  {
                $pages[$i]->click();
                $browser->screenshot($dir.'page-'.$i);
                $pages = $browser->elements('.pagination a');
                    }
                }

                $links = $browser->elements('.pgm-info-button a');
                $prepared_link=array();
                foreach($links as $link)
                {
                    $link_short = str_replace( $app_url, '/', $link->getAttribute('href'));
                    array_push($prepared_link,$link_short);
                }
                   $j=1;
                foreach($prepared_link as $link)
                {
                    if($link != '/trainingsstandorte')
                    $browser->visit( $link)
                    ->pause(200)
                    ->resize(1920, 2500)
                    ->screenshot($dir.'step-'.$j.str_replace('/','-',$link));
                    $j++;
                }
                // $j=1;
                // for($j=1; $j<(sizeof($links))-1 ;$j++)
                // {
                //     if($j>1)
                //   {
                // $links[$j]->click();
                // $browser->pause(500)
                // ->screenshot($dir.'details-'.$j);
                // $links = $browser->elements('.pgm-info-button a');
                //     }
                // }
        });
    }    

    /**
     * @group All
     * @group Header
     */
    public function testHeader()
    {
        $this->browse(function ($browser) {
            $dir = 'adac-'.date("Y-m-d-H") . '/Header/';
            $app_url="https://demo.b2b-fahrsicherheit.de/";

            $pages = $browser->elements('.nav a');
            $prepared_link=array();
            foreach($pages as $page)
            {
                $link_short = str_replace( $app_url, '/', $page->getAttribute('href'));
                array_push($prepared_link,$link_short);
            }
            $i=1;
            foreach($prepared_link as $link)
            {
                if($link != '/trainingsstandorte')
                $browser->visit( $link)
                ->pause(200)
                ->resize(1920, 2500)
                ->screenshot($dir.'step-'.$i.str_replace('/','-',$link));
                $i++;
            }
        });
    }

     /**
     * @group All
     * @group Leftnav
     */
    public function testLeftNav()
    {
        $this->browse(function ($browser) {
            $dir = 'adac-'.date("Y-m-d-H") . '/LeftNav/';
            $app_url="https://demo.b2b-fahrsicherheit.de/";
            $browser->clickLink('Trainingsangebote')
                    ->pause(1000);
            $pages = $browser->elements('.panel-default a');
            $prepared_link=array();
            foreach($pages as $page)
            {
                $link_short = str_replace( $app_url, '/', $page->getAttribute('href'));
                array_push($prepared_link,$link_short);
            }
            $i=1;
            foreach($prepared_link as $link)
            {
                 if($link != '/b2bmaillog' && $link !='https://pm.circuit-booking.com/servicedesk/customer/portal/1' )
                 $browser->visit( $link)
                 ->pause(200)
                 ->resize(1920, 2500)
                 ->screenshot($dir.'step-'.$i.str_replace('/','-',$link));
                 $i++;
            }
        });
    }

    /**
     * @group All
     * @group Booking
     */
    public function testBooking()
    {
        $this->browse(function ($browser) {
            $dir = 'adac-'.date("Y-m-d-H") . '/Booking/';
            $app_url="https://demo.b2b-fahrsicherheit.de/";
            $browser->visit('/');
            $browser->clickLink('Trainingsangebote')
                    ->pause(1000)
                    ->clickAtXPath('/html/body/div[2]/div[3]/div/div[1]/nav/div/div[1]/div/div[6]/div[1]/a')
                    ->pause(100)
                    ->screenshot($dir.'tarinings')
                    ->clickLink('Buchungen')
                    ->screenshot($dir.'Buchungen');

            $tabs = $browser->elements('.pgm-datatable-column-toggle-DT_bookings span');
            $j=1;

            //click on all tabs.
            foreach($tabs as $tab)
            {
                $tab->click();
                $browser->screenshot($dir.'step-'.$j.'-'.$tab->getAttribute('innerHTML'));
                $j++;
            }
            //revert changes.
            $tabs = $browser->elements('.pgm-datatable-column-toggle-DT_bookings span');
            foreach($tabs as $tab)
            {
                $tab->click();
            }
            
            //click through all pages.
            $pages = $browser->elements('.paginate_button  a');   
            for($i=0;$i<(sizeof($pages))-1;$i++)
            {
                if($i>1)
                {
                    $pages[$i]->click();
                    $browser->screenshot($dir.'page-'.$i);
                    //update element position.
                    $pages = $browser->elements('.paginate_button  a');
                }
            }
        });
    }

     /**
     * @group All
     * @group Project
     */
    public function testProject()
    {
        $this->browse(function ($browser) {
            $dir = 'adac-'.date("Y-m-d-H") . '/Project/';
            $app_url="https://demo.b2b-fahrsicherheit.de/";
            $browser->visit('/');
            $browser->clickLink('Trainingsangebote')
                    ->pause(1000)
                    ->clickLink('Projekte')
                    ->screenshot($dir.'Project')
                    ->clickLink('Alle Projekte')
                    ->screenshot($dir.'All-Projects')
                    ->clickAtXPath('/html/body/div[2]/div[3]/div/div[2]/div/div[3]/div/div/div[1]/div[2]/a[2]')
                    ->screenshot($dir.'New-project')
                    ->clickAtXPath('/html/body/div[2]/div[3]/div/div[2]/div/div[3]/div/div/div/div/div[2]/div/div[2]/div[2]/a/span/span')
                    ->pause(1000)
                    ->screenshot($dir.'Close-window');


                   
                   

            // $tabs = $browser->elements('.badge innerHTML');
            // $j=1;
            // var_dump($tabs);

            // //click on all tabs.
            // foreach($tabs as $tab)
            // {
            //     $tab->click();
            //     $browser->screenshot($dir.'step-'.$j.'-'.$tab->getAttribute('innerHTML'));
            //     $j++;
            // }
            // //revert changes.
            // $tabs = $browser->elements('.pgm-datatable-column-toggle-DT_bookings span');
            // foreach($tabs as $tab)
            // {
            //     $tab->click();
            // }
            
            //click through all pages.
            $pages = $browser->elements('.paginate_button  a');   
            for($i=0;$i<(sizeof($pages))-1;$i++)
            {
                if($i>1)
                {
                    $pages[$i]->click();
                    $browser->screenshot($dir.'page-'.$i);
                    //update element position.
                    $pages = $browser->elements('.paginate_button  a');
                }
            }
        });
    }

     /**
     * @group All
     * @group Footer
     */
    public function testFooter()
    {
        $this->browse(function ($browser) {
            $dir = 'adac-'.date("Y-m-d-H") . '/Footer/';
            $app_url="https://demo.b2b-fahrsicherheit.de/";
            $browser->visit('/');
            $pages = $browser->elements('.full a');
            $prepared_link=array();
            foreach($pages as $page)
            {
                $link_short = str_replace( $app_url, '/', $page->getAttribute('href'));
                array_push($prepared_link,$link_short);
            }
          
            foreach($prepared_link as $link)
            {
                $browser->visit( $link)
                ->pause(200)
                ->resize(1920, 2500)
                ->screenshot($dir.str_replace('/','',$link));
            }
        });
    }
    
    /**
     * @group All
     * @group Settings
     */
    public function testSettingCompany()
    {
        $this->browse(function ($browser) {
            $dir = 'adac-'.date("Y-m-d-H") . '/Setting/';
            $app_url="https://demo.b2b-fahrsicherheit.de/";
            $browser->visit('/');
            $browser->clickLink('Trainingsangebote')
            ->pause(1000)
            ->clickLink('Einstellungen')
            ->screenshot($dir.'settings')
            ->pause(100)
             ->clickLink('Firma')
            ->screenshot($dir.'Firma')
            ->clickAtXPath('/html/body/div[2]/div[3]/div/div[2]/div/div[3]/div/div/div[1]/div[2]/a[2]')
            ->pause(300)
            ->screenshot($dir.'Add new')
            ->clickAtXPath('/html/body/div[8]/div[2]/div/div/div[3]/a[2]/span')
            ->screenshot($dir.'Close window')
            ->pause(300)            
            ->clickAtXPath('/html/body/div[2]/div[3]/div/div[2]/div/div[3]/div/div/div[2]/span/div[2]/div[2]/table/tbody/tr[1]/td[9]/a')
            ->screenshot($dir.'Edit');
         
            //lop throgh the all tabs.
            $tabs = $browser->elements('.profile-usermenu  li');   
            for($i=1;$i<(sizeof($tabs));$i++)
            {
                    $tabs[$i]->click();
                    $browser->screenshot($dir.'tab-'.$i);
                    //update element position.
                    $tabs = $browser->elements('.profile-usermenu  li');
            }
  

        });
    }

     
    /**
     * @group All
     * @group Settings
     */
    public function testSettingCompanyPages()
    {
        $this->browse(function ($browser) {
            $dir = 'adac-'.date("Y-m-d-H") . '/Setting/Pages/';
            $app_url="https://demo.b2b-fahrsicherheit.de/";
            $browser->visit('/');
            $browser->clickLink('Trainingsangebote')
            ->pause(1000)
            ->clickLink('Einstellungen')
            ->pause(100)
             ->clickLink('Firma')
            ->screenshot($dir.'Firma');
         
            //click through all pages.
            $pages = $browser->elements('.paginate_button  a');   
                for($i=0;$i<(sizeof($pages))-1;$i++)
                {
                 if($i>1)
                      {
                        $pages[$i]->click();
                        $browser->screenshot($dir.'page-'.$i);
                        //update element position.
                        $pages = $browser->elements('.paginate_button  a');
                        }
                }

                $tabs = $browser->elements('.portlet-body span');
                $j=1;
                //click on all tabs.
                foreach($tabs as $tab)
                { 
                    if($j>1)
                    {
                        $tab->click();
                        $browser->screenshot($dir.'tab-'.$j.'-'.$tab->getAttribute('innerHTML'));
                    }
                    $j++;
                }

        });
    }

      /**
     * @group All
     * @group Setting
     */
    public function testSettingUser()
    {
        $this->browse(function ($browser) {
            $dir = 'adac-'.date("Y-m-d-H") . '/Setting/user/';
            $app_url="https://demo.b2b-fahrsicherheit.de/";
            $browser->visit('/');
            $browser->clickLink('Trainingsangebote')
            ->pause(1000)
            ->clickLink('Einstellungen')
            ->pause(100)
             ->clickLink('Nutzer')
            ->screenshot($dir.'Nutzer');
         
            //click through all pages.
            $pages = $browser->elements('.paginate_button  a');   
                for($i=0;$i<(sizeof($pages))-1;$i++)
                {
                 if($i>1)
                      {
                        $pages[$i]->click();
                        $browser->screenshot($dir.'page-'.$i);
                        //update element position.
                        $pages = $browser->elements('.paginate_button  a');
                        }
                }

                $tabs = $browser->elements('.portlet-body span');
                $j=1;
                echo PHP_EOL;
                echo "size of tabs ".sizeof($tabs).PHP_EOL;
                //click on all tabs.
                foreach($tabs as $tab)
                { 
                    if($j>1 && $j< ((sizeof($tabs))-3))
                    {
                        $tab->click();
                        $browser->screenshot($dir.'tab-'.$j.'-');
                    }
                    $j++;
                }

        });
    }


    
}



