<?php

namespace Tests\Browser;

use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ProductTest extends DuskTestCase
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
    public function admin_product_list(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/products')
                ->assertSee('Products');
        });
    }

    /** @test */
    public function admin_product_create(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/products/create')
                ->typeSlowly('#data\.title', 'Roti 404')
                ->typeSlowly('#data\.price', '15000')
                ->typeSlowly('#data\.stock', '10')
                ->scrollTo('#key-bindings-1')
                ->pause(3000)
                ->press('#key-bindings-1')
                ->waitUntil("window.location.href != 'http://127.0.0.1:8000/admin/products/create'")
                ->waitForText('Created', 10)
                ->assertSee('Created');
        });
    }

    /** @test */
    public function admin_product_update(): void
    {
        $this->browse(function (Browser $browser) {
            $lastItem = Product::latest()->first()->id;
            $browser->visit("/admin/products/{$lastItem}/edit")
                ->typeSlowly('#data\.title', 'Roti 200')
                ->typeSlowly('#data\.price', '20000')
                ->typeSlowly('#data\.stock', '20')
                ->scrollTo('#key-bindings-2')
                ->pause(3000)
                ->press('#key-bindings-2')
                ->waitForText('Saved', 10)
                ->assertSee('Saved');
        });
    }

    /** @test */
    public function admin_product_delete(): void
    {
        $this->browse(function (Browser $browser) {
            $lastItem = Product::latest()->first()->id;
            $browser->visit("/admin/products/{$lastItem}/edit")
                ->press('#key-bindings-1')
                ->waitFor('.fi-modal-window button[x-data*="isProcessing"]')
                ->press('.fi-modal-window button[x-data*="isProcessing"]')
                ->waitForLocation('/admin/products')
                ->assertSee('Deleted');
        });
    }
}
