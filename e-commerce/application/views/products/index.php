<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php $this->load->view('partials/header'); ?>
    
    <div class="container my-5">
        <h2>Products</h2>
        <div class="row">
            <?php foreach ($products as $product): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="<?= $product['image_url'] ?>" class="card-img-top" alt="<?= $product['name'] ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $product['name'] ?></h5>
                            <p class="card-text">$<?= number_format($product['price'], 2) ?></p>
                            <a href="/products/details/<?= $product['id'] ?>" class="btn btn-primary">View Details</a>
                            <form action="/cart/add/<?= $product['id'] ?>" method="POST" class="mt-2">
                                <button type="submit" class="btn btn-success">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    
    <?php $this->load->view('partials/footer'); ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>