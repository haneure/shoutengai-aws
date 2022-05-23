<?php

namespace App\Http\Livewire;

use App\Models\Coupon;
use Carbon\Carbon;
use Livewire\Component;
use Cart;
use Auth;

class CartComponent extends Component
{
    public $haveCouponCode;
    public $couponCode;
    public $discount;
    public $subtotalAfterDiscount;
    public $taxAfterDiscount;
    public $totalAfterDiscount;

    public function increaseQuantity($id)
    {
        $product = Cart::instance('cart')->get($id);
        $qty = $product->qty + 1;
        Cart::instance('cart')->update($id, $qty);
        $this->emitTo('cart-count-component', 'refreshComponent');
    }

    public function decreaseQuantity($id)
    {
        $product = Cart::instance('cart')->get($id);
        $qty = $product->qty - 1;
        Cart::instance('cart')->update($id, $qty);
        $this->emitTo('cart-count-component', 'refreshComponent');
    }

    public function destroy($id)
    {
        Cart::instance('cart')->remove($id);
        $this->emitTo('cart-count-component', 'refreshComponent');
        session()->flash('success', 'Product removed from cart');
    }

    public function destroyAll() {
        Cart::instance('cart')->destroy();
        $this->emitTo('cart-count-component', 'refreshComponent');
        session()->flash('success', 'Cart is emptied');
    }

    public function saveForLater($rowId){
        $item = Cart::instance('cart')->get($rowId);
        Cart::instance('cart')->remove($rowId);
        Cart::instance('saveforlater')->add($item->id, $item->name, 1, $item->price)->associate('App\Models\Product');
        $this->emitTo('cart-count-component', 'refreshComponent');
        session()->flash('success_message', 'Product saved for later');
    }

    public function moveToCart($rowId){
        $item = Cart::instance('saveforlater')->get($rowId);
        Cart::instance('saveforlater')->remove($rowId);
        Cart::instance('cart')->add($item->id, $item->name, 1, $item->price)->associate('App\Models\Product');
        $this->emitTo('cart-count-component', 'refreshComponent');
        session()->flash('s_success_message', 'Product has been moved to cart');
    }

    public function deleteFromSaveForLater($rowId) {
        Cart::instance('saveforlater')->remove($rowId);
        session()->flash('s_success_message', 'Product has been removed from save for later');
    }

    public function applyCouponCode() {
        $notfound = Coupon::where('code', $this->couponCode)->first();
        $notenough = Coupon::where('code', $this->couponCode)->where('cart_value', '<=', Cart::instance('cart')->subtotal())->first();
        $expired = Coupon::where('code', $this->couponCode)->where('expiry_date', '>=', Carbon::today())->first();

        $coupon = Coupon::where('code', $this->couponCode)->where('expiry_date', '>=', Carbon::today())->where('cart_value', '<=', Cart::instance('cart')->subtotal())->first();

        if(!$notfound){
            session()->flash('error_message', 'Coupon code is not valid');
            return;
        }

        if(!$expired){
            session()->flash('error_message', 'Coupon code has been expired');
            return;
        }

        if(!$notenough){
            $cart_value = Coupon::where('code', $this->couponCode)->first()->cart_value;
            session()->flash('error_message', 'Requirement not met, you have to spend a minimal of $'.$cart_value.' to use this coupon');
            return;
        }

        session()->put('coupon', [
            'code' => $coupon->code,
            'type' => $coupon->type,
            'value' => $coupon->value,
            'cart_value' => $coupon->cart_value
        ]);
    }

    public function calculateDiscounts() {
        if(session()->has('coupon')) {
            if(session()->get('coupon')['type'] == 'fixed') {
                $this->discount = session()->get('coupon')['value'];
            } else {
                $this->discount = (Cart::instance('cart')->subtotal() * session()->get('coupon')['value']) / 100;
            }

            $this->subtotalAfterDiscount = Cart::instance('cart')->subtotal() - $this->discount;
            $this->taxAfterDiscount = ($this->subtotalAfterDiscount * config('cart.tax')) / 100;
            $this->totalAfterDiscount = $this->subtotalAfterDiscount + $this->taxAfterDiscount;
        }
    }

    public function removeCoupon() {
        session()->forget('coupon');
        $this->discount = 0;
    }

    public function checkout() {
        if(Auth::check()) {
            return redirect()->route('checkout');
        } else {
            return redirect()->route('login');
        }
    }

    public function setAmountForCheckout() {
        if(!Cart::instance('cart')->count() > 0){
            session()->forget('checkout');
            return;
        }

        if(session()->has('coupon')) {
            session()->put('checkout', [
                'discount' => $this->discount,
                'subtotal' => $this->subtotalAfterDiscount,
                'tax' => $this->taxAfterDiscount,
                'total' => $this->totalAfterDiscount
            ]);
        } else {
            session()->put('checkout', [
                'discount' => 0,
                'subtotal' => Cart::instance('cart')->subtotal(),
                'tax' => Cart::instance('cart')->tax(),
                'total' => Cart::instance('cart')->total()
            ]);
        }
    }

    public function render()
    {
        if(session()->has('coupon')) {
            if(Cart::instance('cart')->subtotal() < session()->get('coupon')['cart_value']) {
                session()->forget('coupon');
            } else {
                $this->calculateDiscounts();
            }
        }
        $this->setAmountForCheckout();

        if(Auth::check()) {
            Cart::instance('cart')->store(Auth::user()->email);
        }

        return view('livewire.cart-component')->layout("layouts.base");
    }
}
