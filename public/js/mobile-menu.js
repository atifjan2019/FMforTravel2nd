// Mobile Menu Toggle Script
document.addEventListener('DOMContentLoaded', function() {
    // Check if we're on mobile
    if (window.innerWidth <= 768) {
        initMobileMenu();
    }
    
    // Reinitialize on window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth <= 768) {
            initMobileMenu();
        } else {
            cleanupMobileMenu();
        }
    });
});

function initMobileMenu() {
    const header = document.querySelector('header');
    const nav = document.querySelector('header nav');
    
    if (!header || !nav) return;
    
    // Check if mobile menu already exists
    if (document.querySelector('.mobile-menu-toggle')) return;
    
    // Restructure header for mobile if not already done
    if (!header.querySelector('.header-left')) {
        restructureHeader(header);
    }
    
    // Create hamburger menu button
    const hamburger = document.createElement('div');
    hamburger.className = 'mobile-menu-toggle';
    hamburger.innerHTML = '<span></span><span></span><span></span>';
    
    // Create overlay
    const overlay = document.createElement('div');
    overlay.className = 'mobile-menu-overlay';
    
    // Clone navigation and make it mobile menu
    const mobileNav = nav.cloneNode(true);
    mobileNav.classList.add('mobile-menu');
    
    // Create logo at top of mobile menu
    const logoDiv = document.createElement('div');
    logoDiv.className = 'mobile-menu-logo';
    logoDiv.innerHTML = '<img src="/images/alnafi.png" alt="Al Nafi Travels">';
    
    // Create close button
    const closeBtn = document.createElement('button');
    closeBtn.className = 'mobile-menu-close';
    closeBtn.innerHTML = '×';
    closeBtn.setAttribute('aria-label', 'Close menu');
    
    // Add logo and close button to mobile nav
    mobileNav.insertBefore(logoDiv, mobileNav.firstChild);
    mobileNav.insertBefore(closeBtn, mobileNav.firstChild);
    
    // Add hamburger to header-right
    const headerRight = header.querySelector('.header-right');
    if (headerRight) {
        headerRight.appendChild(hamburger);
    }
    
    // Append mobile menu and overlay to body
    document.body.appendChild(overlay);
    document.body.appendChild(mobileNav);
    
    // Toggle menu function
    function toggleMenu() {
        mobileNav.classList.toggle('active');
        overlay.classList.toggle('active');
        document.body.style.overflow = mobileNav.classList.contains('active') ? 'hidden' : '';
    }
    
    // Event listeners
    hamburger.addEventListener('click', toggleMenu);
    closeBtn.addEventListener('click', toggleMenu);
    overlay.addEventListener('click', toggleMenu);
    
    // Close menu when clicking a link
    const mobileLinks = mobileNav.querySelectorAll('a');
    mobileLinks.forEach(link => {
        link.addEventListener('click', function() {
            toggleMenu();
        });
    });
}

function restructureHeader(header) {
    // Get existing elements
    const title = header.querySelector('h1');
    const subtitle = header.querySelector('p');
    const nav = header.querySelector('nav');
    const addButton = header.querySelector('.btn-success, .btn-primary, a.btn');
    
    // Create structure
    const headerLeft = document.createElement('div');
    headerLeft.className = 'header-left';
    
    const headerCenter = document.createElement('div');
    headerCenter.className = 'header-center';
    
    const headerRight = document.createElement('div');
    headerRight.className = 'header-right';
    
    // Add Customer/Add button to left if exists
    if (addButton && window.innerWidth <= 768) {
        const clonedButton = addButton.cloneNode(true);
        clonedButton.textContent = '+ Add';
        headerLeft.appendChild(clonedButton);
        addButton.style.display = 'none';
    }
    
    // Add title to center
    if (title) {
        const clonedTitle = title.cloneNode(true);
        headerCenter.appendChild(clonedTitle);
        if (subtitle) {
            const clonedSubtitle = subtitle.cloneNode(true);
            headerCenter.appendChild(clonedSubtitle);
        }
    }
    
    // Clear header and add new structure
    header.innerHTML = '';
    header.appendChild(headerLeft);
    header.appendChild(headerCenter);
    header.appendChild(headerRight);
    
    // Re-add nav (will be hidden on mobile)
    if (nav) {
        header.appendChild(nav);
    }
}

function cleanupMobileMenu() {
    const hamburger = document.querySelector('.mobile-menu-toggle');
    const overlay = document.querySelector('.mobile-menu-overlay');
    const mobileNav = document.querySelector('.mobile-menu');
    
    if (hamburger) hamburger.remove();
    if (overlay) overlay.remove();
    if (mobileNav) mobileNav.remove();
    
    document.body.style.overflow = '';
}
