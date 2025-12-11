<?php

namespace Tests\Browser;

use App\Models\Single;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class SingleTest extends DuskTestCase
{
    /** @test */
    public function admin_login(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/login')
                ->type('#data\.email', 'admin@impal.com')
                ->type('#data\.password', 'admin123')
                ->press('#form > div.fi-form-actions > div > button')
                ->waitForLocation('/admin')
                ->assertPathIs('/admin');
        });
    }

    /** @test */
    public function admin_single_list(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/singles')
                ->assertSee('Singles');
        });
    }

    /** @test */
    public function admin_single_create(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/singles/create')
                ->typeSlowly('#data\.title', 'Test Page')
                ->typeSlowly('#data\.slug', 'test-page')
                ->scrollTo('#key-bindings-1')
                ->pause(3000)
                ->press('#key-bindings-1')
                ->waitUntil("window.location.href != 'http://127.0.0.1:8000/admin/singles/create'")
                ->waitForText('Created', 10)
                ->assertSee('Created');
        });
    }

    /** @test */
    public function admin_single_update(): void
    {
        $this->browse(function (Browser $browser) {
            $lastItem = Single::latest()->first()->slug;
            $browser->visit("/admin/singles/{$lastItem}/edit")
                ->typeSlowly('#data\.title', 'Test')
                ->typeSlowly('#data\.slug', 'test')
                ->scrollTo('#key-bindings-2')
                ->pause(3000)
                ->press('#key-bindings-2')
                ->waitForText('Saved', 10)
                ->assertSee('Saved');
        });
    }

    /** @test */
    public function admin_single_delete(): void
    {
        $this->browse(function (Browser $browser) {
            $lastItem = Single::latest()->first()->slug;
            $browser->visit("/admin/singles/{$lastItem}/edit")
                ->press('#key-bindings-1')
                ->waitFor('.fi-modal-window button[x-data*="isProcessing"]')
                ->press('.fi-modal-window button[x-data*="isProcessing"]')
                ->waitForLocation('/admin/singles')
                ->assertSee('Deleted');
        });
    }

    /** @test */
    public function check_about_page(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit("/about")
                ->assertSee('Kami adalah toko roti lokal yang berkomitmen');
        });
    }

    /** @test */
    public function check_faq_page(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit("/faq")
                ->scrollTo('div[x-data] .mb-3:nth-child(3) .card-header')
                ->pause(1000)
                ->click('div[x-data] .mb-3:nth-child(3) .card-header')
                ->waitForText('Ya, kami melayani pengantaran ke wilayah kota');
        });
    }
}
