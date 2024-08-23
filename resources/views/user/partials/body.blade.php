@extends('layout.main')
@section('main')
<div x-data="{ 
    cartCount:0, 
    cart:[], 
    totalPrice:0, 
    removeCart(index) {
        this.cartCount -= this.cart[index].quantity;
        this.cart.splice(index, 1);
    },
    addCart(newProduct) {
        let index = this.cart.findIndex(product => product.id === newProduct.id);
        if (index !== -1) {
            this.cart[index].quantity ++;
        } else {
            this.cart.push({
                id: newProduct['id'],
                name: newProduct['name'],
                price: newProduct['price'],
                quantity: 1,
            });
        }
        this.totalPrice += newProduct['price'];
        this.cartCount++;
    },
    decrementCart(id) {
        let index = this.cart.findIndex(product => product.id === id);
        this.cart[index].quantity --;
        this.totalPrice -= this.cart[index].price;
        this.cartCount--;
    },
    incrementCart(id) {
        let index = this.cart.findIndex(product => product.id == id);
        this.cart[index].quantity ++;
        this.totalPrice += this.cart[index].price;
        this.cartCount++;
    },
    checkoutHandler(e) {
        const form = e.target;
        const data = document.createElement('input');
        const totalPrice = document.createElement('input');
        
        data.setAttribute('hidden', 'text');
        data.setAttribute('name', 'data');
        data.setAttribute('value', JSON.stringify(this.cart));
        totalPrice.setAttribute('hidden', 'text');
        totalPrice.setAttribute('name', 'total_price');
        totalPrice.setAttribute('value', this.totalPrice);

        form.appendChild(data);
        form.appendChild(totalPrice);

        form.submit();
    }
    
}" class="wrapper relative">
    @include('user.partials.navbar')
    @yield("wrapper")
</div>
@endsection