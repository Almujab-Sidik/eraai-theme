/**
 * AJAX Category Filter and Load More pagination
 */
document.addEventListener('DOMContentLoaded', function () {
    const filterGrid = document.querySelector('.blog-grid');
    const tabs = document.querySelectorAll('.blog-filter-tab');
    const loadMoreBtn = document.getElementById('blog-load-more');
    const spinner = document.querySelector('.blog-loader-spinner');

    if (!filterGrid || !loadMoreBtn) return;

    let currentPage = 1;
    let currentCategory = 'all';
    let isLoading = false;

    // Helper to fetch posts
    async function fetchPosts(isLoadMore = false) {
        if (isLoading) return;
        isLoading = true;

        // Show spinner & disable button
        spinner.style.display = 'inline-block';
        loadMoreBtn.disabled = true;
        loadMoreBtn.textContent = 'Memuat...';

        if (!isLoadMore) {
            filterGrid.style.opacity = '0.5';
        }

        try {
            const formData = new FormData();
            formData.append('action', 'load_more_posts');
            formData.append('page', currentPage);
            formData.append('category', currentCategory);

            const response = await fetch(eraai_ajax.ajax_url, {
                method: 'POST',
                body: formData
            });

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const html = await response.text();
            
            // Trim the response to check if it's empty
            const trimmedHtml = html.trim();

            if (isLoadMore) {
                if (trimmedHtml === '') {
                    loadMoreBtn.style.display = 'none';
                } else {
                    filterGrid.insertAdjacentHTML('beforeend', trimmedHtml);
                    
                    // Count added elements to hide load more button if less than 6 were returned
                    const tempDiv = document.createElement('div');
                    tempDiv.innerHTML = trimmedHtml;
                    const cardCount = tempDiv.querySelectorAll('.card').length;
                    if (cardCount < 6) {
                        loadMoreBtn.style.display = 'none';
                    } else {
                        loadMoreBtn.style.display = 'inline-flex';
                    }
                }
            } else {
                filterGrid.innerHTML = trimmedHtml;
                
                const tempDiv = document.createElement('div');
                tempDiv.innerHTML = trimmedHtml;
                const cardCount = tempDiv.querySelectorAll('.card').length;
                
                if (trimmedHtml === '' || cardCount < 6) {
                    loadMoreBtn.style.display = 'none';
                } else {
                    loadMoreBtn.style.display = 'inline-flex';
                }
            }

            // Animate card entry
            const cards = filterGrid.querySelectorAll('.card');
            cards.forEach(card => {
                if (!card.classList.contains('is-filtered')) {
                    card.classList.add('is-filtered');
                }
            });

        } catch (error) {
            console.error('Error fetching posts:', error);
            if (!isLoadMore) {
                filterGrid.innerHTML = '<p class="error-msg">Gagal memuat artikel. Silakan coba lagi.</p>';
            }
        } finally {
            isLoading = false;
            filterGrid.style.opacity = '1';
            spinner.style.display = 'none';
            loadMoreBtn.disabled = false;
            loadMoreBtn.textContent = 'Lihat Lebih Banyak';
        }
    }

    // Select selectors
    const selectAllCheckbox = document.getElementById('category-select-all');
    const categoryCheckboxes = document.querySelectorAll('.blog-category-checkbox');
    const mobileToggleBtn = document.getElementById('blog-mobile-filter-toggle');
    const sidebar = document.getElementById('blog-sidebar');
    const sidebarCloseBtn = document.getElementById('blog-sidebar-close');
    const sidebarOverlay = document.getElementById('blog-sidebar-overlay');

    // Helper to calculate and apply filters
    function updateFilters() {
        if (selectAllCheckbox && selectAllCheckbox.checked) {
            currentCategory = 'all';
        } else {
            const checkedSlugs = [];
            categoryCheckboxes.forEach(cb => {
                if (cb.checked) {
                    checkedSlugs.push(cb.value);
                }
            });

            if (checkedSlugs.length === 0) {
                // If nothing checked, default back to Select All
                if (selectAllCheckbox) selectAllCheckbox.checked = true;
                currentCategory = 'all';
            } else {
                currentCategory = checkedSlugs.join(',');
            }
        }
        currentPage = 1;
        fetchPosts(false);
    }

    // Select All Change Handler
    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', function () {
            if (this.checked) {
                // Uncheck all other checkboxes
                categoryCheckboxes.forEach(cb => cb.checked = false);
            }
            updateFilters();
        });
    }

    // Category Checkboxes Change Handler
    categoryCheckboxes.forEach(cb => {
        cb.addEventListener('change', function () {
            if (this.checked) {
                // Uncheck Select All
                if (selectAllCheckbox) selectAllCheckbox.checked = false;
            }
            updateFilters();
        });
    });

    // Mobile Sidebar Drawer Toggles
    if (mobileToggleBtn && sidebar && sidebarOverlay) {
        mobileToggleBtn.addEventListener('click', function () {
            sidebar.classList.add('open');
            sidebarOverlay.classList.add('open');
            document.body.style.overflow = 'hidden'; // prevent background scrolling
        });

        const closeSidebar = function () {
            sidebar.classList.remove('open');
            sidebarOverlay.classList.remove('open');
            document.body.style.overflow = '';
        };

        if (sidebarCloseBtn) sidebarCloseBtn.addEventListener('click', closeSidebar);
        sidebarOverlay.addEventListener('click', closeSidebar);
    }

    // Load More click handler
    loadMoreBtn.addEventListener('click', function () {
        if (isLoading) return;
        currentPage++;
        fetchPosts(true);
    });
});
