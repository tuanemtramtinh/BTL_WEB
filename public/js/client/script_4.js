document.addEventListener('DOMContentLoaded', function () {
  let currentController = null;

  function handleFilter() {
    if (currentController) currentController.abort();

    currentController = new AbortController();
    const { signal } = currentController;

    const spinner = document.createElement('div');
    spinner.className = 'loading-spinner';
    spinner.innerHTML = 'Loading...';
    document.body.appendChild(spinner);

    const searchValue = document.getElementById('search-input').value;
    const activeCategory = document.querySelector('.blog__search-item.active');
    const category = activeCategory ? activeCategory.dataset.categoryId : '';
    const page = new URLSearchParams(window.location.search).get('page') || 1;

    const url = new URL(window.location.href);
    url.searchParams.set('search', searchValue);
    url.searchParams.set('category', category);
    url.searchParams.set('page', page);

    fetch(url, { signal })
      .then(response => response.text())
      .then(html => {
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');

        document.querySelector('.blog__posts').innerHTML = doc.querySelector('.blog__posts').innerHTML;
        const paginationElement = document.querySelector('.pagination-custom');
        if (paginationElement) {
            paginationElement.innerHTML = doc.querySelector('.pagination-custom').innerHTML;
        } else {
            // console.error('Element with class "pagination-custom" not found in the DOM');
        }
        document.querySelector('.blog__search-list').innerHTML = doc.querySelector('.blog__search-list').innerHTML;

        AOS.refresh();
      })
      .catch(err => {
        if (err.name !== 'AbortError') console.log(err);
      })
      .finally(() => {
        document.body.removeChild(spinner);
        currentController = null;
      });
  }

  const debounce = (func, delay) => {
    let timeout;
    return (...args) => {
      clearTimeout(timeout);
      timeout = setTimeout(() => func.apply(this, args), delay);
    };
  };

  if (document.getElementById('search-input')){
    document.getElementById('search-input').addEventListener('keydown', function (e) {
      if (e.key === 'Enter') {
        e.preventDefault();
        handleFilter();
      }
    });
    
  }

  // document.getElementById('search-input').addEventListener('input', debounce(handleFilter, 100));

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

function copyPostLink() {
  const url = window.location.href;
  navigator.clipboard.writeText(url)
      .then(() => {
          const notify = document.querySelector('.detail__share-notify');
          notify.style.display = 'inline';
          setTimeout(() => {
              notify.style.display = 'none';
          }, 2000);
      })
      .catch(err => {
          console.log('Failed to copy: ', err);
      });
}

document.addEventListener("DOMContentLoaded", function() {
  const commentForm = document.getElementById('commentForm');
  const flashMessage = document.querySelector(".wrapper");
  if (commentForm && flashMessage) {
    commentForm.addEventListener('submit', function(event) {
      event.preventDefault(); 

      const formData = new FormData(commentForm);

      fetch(commentForm.action, {
          method: 'POST',
          body: formData,
          headers: {
              'X-Requested-With': 'XMLHttpRequest'
          }
      })
      .then(response => response.json())
      .then(data => {
        flashMessage.insertAdjacentHTML('beforeend', `
                                      <div class="alert ${data.success ? 'success' : 'error'}" style="display: block">
                                        <span class="closebtn">×</span>
                                        ${data.message}
                                      </div>
                                    `);
          // <div class="alert success" style="opacity: 0; display: none;">
          // <span class="closebtn">×</span>Login Successfully</div>
          // console.log(data.message);
          if (data.success) {
              commentForm.reset();
          }
          setTimeout(() => {
              const alert = document.querySelector('.alert');
              alert.style.display = 'none';
              alert.remove();
          }, 3000);
      })
      .catch(err => {
          console.error('Error:', err);
          flashMessage.insertAdjacentHTML('beforeend', `<div class="alert danger" style="display: block">
                                        <span class="closebtn">×</span>
                                        An error occurred. Please try again.
                                    </div>`);
          setTimeout(() => {
            const alert = document.querySelector('.alert');
            alert.style.display = 'none';
            alert.remove();
          }, 3000);
      });
  });
  }
  
});


document.querySelectorAll('.react-toggle').forEach(radio => {
  const flashMessage = document.querySelector(".wrapper");
  radio.addEventListener('click', function() {
      const commentId = this.getAttribute('data-id');
      const action = this.getAttribute('data-action'); 
      

      const bodyData = `commentId=${commentId}&likeStatus=${action}`;
      // console.log("Body Data:", bodyData);

      // console.log(`commentId=${commentId}&likeStatus=${action}`)
      fetch("http://localhost/BTL_WEB/blog/toggleLike", {
          method: 'POST',
          headers: {
              'Content-Type': 'application/x-www-form-urlencoded'
          },
          body: `commentId=${commentId}&likeStatus=${action}`
      })
      .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
      })
      .then(data => {
        flashMessage.insertAdjacentHTML('beforeend', `
          <div class="alert ${data.success ? 'success' : 'error'}" style="display: block">
            <span class="closebtn">×</span>
            ${data.message}
          </div>
        `);
        setTimeout(() => {
          const alert = document.querySelector('.alert');
          alert.style.display = 'none';
          alert.remove();
        }, 3000);
          if (data.success) {
              document.getElementById(`like-count-${commentId}`).textContent = data.likes;
              document.getElementById(`dislike-count-${commentId}`).textContent = data.dislikes;

              document.getElementById(`like-label-${commentId}`).classList.remove('active');
              document.getElementById(`dislike-label-${commentId}`).classList.remove('active');

              if (data.status === 1) {
                  document.getElementById(`like-label-${commentId}`).classList.add('active');
              } else if (data.status === 0) {
                  document.getElementById(`dislike-label-${commentId}`).classList.add('active');
              }
          } else {
              alert(data.message);
          }
      })
      .catch(err => {
        console.error('Error:', err);
          flashMessage.insertAdjacentHTML('beforeend', `<div class="alert danger" style="display: block">
                                        <span class="closebtn">×</span>
                                        Please check your login!
                                    </div>`);
          setTimeout(() => {
            const alert = document.querySelector('.alert');
            alert.style.display = 'none';
            // alert.remove();
          }, 3000);
          // console.error('Error:', err);
          // alert('An error occurred. Please try again.');
      });
  });
});
