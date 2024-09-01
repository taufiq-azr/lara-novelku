<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class IndexPageTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testIndexPageLoads()
    {
        $this->browse(function (Browser $browser) {
            // Uji bahwa halaman utama dimuat dengan benar
            $browser->visit('/')
                ->pause(1000)
                ->assertSee('NovelKu') // Pastikan halaman memiliki judul NovelKu
                ->assertSee('RANDOM NOVEL') // Pastikan halaman memiliki section untuk random novel
                ->assertSee('LAST UPDATE') // Pastikan halaman memiliki section untuk last update
                ->assertPathIs('/'); // Pastikan URL halaman sesuai dengan yang diharapkan

            // Pastikan elemen "Read More" tersedia sebelum diklik
            $browser->waitFor('a.btn')
                ->clickLink('Read More', 'a.btn')
                ->pause(1000); // Tambahkan penundaan singkat untuk memastikan halaman detail dimuat sepenuhnya

            // Uji bahwa halaman detail novel dimuat dengan benar
            $browser->assertSee('Genre:') // Pastikan halaman detail novel memiliki label Genre
                ->assertSee('Status:') // Pastikan halaman detail novel memiliki label Status
                ->assertPathBeginsWith('/novels/'); // Pastikan URL sesuai dengan yang diharapkan
        });
    }
}
