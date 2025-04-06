<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $product['name'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .product-image {
            max-height: 500px;
            object-fit: contain;
        }
        .product-info {
            background: #f8f9fa;
            padding: 2rem;
            border-radius: 10px;
        }
        .btn-add-to-cart {
            padding: 0.8rem 2rem;
            font-size: 1.1rem;
        }
    </style>
</head>
<body>
    <?php $this->load->view('partials/header'); ?>
    
    <div class="container my-5">
        <div class="row">
            <div class="col-md-6 mb-4">
                <img src="<?= $product['image_url'] ?>" class="img-fluid product-image rounded shadow" alt="<?= $product['name'] ?>">
            </div>
            <div class="col-md-6">
                <div class="product-info">
                    <h1 class="mb-3"><?= $product['name'] ?></h1>
                    <div class="d-flex align-items-center mb-3">
                        <span class="text-warning me-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </span>
                        <span class="text-muted">(24 reviews)</span>
                    </div>
                    <h3 class="text-primary mb-4">$<?= number_format($product['price'], 2) ?></h3>
                    
                    <p class="mb-4"><?= nl2br($product['description']) ?></p>
                    
                    <div class="d-flex align-items-center mb-4">
                        <div class="input-group me-3" style="width: 120px;">
                            <button class="btn btn-outline-secondary" type="button">-</button>
                            <input type="text" class="form-control text-center" value="1">
                            <button class="btn btn-outline-secondary" type="button">+</button>
                        </div>
                        <form action="/cart/add/<?= $product['id'] ?>" method="POST" class="flex-grow-1">
                            <button type="submit" class="btn btn-primary btn-add-to-cart w-100">
                                <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                            </button>
                        </form>
                    </div>
                    
                    <div class="d-flex">
                        <button class="btn btn-outline-secondary me-2">
                            <i class="far fa-heart"></i> Wishlist
                        </button>
                        <button class="btn btn-outline-secondary">
                            <i class="fas fa-share-alt"></i> Share
                        </button>
                    </div>
                </div>
                
                <div class="mt-4">
                    <h5>Product Details</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Category:</strong> <?= $product['category_name'] ?? 'General' ?></li>
                        <li class="list-group-item"><strong>Availability:</strong> In Stock (<?= $product['stock'] ?? 10 ?> items)</li>
                        <li class="list-group-item"><strong>Shipping:</strong> Free shipping for orders over $50</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <?php $this->load->view('partials/footer'); ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>