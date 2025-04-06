<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Shopping Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .cart-item-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 4px;
        }
        .quantity-input {
            width: 50px;
            text-align: center;
        }
    </style>
</head>
<body>
    <?php $this->load->view('partials/header'); ?>
    
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Your Shopping Cart</h2>
            <span class="badge bg-primary rounded-pill">
                <?= count($cart ?? []) ?> item(s)
            </span>
        </div>
        
        <?php if (empty($cart)): ?>
            <div class="card shadow-sm">
                <div class="card-body text-center py-5">
                    <i class="fas fa-shopping-cart fa-4x text-muted mb-4"></i>
                    <h4 class="text-muted">Your cart is empty</h4>
                    <p class="text-muted">Start shopping to add items to your cart</p>
                    <a href="/products" class="btn btn-primary mt-3">
                        <i class="fas fa-arrow-left me-2"></i> Continue Shopping
                    </a>
                </div>
            </div>
        <?php else: ?>
            <div class="row">
                <div class="col-lg-8">
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <?php foreach ($cart as $id => $item): ?>
                                <div class="row align-items-center mb-4 pb-3 border-bottom">
                                    <div class="col-md-2">
                                        <img src="<?= $item['image_url'] ?>" class="cart-item-image" alt="<?= $item['name'] ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <h5 class="mb-1"><?= $item['name'] ?></h5>
                                        <small class="text-muted">SKU: <?= $id ?></small>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <button class="btn btn-outline-secondary quantity-btn" type="button" data-action="decrease">-</button>
                                            <input type="text" class="form-control quantity-input" value="1">
                                            <button class="btn btn-outline-secondary quantity-btn" type="button" data-action="increase">+</button>
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-end">
                                        <span class="fw-bold">$<?= number_format($item['price'], 2) ?></span>
                                    </div>
                                    <div class="col-md-1 text-end">
                                        <a href="/cart/remove/<?= $id ?>" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Order Summary</h5>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal:</span>
                                <span>$<?= number_format($subtotal, 2) ?></span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Shipping:</span>
                                <span>$5.00</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span>Tax:</span>
                                <span>$<?= number_format($subtotal * 0.1, 2) ?></span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between fw-bold fs-5 mb-4">
                                <span>Total:</span>
                                <span>$<?= number_format($subtotal + 5 + ($subtotal * 0.1), 2) ?></span>
                            </div>
                            <a href="/checkout" class="btn btn-primary w-100 py-2">
                                Proceed to Checkout <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                            <div class="text-center mt-3">
                                <small class="text-muted">or</small>
                                <a href="/products" class="d-block mt-2">
                                    <i class="fas fa-arrow-left me-2"></i> Continue Shopping
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
    
    <?php $this->load->view('partials/footer'); ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.quantity-btn').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.parentElement.querySelector('.quantity-input');
                let value = parseInt(input.value);
                
                if (this.dataset.action === 'increase') {
                    value++;
                } else if (this.dataset.action === 'decrease' && value > 1) {
                    value--;
                }
                
                input.value = value;
                // TODO: Update cart quantity via AJAX
            });
        });
    </script>
</body>
</html>