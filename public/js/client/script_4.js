(() => {
  let currentController = null;

  const spinner = document.createElement('div');
  spinner.id = 'loading-spinner';
  spinner.className = 'loading-spinner';
  spinner.textContent = 'Loading...';
  spinner.style.display = 'none';
  document.body.appendChild(spinner);

  function debounce(fn, delay) {
    let timer = null;
    return (...args) => {
      clearTimeout(timer);
      timer = setTimeout(() => fn.apply(this, args), delay);
    };
  }

  function showFlash(message, type = 'success') {
    const wrapper = document.querySelector('.wrapper');
    if (!wrapper) return;

    const alert = document.createElement('div');
    alert.className = `alert ${type}`;
    alert.style.display = 'block';

    const closeBtn = document.createElement('span');
    closeBtn.className = 'closebtn';
    closeBtn.textContent = '×';
    closeBtn.addEventListener('click', () => alert.remove());
    alert.appendChild(closeBtn);

    const text = document.createElement('span');
    text.textContent = message;
    alert.appendChild(text);

    wrapper.appendChild(alert);
    setTimeout(() => alert.remove(), 3000);
  }

  function handleFilter() {
    if (currentController) currentController.abort();
    currentController = new AbortController();
    const { signal } = currentController;

    spinner.style.display = 'block';

    const searchValue = document.getElementById('search-input')?.value.trim() || '';
    const activeItem = document.querySelector('.blog__search-item.active');
    const category = activeItem?.dataset.categoryId || '';
    const page = new URLSearchParams(window.location.search).get('page') || 1;

    const url = new URL(window.location.href);
    url.searchParams.set('search', searchValue);
    url.searchParams.set('category', category);
    url.searchParams.set('page', page);

    fetch(url, { signal })
      .then(resp => resp.ok ? resp.text() : Promise.reject(resp.statusText))
      .then(html => {
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');

        document.querySelector('.blog__posts').innerHTML = doc.querySelector('.blog__posts').innerHTML;
        const pag = document.querySelector('.pagination-custom');
        if (pag && doc.querySelector('.pagination-custom')) {
          pag.innerHTML = doc.querySelector('.pagination-custom').innerHTML;
        }
        document.querySelector('.blog__search-list').innerHTML = doc.querySelector('.blog__search-list').innerHTML;

        AOS.refresh();
      })
      .catch(err => {
        if (err.name !== 'AbortError') console.error('Filter error:', err);
      })
      .finally(() => {
        spinner.style.display = 'none';
        currentController = null;
      });
  }

  window.handleFilter = handleFilter;

  function copyPostLink() {
    navigator.clipboard.writeText(window.location.href)
      .then(() => {
        const notify = document.querySelector('.detail__share-notify');
        if (notify) {
          notify.style.display = 'inline';
          setTimeout(() => { notify.style.display = 'none'; }, 2000);
        } else {
          showFlash('Link copied to clipboard.', 'success');
        }
      })
      .catch(err => console.error('Copy failed:', err));
  }

  window.copyPostLink = copyPostLink;

  function init() {
    const searchInput = document.getElementById('search-input');

    if (searchInput) {
      searchInput.addEventListener('keydown', e => {
        if (e.key === 'Enter') {
          e.preventDefault();
          handleFilter();
        }
      });
      searchInput.addEventListener('input', debounce(handleFilter, 300));
    }

    document.body.addEventListener('click', e => {
      const target = e.target;

      const catItem = target.closest('.blog__search-item');
      if (catItem) {
        document.querySelectorAll('.blog__search-item.active').forEach(el => el.classList.remove('active'));
        catItem.classList.add('active');
        handleFilter();
        return;
      }

      if (target.closest('.clear-filter')) {
        document.querySelectorAll('.blog__search-item.active').forEach(el => el.classList.remove('active'));
        if (searchInput) searchInput.value = '';
        handleFilter();
        return;
      }

      const pageBtn = target.closest('.pagination-button');
      if (pageBtn && !pageBtn.classList.contains('disabled')) {
        e.preventDefault();
        window.history.pushState({}, '', pageBtn.href);
        handleFilter();
        return;
      }

      if (target.closest('.detail__share-btn') || target.matches('.copy-link-btn')) {
        copyPostLink();
        return;
      }

      const toggle = target.closest('.react-toggle');
      if (toggle) {
        const commentId = toggle.dataset.id;
        const action = toggle.dataset.action;
        const bodyData = `commentId=${commentId}&likeStatus=${action}`;

        fetch('blog/toggleLike', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: bodyData
        })
          .then(res => res.ok ? res.json() : Promise.reject(res.statusText))
          .then(data => {
            showFlash(data.message, data.success ? 'success' : 'danger');
            if (data.success) {
              document.getElementById(`like-count-${commentId}`).textContent = data.likes;
              document.getElementById(`dislike-count-${commentId}`).textContent = data.dislikes;
              document.getElementById(`like-label-${commentId}`).classList.toggle('active', data.status === 1);
              document.getElementById(`dislike-label-${commentId}`).classList.toggle('active', data.status === 0);
            }
          })
          .catch(() => showFlash('Please check your login!', 'danger'));
        return;
      }

      const catLink = target.closest('.category-link');
      if (catLink) {
        sessionStorage.setItem('selectedCategory', catLink.dataset.category);
        window.location.href = '/BTL_WEB/blog';
      }
    });

    const shareBtn = document.querySelector('.detail__share-btn');
    if (shareBtn) {
      shareBtn.addEventListener('click', copyPostLink);
    }

    const commentForm = document.getElementById('commentForm');
    if (commentForm) {
      commentForm.addEventListener('submit', e => {
        e.preventDefault();
        const formData = new FormData(commentForm);
        fetch(commentForm.action, {
          method: 'POST',
          body: formData,
          headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
          .then(res => res.json())
          .then(data => {
            showFlash(data.message, data.success ? 'success' : 'danger');
            if (data.success) commentForm.reset();
          })
          .catch(() => showFlash('Please wait for comment approval.', 'success'));
      });
    }

    window.addEventListener('popstate', handleFilter);
  }

  document.addEventListener('DOMContentLoaded', init);
})();

document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('.category-link').forEach(link => {
    link.addEventListener('click', function () {
      const category = this.dataset.category;
      sessionStorage.setItem('selectedCategory', category);
      window.location.href = '/BTL_WEB/blog';
    });
  });
});

document.addEventListener('DOMContentLoaded', function () {
  const selected = sessionStorage.getItem('selectedCategory');
  if (selected) {
    const allItems = document.querySelectorAll('.blog__search-item');
    allItems.forEach(item => {
      if (item.dataset.categoryName === selected) {
        item.click();
      }
    });

    const postSection = document.querySelector('.blog__search-chua');
    if (postSection) {
      setTimeout(() => {
        postSection.scrollIntoView({ behavior: 'smooth' });
      }, 500);
    }

    sessionStorage.removeItem('selectedCategory');
  }
});

document.addEventListener('DOMContentLoaded', function () {
  const selectedCategory = sessionStorage.getItem('selectedCategory');
  if (selectedCategory) {
    const target = [...document.querySelectorAll('.blog__search-item')]
      .find(el => el.dataset.categoryId === selectedCategory);

    if (target) {
      target.classList.add('active');
      handleFilter();
    }

    sessionStorage.removeItem('selectedCategory');
  }
});