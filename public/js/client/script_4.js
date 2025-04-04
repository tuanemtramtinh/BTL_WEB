document.addEventListener('DOMContentLoaded', function() {
  let currentRequest = null;

  function handleFilter() {
    if (currentRequest) currentRequest.abort();

    const spinner = document.createElement('div');
    spinner.className = 'loading-spinner';
    spinner.innerHTML = '⏳ Loading...';
    document.body.appendChild(spinner);

    const searchValue = document.getElementById('search-input').value;
    const activeCategory = document.querySelector('.blog__search-item.active');
    const category = activeCategory ? activeCategory.dataset.categoryId : '';
    const page = new URLSearchParams(window.location.search).get('page') || 1;

    const url = new URL(window.location.href);
    url.searchParams.set('search', searchValue);
    url.searchParams.set('category', category);
    url.searchParams.set('page', page);

    currentRequest = fetch(url)
      .then(response => response.text())
      .then(html => {
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');
        
        document.querySelector('.blog__posts').innerHTML = doc.querySelector('.blog__posts').innerHTML;
        document.querySelector('.pagination-custom').innerHTML = doc.querySelector('.pagination-custom').innerHTML;
        document.querySelector('.blog__search-list').innerHTML = doc.querySelector('.blog__search-list').innerHTML;
        
        AOS.refresh();
      })
      .catch(err => { if (!err.name === 'AbortError') console.error(err) })
      .finally(() => {
        document.body.removeChild(spinner);
        currentRequest = null;
      });
  }

  const debounce = (func, delay) => {
    let timeout;
    return (...args) => {
      clearTimeout(timeout);
      timeout = setTimeout(() => func.apply(this, args), delay);
    };
  };

  document.getElementById('search-input').addEventListener('input', debounce(handleFilter, 500));

  document.body.addEventListener('click', e => {
    if (e.target.closest('.blog__search-item')) {
      document.querySelectorAll('.blog__search-item').forEach(i => i.classList.remove('active'));
      e.target.closest('.blog__search-item').classList.add('active');
      handleFilter();
    }
  });

  document.body.addEventListener('click', e => {
    if (e.target.closest('.clear-filter')) {
      document.querySelectorAll('.blog__search-item').forEach(i => i.classList.remove('active'));
      handleFilter();
    }
  });

  document.body.addEventListener('click', e => {
    const target = e.target.closest('.pagination-button');
    if (target && !target.classList.contains('disabled')) {
      e.preventDefault();
      window.history.pushState({}, '', target.href);
      handleFilter();
    }
  });

  window.addEventListener('popstate', handleFilter);
});