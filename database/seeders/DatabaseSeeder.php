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
        Customer::create(['name' => 'Ahmed Khan', 'phone' => '+880 1711-111111', 'email' => 'ahmed@example.com', 'address' => 'Dhaka', 'status' => 'active']);
        Customer::create(['name' => 'Fatima Ali', 'phone' => '+880 1722-222222', 'email' => 'fatima@example.com', 'address' => 'Chittagong', 'status' => 'active']);
        Customer::create(['name' => 'Hassan Rahman', 'phone' => '+880 1733-333333', 'email' => 'hassan@example.com', 'address' => 'Sylhet', 'status' => 'active']);
        Customer::create(['name' => 'Aisha Begum', 'phone' => '+880 1744-444444', 'email' => 'aisha@example.com', 'address' => 'Khulna', 'status' => 'active']);
        Customer::create(['name' => 'Omar Farooq', 'phone' => '+880 1755-555555', 'email' => 'omar@example.com', 'address' => 'Rajshahi', 'status' => 'active']);
        Supplier::create(['name' => 'Bangladesh Airlines', 'phone' => '+880 2-9898989', 'email' => 'contact@bdairlines.com', 'address' => 'Dhaka', 'status' => 'active']);
        Supplier::create(['name' => 'Royal Hotel Group', 'phone' => '+880 2-8787878', 'email' => 'booking@royalhotel.com', 'address' => 'Chittagong', 'status' => 'active']);
        Supplier::create(['name' => 'Express Transport', 'phone' => '+880 2-7676767', 'email' => 'info@express.com', 'address' => 'Dhaka', 'status' => 'active']);
        Supplier::create(['name' => 'Travel Insurance Co', 'phone' => '+880 2-6565656', 'email' => 'sales@insurance.com', 'address' => 'Dhaka', 'status' => 'active']);
        Item::create(['name' => 'Hajj Package', 'category' => 'Religious Travel', 'unit' => 'package', 'description' => 'Complete Hajj package', 'status' => 'active']);
        Item::create(['name' => 'Umrah Package', 'category' => 'Religious Travel', 'unit' => 'package', 'description' => 'Umrah travel', 'status' => 'active']);
        Item::create(['name' => 'Dubai Tour', 'category' => 'International', 'unit' => 'package', 'description' => '5 days Dubai', 'status' => 'active']);
        Item::create(['name' => 'Thailand Tour', 'category' => 'International', 'unit' => 'package', 'description' => '7 days Thailand', 'status' => 'active']);
        Item::create(['name' => 'Cox Bazar Package', 'category' => 'Domestic', 'unit' => 'package', 'description' => '3 days Cox Bazar', 'status' => 'active']);
        Item::create(['name' => 'Visa Processing', 'category' => 'Service', 'unit' => 'visa', 'description' => 'Visa application', 'status' => 'active']);
        Item::create(['name' => 'Travel Insurance', 'category' => 'Service', 'unit' => 'policy', 'description' => 'Travel insurance', 'status' => 'active']);
        for ($i = 0; $i < 30; $i++) {
            Purchase::create(['supplier_id' => rand(1, 4), 'item_id' => rand(1, 7), 'quantity' => rand(1, 5), 'unit_price' => rand(50000, 200000), 'purchase_date' => now()->subDays(rand(1, 90)), 'reference_no' => 'PUR-' . str_pad($i + 1, 4, '0', STR_PAD_LEFT)]);
        }
        for ($i = 0; $i < 40; $i++) {
            Income::create(['customer_id' => rand(1, 5), 'item_id' => rand(1, 7), 'amount' => rand(80000, 300000), 'income_date' => now()->subDays(rand(1, 90)), 'reference_no' => 'INC-' . str_pad($i + 1, 4, '0', STR_PAD_LEFT), 'description' => 'Customer booking', 'status' => 'completed']);
        }
        for ($i = 0; $i < 35; $i++) {
            CustomerPayment::create(['customer_id' => rand(1, 5), 'amount' => rand(20000, 150000), 'payment_date' => now()->subDays(rand(1, 90)), 'payment_method' => 'cash', 'reference_no' => 'CP-' . str_pad($i + 1, 4, '0', STR_PAD_LEFT)]);
        }
        for ($i = 0; $i < 25; $i++) {
            SupplierPayment::create(['supplier_id' => rand(1, 4), 'amount' => rand(30000, 180000), 'payment_date' => now()->subDays(rand(1, 90)), 'payment_method' => 'bank_transfer', 'reference_no' => 'SP-' . str_pad($i + 1, 4, '0', STR_PAD_LEFT)]);
        }
        $categories = ['Office Rent', 'Salaries', 'Utilities', 'Marketing', 'Transportation'];
        for ($i = 0; $i < 25; $i++) {
            Expense::create(['category' => $categories[rand(0, 4)], 'amount' => rand(5000, 50000), 'expense_date' => now()->subDays(rand(1, 90)), 'reference_no' => 'EXP-' . str_pad($i + 1, 4, '0', STR_PAD_LEFT), 'description' => 'Office expense', 'status' => 'paid']);
        }
    }
}
