# Reusable Header Components

## Overview
Created reusable Blade components to simplify page creation and maintain consistency across the application.

## Components Created

### 1. Layout Component (`<x-layout>`)
**Location:** `resources/views/components/layout.blade.php`

Main wrapper for all pages. Includes common styles, responsive CSS, and mobile menu JavaScript.

**Usage:**
```blade
<x-layout title="Page Title - Al Nafi Travels">
    <!-- Your page content here -->
</x-layout>
```

**Props:**
- `title` (optional): Browser tab title

### 2. Page Header Component (`<x-page-header>`)
**Location:** `resources/views/components/page-header.blade.php`

Consistent header with navigation menu, page title, and optional action button.

**Usage:**
```blade
<!-- Index page with Add button -->
<x-page-header 
    title="Customers" 
    icon="👥" 
    actionUrl="/customers/create" 
    actionText="+ Add Customer" 
/>

<!-- Create/Edit page without Add button -->
<x-page-header 
    title="Add New Customer" 
    icon="➕" 
    backUrl="/customers"
/>
```

**Props:**
- `title` (required): Page title text
- `icon` (optional): Emoji icon for the title (default: 📄)
- `backUrl` (optional): URL for back navigation (default: /)
- `actionUrl` (optional): URL for action button (e.g., Add button)
- `actionText` (optional): Text for action button (default: '+ Add')

## Mobile Features

### Header Layout (Mobile):
```
[Action Button] | Page Title | [☰ Menu]
```

### Navigation Menu:
- **Desktop:** Horizontal menu below title
- **Mobile:** Hidden, accessed via hamburger (☰) icon
- Slides in from right side (70% width)
- List-style display with dividers

## Example Pages

### Index Page Example:
```blade
<x-layout title="Customers - Al Nafi Travels">
    <x-page-header 
        title="Customers" 
        icon="👥" 
        actionUrl="/customers/create" 
        actionText="+ Add Customer" 
    />

    <div class="card">
        <table>
            <!-- Your table content -->
        </table>
    </div>
</x-layout>
```

### Create/Edit Page Example:
```blade
<x-layout title="Add Customer - Al Nafi Travels">
    <x-page-header 
        title="Add New Customer" 
        icon="➕" 
        backUrl="/customers"
    />

    <div class="card">
        <form action="/customers" method="POST">
            @csrf
            <!-- Your form fields -->
            
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">💾 Save</button>
                <a href="/customers" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</x-layout>
```

## Migration Guide

### Converting Existing Pages:

**Before:**
```blade
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers - Al Nafi Travels</title>
    <link rel="stylesheet" href="/css/responsive.css">
    <style>
        /* ... lots of repeated styles ... */
    </style>
</head>
<body>
    <div class="container">
        <header>
            <div>
                <h1>👥 Customers</h1>
                <nav>
                    <a href="/">🏠 Dashboard</a>
                    <!-- ... more nav links ... -->
                </nav>
            </div>
            <a href="/customers/create" class="btn btn-success">+ Add Customer</a>
        </header>

        <div class="card">
            <!-- content -->
        </div>
    </div>
    <script src="/js/mobile-menu.js"></script>
</body>
</html>
```

**After:**
```blade
<x-layout title="Customers - Al Nafi Travels">
    <x-page-header 
        title="Customers" 
        icon="👥" 
        actionUrl="/customers/create" 
        actionText="+ Add Customer" 
    />

    <div class="card">
        <!-- content -->
    </div>
</x-layout>
```

## Benefits

1. **Consistency:** All pages use the same header structure
2. **Maintainability:** Update header in one place, affects all pages
3. **Less Code:** Reduced boilerplate from ~80 lines to ~10 lines
4. **Mobile Ready:** Automatically includes responsive CSS and mobile menu
5. **Easy Updates:** Change navigation links in one component

## Available CSS Classes

- `.container` - Main page wrapper
- `.card` - White content card with shadow
- `.btn` - Base button class
- `.btn-primary` - Blue button
- `.btn-success` - Green button
- `.btn-danger` - Red button
- `.btn-secondary` - Gray button
- `.form-group` - Form field wrapper
- `.form-actions` - Form button container
- `.badge` - Status badge
- `.badge-success`, `.badge-danger`, `.badge-warning` - Badge variants

## Next Steps

To update existing pages:
1. Replace DOCTYPE and all <head> content with `<x-layout>`
2. Replace header section with `<x-page-header>`
3. Remove closing HTML tags, use `</x-layout>` instead
4. Keep only the main content (cards, tables, forms)

Example files created:
- `resources/views/customers/index-new.blade.php` (index page)
- `resources/views/customers/create-new.blade.php` (create page)

Test these files and once confirmed working, you can:
1. Backup originals
2. Replace old files with new versions
3. Apply same pattern to all other pages
