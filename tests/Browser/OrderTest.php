<?php

namespace Tests\Browser;

use App\Models\Order;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class OrderTest extends DuskTestCase
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
    public function admin_order_list(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/orders')
                ->assertSee('Orders');
        });
    }

    /** @test */
    public function admin_order_update_status(): void
    {
        $this->browse(function (Browser $browser) {
            Order::latest()->first()->update([
                'shipping_receipt' => null,
                'status' => 'Processing'
            ]);
            $lastItem = Order::latest()->first()->receipt;
            $browser->visit("/admin/orders/{$lastItem}/edit")
                ->typeSlowly('#data\.shipping_receipt', 'SPX647290')
                ->select('#data\.status', 'Shipped')
                ->scrollTo('#key-bindings-2')
                ->pause(3000)
                ->press('#key-bindings-2')
                ->waitForText('Saved', 10);
        });
    }

    /** @test */
    public function order_check(): void
    {
        $this->browse(function (Browser $browser) {
            $lastItem = Order::latest()->first();
            $browser->visit('/order-check')
                ->typeSlowly('input[name=invoice]', $lastItem->receipt)
                ->typeSlowly('input[name=whatsapp]', substr($lastItem->customer_whatsapp, -5))
                ->press('button[type=submit]')
                ->waitForText('DETAIL PESANAN');
        });
    }
}
