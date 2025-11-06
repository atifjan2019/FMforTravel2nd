# Dashboard Receivables Update

## Issue
The "Current Month Receivables" on the dashboard was showing incorrect amounts (e.g., Rs 7,000) instead of actual unpaid amounts. It was calculating `totalIncome - totalCustomerPayments` which doesn't account for the new payment tracking system.

## Example Scenario
- Customer has invoice of Rs 7,000
- Customer paid Rs 500 (partial payment)
- **Old Calculation**: Would show Rs 7,000 - Rs 500 = Rs 6,500 (if payment was recorded separately)
- **New Calculation**: Shows Rs 6,500 from `remaining_amount` field directly

## Solution
Updated the dashboard to use the `remaining_amount` field from the incomes table and filter by payment status.

## Changes Made

### 1. DashboardController.php

#### Updated Receivables Calculation
**Before:**
```php
$customerReceivables = $totalIncome - $totalCustomerPayments;
```

**After:**
```php
// Calculate balances - using remaining_amount from incomes for accurate receivables
$customerReceivables = Income::whereBetween('income_date', [$currentMonthStart, $currentMonthEnd])
    ->whereIn('payment_status', ['unpaid', 'partial'])
    ->sum('remaining_amount');
```

#### Added Payment Status Breakdown
```php
// Payment status breakdown for current month
$totalPaidAmount = Income::whereBetween('income_date', [$currentMonthStart, $currentMonthEnd])->sum('paid_amount');
$paidIncomesCount = Income::whereBetween('income_date', [$currentMonthStart, $currentMonthEnd])
    ->where('payment_status', 'paid')->count();
$partialIncomesCount = Income::whereBetween('income_date', [$currentMonthStart, $currentMonthEnd])
    ->where('payment_status', 'partial')->count();
$unpaidIncomesCount = Income::whereBetween('income_date', [$currentMonthStart, $currentMonthEnd])
    ->where('payment_status', 'unpaid')->count();
```

#### Added to View Data
```php
'totalPaidAmount',
'paidIncomesCount',
'partialIncomesCount',
'unpaidIncomesCount',
```

### 2. dashboard.blade.php

#### Updated Receivables Card
**Added:**
- Count of unpaid incomes
- Count of partial payment incomes
- Small text under the value showing breakdown

```php
<div class="stat-card">
    <h3>Current Month Receivables</h3>
    <div class="value info">Rs {{ number_format($customerReceivables ?? 0) }}</div>
    <small style="color: #666; font-size: 12px; margin-top: 5px;">
        Unpaid: {{ $unpaidIncomesCount ?? 0 }} | Partial: {{ $partialIncomesCount ?? 0 }}
    </small>
</div>
```

#### Updated Recent Incomes Table
**Added Columns:**
- Paid Amount (blue color)
- Payment Status (badge with color coding)

**Before:** 5 columns (Date, Customer, Item, Amount, Status)
**After:** 7 columns (Date, Customer, Item, Amount, Paid, Payment Status, Status)

**Payment Status Badges:**
- ✓ Paid (green background)
- ◐ Partial (yellow background)
- ✗ Unpaid (red background)

```php
<td>
    @if($income->payment_status == 'paid')
        <span class="badge" style="background: #d1fae5; color: #047857;">✓ Paid</span>
    @elseif($income->payment_status == 'partial')
        <span class="badge" style="background: #fef3c7; color: #92400e;">◐ Partial</span>
    @else
        <span class="badge" style="background: #fee2e2; color: #991b1b;">✗ Unpaid</span>
    @endif
</td>
```

## Benefits

### 1. Accurate Receivables Calculation
- Shows only actual unpaid and partially paid amounts
- Excludes fully paid incomes automatically
- Uses database field instead of calculation

### 2. Better Visibility
- Dashboard shows breakdown: "Unpaid: 2 | Partial: 3"
- Recent incomes table shows payment status for each transaction
- Color-coded badges make it easy to identify payment issues

### 3. Real-time Accuracy
- As payments are made, receivables automatically decrease
- No need to manually track customer payments separately
- Single source of truth (incomes table)

## Example Output

### Dashboard Card
```
Current Month Receivables
Rs 6,500
Unpaid: 2 | Partial: 1
```

### Recent Incomes Table
| Date | Customer | Item | Amount | Paid | Payment Status | Status |
|------|----------|------|--------|------|---------------|---------|
| 05 Nov 2025 | Ahmed Khan | Visa | Rs 7,000 | Rs 500 | ◐ Partial | Completed |
| 04 Nov 2025 | Sarah Ali | Ticket | Rs 5,000 | Rs 5,000 | ✓ Paid | Completed |
| 03 Nov 2025 | Omar Syed | Hotel | Rs 3,000 | Rs 0 | ✗ Unpaid | Pending |

## Testing

To test the changes:

1. **Create an income with partial payment:**
   - Amount: Rs 7,000
   - Paid: Rs 500
   - Check dashboard shows Rs 6,500 in receivables

2. **Create an unpaid income:**
   - Amount: Rs 3,000
   - Paid: Rs 0
   - Check receivables increases by Rs 3,000

3. **Mark an income as fully paid:**
   - Edit existing income
   - Set Paid = Total Amount
   - Check receivables decreases accordingly

4. **Check breakdown counts:**
   - Verify "Unpaid: X | Partial: Y" matches actual count
   - Check Recent Incomes table shows correct badges

## Files Modified

1. `app/Http/Controllers/DashboardController.php`
   - Updated receivables calculation
   - Added payment status breakdown queries
   - Added new variables to view data

2. `resources/views/dashboard.blade.php`
   - Added payment breakdown to receivables card
   - Added Paid column to recent incomes table
   - Added Payment Status column with badges
   - Updated colspan from 5 to 7

## Notes

- The receivables calculation now depends on the `payment_status` field being accurate
- The `updatePaymentStatus()` method in Income model ensures automatic updates
- All existing incomes will need to have their payment status updated if migrating from old system
