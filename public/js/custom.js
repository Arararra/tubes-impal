function getCart() {
  const cookie = document.cookie.split('; ').find(row => row.startsWith('cart='));
  return cookie ? JSON.parse(decodeURIComponent(cookie.split('=')[1])) : [];
}

function saveCart(cart) {
  document.cookie = `cart=${encodeURIComponent(JSON.stringify(cart))};path=/;max-age=${60 * 60 * 24 * 7}`;
  renderCart();
}

function addToCart(product) {
  let cart = getCart();
  let existing = cart.find(item => item.id == product.id);

  if (existing) {
    existing.qty += 1;
  } else {
    cart.push({ ...product, qty: 1 });
  }

  saveCart(cart);
  notify(`${product.name} berhasil ditambahkan ke cart!`, 'success');
}

function removeFromCart(id) {
  let cart = getCart().filter(item => item.id != id);
  saveCart(cart);
  notify('Produk telah dihapus dari cart!', 'error');
}

function clearCart() {
  document.cookie = "cart=[];path=/;max-age=0";
  renderCart();
  notify('Cart telah dikosongkan!', 'error');
}

function changeQty(id, delta) {
  let cart = getCart();
  let item = cart.find(i => i.id == id);
  if (!item) return;

  item.qty = Math.max(1, item.qty + delta); // minimal 1
  saveCart(cart);
}

function setQty(id, value) {
  let cart = getCart();
  let item = cart.find(i => i.id == id);
  if (!item) return;

  let qty = parseInt(value);
  if (isNaN(qty) || qty < 1) qty = 1;
  item.qty = qty;

  saveCart(cart);
}


function calcTotal(cart) {
  return cart.reduce((sum, item) => sum + item.price * item.qty, 0);
}

function calcCount(cart) {
  return cart.reduce((sum, item) => sum + item.qty, 0);
}

function renderCart() {
  const cart = getCart();
  const itemContainers = document.querySelectorAll('.cart-items');
  const totalElements = document.querySelectorAll('.cart-total');
  const countElements = document.querySelectorAll('.cart-count');
  const previewContainer = document.querySelectorAll('.order-preview');

  const html = cart.length ? cart.map(item => `
    <div class="ps-product--mini-cart">
      <div class="ps-product__thumbnail">
        <a href="#">
          <img src="${item.image}" alt="${item.name}" class="h-100 object-fit-cover">
        </a>
      </div>
      <div class="ps-product__content">
        <span class="ps-btn--close" onclick="removeFromCart(${item.id})"></span>
        <a class="ps-product__title" href="javascript:;">${item.name}</a>
        <p><strong>
          Quantity: 
          <input type="number" min="1" value="${item.qty}" onchange="setQty(${item.id}, this.value)" 
            class="border rounded-pill text-center ml-1 px-4" style="width: 8rem; height: 4rem">
        </strong></p>
        <small>Rp. ${item.price.toLocaleString('id-ID')}</small>
      </div>
    </div>
  `).join('')
  : '<p class="text-center py-3">Cart masih kosong.</p>';

  const previewHtml = cart.length ? cart.map(item => `
    <p>
      ${item.qty} ${item.name} <span>Rp. ${(item.price * item.qty).toLocaleString('id-ID')}</span>
    </p>
  `).join('')
  : '<p class="text-center py-3">Cart masih kosong.</p>';

  // render ke cart-items dan order-preview
  itemContainers.forEach(c => c.innerHTML = html);
  previewContainer.forEach(c => c.innerHTML = previewHtml);

  // render total dan count
  const total = `Rp. ${calcTotal(cart).toLocaleString('id-ID')}`;
  totalElements.forEach(s => s.textContent = total);
  countElements.forEach(s => s.textContent = calcCount(cart));
}

document.querySelectorAll('.cart-add').forEach(btn => {
  btn.addEventListener('click', () => {
    const product = {
      id: btn.dataset.id,
      name: btn.dataset.name,
      image: btn.dataset.image,
      price: parseFloat(btn.dataset.price),
    };
    addToCart(product);
  });
});
document.querySelectorAll('.cart-clear').forEach(btn => {
  btn.addEventListener('click', () => {
    clearCart()
  });
});
renderCart();

function notify(message, type = 'success', persist = false) {
  Toastify({
    text: message,
    duration: persist ? -1 : 3000,
    gravity: 'top',
    position: 'right',
    backgroundColor: type == 'success' ? '#4CAF50' : '#f44336',
    stopOnFocus: true,
    close: true,
  }).showToast();
}
