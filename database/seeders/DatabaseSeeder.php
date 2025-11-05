<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Customer;
use App\Models\Supplier;
use App\Models\Item;
use App\Models\Purchase;
use App\Models\Income;
use App\Models\Expense;
use App\Models\CustomerPayment;
use App\Models\SupplierPayment;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create(['name' => 'Admin', 'email' => 'admin@alnafi.com', 'password' => Hash::make('password')]);
    }
}
