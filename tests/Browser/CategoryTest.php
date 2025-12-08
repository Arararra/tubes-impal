<?php

namespace Tests\Browser;

use App\Models\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CategoryTest extends DuskTestCase
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
    public function admin_category_list(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/categories')
                ->assertSee('Categories');
        });
    }

    /** @test */
    public function admin_category_create(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/categories/create')
                ->typeSlowly('#data\.title', 'New Category')
                ->press('#key-bindings-1')
                ->waitForText('Created')
                ->assertSee('Created');
        });
    }

    /** @test */
    public function admin_category_update(): void
    {
        $this->browse(function (Browser $browser) {
            $lastItemId = Category::latest()->first()->id;
            $browser->visit("/admin/categories/{$lastItemId}/edit")
                ->typeSlowly('#data\.title', 'Updated Category')
                ->press('#key-bindings-2')
                ->waitForText('Saved')
                ->assertSee('Saved');
        });
    }

    /** @test */
    public function admin_category_delete(): void
    {
        $this->browse(function (Browser $browser) {
            $lastItemId = Category::latest()->first()->id;
            $browser->visit("/admin/categories/{$lastItemId}/edit")
                ->press('#key-bindings-1')
                ->waitFor('.fi-modal-window button[x-data*="isProcessing"]')  
                ->press('.fi-modal-window button[x-data*="isProcessing"]')  
                ->waitForLocation('/admin/categories')
                ->assertSee('Deleted');
        });
    }
}
