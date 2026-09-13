cd C:\ERP\backend

php artisan make:service PurchaseService
php artisan make:service SaleService
php artisan make:service WorkOrderService

php artisan optimize:clear

$purchaseModel = @'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $guarded = [];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function items()
    {
        return $this->hasMany(PurchaseItem::class);
    }
}
'@

$purchaseModel | Set-Content app\Models\Purchase.php

$purchaseItemModel = @'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    protected $guarded = [];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
'@

$purchaseItemModel | Set-Content app\Models\PurchaseItem.php

$saleModel = @'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(SaleItem::class);
    }
}
'@

$saleModel | Set-Content app\Models\Sale.php

$saleItemModel = @'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    protected $guarded = [];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
'@

$saleItemModel | Set-Content app\Models\SaleItem.php

$productModel = @'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function purchaseItems()
    {
        return $this->hasMany(PurchaseItem::class);
    }

    public function saleItems()
    {
        return $this->hasMany(SaleItem::class);
    }

    public function stockMovements()
    {
        return $this->hasMany(StockMovement::class);
    }
}
'@

$productModel | Set-Content app\Models\Product.php

php artisan optimize:clear

Write-Host ""
Write-Host "================================="
Write-Host "SPRINT 2 MODEL REFACTOR DONE"
Write-Host "================================="