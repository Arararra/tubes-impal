<?php

namespace Tests\Browser;

use App\Models\Review;
use App\Models\OrderProduct;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ReviewTest extends DuskTestCase
{
    /** @test */
    public function add_product_review(): void
    {
        $this->browse(function (Browser $browser) {
            $lastItem = OrderProduct::latest()->first();
            Review::where('order_id', $lastItem->order_id)
                ->where('product_id', $lastItem->product_id)
                ->delete();
            $browser->visit("/products/{$lastItem->product_id}")
                ->scrollTo('form button')
                ->typeSlowly('form input[name=order_receipt]', $lastItem->order->receipt)
                ->typeSlowly('form input[name=customer_whatsapp]', substr($lastItem->order->customer_whatsapp, -5))
                ->within('form .br-wrapper', function (Browser $browser) {
                    $browser->click('a[data-rating-value="5"]');
                })
                ->typeSlowly('form textarea[name=body]', 'This is an automated test review.')
                ->click('form button')
                ->waitForText('Review berhasil disimpan');
        });
    }
    
    /** @test */
    public function update_product_review(): void
    {
        $this->browse(function (Browser $browser) {
            $lastItem = Review::latest()->first();
            $browser->visit("/products/{$lastItem->product_id}")
                ->scrollTo('form button')
                ->typeSlowly('form input[name=order_receipt]', $lastItem->order->receipt)
                ->typeSlowly('form input[name=customer_whatsapp]', substr($lastItem->order->customer_whatsapp, -5))
                ->within('form .br-wrapper', function (Browser $browser) {
                    $browser->click('a[data-rating-value="1"]');
                })
                ->typeSlowly('form textarea[name=body]', 'This is a bad automated test review.')
                ->click('form button')
                ->waitForText('Review berhasil disimpan');
        });
    }
}
